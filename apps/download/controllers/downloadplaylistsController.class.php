<?php
Library::import('download.models.downloadplaylists');
Library::import('admin.models.adminusers');
Library::import('admin.models.adminpurchases');
Library::import('admin.models.adminassets');
Library::import('download.models.downloadpurchasedtracks');
Library::import('musicplayground.models.mpmetadata');
Library::import('diner.models.dinerpostings');
Library::import('diner.models.dinerpostingassets');
Library::import('diner.models.dinermetadata');
Library::import('musicplayground.models.mpmetadata');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadplaylists/
 * !RoutesPrefix playlist/
 */
class downloadplaylistsController extends Controller {
	
	/** @var downloadplaylists */
	protected $downloadplaylists;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadplaylists = new downloadplaylists();
		$this->user = new adminusers();
		$this->purchases = new adminpurchases();
		$this->purchasedtracks = new downloadpurchasedtracks();
		$this->mpmetadata = new mpmetadata();
		$this->dinerpostings = new dinerpostings();
		$this->dinerpostingassets = new dinerpostingassets();
		$this->dinermetadata = new dinermetadata();
		$this->_form = new ModelForm('downloadplaylists', $this->request->data('downloadplaylists'), $this->downloadplaylists);
	}

	/** 
	* !Route GET, $hash
	* !Route GET, $hash/$format 
	* !Route GET, $hash/$format/$user 
	* */
	function downloadPlaylist($hash, $format='mp3', $user='guest') {
	
	
		$time = time();
		
		if($format == 'album') {
		    //print($format);
		    //$a = substr($hash.' (www.themusicplayground.com)', 0, 62);

    		$tSet = $this->mpmetadata->equal('CDDescription',$hash);
/*    		print_r($tSet[0]);
*/
    		//print_r(count($tSet));
    		if(count($tSet)>0) {
				$fname = 'THEMUSICPLAYGROUND-'.$hash.'-'.rand().'.zip';
    			$zip = new ZipArchive;
    			$zipname = 'THEMUSICPLAYGROUND-'.$hash.'-'.rand().'.zip';
    			if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
        			foreach($tSet as $t) {
    					$assetPath = '/MEDIAPATH/GOES/HERE/media/'.$t->cloudPrefixes()->MusicPlayground['path'].'/'.$t->Filename;
    					if(file_exists($assetPath)) {
            				$zip->addFile($assetPath, $t->Filename);
    					}
            		}
        			if ($zip->close()) {
        				// we deliver a zip file
        				header("Cache-Control: ");# leave blank to avoid IE errors
        				header("Pragma: ");# leave blank to avoid IE errors
        				header("Content-Type: archive/zip");
        			
        				// filename for the browser to save the zip file
        				header('Content-Disposition: attachment; filename="'.$zipname.'"');
        			
        				chdir('/tmp/');
        				$filesize = filesize($zipname);
        				header("Content-Length: $filesize");
        				$zipstatus = $this->readfile_chunked($zipname, true);
        				if ($zipstatus) {
        					unlink($zipname);
        					$this->result = "ok";
        				} else {
        					print "another error";
        				}
        			} else {
        				print "didn't close";
        			}
        		} else {
        			print "couldn't open";
        		}
    		}
		} else {

/*
    		$this->downloadplaylists->hash=$hash;
    		if($this->downloadplaylists->exists()) {
    		
    			$name = $this->downloadplaylists->name;
    			
    			$assets = $this->downloadplaylists->assets();
    			
    			$fileprefix = strtoupper($this->downloadplaylists->source);
    			//print count($assets);
				$fname = $fileprefix.'-'.$name.'-'.rand().'.zip';
	   			$f = array();
    			
    			foreach ($assets as $index=>$val) {
	    			array_push($f, $val->Filename);
    			}
				//use OpenCloud\Rackspace;
				//print_r($f);
				zipDL($f,$fname);
				exit;
    		} else {
    			print 'fail';
    		}
    	}
		exit;
*/
    		$this->downloadplaylists->hash=$hash;
    		if($this->downloadplaylists->exists()) {
    		
    			$name = $this->downloadplaylists->name;
    			
    			$assets = $this->downloadplaylists->assets();
    			
    			$fileprefix = strtoupper($this->downloadplaylists->source);
    			//print count($assets);
    			
    			$zip = new ZipArchive;
    			$zipname = $fileprefix.'-'.$name.'-'.rand().'.zip';
    			if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
    				foreach ($assets as $asset):
    				
    					$auth = false;
    				
    					$this->user->key = $user;
    					if($this->user->exists()) {
    						if ($asset->db_id == 26) {
    							$a = new adminassets();
    							$a->asset_key = $asset->asset_key;
    							if($a->exists()) {
    								if(in_array($a->asset_key, $this->user->getPurchasedAssets())) {
    									$auth = true;
    								} else if($this->user->diner_subscription_dls == -1) {
    									$auth = true;
    									$c = $this->purchases->equal('user_id',$this->user->id)->equal('status','active')->orderBy('date DESC')->first();
    									$newTrack = new downloadpurchasedtracks();
    									$newTrack->purchase_id = $c->id;
    									$newTrack->asset_id = $a->id;
    									$newTrack->user_id = $this->user->id;
    									$newTrack->db_id = $asset->db_id;
    									$newTrack->created = $time;
    									
    									$newTrack->save();
    								} else if($this->user->diner_subscription_dls > 0) {
    									$auth = true;
    									$this->user->diner_subscription_dls = $this->user->diner_subscription_dls - 1;
    									$this->user->save();
    									$c = $this->purchases->equal('user_id',$this->user->id)->equal('status','active')->orderBy('date DESC')->first();
    									$newTrack = new downloadpurchasedtracks();
    									$newTrack->purchase_id = $c->id;
    									$newTrack->asset_id = $a->id;
    									$newTrack->user_id = $this->user->id;
    									$newTrack->db_id = $asset->db_id;
    									$newTrack->created = $time;
    									
    									$newTrack->save();
    								} else if($this->user->diner_maxpack_dls > 0) {
    									$auth = true;
    									$this->user->diner_maxpack_dls = $this->user->diner_maxpack_dls - 1;
    									$this->user->save();
    									$c = $this->purchases->greaterThan('dls_remaining',0)->orderBy('date DESC')->first();
    									$c->dls_remaining = $c->dls_remaining - 1;
    									$c->save();
    									$newTrack = new downloadpurchasedtracks();
    									$newTrack->purchase_id = $c->id;
    									$newTrack->asset_id = $a->id;
    									$newTrack->user_id = $this->user->id;
    									$newTrack->db_id = $asset->db_id;
    									$newTrack->created = $time;
    									
    									$newTrack->save();
    								}
    												
    							}
    						} else {
    						
    							$auth = true;
    						
    						}
    					}
    					if ($auth) {
    						
    						$assetPath = '/MEDIAPATH/GOES/HERE/media/';
    						$fname = '';
    						
							switch($asset->db_id) {
								case 12:
	    							
	    							$assetPath .= $asset->cloudPrefixes()->{$asset->Manufacturer}['path'] . '/';
	    							$assetPath .= ($format=='mp3') ? $asset->Filename : str_replace('.mp3', '.aif', $asset->Filename);
	    							$fname = ($format=='mp3') ? $asset->Filename : str_replace('.mp3', '.aif', $asset->Filename);
									break;
								case 26:
	    							$assetPath .= ($format=='mp3') ? $asset->cloudPrefixes()->ProSFX['path'] . '/' . $asset->Filename : $asset->cloudPrefixes()->ProSFX['path_wav'] . '/' . str_replace('.mp3', '.wav', $asset->Filename);
	    							$fname = ($format=='mp3') ? $asset->Filename : str_replace('.mp3', '.wav', $asset->Filename);
									break;
								case 6:
	    							$assetPath .= $asset->cloudPrefixes()->MusicPlayground['path'] . '/';
	    							$assetPath .= ($format=='mp3') ? $asset->Filename : str_replace('.mp3', '.aif', $asset->Filename);
	    							$fname = ($format=='mp3') ? $asset->Filename : str_replace('.mp3', '.aif', $asset->Filename);
									break;	
							}
							if (file_exists( $assetPath ) ) {
								$zip->addFile( $assetPath, $fname );
							} else {
								print $asset->Filename;
								exit;
							}
    					}				
    				
    				endforeach;
    				
    				if ($zip->close()) {
    					// we deliver a zip file
    					header("Cache-Control: ");# leave blank to avoid IE errors
    					header("Pragma: ");# leave blank to avoid IE errors
    					header("Content-Type: archive/zip");
    				
    					// filename for the browser to save the zip file
    					header('Content-Disposition: attachment; filename="'.$zipname.'"');
    				
    					chdir('/tmp/');
    					$filesize = filesize($zipname);
    					header("Content-Length: $filesize");
    					$zipstatus = $this->readfile_chunked($zipname, true);
    					if ($zipstatus) {
    						unlink($zipname);
    						$this->result = "ok";
    					} else {
    						print "another error";
    					}
    				} else {
    					print "didn't close";
    				}
    			} else {
    				print "couldn't open";
    			}
    	
    		} else {
    			print 'fail';
    		}
    	}
		exit;
	}
	

	/** 
	* !Route GET, diner/posting/$slug
	* */
	function downloadDinerPosting($slug) {
	
		$time = time();

		$this->dinerpostings->slug=$slug;
		if($this->dinerpostings->exists()) {
					
			$assets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
			$fileprefix = "THEDINER";
			//print count($assets);
			
			$zip = new ZipArchive;
			$zipname = $fileprefix.'-'.$slug.'-'.rand().'.zip';
			if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
				foreach ($assets as $asset):
					
					if(substr($asset->longID,0,8) == 'unsigned') {
						if(file_exists('/var/www/vhosts/thedinermusic.com/httpdocs/api/'.$asset->filepath)) {
							$zip->addFile('/var/www/vhosts/thedinermusic.com/httpdocs/api/'.$asset->filepath, $asset->filename);
						}
					} else {						
    					$assetPath = '/MEDIAPATH/GOES/HERE/media/'.$asset->cloudPrefixes()->{$asset->Manufacturer}['path'].'/'.$asset->Filename;
						if(file_exists($assetPath)) {
							$zip->addFile($assetPath, $asset->Filename);
						}
					}
									
				endforeach;
				
				if ($zip->close()) {
					// we deliver a zip file
					header("Cache-Control: ");# leave blank to avoid IE errors
					header("Pragma: ");# leave blank to avoid IE errors
					header("Content-Type: archive/zip");
				
					// filename for the browser to save the zip file
					header("Content-Disposition: attachment; filename=$zipname");
				
					chdir('/tmp/');
					$filesize = filesize($zipname);
					header("Content-Length: $filesize");
					$zipstatus = $this->readfile_chunked($zipname, true);
					if ($zipstatus) {
						unlink($zipname);
						$this->result = "ok";
					} else {
						$this->result = "another error";
					}
				} else {
					$this->result = "didn't close";
				}
			} else {
				$this->result = "couldn't open";
			}
	
		} else {
			print 'fail';
		}
		exit;
	}
}
?>