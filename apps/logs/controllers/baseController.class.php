<?php
Library::import('logs.models.base');
Library::import('logs.models.downloads');
Library::import('logs.models.searches');
Library::import('logs.models.hosts');
Library::import('logs.models.browsers');
Library::import('logs.models.logins');
Library::import('logs.models.queries');
Library::import('logs.models.shares');
Library::import('logs.models.messages');
Library::import('logs.models.logpurchases');
Library::import('logs.models.logpurchasedtracks');
Library::import('playlists.models.playlists');
Library::import('playlists.models.tracks');
Library::import('admin.models.admincartitems');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix base/
 */
class baseController extends Controller {
	
	/** @var base */
	protected $base;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->base = new base();
		$this->browsers = new browsers();
		$this->downloads = new downloads();
		$this->searches = new searches();
		$this->hosts = new hosts();
		$this->logins = new logins();
		$this->assets = new assets();
		$this->queries = new queries();
		$this->playlists = new playlists();
		$this->messages = new messages();
		$this->user = new adminusers();
		$this->purchases = new logpurchases();
		$this->cart = new admincartitems();
		$this->_form = new ModelForm('base', $this->request->data('base'), $this->base);
	}
	
	/** !Route GET */
	function index() {
		$this->baseSet = $this->base->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->base->id = $id;
		if($this->base->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, hello */
	function hello() {
		$userAgent = $this->request->headers['USER_AGENT'];
		$browser = get_browser($userAgent);
		//print $userAgent;
		print date("Y-m-d H:i:s");
		exit;
	}
	
	/** !Route GET, new */
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
	/** !Route POST */
	function insert() {
		try {
			$this->base->insert();
			return $this->created($this->urlTo('details', $this->base->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route POST, add */
	function add() {
		$time = time();
		$event = $this->request->post['event'];
/* 		$user_id = $this->request->post['user_id']; */
		$hostIP = $this->request->post['hostIP'];
		$userAgent = $this->request->post['userAgent'];

		//$u = $this->request->headers['USER'];
		//$this->user->key = $u;
		$this->user->key = !empty($this->request->headers['USER']) ? $this->request->headers['USER'] : 0;
		if(empty($this->request->headers['USER']) && !empty($this->request->post['userkey'])) {
			$this->user->key = $this->request->post['userkey'];
		}
		if($this->user->exists()) {
    		$user_id = $this->user->id;
		} else {
    		$user_id = 2;
		}    		
		//if ($this->user->exists()) {
		
			$user_id = $this->user->id;
			
			$hostName = gethostbyaddr($hostIP);
			
			$hostSet = $this->hosts->equal('ip', $hostIP)->equal('name', $hostName);
			if (count($hostSet)>0) {
				$hostID = $hostSet->first()->id;
			} else {
			
				$newHost = new hosts();
				$newHost->ip = $hostIP;
				$newHost->name = $hostName;
				$newHost->save();
				$hostID = $newHost->id;
				
			}
			
			$browsersSet = $this->browsers->equal('user_agent', $userAgent);
			if (count($browsersSet)>0) {
				$browserID = $browsersSet->first()->id;
			} else {
			
				$newBrowser = new browsers();
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
			
			$this->base->time = $time;
			$this->base->event = $event;
			$this->base->user_id = $user_id;
			$this->base->host_id = $hostID;
			$this->base->browser_id = $browserID;
			$this->base->source = $this->request->post['source'];
			$this->base->save();
			
			$log_id = $this->base->id;
			
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
					
						$newQuery = new queries();
						$newQuery->databases = $databases;
						$newQuery->query = $query;
						$newQuery->save();
						$queryID = $newQuery->id;
						
					}
					
					$newSearch = new searches();
					
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
				
					$asset_key = $this->request->post['asset_id'];
	/* 				print $asset_key; */
					
					$asset = new assets();
					$asset->asset_key = $asset_key;
					if ($asset->exists()) {
						$asset_id = $asset->id;
						$this->downloads->log_id = $log_id;
						$this->downloads->asset_id = $asset_id;
						$this->downloads->db_id = $asset->db_id;
						$this->downloads->track_id = $asset->track_id;
						$this->downloads->file_path = $asset->Filename;
						$this->downloads->file_size = filesize('/MEDIAPATH/GOES/HERE/media/'.$asset->cloudPrefixes()->{$asset->Manufacturer}['path'].'/'.$asset->Filename);
						$this->downloads->file_type = $asset->FileType;
						$this->downloads->completed = 1;
						$this->downloads->save();
		
						if($event=="download" && $asset->db_id==26) {
							$this->user->id = $user_id;
							if ($this->user->exists()) {
								unset($this->user->password);
								print json_encode($this->user);
							}
						}
					}
					
					
	/*
					if($event=="download" && $asset->db_id==26) {
						$this->user->id = $user_id;
						if ($this->user->exists()) {
						
							$p = $this->user->getPurchasedAssets();
							$c = $this->purchases->equal('user_id',$user_id)->orderBy('date','DESC')->limit(1)->first();
							
							if($c && !in_array($asset_key, $p)) {
						
								if ($this->user->diner_subscription_dls > 0) {
								
									$this->user->diner_subscription_dls = $this->user->diner_subscription_dls - 1 ;
									$this->user->save();
	
									$newTrack = new logpurchasedtracks();
									$newTrack->purchase_id = $c->id;
									$newTrack->asset_id = $asset_id;
									$newTrack->user_id = $user_id;
									$newTrack->db_id = $asset->db_id;
									$newTrack->created = $time;
									
									$newTrack->save();
									
									$this->playlists->hash = $this->user->diner_purch_id;
									if ($this->playlists->exists()) {
									
										$length = count($this->playlists->tracks());
									
										$t = new tracks();
										$t->playlist_id = $this->playlists->id;
										$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
										$t->asset_id = $asset_id;
										$t->db_id = $asset->db_id;
										$t->track_id = $asset->track_id;
										$t->ndx = $length;
										$t->created = $_SERVER['REQUEST_TIME'];
										$t->updated = $_SERVER['REQUEST_TIME'];
										$t->updated_by = $this->playlists->updated_by;
										$t->save();
									}
									
								} elseif ($this->user->diner_subscription_dls == 0 && $this->user->diner_maxpack_dls > 0) {
									$this->user->diner_maxpack_dls = $this->user->diner_maxpack_dls - 1;
									$this->user->save();
	
									$newTrack = new logpurchasedtracks();
									$newTrack->purchase_id = $c->id;
									$newTrack->asset_id = $asset_id;
									$newTrack->user_id = $user_id;
									$newTrack->db_id = $asset->db_id;
									$newTrack->created = $time;
									
									$newTrack->save();
									
									$this->playlists->hash = $this->user->diner_purch_id;
									if ($this->playlists->exists()) {
									
										$length = count($this->playlists->tracks());
									
										$t = new tracks();
										$t->playlist_id = $this->playlists->id;
										$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
										$t->asset_id = $asset_id;
										$t->db_id = $asset->db_id;
										$t->track_id = $asset->track_id;
										$t->ndx = $length;
										$t->created = $_SERVER['REQUEST_TIME'];
										$t->updated = $_SERVER['REQUEST_TIME'];
										$t->updated_by = $this->playlists->updated_by;
										$t->save();
									}
	
								} elseif ($this->user->diner_subscription_dls == -1) {
									$newTrack = new logpurchasedtracks();
									$newTrack->purchase_id = $c->id;
									$newTrack->asset_id = $asset_id;
									$newTrack->user_id = $user_id;
									$newTrack->db_id = $asset->db_id;
									$newTrack->created = $time;
									
									$newTrack->save();
									
									$this->playlists->hash = $this->user->diner_purch_id;
									if ($this->playlists->exists()) {
									
										$length = count($this->playlists->tracks());
									
										$t = new tracks();
										$t->playlist_id = $this->playlists->id;
										$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
										$t->asset_id = $asset_id;
										$t->db_id = $asset->db_id;
										$t->track_id = $asset->track_id;
										$t->ndx = $length;
										$t->created = $_SERVER['REQUEST_TIME'];
										$t->updated = $_SERVER['REQUEST_TIME'];
										$t->updated_by = $this->playlists->updated_by;
										$t->save();
									}
								
								}
							}
						
							unset($this->user->password);
							print json_encode($this->user);
						}
					}
		
	*/			
					break;
					
				case "login":
				case "logout":
				
	/* 			} else if ( $event == "login" || $event == "logout" ) { */
						
					$newLogin = new logins();
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
						
					$newShare = new shares();
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
						
					$newMessage = new messages();
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
				
					$newPurchase = new logpurchases();
					$newPurchase->log_id = $log_id;
					
					$newPurchase->user_id = $user_id;
					$newPurchase->hash = sha1($user_id . ":" . $log_id . ":" . $this->request->post['stripe_id']);
					$newPurchase->stripe_id = $this->request->post['stripe_id'];
					$newPurchase->amount = $this->request->post['amount'];
					$newPurchase->date = $time;
					$newPurchase->save();
					
					if (isset($this->request->post['type'])) {
						$newPurchase->type = urldecode($this->request->post['type']);
						$typeArray = explode(',', $newPurchase->type);
						foreach($typeArray as $val) {
							if($val != 'alacarte') {
								$this->user->id = $user_id;
								if($this->user->exists()) {
		
									switch($val) {
									
										case 'sub1U':
											$this->user->diner_subscription_dls = -1;
											$newPurchase->status = 'active';
											break;
										case 'sub1':
										case 'sub4':
										case 'sub12':
										case 'sub52':
											$this->user->diner_subscription_dls = 25;
											$newPurchase->status = 'active';
											$oldscrips = new logpurchases();
											$oldscripsObj = $oldscrips->equal('status','active');
											foreach($oldscripsObj as $old) {
												$old->status = 'closed';
												$old->save();
												//$newPurchase->status = 'pending';
												
											}
											break;
										case 'mp20':
										case 'mp50':
										case 'mp125':
											$this->user->diner_maxpack_dls += intval(substr($val,2));
											$newPurchase->dls_remaining += intval(substr($val,2));
											break;
									
									}
									
									$this->user->save();
								}
							} else if($val == 'alacarte') {
					
								//$trackArray = explode(',', $this->request->post['tracks']);
								$tSet = $this->cart->equal('user_id',$this->user->id);
								foreach($tSet as $track) {
								
									$newTrack = new logpurchasedtracks();
									$newTrack->purchase_id = $newPurchase->id;
									$newTrack->asset_id = $track->asset_id;
									$newTrack->user_id = $user_id;
									$newTrack->db_id = $this->request->post['db'];
									$newTrack->created = $time;
									
									$newTrack->save();
																	
								}
								
							}
						}
					}
					
					$newPurchase->save();
					if (!empty($this->request->post['customer'])) {
						$this->user->id = $user_id;
						if($this->user->exists()) {
							if ($this->user->stripe_id != $this->request->post['customer']) {
								if($this->request->post['customer'] == 'delete') {
									$this->user->stripe_id = 'NULL';
								} else {
									$this->user->stripe_id = $this->request->post['customer'];
								}
							}
							$this->user->save();
						}
					}
					if (!empty($this->request->post['customerDev'])) {
						$this->user->id = $user_id;
						if($this->user->exists()) {
							if ($this->user->stripe_id_dev != $this->request->post['customerDev']) {
								if($this->request->post['customerDev'] == 'delete') {
									$this->user->stripe_id_dev = 'NULL';
								} else {
									$this->user->stripe_id_dev = $this->request->post['customerDev'];
								}
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
		//}
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
		
			$newHost = new hosts();
			$newHost->ip = $hostIP;
			$newHost->name = $hostName;
			$newHost->save();
			$hostID = $newHost->id;
			
		}
		
		$browsersSet = $this->browsers->equal('user_agent', $userAgent);
		if (count($browsersSet)>0) {
			$browserID = $browsersSet->first()->id;
		} else {
		
			$newBrowser = new browsers();
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
		
			$newEvent = new base();
			$newEvent->time = $time;
			$newEvent->event = $event;
			$newEvent->user_id = $user_id;
			$newEvent->host_id = $hostID;
			$newEvent->browser_id = $browserID;
			$newEvent->source = $this->request->post['source'];
			$newEvent->save();
			
			$log_id = $newEvent->id;
			
			$newDownload = new downloads();
			$newDownload->log_id = $log_id;
			$newDownload->asset_id = $asset->asset_id;
			$newDownload->db_id = $asset->db_id;
			$newDownload->track_id = $asset->RecID;
			$newDownload->file_path = $asset->FilePath;
			$newDownload->file_size = filesize('/MEDIAPATH/GOES/HERE/media/'.$asset->cloudPrefixes()->{$asset->Manufacturer}['path'].'/'.$asset->Filename);
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
		
		$report = $this->base->equal('event', $type)->between('time', $startDate, $endDate);
		
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
	
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->base->id = $id;
		if($this->base->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'base does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldbase = new base($id);
		if($oldbase->exists()) {
			$oldbase->copy($this->base)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'base does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->base->id = $id;
		if($this->base->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'base does not exist.');
		}
	}
}
?>