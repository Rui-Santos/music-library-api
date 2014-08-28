<?php
Library::import('admin.models.adminlogs');
Library::import('admin.models.admindownloads');
Library::import('admin.models.adminsearches');
Library::import('admin.models.adminhosts');
Library::import('admin.models.adminbrowsers');
Library::import('admin.models.adminlogins');
Library::import('admin.models.adminqueries');
Library::import('admin.models.adminshares');
Library::import('admin.models.adminmessages');
Library::import('admin.models.adminpurchases');
Library::import('admin.models.adminpurchasedtracks');
Library::import('admin.models.adminplaylists');
Library::import('admin.models.adminusers');
Library::import('admin.models.adminassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminlogs/
 */
class adminlogsController extends Controller {
	
	/** @var adminlogs */
	protected $adminlogs;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminlogs = new adminlogs();
		$this->browsers = new adminbrowsers();
		$this->downloads = new admindownloads();
		$this->searches = new adminsearches();
		$this->hosts = new adminhosts();
		$this->logins = new adminlogins();
		$this->assets = new adminassets();
		$this->queries = new adminqueries();
		$this->playlists = new adminplaylists();
		$this->messages = new adminmessages();
		$this->user = new adminusers();
		$this->_form = new ModelForm('adminlogs', $this->request->data('adminlogs'), $this->adminlogs);
	}
	
	/** !Route GET */
	function index() {
		$this->adminlogsSet = $this->adminlogs->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, test */
	function test() {
		
		$b = $this->doLog('search',array('query'=>'rock','results'=>823,'database'=>'THE_MUSIC_PLAYGROUND'));
		//$b = $_SERVER['HTTP_USER_AGENT'];
		print_r($b);
		
		exit;
	}
	
	/** !Route POST, add */
	function add() {
	
		$time = time();
		$event = $this->request->post['event'];
		$user_id = $this->request->post['user_id'];
		$hostIP = $this->request->post['hostIP'];
		$userAgent = $this->request->post['userAgent'];
		
		$hostName = gethostbyaddr($hostIP);
		
		$hostSet = $this->hosts->equal('ip', $hostIP)->equal('name', $hostName);
		if (count($hostSet)>0) {
			$hostID = $hostSet->first()->id;
		} else {
		
			$newHost = new adminhosts();
			$newHost->ip = $hostIP;
			$newHost->name = $hostName;
			$newHost->save();
			$hostID = $newHost->id;
			
		}
		
		$browsersSet = $this->browsers->equal('user_agent', $userAgent);
		if (count($browsersSet)>0) {
			$browserID = $browsersSet->first()->id;
		} else {
		
			$newBrowser = new adminbrowsers();
			$newBrowser->user_agent = $userAgent;
			$browserInfo = get_browser($userAgent);
			$newBrowser->browser = $browserInfo->browser;
			$newBrowser->version = $browserInfo->version;
			$newBrowser->version_maj = $browserInfo->majorver;
			$newBrowser->version_min = $browserInfo->minorver;
			$newBrowser->platform = $browserInfo->platform;
			$newBrowser->save();
			$browserID = $newBrowser->id;
		
		}
		
		$this->adminlogs->time = $time;
		$this->adminlogs->event = $event;
		$this->adminlogs->user_id = $user_id;
		$this->adminlogs->host_id = $hostID;
		$this->adminlogs->browser_id = $browserID;
		$this->adminlogs->source = $this->request->post['source'];
		$this->adminlogs->save();
		
		$log_id = $this->adminlogs->id;
		
		switch ($event) {
		
			case "search":
			case "simple-search":
/* 			if ($event == "search" || $event == "simple-search") { */
			
				$query = $this->request->post['query'];
				$results = $this->request->post['results'];
				$databases = "SFX_MP3, THE_DINER_2, The_Music_Playground";
				
				$querySet = $this->queries->equal('query', $query)->equal('databases', $databases);
				if (count($querySet)>0) {
					$queryID = $querySet->first()->id;
				} else {
				
					$newQuery = new adminqueries();
					$newQuery->databases = $databases;
					$newQuery->query = $query;
					$newQuery->save();
					$queryID = $newQuery->id;
					
				}
				
				$newSearch = new adminsearches();
				
				$newSearch->query_id = $queryID;
				$newSearch->log_id = $log_id;
				$newSearch->lock = false;
				$newSearch->text = $query;
				$newSearch->total = $results;
	
				$newSearch->save();
				
				break;
				
			case "download":
			case "audition":
			
/* 			} else if ( $event == "download" || $event == "audition" ) { */
			
				$asset_id = $this->request->post['asset_id'];
				
				$asset = new adminassets($asset_id);
				if ($asset->exists()) {}
				
				$this->downloads->log_id = $log_id;
				$this->downloads->asset_id = $asset_id;
				$this->downloads->db_id = $asset->db_id;
				$this->downloads->track_id = $asset->track_id;
				$this->downloads->file_path = $asset->FilePath;
				$this->downloads->file_size = filesize($asset->FilePath);
				$this->downloads->file_type = $asset->FileType;
				$this->downloads->completed = 1;
				$this->downloads->save();
				
				break;
				
			case "login":
			case "logout":
			
/* 			} else if ( $event == "login" || $event == "logout" ) { */
					
				$newLogin = new adminlogins();
				$newLogin->log_id = $log_id;
				
				if ($event=="logout") {
					$newBase = new base();
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
				
				$newShare->type = $this->request->post['type'];
				$newShare->value = $this->request->post['value'];
				$newShare->method = $this->request->post['method'];
				$newShare->message = $this->request->post['message'];
				$newShare->email = $this->request->post['email'];
	
				$newShare->save();
				
				break;
				
			case "message":
			
/* 			} else if ( $event == "message" ) { */
					
				$newMessage = new adminmessages();
				$newMessage->log_id = $log_id;
				
				$newMessage->type = urldecode($this->request->post['type']);
				$newMessage->email = urldecode($this->request->post['email']);
				$newMessage->name = urldecode($this->request->post['name']);
	
				if (isset($this->request->post['message'])) {$newMessage->message = urldecode($this->request->post['message']);}
				if (isset($this->request->post['company'])) {$newMessage->company = urldecode($this->request->post['company']);}
				if (isset($this->request->post['phone'])) {$newMessage->phone = urldecode($this->request->post['phone']);}
				if (isset($this->request->post['client'])) {$newMessage->client = urldecode($this->request->post['client']);}
				if (isset($this->request->post['product'])) {$newMessage->product = urldecode($this->request->post['product']);}
				if (isset($this->request->post['numspots'])) {$newMessage->num_spots = urldecode($this->request->post['numspots']);}
				if (isset($this->request->post['titles'])) {$newMessage->titles = urldecode($this->request->post['titles']);}
				if (isset($this->request->post['length'])) {$newMessage->lengths = urldecode($this->request->post['length']);}
				if (isset($this->request->post['isci'])) {$newMessage->isci = urldecode($this->request->post['isci']);}
				if (isset($this->request->post['numtracks'])) {$newMessage->num_tracks = urldecode($this->request->post['numtracks']);}
				if (isset($this->request->post['tags'])) {$newMessage->tags = urldecode($this->request->post['tags']);}
				if (isset($this->request->post['territories'])) {$newMessage->territories = urldecode($this->request->post['territories']);}
				if (isset($this->request->post['media'])) {$newMessage->media = urldecode($this->request->post['media']);}
				if (isset($this->request->post['startdate'])) {$newMessage->date_start = urldecode($this->request->post['startdate']);}
				if (isset($this->request->post['duration'])) {$newMessage->duration = urldecode($this->request->post['duration']);}
				if (isset($this->request->post['budget'])) {$newMessage->budget = urldecode($this->request->post['budget']);}
				if (isset($this->request->post['post'])) {$newMessage->post = urldecode($this->request->post['post']);}
				if (isset($this->request->post['direction'])) {$newMessage->tracks_direction = urldecode($this->request->post['direction']);}
				if (isset($this->request->post['description'])) {$newMessage->description = urldecode($this->request->post['description']);}
	
				$newMessage->save();
				
				break;
			
			case "purchase":
			
				$newPurchase = new adminpurchases();
				$newPurchase->log_id = $log_id;
				
				$newPurchase->user_id = $user_id;
				$newPurchase->hash = sha1($user_id . ":" . $log_id . ":" . $this->request->post['stripe_id']);
				$newPurchase->stripe_id = $this->request->post['stripe_id'];
				$newPurchase->amount = $this->request->post['amount'];
				$newPurchase->date = $time;
				
				$newPurchase->save();
				
				$trackArray = explode(',', $this->request->post['tracks']);
				foreach($trackArray as $track) {
				
					$newTrack = new adminpurchasedtracks();
					$newTrack->purchase_id = $newPurchase->id;
					$newTrack->asset_id = $track;
					$newTrack->user_id = $user_id;
					$newTrack->db_id = $this->request->post['db'];
					$newTrack->created = $time;
					
					$newTrack->save();
				
				}
				
				if (isset($this->request->post['customer'])) {
					$this->user->id = $user_id;
					if($this->user->exists()) {
						if ($this->user->stripe_id != $this->request->post['customer']) {
							$this->user->stripe_id = $this->request->post['customer'];
						}
						$this->user->save();
					}
				}
				
				$purchaseJSON = json_encode($newPurchase);
				print $purchaseJSON;
					
				break;
			
		}
		
		print "success";
		exit;
	}

	/** !Route POST, playlist */
	function playlist() {
	
		$playlist_id = $this->request->post['playlist_id'];
		$playlist = $this->playlists->equal('hash', $playlist_id)->first();
		
		$time = time();
		$event = $this->request->post['event'];
		$user_id = $this->request->post['user_id'];
		$hostIP = $this->request->post['hostIP'];
		$userAgent = $this->request->post['userAgent'];
		
		
		$hostName = gethostbyaddr($hostIP);
		
		$hostSet = $this->hosts->equal('ip', $hostIP)->equal('name', $hostName);
		if (count($hostSet)>0) {
			$hostID = $hostSet->first()->id;
		} else {
		
			$newHost = new adminhosts();
			$newHost->ip = $hostIP;
			$newHost->name = $hostName;
			$newHost->save();
			$hostID = $newHost->id;
			
		}
		
		$browsersSet = $this->browsers->equal('user_agent', $userAgent);
		if (count($browsersSet)>0) {
			$browserID = $browsersSet->first()->id;
		} else {
		
			$newBrowser = new adminbrowsers();
			$newBrowser->user_agent = $userAgent;
			$browserInfo = get_browser($userAgent);
			$newBrowser->browser = $browserInfo->browser;
			$newBrowser->version = $browserInfo->version;
			$newBrowser->version_maj = $browserInfo->majorver;
			$newBrowser->version_min = $browserInfo->minorver;
			$newBrowser->platform = $browserInfo->platform;
			$newBrowser->save();
			$browserID = $newBrowser->id;
		
		}
		
		$assets = $playlist->getTrackAssets();
		
		foreach ($assets as $asset) {
		
			$newEvent = new adminlogs();
			$newEvent->time = $time;
			$newEvent->event = $event;
			$newEvent->user_id = $user_id;
			$newEvent->host_id = $hostID;
			$newEvent->browser_id = $browserID;
			$newEvent->source = $this->request->post['source'];
			$newEvent->save();
			
			$log_id = $newEvent->id;
			
			$newDownload = new admindownloads();
			$newDownload->log_id = $log_id;
			$newDownload->asset_id = $asset->asset_id;
			$newDownload->db_id = $asset->db_id;
			$newDownload->track_id = $asset->RecID;
			$newDownload->file_path = $asset->FilePath;
			$newDownload->file_size = filesize($asset->FilePath);
			$newDownload->file_type = $asset->FileType;
			$newDownload->completed = 1;
			$newDownload->save();
	
		}
		
		print "success";
		exit;
	
	}
	
	/**
	* !Route GET, report/$type
	* !Route GET, report/$type/$start/$end
	* */
	function getReport($type, $start='yesterday', $end='yesterday') {
	
		$startDate = strtotime(date('Y-m-d 00:00:00', strtotime($start)));
		$endDate = strtotime(date('Y-m-d 23:59:59', strtotime($end)));
		
		$report = $this->adminlogs->equal('event', $type)->between('time', $startDate, $endDate);
		
		$rep_array = array();
		$rep_array['start'] = date('Y-m-d', $startDate);
		$rep_array['end'] = date('Y-m-d', $endDate);
		$rep_array['count'] = count($report);
		$rep_array['results'] = array();
		foreach ($report as $rep) {
			
			$rep->userInfo = $rep->users();
			unset($rep->userInfo->password);
			unset($rep->userInfo->key);
			array_push($rep_array['results'], $rep);
			
		}
		
		if (count($rep_array['results']) > 0) {
			print json_encode($rep_array);
		} else {
			print "no results";
		}
		
		exit;
	}
}
?>