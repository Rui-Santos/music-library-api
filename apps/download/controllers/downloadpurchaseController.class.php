<?php
Library::import('download.models.downloadpurchase');
Library::import('download.models.downloadpurchasedtracks');
Library::import('admin.models.adminusers');
Library::import('admin.models.admincartitems');
Library::import('admin.models.adminassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadpurchase/
 * !RoutesPrefix purchase/
 */
class downloadpurchaseController extends Controller {
	
	/** @var downloadpurchase */
	protected $downloadpurchase;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadpurchase = new downloadpurchase();
		$this->purchtracks = new downloadpurchasedtracks();
		$this->cart = new admincartitems();
		$this->user = new adminusers();
		$this->_form = new ModelForm('downloadpurchase', $this->request->data('downloadpurchase'), $this->downloadpurchase);
	}

	/** 
	* !Route GET, $key/$hash 
	* !Route GET, $key/$hash/$format 
	* */
	function downloadPurchase($key, $hash, $format='mp3') {
	
		$this->downloadpurchase->hash=$hash;
		$this->user->key = $key;
		if ($this->user->exists()) {
			if($this->downloadpurchase->exists()) {
			
				$purchSet = $this->user->getPurchasedAssets();
				
				$name = 'DFX';
				$purchID = ''.$this->downloadpurchase->id;
				while (strlen($purchID)<5) {
					$purchID = '0'.$purchID;
				}
				$name .= $purchID;
				
				$assets = $this->downloadpurchase->assets();
				
				$zip = new ZipArchive;
				$zipname = 'THEDINERSFX-'.$name.'-'.rand().'.zip';
				if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
				
					foreach ($assets as $asset) {
						
						if(in_array($asset->asset_key, $purchSet)) {
						
		/*
							if (file_exists($asset->FilePath)) {
								$zip->addFile($asset->FilePath, $asset->Filename);
							}
		*/
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
						}
						
					}
					
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
							print "ok";
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
		} else {
			print 'fail';
		}
		exit;
	}
	
	/** !Route GET, cart/$key/$hash/$format */
	function downloadCart($key, $hash, $format) {
		
		$time = time();
		
		$this->downloadpurchase->hash=$hash;
		if($this->downloadpurchase->exists()) {
		
			$u = $key;
			$this->user->key = $u;
			if ($this->user->exists()) {
				if($this->user->id == $this->downloadpurchase->user_id){
					$name = 'DFX';
					$purchID = ''.$this->downloadpurchase->id;
					while (strlen($purchID)<5) {
						$purchID = '0'.$purchID;
					}
					$name .= $purchID;
					
					$assets = $this->downloadpurchase->assets();
					
					$zip = new ZipArchive;
					$zipname = 'THEDINERSFX-'.$name.'-'.rand().'.zip';
					if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
							
						$cartSet = $this->cart->equal('user_id',$this->user->id);
						foreach($cartSet as $c) {
							$dl = false;
							
							if($c->type == 'asset') {
								$purchSet = $this->user->getPurchasedAssets();
								if(in_array($c->assets()->asset_key, $purchSet)) {
									$dl = true;
								} else {
									$asset = new adminassets();
									$asset->asset_key = $c->assets()->asset_key;
									if($asset->exists()) {
										if ($this->user->diner_subscription_dls > 0) {
										
											$this->user->diner_subscription_dls = $this->user->diner_subscription_dls - 1 ;
											$this->user->save();
				
											$newTrack = new downloadpurchasedtracks();
											$newTrack->purchase_id = $this->downloadpurchase->id;
											$newTrack->asset_id = $asset->id;
											$newTrack->user_id = $this->user->id;
											$newTrack->db_id = $asset->db_id;
											$newTrack->created = $time;
											
											$newTrack->save();
											
											$dl = true;
				
										} elseif ($this->user->diner_subscription_dls == 0 && $this->user->diner_maxpack_dls > 0) {
											$this->user->diner_maxpack_dls = $this->user->diner_maxpack_dls - 1;
											$this->user->save();
											
											$this->downloadpurchase->dls_remaining = $this->downloadpurchase->dls_remaining -1;
											$this->downloadpurchase->save();
				
											$newTrack = new downloadpurchasedtracks();
											$newTrack->purchase_id = $this->downloadpurchase->id;
											$newTrack->asset_id = $asset->id;
											$newTrack->user_id = $this->user->id;
											$newTrack->db_id = $asset->db_id;
											$newTrack->created = $time;
											
											$newTrack->save();
											
											$dl = true;
				
										} elseif ($this->user->diner_subscription_dls == -1) {
											$newTrack = new downloadpurchasedtracks();
											$newTrack->purchase_id = $this->downloadpurchase->id;
											$newTrack->asset_id = $asset->id;
											$newTrack->user_id = $this->user->id;
											$newTrack->db_id = $asset->db_id;
											$newTrack->created = $time;
											
											$newTrack->save();
											
											$dl = true;
				
										}
									}
								}
							} else {
								//$c->delete();
								$cDel = new admincartitems();
								$cDel->id = $c->id;
								$cDel->delete();
							}
			
							if($dl) {
								$asset = $c->assets();
								//$c->delete();
								$cDel = new admincartitems();
								$cDel->id = $c->id;
								if($cDel->exists()) {
									$cDel->delete();
								}
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
								
							}
							$cDel = new admincartitems();
							$cDel->id = $c->id;
							$cDel->delete();
						}
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
								print "ok";
							} else {
								print "another error";
							}
						} else {
							print "didn't close";
						}
					
					} else {
						print 'fail';
					}
				}
			} else {
				print 'fail no user';
			}

		} else {
			print 'fail no purchase';
		}
		
		exit;
	}
	
}
?>