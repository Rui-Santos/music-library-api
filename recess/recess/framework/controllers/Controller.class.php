<?php
Library::import('recess.framework.AbstractController');

Library::import('recess.lang.Annotation');
Library::import('recess.framework.controllers.annotations.ViewAnnotation');
Library::import('recess.framework.controllers.annotations.RouteAnnotation');
Library::import('recess.framework.controllers.annotations.RoutesPrefixAnnotation');
Library::import('recess.framework.controllers.annotations.PrefixAnnotation');
Library::import('recess.framework.controllers.annotations.RespondsWithAnnotation');

Library::import('admin.models.adminlogs');
Library::import('admin.models.admindownloads');
Library::import('admin.models.adminsearches');
Library::import('admin.models.adminhosts');
Library::import('admin.models.adminbrowsers');
Library::import('admin.models.adminlogins');
Library::import('admin.models.adminqueries');
Library::import('admin.models.adminshares');
Library::import('admin.models.adminmessages');
Library::import('admin.models.adminusers');

/**
 * The controller is responsible for interpretting a preprocessed Request,
 * performing some action in response to the Request (usually CRUDS), and
 * returning a Response which contains relevant state for a view to render
 * the Response.
 * 
 * @author Kris Jordan <krisjordan@gmail.com>
 * @author Joshua Paine
 */
abstract class Controller extends AbstractController {
	
	const CLASSNAME = 'Controller';
	
	/** @var Request */
	protected $request;
	
	protected $headers;
	
	/** @var Application */
	protected $application;
		
	public function __construct($application = null) {
		$this->application = $application;
	}
	
	public function init() { }

	protected static function initClassDescriptor($class) {
		$descriptor = new ClassDescriptor();
		$descriptor->routes = array();
		$descriptor->methodUrls = array();
		$descriptor->routesPrefix = '';
		$descriptor->viewClass = 'LayoutsView';
		$descriptor->viewsPrefix = '';
		$descriptor->respondWith = array();
		return $descriptor;
	}

	protected static function shapeDescriptorWithMethod($class, $method, $descriptor, $annotations) {
		$unreachableMethods = array('serve','urlTo','__call','__construct','init','application');

		if(in_array($method->getName(), $unreachableMethods)) return $descriptor;
		
		if(	empty($annotations) && 
				$method->isPublic() && 
				!$method->isStatic()
			   ) {
			   	$parameters = $method->getParameters();
			   	$parameterNames = array();
			   	foreach($parameters as $parameter) {
			   		$parameterNames[] = '$' . $parameter->getName();
			   	}
			   	if(!empty($parameterNames)) {
			   		$parameterPath = '/' . implode('/',$parameterNames);
			   	} else {
			   		$parameterPath = '';
			   	}
				// Default Routing for Public Methods Without Annotations
				$descriptor->routes[] = 
					new Route(	$class, 
								$method->getName(), 
								Methods::GET, 
								$descriptor->routesPrefix . $method->getName() . $parameterPath);
		}
		return $descriptor;
	}

	/**
	 * urlTo is a helper method that returns the url to a controller method.
	 * Examples:
	 * 	$controller->urlTo('someMethod'); => /route/to/someMethod/
	 *  $controller->urlTo('someMethodOneParameter', 'param1');  =>  /route/to/someMethodOneParam/param1
	 *  $controller->urlTo('OtherController::otherMethod'); => Returns the route to another controller's method
	 *  
	 * Thanks to Joshua Paine for improving the API of urlTo!
	 * 
	 * @param $methodName
	 * @return string The url linking to controller method.
	 */
	public function urlTo($methodName) {
		$args = func_get_args();
		
		// First check to see if this is a urlTo on another Controller Class
		if(strpos($methodName,'::') !== false) {
		    return call_user_func_array(array($this->application,'urlTo'),$args);
		}		
    
    // Check to see if this urlTo contains args in the methodName
		// Ignores keys, assuming params are in the proper order.
		// Ex. $controller->urlTo("details?id=43")
		if(strpos($methodName,'?') !== false) {
		    list($methodName, $params) = explode('?', $methodName, 2);
			$args = empty($args)? explode('&',$params) : $args;
			foreach($args as $i => $arg) {
				$val = strpos($arg, '=') !== false ? substr($arg,strrpos($arg, '=')+1) : $arg;
				$args[$i] = $val;
			}
		}
		
		array_shift($args);
		$descriptor = Controller::getClassDescriptor($this);
		if(isset($descriptor->methodUrls[$methodName])) {
			$url = $descriptor->methodUrls[$methodName];
			if($url[0] != '/') {
				$url = $this->application->routingPrefix . $url;
			} else {
				$url = substr($url, 1);
			}
			
			if(!empty($args)) {
				$reflectedMethod = new ReflectionMethod($this, $methodName);
				$parameters = $reflectedMethod->getParameters();
				
				if(count($parameters) < count($args)) {
					throw new RecessException('urlTo(\'' . $methodName . '\') called with ' . count($args) . ' arguments, method "' . $methodName . '" takes ' . count($parameters) . '.', get_defined_vars());
				}
				
				$i = 0;
				$params = array();
				foreach($parameters as $parameter) {
					if(isset($args[$i])) $params[] = '$' . $parameter->getName();
					$i++;
				}
				$url = str_replace($params, $args, $url);
			}
			
			if(strpos($url, '$') !== false) { 
				throw new RecessException('Missing arguments in urlTo(' . $methodName . '). Provide values for missing arguments: ' . $url, get_defined_vars());
			}
			return trim($_ENV['url.base'] . $url);
		} else {
			throw new RecessException('No url for method ' . $methodName . ' exists.', get_defined_vars());
		}
	}
	
	/**
	 * The serve method is where inversion of control occurs which delegates
	 * control to another method in the controller.
	 * 
	 * The method name and arguments should have been extracted in the 
	 * preprocessing step. Here we ensure that the method exists and that all 
	 * required parameters are provided as arguments from the request string.
	 * 
	 * Call the method and return its response.
	 *
	 * @param DefaultRequest $request The HTTP request being served.
	 * 
	 * !Wrappable serve
	 */
	function wrappedServe(Request $request) {		
		$this->request = $request;
		
		$shortWiredResponse = $this->init();
		if($shortWiredResponse instanceof Response) {
				$shortWiredResponse->meta->viewClass = 'LayoutsView';
				$shortWiredResponse->meta->viewsPrefix = '';
				return $shortWiredResponse;
		}
		
		$methodName = $request->meta->controllerMethod;
		$methodArguments = $request->meta->controllerMethodArguments;
		$useAssociativeArguments = $request->meta->useAssociativeArguments;
		
		// Does method exist? Do arguments match?
		if (method_exists($this, $methodName)) {
			$method = new ReflectionMethod($this, $methodName);
			$parameters = $method->getParameters();
			
			$callArguments = array();
			try {
				if($useAssociativeArguments) {
					$callArguments = $this->getCallArgumentsAssociative($parameters, $methodArguments);
				} else {
					$callArguments = $this->getCallArgumentsSequential($parameters, $methodArguments);
				}
			} catch(RecessException $e) {
				throw new RecessException('Error calling method "' . $methodName . '" in "' . get_class($this) . '". ' . $e->getMessage(), array());
			}
			
			$response = $method->invokeArgs($this, $callArguments);
		} else {
			throw new RecessException('Error calling method "' . $methodName . '" in "' . get_class($this) . '". Method does not exist.', array());
		}

		if(!$response instanceof Response) {
			Library::import('recess.http.responses.OkResponse');
			$response = new OkResponse($this->request);
		}
		
		$descriptor = self::getClassDescriptor($this);
		if(!$response instanceof ForwardingResponse && 
		   !isset($response->meta->viewName)) $response->meta->viewName = $methodName;
		// TODO: Remove this deprecated viewClass at 0.3
		$response->meta->viewClass = $descriptor->viewClass;
		$response->meta->viewsPrefix = $descriptor->viewsPrefix;
		
		$response->meta->respondWith = $descriptor->respondWith;
		if(empty($response->data)) $response->data = get_object_vars($this);

		if(is_array($this->headers)) { foreach($this->headers as $header) $response->addHeader($header); }
		
		if(is_array($response->data)) {
			$response->data['controller'] = $this;
			unset($response->data['request']);
			unset($response->data['headers']);
		}
		return $response;
	}

	private function getCallArgumentsAssociative($parameters, $arguments) {
		$callArgs = array();
		foreach($parameters as $parameter) {
			if(!isset($arguments[$parameter->getName()])) {
				if(!$parameter->isOptional()) {
					throw new RecessException('Expects ' . count($parameters) . ' arguments, given ' . count($arguments) . ' and missing required parameter: "' . $parameter->name . '"', array());
				}
			} else {
				$callArgs[] = $arguments[$parameter->getName()];
			}
		}
		return $callArgs;
	}

	private function getCallArgumentsSequential($parameters, $arguments) {
		$callArgs = array();
		$parameterCount = count($parameters);
		for($i = 0; $i < $parameterCount; $i++) {
			if(!isset($arguments[$i])) {
				if(!$parameters[$i]->isOptional()) {
					throw new RecessException('Expects ' . count($parameters) . ' arguments, given ' . count($arguments) . ' and missing required parameter # ' . ($i + 1) . ' named: "' . $parameters[$i]->name . '"', array());
				}
			} else {
				$callArgs[] = $arguments[$i];
			}
		}
		return $callArgs;
	}

	public function application() {
		return $this->application;
	}
	
	public function readfile_chunked($filename,$retbytes=true) {
		$chunksize = 1*(1024*1024); // how many bytes per chunk
		$buffer = '';
		$cnt =0;
		// $handle = fopen($filename, 'rb');
		$handle = fopen($filename, 'rb');
		if ($handle === false) {
			return false;
		}
		while (!feof($handle)) {
			$buffer = fread($handle, $chunksize);
			echo $buffer;
			ob_flush();
			flush();
			if ($retbytes) {
				$cnt += strlen($buffer);
			}
		}
		$status = fclose($handle);
		if ($retbytes && $status) {
	//       return $cnt; // return num. bytes delivered like readfile() does.
		}
		return $status;
	}
	
	public function imgGen($m, $size, $path, $artist=false) {
		$cachepath = "/PATH/GOES/HERE/api/img_cache/".$path;
		if($artist) {
			$file = $cachepath . $m->filename . "_full.jpg";
		 	$full = $cachepath . $m->filename . "_full.jpg"; 
		 	$sizepath = $cachepath . $m->filename . "_".$size.".jpg";
		} else {
			$file = $cachepath . "image_full_" . $m->RecID . ".jpg";
		 	$full = $cachepath . 'image_full_'.$m->RecID.'.jpg'; 
		 	$sizepath = $cachepath . "image_" . $size . "_" . $m->RecID . ".jpg";
		}
		if( !file_exists( $file ) ) {
/* 			$data = $this->mpart->equal('RecID',$recid)->first(); */
	 		$fp = fopen( $full, 'wb' ); 
	 		fwrite( $fp, $m->Picture ); 
	 		fclose($fp); 
		}
		if ($size == 0) return true;
		else {
			if (file_exists($sizepath)) return true;
			else {
 				$fsize = getimagesize($full); 
		 		$imageFull = imagecreatefromjpeg($full); 
		 		$msize = $fsize[0] > $size ? $size : $fsize[0]; 
		 		$msize = $fsize[1] > $size ? $size : $fsize[1]; 
		 		$imageMeta = imagecreatetruecolor($msize, $msize); 
		 		imagecopyresampled( $imageMeta, $imageFull, 0, 0, 0, 0, $msize, $msize, $fsize[0], $fsize[1] ); 
		 		imagejpeg( $imageMeta, $sizepath, 90 ); 
		 		imagedestroy($imageMeta);
			}
		}
	}
	
	public function digest() {
		$digestArray = array();
		if($_SERVER['PHP_AUTH_USER']) {
			$digestArray['username'] =$_SERVER['PHP_AUTH_USER'];
/*
			$a1 = explode(', ', $_SERVER['PHP_AUTH_USER']);
			foreach($a1 as $b) {
				//print $b.'<br/>';
				$b = str_replace('"', '', $b);
				$t = substr($b, 0, strpos($b, '='));
				$v = strrchr($b, '=');
				$v = substr($v, 1);
				$digestArray[$t] = $v;
			}
*/
		} else {
			$digestArray['username'] = 'no-auth';
		}

		return $digestArray;
	}

	public $apollo = true;
	
	public function getInput() {
		if(empty($this->request->post)) {
			$input = json_decode($this->request->input, true);
		} else {
			$input = $this->request->post;
		}
		return $input;
	}
	
	public function doLog($event,$data=false,$user=false) {
		//set variables
		$input = $this->getInput();
		$time = time();
		if(!$user) {
    		$user = new adminusers();
    		$user->key = !empty($this->request->headers['USER']) ? $this->request->headers['USER'] : 0;
    		if($user->exists()) {
        		$user_id = $user->id;
    		} else {
        		$user_id = 2;
    		}    		
		} else {
    		$user_id = $user->id;
		}
		
/* 		$user_id = $this->request->headers['USER'] == 'guest' ? $input['user_id'] : 0; */
		if($_SERVER['HTTP_USER_AGENT'] == 'api-curl') {
		    $hostIP = $this->request->headers['HOSTIP'];
    		$userAgent = $this->request->headers['USERAGENT'];
		} else {
		    $hostIP = $_SERVER['REMOTE_ADDR'];
    		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		
		$d = $this->digest();
		if ($d['username'] == 'apitester') {
			$source = 'www.thedinermusic.com';
		} else {
			$source = $d['username'];
		}
		
		// log host if new
		$hostName = gethostbyaddr($hostIP);
		
		$host = new adminhosts();
		$host->ip = $hostIP;
		$host->name = $hostName;
		if ($host->exists()) {
			$hostID = $host->id;
		} else {
			$host->save();
			$hostID = $host->id;			
		}

		// log browser if new
		$browser = new adminbrowsers();
		$browser->user_agent = $userAgent;
		if ($browser->exists()) {
			$browserID = $browser->id;
		} else {
			$browserInfo = get_browser($userAgent);
			$browser->browser = $browserInfo->browser;
			$browser->version = $browserInfo->version;
			$browser->version_maj = $browserInfo->majorver;
			$browser->version_min = $browserInfo->minorver;
			$browser->platform = $browserInfo->platform;
			$browser->save();
			$browserID = $browser->id;
		
		}
		$adminlogs = new adminlogs();
		$adminlogs->time = $time;
		$adminlogs->event = $event;
		$adminlogs->user_id = $user_id;
		$adminlogs->host_id = $hostID;
		$adminlogs->browser_id = $browserID;
		$adminlogs->source = $source;
		$adminlogs->save();
		
		$log_id = $adminlogs->id;

		switch ($event) {
		
			case "search":
			case "simple-search":
/* 			if ($event == "search" || $event == "simple-search") { */
			
				$query = $data['query'];
				$results = $data['results'];
				$databases = $data['database'];
				
				//$querySet = $this->queries->equal('query', $query)->equal('databases', $databases);
				$q = new adminqueries();
				$q->query = $query;
				$q->databases = $databases;
				if ($q->exists()) {
					$queryID = $q->id;
				} else {
					$q->save();
					$queryID = $q->id;
					
				}
				
				$newSearch = new adminsearches();
				
				$newSearch->query_id = $queryID;
				$newSearch->log_id = $log_id;
				$newSearch->lock = false;
				$newSearch->text = $query;
				$newSearch->total = $results;
	
				$newSearch->insert();
				$n = new adminsearches($log_id);
				$n->exists();
				
				break;

			case "download":
			case "audition":
				
				$newDownloads = new admindownloads();
				
				$newDownloads->log_id = $log_id;
				$newDownloads->asset_id = $data->asset_id;
				$newDownloads->db_id = $data->db_id;
				$newDownloads->track_id = $data->track_id;
				$newDownloads->completed = 1;
				$newDownloads->insert();
				
				if($event=='download') {
    				$data->downloads = $data->downloads+1;
				} else {
    				$data->auditions = $data->auditions+1;
				}
   				$data->save();
				
				break;
				
			case "login":
			case "logout":
					
				$newLogin = new adminlogins();
				$newLogin->log_id = $log_id;
				
				if ($event=="logout") {
					$newBase = new adminlogins();
					$baseLogin = $newBase->equal("user_id", $user_id)->equal("event", "login")->orderBy('id DESC')->first()->id;
									
					$newLogin->login_id = $baseLogin;
				}
				
				$newLogin->method = "user";
				$newLogin->save();
				
				break;
				
			case "share":
			
/* 			} else if ( $event == "share" ) { */
					
				$newShare = new adminshares();
				$newShare->log_id = $log_id;
				
				$newShare->type = $data['type'];
				$newShare->value = $data['value'];
				$newShare->method = $data['method'];
				$newShare->message = $data['message'];
				$newShare->email = $data['email'];
	
				$newShare->save();

   				$data->shares = $data->shares+1;
   				$data->save();
				
				break;
				
		}
		return $data;
	}
	
/*
	public function cloudPrefixes() {
		
		$cloudPrefixes = new stdClass();
		
		$cloudPrefixes->Diner = array(
			'http'=>'http://38bb1b9dca3a63b92e39-f1fdcfefc21c118849f16464fbb25fb9.r73.cf1.rackcdn.com/',
			'https'=>'https://912851543cc63d4a75b9-f1fdcfefc21c118849f16464fbb25fb9.ssl.cf1.rackcdn.com/',
			'streaming'=>'http://bff10d82a2e34db3b9c6-f1fdcfefc21c118849f16464fbb25fb9.r73.stream.cf1.rackcdn.com/',
			'ios'=>'http://11767cbf45963064ffde-f1fdcfefc21c118849f16464fbb25fb9.iosr.cf1.rackcdn.com/',
		);
		$cloudPrefixes->Gega = array(
			'http'=>'http://b3df9979e7276e9c10ba-6fc810a94538ac30ddcb5b230a7b7339.r61.cf1.rackcdn.com/',
			'https'=>'https://21cd896300d2efe4821c-6fc810a94538ac30ddcb5b230a7b7339.ssl.cf1.rackcdn.com/',
			'streaming'=>'http://0a30e593103f6b057b99-6fc810a94538ac30ddcb5b230a7b7339.r61.stream.cf1.rackcdn.com/',
			'ios'=>'http://51e4b62ff2a00daee70f-6fc810a94538ac30ddcb5b230a7b7339.iosr.cf1.rackcdn.com/',
		);
		$cloudPrefixes->Apollo = array(
			'http'=>'http://45bb2ad4bbd9979116a4-2b18608dfe58ebf5b8cdde5e9ab29455.r21.cf1.rackcdn.com/',
			'https'=>'https://37e6d8658db01270fd85-2b18608dfe58ebf5b8cdde5e9ab29455.ssl.cf1.rackcdn.com/',
			'streaming'=>'http://cdba11337dca9b4b6ce7-2b18608dfe58ebf5b8cdde5e9ab29455.r21.stream.cf1.rackcdn.com/',
			'ios'=>'http://7ca0fe0f25fcca06d311-2b18608dfe58ebf5b8cdde5e9ab29455.iosr.cf1.rackcdn.com/',
		);
		$cloudPrefixes->ProSFX = array(
			'mp3_http'=>'http://5af90fe433bb4ebe4139-a06ba1617be2a5254cdfb32f69614f4a.r6.cf1.rackcdn.com/',
			'mp3_https'=>'https://c7f068c49be99ff132c7-a06ba1617be2a5254cdfb32f69614f4a.ssl.cf1.rackcdn.com/',
			'mp3_streaming'=>'http://60d7fe325a897334b4f9-a06ba1617be2a5254cdfb32f69614f4a.r6.stream.cf1.rackcdn.com/',
			'mp3_ios'=>'http://31b1a5b45a9946ad550e-a06ba1617be2a5254cdfb32f69614f4a.iosr.cf1.rackcdn.com/',
			'wav_http'=>'http://f24a2cb46b5d459b209e-1869e6b461338a9cb4e3150688a2dd0b.r75.cf1.rackcdn.com/',
			'wav_https'=>'https://12405e38e059c81b4ff6-1869e6b461338a9cb4e3150688a2dd0b.ssl.cf1.rackcdn.com/',
			'wav_streaming'=>'http://f0ce0c61a06038fcc3c4-1869e6b461338a9cb4e3150688a2dd0b.r75.stream.cf1.rackcdn.com/',
			'wav_ios'=>'http://fbd83a6c190c1f920d0b-1869e6b461338a9cb4e3150688a2dd0b.iosr.cf1.rackcdn.com/',
		);
		$cloudPrefixes->MusicPlayground = array(
			'http'=>'http://46df4df5f004e00d1369-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.cf1.rackcdn.com/',
			'https'=>'https://288763349e1d9895c284-03bc13b1e76a5a9c9ac4fb771e9b7a23.ssl.cf1.rackcdn.com/',
			'streaming'=>'http://3fe53bbd7b947c5383b3-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.stream.cf1.rackcdn.com/',
			'ios'=>'http://eb24d662ea3d83e9147e-03bc13b1e76a5a9c9ac4fb771e9b7a23.iosr.cf1.rackcdn.com/',
		);
		return $cloudPrefixes;
	}
*/

}

?>