<?php
Library::import('download.models.downloadassets');
Library::import('admin.models.adminusers');
Library::import('admin.models.adminpurchases');
Library::import('admin.models.adminplaylists');
Library::import('admin.models.admintracks');
Library::import('download.models.downloadpurchasedtracks');
Library::import('diner.models.dinerall');
Library::import('prosfx.models.prosfxall');
Library::import('musicplayground.models.mpallassets');
Library::import('musicplayground.models.mpsamplerassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadassets/
 * !RoutesPrefix asset/
 */
class downloadassetsController extends Controller {
	
	/** @var downloadassets */
	protected $downloadassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadassets = new downloadassets();
		$this->user = new adminusers();
		$this->purchasedtracks = new downloadpurchasedtracks();
		$this->diner = new dinerall();
		$this->prosfx = new prosfxall();
		$this->purchases = new adminpurchases();
		$this->playlists = new adminplaylists();
		$this->mpallassets = new mpallassets();
		$this->mpsamplerassets = new mpsamplerassets();
		$this->_form = new ModelForm('downloadassets', $this->request->data('downloadassets'), $this->downloadassets);
	}

	function getAsset($db_id, $tr_id) {

		$this->assetSet = $this->downloadassets->equal("RecID", $tr_id)->equal("db_id", $db_id)->orderBy('EntryDate DESC');
		$length = count($this->assetSet);
		if ($db_id == 12) {
			$this->oldAsset = $this->diner->equal("RecID", $tr_id)->first();
		} else if ($db_id == 26) {
			$this->oldAsset = $this->prosfx->equal("RecID", $tr_id)->first();
		}

		if ($length > 0) {
			$this->asset = $this->assetSet->first();
			
			if ($this->asset->EntryDate < $this->oldAsset->EntryDate) {
				$this->newAsset = new assets();
				$this->newAsset->db_id = $db_id;
				$this->newAsset->track_id = $tr_id;
				$this->newAsset->asset_key = MD5(RAND());
		
				$this->newAsset->Filename = $this->oldAsset->Filename;
				$this->newAsset->Pathname = $this->oldAsset->Pathname;
				$this->newAsset->FilePath = $this->oldAsset->FilePath;
				$this->newAsset->Duration = $this->oldAsset->Duration;
				$this->newAsset->FileType = $this->oldAsset->FileType;
				$this->newAsset->CreationDate = $this->oldAsset->CreationDate;
				$this->newAsset->ModificationDate = $this->oldAsset->ModificationDate;
				$this->newAsset->TotalFrames = $this->oldAsset->TotalFrames;
				$this->newAsset->EntryDate = $this->oldAsset->EntryDate;
				$this->newAsset->Popularity = $this->oldAsset->Popularity;
				$this->newAsset->Split = $this->oldAsset->Split;
				$this->newAsset->Rating = $this->oldAsset->Rating;
				$this->newAsset->SampleRate = $this->oldAsset->SampleRate;
				$this->newAsset->Channels = $this->oldAsset->Channels;
				$this->newAsset->BitDepth = $this->oldAsset->BitDepth;
				$this->newAsset->ChannelLayout = $this->oldAsset->ChannelLayout;
				$this->newAsset->_FlatCategory = $this->oldAsset->_FlatCategory;
				$this->newAsset->_WaveformLink = $this->oldAsset->_WaveformLink;
				$this->newAsset->_PictureLink = $this->oldAsset->_PictureLink;
				$this->newAsset->_UMID = $this->oldAsset->_UMID;
				$this->newAsset->Time = $this->oldAsset->Time;
				$this->newAsset->Volume = $this->oldAsset->Volume;
				$this->newAsset->Track = $this->oldAsset->Track;
				$this->newAsset->_Dirty = $this->oldAsset->_Dirty;
				$this->newAsset->Lyrics = $this->oldAsset->Lyrics;
				$this->newAsset->Description = $this->oldAsset->Description;
				$this->newAsset->Source = $this->oldAsset->Source;
				$this->newAsset->Category = $this->oldAsset->Category;
				$this->newAsset->SubCategory = $this->oldAsset->SubCategory;
				$this->newAsset->FXName = $this->oldAsset->FXName;
				$this->newAsset->Notes = $this->oldAsset->Notes;
				$this->newAsset->Show = $this->oldAsset->Show;
				$this->newAsset->Library = $this->oldAsset->Library;
				$this->newAsset->RecType = $this->oldAsset->RecType;
				$this->newAsset->ShortID = $this->oldAsset->ShortID;
				$this->newAsset->LongID = $this->oldAsset->LongID;
				$this->newAsset->RecMedium = $this->oldAsset->RecMedium;
				$this->newAsset->Keywords = $this->oldAsset->Keywords;
				$this->newAsset->Location = $this->oldAsset->Location;
				$this->newAsset->Microphone = $this->oldAsset->Microphone;
				$this->newAsset->Composer = $this->oldAsset->Composer;
				$this->newAsset->Arranger = $this->oldAsset->Arranger;
				$this->newAsset->Conductor = $this->oldAsset->Conductor;
				$this->newAsset->Publisher = $this->oldAsset->Publisher;
				$this->newAsset->Performer = $this->oldAsset->Performer;
				$this->newAsset->BPM = $this->oldAsset->BPM;
				$this->newAsset->Key = $this->oldAsset->Key;
				$this->newAsset->Manufacturer = $this->oldAsset->Manufacturer;
				$this->newAsset->Designer = $this->oldAsset->Designer;
				$this->newAsset->TrackTitle = $this->oldAsset->TrackTitle;
				$this->newAsset->CDTitle = $this->oldAsset->CDTitle;
				$this->newAsset->CDDescription = $this->oldAsset->CDDescription;
				$this->newAsset->FeaturedInstrument = $this->oldAsset->FeaturedInstrument;
				$this->newAsset->Scene = $this->oldAsset->Scene;
				$this->newAsset->Take = $this->oldAsset->Take;
				$this->newAsset->Tape = $this->oldAsset->Tape;
				$this->newAsset->Mood = $this->oldAsset->Mood;
				$this->newAsset->Version = $this->oldAsset->Version;
				$this->newAsset->BWDescription = $this->oldAsset->BWDescription;
				$this->newAsset->BWOriginator = $this->oldAsset->BWOriginator;
				$this->newAsset->BWOriginatorRef = $this->oldAsset->BWOriginatorRef;
				$this->newAsset->BWTimeStamp = $this->oldAsset->BWTimeStamp;
				$this->newAsset->BWTime = $this->oldAsset->BWTime;
				$this->newAsset->BWDate = $this->oldAsset->BWDate;
				$this->newAsset->RecID = $this->oldAsset->RecID;
				
				$this->newAsset->save();
				return $this->newAsset;
			} else {
				return $this->asset;
			}
			
		} else {
			$this->newAsset = new assets();
			$this->newAsset->db_id = $db_id;
			$this->newAsset->track_id = $tr_id;
			$this->newAsset->asset_key = MD5(RAND());
	
			$this->newAsset->Filename = $this->oldAsset->Filename;
			$this->newAsset->Pathname = $this->oldAsset->Pathname;
			$this->newAsset->FilePath = $this->oldAsset->FilePath;
			$this->newAsset->Duration = $this->oldAsset->Duration;
			$this->newAsset->FileType = $this->oldAsset->FileType;
			$this->newAsset->CreationDate = $this->oldAsset->CreationDate;
			$this->newAsset->ModificationDate = $this->oldAsset->ModificationDate;
			$this->newAsset->TotalFrames = $this->oldAsset->TotalFrames;
			$this->newAsset->EntryDate = $this->oldAsset->EntryDate;
			$this->newAsset->Popularity = $this->oldAsset->Popularity;
			$this->newAsset->Split = $this->oldAsset->Split;
			$this->newAsset->Rating = $this->oldAsset->Rating;
			$this->newAsset->SampleRate = $this->oldAsset->SampleRate;
			$this->newAsset->Channels = $this->oldAsset->Channels;
			$this->newAsset->BitDepth = $this->oldAsset->BitDepth;
			$this->newAsset->ChannelLayout = $this->oldAsset->ChannelLayout;
			$this->newAsset->_FlatCategory = $this->oldAsset->_FlatCategory;
			$this->newAsset->_WaveformLink = $this->oldAsset->_WaveformLink;
			$this->newAsset->_PictureLink = $this->oldAsset->_PictureLink;
			$this->newAsset->_UMID = $this->oldAsset->_UMID;
			$this->newAsset->Time = $this->oldAsset->Time;
			$this->newAsset->Volume = $this->oldAsset->Volume;
			$this->newAsset->Track = $this->oldAsset->Track;
			$this->newAsset->_Dirty = $this->oldAsset->_Dirty;
			$this->newAsset->Lyrics = $this->oldAsset->Lyrics;
			$this->newAsset->Description = $this->oldAsset->Description;
			$this->newAsset->Source = $this->oldAsset->Source;
			$this->newAsset->Category = $this->oldAsset->Category;
			$this->newAsset->SubCategory = $this->oldAsset->SubCategory;
			$this->newAsset->FXName = $this->oldAsset->FXName;
			$this->newAsset->Notes = $this->oldAsset->Notes;
			$this->newAsset->Show = $this->oldAsset->Show;
			$this->newAsset->Library = $this->oldAsset->Library;
			$this->newAsset->RecType = $this->oldAsset->RecType;
			$this->newAsset->ShortID = $this->oldAsset->ShortID;
			$this->newAsset->LongID = $this->oldAsset->LongID;
			$this->newAsset->RecMedium = $this->oldAsset->RecMedium;
			$this->newAsset->Keywords = $this->oldAsset->Keywords;
			$this->newAsset->Location = $this->oldAsset->Location;
			$this->newAsset->Microphone = $this->oldAsset->Microphone;
			$this->newAsset->Composer = $this->oldAsset->Composer;
			$this->newAsset->Arranger = $this->oldAsset->Arranger;
			$this->newAsset->Conductor = $this->oldAsset->Conductor;
			$this->newAsset->Publisher = $this->oldAsset->Publisher;
			$this->newAsset->Performer = $this->oldAsset->Performer;
			$this->newAsset->BPM = $this->oldAsset->BPM;
			$this->newAsset->Key = $this->oldAsset->Key;
			$this->newAsset->Manufacturer = $this->oldAsset->Manufacturer;
			$this->newAsset->Designer = $this->oldAsset->Designer;
			$this->newAsset->TrackTitle = $this->oldAsset->TrackTitle;
			$this->newAsset->CDTitle = $this->oldAsset->CDTitle;
			$this->newAsset->CDDescription = $this->oldAsset->CDDescription;
			$this->newAsset->FeaturedInstrument = $this->oldAsset->FeaturedInstrument;
			$this->newAsset->Scene = $this->oldAsset->Scene;
			$this->newAsset->Take = $this->oldAsset->Take;
			$this->newAsset->Tape = $this->oldAsset->Tape;
			$this->newAsset->Mood = $this->oldAsset->Mood;
			$this->newAsset->Version = $this->oldAsset->Version;
			$this->newAsset->BWDescription = $this->oldAsset->BWDescription;
			$this->newAsset->BWOriginator = $this->oldAsset->BWOriginator;
			$this->newAsset->BWOriginatorRef = $this->oldAsset->BWOriginatorRef;
			$this->newAsset->BWTimeStamp = $this->oldAsset->BWTimeStamp;
			$this->newAsset->BWTime = $this->oldAsset->BWTime;
			$this->newAsset->BWDate = $this->oldAsset->BWDate;
			$this->newAsset->RecID = $this->oldAsset->RecID;
			
			$this->newAsset->save();
			return $this->newAsset;
		}
	}
	
	function readfile_chunked($filename,$retbytes=true) {
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
	       return $cnt; // return num. bytes delivered like readfile() does.
	   }
	   return $status;
	
}

	
	/** !Route GET, $key/$user */
	function downloadAsset($key, $user){
		
		$this->downloadassets->asset_key = $key;
		if($this->downloadassets->exists()) {
		
			$auth = false;
		
			$this->user->key = $user;
			if($this->user->exists()) {
				if ($this->downloadassets->db_id != 26) {
				
					$auth = true;
									
				} else if ($this->downloadassets->db_id == 26) {
								
					$purchasedTrackSet = $this->purchasedtracks->equal('user_id', $this->user->id);
					foreach($purchasedTrackSet as $track) {
					
						if ($track->assets()->asset_key == $key) {
							$auth = true;
							break;
						}
					
					}
				
				}
			} else {
				print 'not authorized';
			}
			
			//print $this->downloadassets->FilePath;
			
			if ($auth) {
				$file = $this->downloadassets->FilePath;
				$filename = $this->downloadassets->Filename;
				
			    $exists = false;
	
			    if(!file_exists($file)) {
			    		    	
			    	$newFileSet = $this->downloadassets->equal('Filename', $filename)->orderBy('id DESC');
			    	foreach ($newFileSet as $newFile) {
				    	
				    	if (file_exists($newFile->Filename)) {
					    	
					    	$file = $newFile->FilePath;
					    	$filename = $newFile->Filename;
					    	$exists = true;
					    	break;
					    	
				    	}
				    	
			    	}
		        } else { $exists=true;}
		        if (!$exists) {
		        	print "Sorry that file does not exist";
		        } else {
					header("Cache-Control: ");# leave blank to avoid IE errors
					header("Pragma: ");# leave blank to avoid IE errors
			        header("Content-Type: ".filetype($file));
			        header("Content-Disposition: attachment; filename=\"".substr(strrchr($file,'/'),1)."\"");
					header("Content-length:".(string)(filesize($file)));
			        $fp = fopen($file, "r");
			        $data = fread($fp, filesize($file));
			        fclose($fp);
			        print $data;
			    }
			} else {
				print "you do not have access";
			}
			
		} else {
			
			print "fail";
			
		}		
		exit;
	}

	/** 
	* !Route GET, track
	* !Route GET, track/$asset_key
	* !Route GET, track/$asset_key/$user 
	* !Route GET, track/$asset_key/$user/$format
	* */
	function downloadTrack($asset_key='test', $user='test', $format='mp3'){
		
		//$track = $this->getAsset($db, $id);
		
		//print $track->TrackTitle;
		if($asset_key=='test' && $user=='test') {
			$a = '8d7230781374f2815bbb1adb9051ee09';
			$this->downloadassets->asset_key = $a;
			if ($this->downloadassets->exists()) {
				$file = $this->downloadassets->FilePath;
				header("Cache-Control: ");# leave blank to avoid IE errors
				header("Pragma: ");# leave blank to avoid IE errors
		        header("Content-Type: ".filetype($file));
		        header("Content-Disposition: attachment; filename=\"".substr(strrchr($file,'/'),1)."\"");
				header("Content-length:".(string)(filesize($file)));
	/*
		        $fp = fopen($file, "r");
		        $data = fread($fp, 8192);
		        fclose($fp);
		        print $data;
	*/			$this->readfile_chunked($file,true);
				exit;
			}
		}
		if(substr($asset_key,0,8) == 'unsigned') {
		
			$this->mpsamplerassets->asset_key = $asset_key;
			if($this->mpsamplerassets->exists()) {
				
				$file = '/PATH/GOES/HERE/api/'.$this->mpsamplerassets->filepath;
				
			    if(!file_exists($file)) {
			    		    	
					print 'file doesn\'t exist';
	
		        } else {

					header("Cache-Control: ");# leave blank to avoid IE errors
					header("Pragma: ");# leave blank to avoid IE errors
			        header("Content-Type: ".filetype($file));
			        header("Content-Disposition: attachment; filename=\"".substr(strrchr($file,'/'),1)."\"");
					header("Content-length:".(string)(filesize($file)));
/*
			        $fp = fopen($file, "r");
			        $data = fread($fp, 8192);
			        fclose($fp);
			        print $data;
*/					$this->readfile_chunked($file,true);
			    }

			} else {
				print 'error';
			}
			exit;
			
		}
		$this->downloadassets->asset_key = $asset_key;
		if ($this->downloadassets->exists()) {
			
			$asset = $this->downloadassets;
			$time = time();
			
			$db = $this->downloadassets->db_id;
			$auth = false;
/*
			if($user == 'test') {
				$user = 'c2002a9449b44bf6303e369484ea6aa17942df75';

			}
*/
		
			$this->user->key = $user;
			if($this->user->exists()) {
				if ($db != 26) {
				
					$auth = true;
									
				} else if ($db == 26) {
								
/*
					$purchasedTrackSet = $this->purchasedtracks->equal('user_id', $this->user->id);
					//print count($purchasedTrackSet);
					foreach($purchasedTrackSet as $purchasedTrack) {
					
						//print $purchasedTrack->assets()->asset_key . ',';
					
						if ($purchasedTrack->assets()->asset_key == $this->downloadassets->asset_key) {
							$auth = true;
							//print 'auth';
							break;
						}
					
					}
*/
						
					$p = $this->user->getPurchasedAssets();
					//$c = $this->purchases->equal('user_id',$this->user->id)->orderBy('date','DESC')->limit(1)->first();
					
					if(in_array($asset_key, $p)) {
						$auth = true;
					} else {
				
						if ($this->user->diner_subscription_dls > 0) {
						
							$this->user->diner_subscription_dls = $this->user->diner_subscription_dls - 1 ;
							$this->user->save();

							$c = $this->purchases->equal('user_id',$this->user->id)->equal('status','active')->orderBy('date DESC')->first();
							
							$newTrack = new downloadpurchasedtracks();
							$newTrack->purchase_id = $c->id;
							$newTrack->asset_id = $asset->id;
							$newTrack->user_id = $this->user->id;
							$newTrack->db_id = $asset->db_id;
							$newTrack->created = $time;
							
							$newTrack->save();
							
							$this->playlists->hash = $this->user->diner_purch_id;
							if ($this->playlists->exists()) {
							
								$length = count($this->playlists->tracks());
							
								$t = new admintracks();
								$t->playlist_id = $this->playlists->id;
								$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
								$t->asset_id = $asset->id;
								$t->db_id = $asset->db_id;
								$t->track_id = $asset->track_id;
								$t->ndx = $length;
								$t->created = $_SERVER['REQUEST_TIME'];
								$t->updated = $_SERVER['REQUEST_TIME'];
								$t->updated_by = $this->playlists->updated_by;
								$t->save();
							}
							
							$auth = true;

						} elseif ($this->user->diner_subscription_dls == 0 && $this->user->diner_maxpack_dls > 0) {
							$this->user->diner_maxpack_dls = $this->user->diner_maxpack_dls - 1;
							$this->user->save();

							$c = $this->purchases->greaterThan('dls_remaining',0)->orderBy('date DESC')->first();
							$c->dls_remaining = $c->dls_remaining - 1;
							$c->save();
							
							$newTrack = new downloadpurchasedtracks();
							$newTrack->purchase_id = $c->id;
							$newTrack->asset_id = $asset->id;
							$newTrack->user_id = $this->user->id;
							$newTrack->db_id = $asset->db_id;
							$newTrack->created = $time;
							
							$newTrack->save();
							
							$this->playlists->hash = $this->user->diner_purch_id;
							if ($this->playlists->exists()) {
							
								$length = count($this->playlists->tracks());
							
								$t = new admintracks();
								$t->playlist_id = $this->playlists->id;
								$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
								$t->asset_id = $asset->id;
								$t->db_id = $asset->db_id;
								$t->track_id = $asset->track_id;
								$t->ndx = $length;
								$t->created = $_SERVER['REQUEST_TIME'];
								$t->updated = $_SERVER['REQUEST_TIME'];
								$t->updated_by = $this->playlists->updated_by;
								$t->save();
							}

							$auth = true;

						} elseif ($this->user->diner_subscription_dls == -1) {
							$c = $this->purchases->equal('user_id',$this->user->id)->equal('status','active')->orderBy('date DESC')->first();
							
							$newTrack = new downloadpurchasedtracks();
							$newTrack->purchase_id = $c->id;
							$newTrack->asset_id = $asset->id;
							$newTrack->user_id = $this->user->id;
							$newTrack->db_id = $asset->db_id;
							$newTrack->created = $time;
							
							$newTrack->save();
							
							$this->playlists->hash = $this->user->diner_purch_id;
							if ($this->playlists->exists()) {
							
								$length = count($this->playlists->tracks());
							
								$t = new admintracks();
								$t->playlist_id = $this->playlists->id;
								$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
								$t->asset_id = $asset->id;
								$t->db_id = $asset->db_id;
								$t->track_id = $asset->track_id;
								$t->ndx = $length;
								$t->created = $_SERVER['REQUEST_TIME'];
								$t->updated = $_SERVER['REQUEST_TIME'];
								$t->updated_by = $this->playlists->updated_by;
								$t->save();
							}
						
							$auth = true;

						}
					}
				
/*
					unset($this->user->password);
					print json_encode($this->user);
*/
						
				}
			} else {
				print 'not authorized';
			}
			$file = '';
			if($format == 'mp3') {
				$file = $this->downloadassets->FilePath;
			} else {
				switch($this->downloadassets->db_id) {
				case 12:
					$file = str_replace('MP3s', 'AIFFs', $this->downloadassets->Pathname);
					$file .= '/' . str_replace('.mp3', '.aif', $this->downloadassets->Filename);
					//print $file;
					break;
				case 26:
					$file = str_replace('MP3s', 'WAVs', $this->downloadassets->Pathname);
					$file .= '/' . str_replace('.mp3', '.wav', $this->downloadassets->Filename);
					break;
				case 6:
					$file = str_replace('mp3', 'wav', $this->downloadassets->Pathname);
					$file .= '/' . str_replace('.mp3', '.wav', $this->downloadassets->Filename);
					break;
				}
			}
		
			if ($auth) {
				//$file = $this->downloadassets->FilePath;
							
			    if(!file_exists($file)) {
			    		    	
					print 'file doesn\'t exist';
	
		        } else {

					header("Cache-Control: ");# leave blank to avoid IE errors
					header("Pragma: ");# leave blank to avoid IE errors
			        header("Content-Type: ".filetype($file));
			        header("Content-Disposition: attachment; filename=\"".substr(strrchr($file,'/'),1)."\"");
					header("Content-length:".(string)(filesize($file)));
/*
			        $fp = fopen($file, "r");
			        $data = fread($fp, 8192);
			        fclose($fp);
			        print $data;
*/					$this->readfile_chunked($file,true);
			    }
	
			} else {
				print "you do not have access";
			}
		}
		
		exit;
	}

	/** !Route GET, play/$asset_key */
	function getMP3($asset_key) {
	
		//$asset = $this->getAsset($db_id, $tr_id);
		$this->downloadassets->asset_key = $asset_key;
		if ($this->downloadassets->exists()) {
			$size = filesize($this->downloadassets->FilePath);
			header("Cache-Control: ");# leave blank to avoid IE errors
			header("Pragma: ");# leave blank to avoid IE errors
			header("Accept-Ranges: bytes");
			header("Connection: Keep-Alive");
		    header('Content-length: ' . (string)($size));
		    header('Content-Type: audio/mpeg');
	        header("Content-Disposition: filename=\"".$this->downloadassets->Filename."\"");
		    header('Keep-Alive:timeout=15, max=500');
		    
			readfile($this->downloadassets->FilePath);
		}
		exit;
	
	}
	
	/** !Route GET, mp/$file_hash */
	function getMPFile($file_hash) {

    	$this->mpallassets->file_hash = $file_hash;
    	if($this->mpallassets->exists()) {
        	
        	$file = $this->mpallassets->metadata()->first()->Filename;
        	$file = 'http://46df4df5f004e00d1369-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.cf1.rackcdn.com/'.$file;
    		header("Cache-Control: ");# leave blank to avoid IE errors
    		header("Pragma: ");# leave blank to avoid IE errors
            //header("Content-Type: ".filetype($file));
            header("Content-Disposition: attachment; filename=\"".$this->mpallassets->metadata()->first()->Filename."\"");
            //header ("Location: ".$file);
            //print $file;
    		//header("Content-length:".(string)(filesize($file)));
    		//$this->readfile_chunked($file,true);        	
/*
            $fp = fopen($file, "r");
            $data = fread($fp, filesize($file));
            fclose($fp);
            print $data;
*/
            $fp = fopen($file, "r"); 
            while (!feof($fp))
            {
                echo fread($fp, 65536); 
                flush(); // this is essential for large downloads
            }  
            fclose($fp);
    	}
		exit;
    	
	}

}
?>