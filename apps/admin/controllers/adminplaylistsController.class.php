<?php
Library::import('admin.models.adminplaylists');
Library::import('admin.models.admintracks');
Library::import('admin.models.adminassets');
Library::import('prosfx.models.prosfxassetkeys');
Library::import('diner.models.dinerassets');
Library::import('musicplayground.models.mpallassets');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminplaylists/
 * !RoutesPrefix playlists/
 */
class adminplaylistsController extends Controller {
	
	/** @var adminplaylists */
	protected $adminplaylists;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->playlists = new adminplaylists();
		$this->tracks = new admintracks();
		$this->assets = new adminassets();
		$this->user = new adminusers();
		$this->_form = new ModelForm('adminplaylists', $this->request->data('adminplaylists'), $this->adminplaylists);
	}
	
	function getAsset($oldAsset, $db) {

		$tr_id = $oldAsset->RecID;
		$assetSet = $this->assets->equal("RecID", $tr_id)->equal("db_id", $db)->orderBy('EntryDate DESC');
		//return $assetSet->first();

		$length = count($assetSet);
		//return $length;
		if($length > 0) {
			$asset = $assetSet->first();
			
			if ($asset->EntryDate != $oldAsset->EntryDate || $asset->Lyrics != $oldAsset->Lyrics || $asset->Rating != $oldAsset->Rating) {
				$newAsset = new adminassets();
				$newAsset->db_id = $db;
				$newAsset->track_id = $tr_id;
				$newAsset->asset_key = MD5(RAND());
		
				$newAsset->Filename = $oldAsset->Filename;
				$newAsset->Pathname = $oldAsset->Pathname;
				$newAsset->FilePath = $oldAsset->FilePath;
				$newAsset->Duration = $oldAsset->Duration;
				$newAsset->FileType = $oldAsset->FileType;
				$newAsset->CreationDate = $oldAsset->CreationDate;
				$newAsset->ModificationDate = $oldAsset->ModificationDate;
				$newAsset->TotalFrames = $oldAsset->TotalFrames;
				$newAsset->EntryDate = $oldAsset->EntryDate;
				$newAsset->Popularity = $oldAsset->Popularity;
				$newAsset->Split = $oldAsset->Split;
				$newAsset->Rating = $oldAsset->Rating;
				$newAsset->SampleRate = $oldAsset->SampleRate;
				$newAsset->Channels = $oldAsset->Channels;
				$newAsset->BitDepth = $oldAsset->BitDepth;
				$newAsset->ChannelLayout = $oldAsset->ChannelLayout;
				$newAsset->_FlatCategory = $oldAsset->_FlatCategory;
				$newAsset->_WaveformLink = $oldAsset->_WaveformLink;
				$newAsset->_PictureLink = $oldAsset->_PictureLink;
				$newAsset->_UMID = $oldAsset->_UMID;
				$newAsset->Time = $oldAsset->Time;
				$newAsset->Volume = $oldAsset->Volume;
				$newAsset->Track = $oldAsset->Track;
				$newAsset->_Dirty = $oldAsset->_Dirty;
				$newAsset->Lyrics = $oldAsset->Lyrics;
				$newAsset->Description = $oldAsset->Description;
				$newAsset->Source = $oldAsset->Source;
				$newAsset->Category = $oldAsset->Category;
				$newAsset->SubCategory = $oldAsset->SubCategory;
				$newAsset->FXName = $oldAsset->FXName;
				$newAsset->Notes = $oldAsset->Notes;
				$newAsset->Show = $oldAsset->Show;
				$newAsset->Library = $oldAsset->Library;
				$newAsset->RecType = $oldAsset->RecType;
				$newAsset->ShortID = $oldAsset->ShortID;
				$newAsset->LongID = $oldAsset->LongID;
				$newAsset->RecMedium = $oldAsset->RecMedium;
				$newAsset->Keywords = $oldAsset->Keywords;
				$newAsset->Location = $oldAsset->Location;
				$newAsset->Microphone = $oldAsset->Microphone;
				$newAsset->Composer = $oldAsset->Composer;
				$newAsset->Arranger = $oldAsset->Arranger;
				$newAsset->Conductor = $oldAsset->Conductor;
				$newAsset->Publisher = $oldAsset->Publisher;
				$newAsset->Performer = $oldAsset->Performer;
				$newAsset->BPM = $oldAsset->BPM;
				$newAsset->Key = $oldAsset->Key;
				$newAsset->Manufacturer = $oldAsset->Manufacturer;
				$newAsset->Designer = $oldAsset->Designer;
				$newAsset->TrackTitle = $oldAsset->TrackTitle;
				$newAsset->CDTitle = $oldAsset->CDTitle;
				$newAsset->CDDescription = $oldAsset->CDDescription;
				$newAsset->FeaturedInstrument = $oldAsset->FeaturedInstrument;
				$newAsset->Scene = $oldAsset->Scene;
				$newAsset->Take = $oldAsset->Take;
				$newAsset->Tape = $oldAsset->Tape;
				$newAsset->Mood = $oldAsset->Mood;
				$newAsset->Version = $oldAsset->Version;
				$newAsset->BWDescription = $oldAsset->BWDescription;
				$newAsset->BWOriginator = $oldAsset->BWOriginator;
				$newAsset->BWOriginatorRef = $oldAsset->BWOriginatorRef;
				$newAsset->BWTimeStamp = $oldAsset->BWTimeStamp;
				$newAsset->BWTime = $oldAsset->BWTime;
				$newAsset->BWDate = $oldAsset->BWDate;
				$newAsset->RecID = $oldAsset->RecID;
				
				$newAsset->save();
				return $newAsset;
			} else {
				return $asset;
			}
			
		} else {
			$newAsset = new adminassets();
			$newAsset->db_id = $db;
			$newAsset->track_id = $tr_id;
			$newAsset->asset_key = MD5(RAND());
	
			$newAsset->Filename = $oldAsset->Filename;
			$newAsset->Pathname = $oldAsset->Pathname;
			$newAsset->FilePath = $oldAsset->FilePath;
			$newAsset->Duration = $oldAsset->Duration;
			$newAsset->FileType = $oldAsset->FileType;
			$newAsset->CreationDate = $oldAsset->CreationDate;
			$newAsset->ModificationDate = $oldAsset->ModificationDate;
			$newAsset->TotalFrames = $oldAsset->TotalFrames;
			$newAsset->EntryDate = $oldAsset->EntryDate;
			$newAsset->Popularity = $oldAsset->Popularity;
			$newAsset->Split = $oldAsset->Split;
			$newAsset->Rating = $oldAsset->Rating;
			$newAsset->SampleRate = $oldAsset->SampleRate;
			$newAsset->Channels = $oldAsset->Channels;
			$newAsset->BitDepth = $oldAsset->BitDepth;
			$newAsset->ChannelLayout = $oldAsset->ChannelLayout;
			$newAsset->_FlatCategory = $oldAsset->_FlatCategory;
			$newAsset->_WaveformLink = $oldAsset->_WaveformLink;
			$newAsset->_PictureLink = $oldAsset->_PictureLink;
			$newAsset->_UMID = $oldAsset->_UMID;
			$newAsset->Time = $oldAsset->Time;
			$newAsset->Volume = $oldAsset->Volume;
			$newAsset->Track = $oldAsset->Track;
			$newAsset->_Dirty = $oldAsset->_Dirty;
			$newAsset->Lyrics = $oldAsset->Lyrics;
			$newAsset->Description = $oldAsset->Description;
			$newAsset->Source = $oldAsset->Source;
			$newAsset->Category = $oldAsset->Category;
			$newAsset->SubCategory = $oldAsset->SubCategory;
			$newAsset->FXName = $oldAsset->FXName;
			$newAsset->Notes = $oldAsset->Notes;
			$newAsset->Show = $oldAsset->Show;
			$newAsset->Library = $oldAsset->Library;
			$newAsset->RecType = $oldAsset->RecType;
			$newAsset->ShortID = $oldAsset->ShortID;
			$newAsset->LongID = $oldAsset->LongID;
			$newAsset->RecMedium = $oldAsset->RecMedium;
			$newAsset->Keywords = $oldAsset->Keywords;
			$newAsset->Location = $oldAsset->Location;
			$newAsset->Microphone = $oldAsset->Microphone;
			$newAsset->Composer = $oldAsset->Composer;
			$newAsset->Arranger = $oldAsset->Arranger;
			$newAsset->Conductor = $oldAsset->Conductor;
			$newAsset->Publisher = $oldAsset->Publisher;
			$newAsset->Performer = $oldAsset->Performer;
			$newAsset->BPM = $oldAsset->BPM;
			$newAsset->Key = $oldAsset->Key;
			$newAsset->Manufacturer = $oldAsset->Manufacturer;
			$newAsset->Designer = $oldAsset->Designer;
			$newAsset->TrackTitle = $oldAsset->TrackTitle;
			$newAsset->CDTitle = $oldAsset->CDTitle;
			$newAsset->CDDescription = $oldAsset->CDDescription;
			$newAsset->FeaturedInstrument = $oldAsset->FeaturedInstrument;
			$newAsset->Scene = $oldAsset->Scene;
			$newAsset->Take = $oldAsset->Take;
			$newAsset->Tape = $oldAsset->Tape;
			$newAsset->Mood = $oldAsset->Mood;
			$newAsset->Version = $oldAsset->Version;
			$newAsset->BWDescription = $oldAsset->BWDescription;
			$newAsset->BWOriginator = $oldAsset->BWOriginator;
			$newAsset->BWOriginatorRef = $oldAsset->BWOriginatorRef;
			$newAsset->BWTimeStamp = $oldAsset->BWTimeStamp;
			$newAsset->BWTime = $oldAsset->BWTime;
			$newAsset->BWDate = $oldAsset->BWDate;
			$newAsset->RecID = $oldAsset->RecID;
			
			$newAsset->save();
			return $newAsset;
		}
	}


	/** !Route GET, user */
	function user() {
		
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		$d = $this->digest();
		if ($this->user->exists()) {
			$d = $this->digest();
			$this->d = $d['username'];
			if ($d['username'] == 'apitester') {
				$this->playlistsSet = $this->playlists->equal('folder_id', $this->user->folder_id)->equal('source', 'diner')->orderBy('created ASC');
			} else {
				$this->playlistsSet = $this->playlists->equal('folder_id', $this->user->folder_id)->equal('source', $d['username'])->orderBy('created ASC');
			}
			$this->playlistsSet->folder_id = $this->user->folder_id;
			$this->playlistassets = $this->tracks;
			if(isset($this->request->get['flash'])) {
				$this->flash = $this->request->get['flash'];
			}
		} else {
			print 'user does not exist';
			exit;
		}
	}
	
	/** !Route GET, $hash */
	function details($hash) {
	
		$this->playlists->hash = $hash;
		$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
		//$trackAssets = $this->playlists->getTrackAssets();
		$d = $this->digest();
		$this->d = $d['username'];
		if($this->playlists->exists()) {
			$this->user->folder_id = $this->playlists->folder_id;
			if ($this->user->exists()) {
				$this->purchased = $this->user->getPurchasedAssets();
			}
			//$this->playlists->playlistAssets = $this->tracks->equal('playlist_id', $this->playlists->id);
			if($this->d = 'themusicplayground') {
				return $this->ok('details-mp');
			} else {
				return $this->ok('details');
			}
		} else {
			return $this->forwardNotFound('not found');
		}
	}
	
	/** !Route POST, delete/$hash */
	function remove($hash) {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		$d = $this->digest();
		if ($this->user->exists()) {
			$this->playlists->hash = $hash;
			$t = new playlists();
			$t->hash = $hash;
			if($t->exists()) {
				if($t->folder_id == $this->user->folder_id) {
					if($this->playlists->delete()) {
						$p = new playlists();
						if ($d['username'] == 'apitester') {
							$this->playlistsSet = $p->equal('folder_id', $this->user->folder_id)->equal('source', 'diner')->orderBy('created ASC');
						} else {
							$this->playlistsSet = $p->equal('folder_id', $this->user->folder_id)->equal('source', $d['username'])->orderBy('created ASC');
						}
						$this->playlistsSet->folder_id = $this->user->folder_id;
						$this->d = $d['username'];
						$this->ok('user');
					} else {
						print false;
						exit;
			//			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
					}
				} else {
					print false;
					exit;
				}
			} else {
				print false;
				exit;
			}
		} else {
			print false;
			exit;
		}
	}

	/** !Route POST */
	function insert() {
		$input = $this->getInput();

		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		$d = $this->digest();
		if ($this->user->exists()) {
			$n = new playlists();
			$n->folder_id = $this->user->folder_id;
			$n->path = $this->user->id . ":" . $this->user->folder_id . "/";
			if(empty($input['name'])) {
    		 $n->name = '[no name]';
			} else {
			 $n->name = $input['name'];
			}
			$n->updated_by = $this->user->id;
			$n->created = $_SERVER['REQUEST_TIME'];
			$n->updated = $_SERVER['REQUEST_TIME'];
			if ($d['username'] == 'apitester') {
				$n->source = 'diner';
			} else {
				$n->source = $d['username'];
			}
			$n->save();
			$n->hash = substr(sha1($n->id . ":" . $n->folder_id), 0, 8);
			$n->save();
			if ($d['username'] == 'apitester') {
				$this->playlistsSet = $this->playlists->equal('folder_id', $this->user->folder_id)->equal('source', 'diner')->orderBy('created ASC');
			} else {
				$this->playlistsSet = $this->playlists->equal('folder_id', $this->user->folder_id)->equal('source', $d['username'])->orderBy('created ASC');
			}
			$this->playlistsSet->folder_id = $this->user->folder_id;
			$this->playlistassets = $this->tracks;
			$this->d = $d['username'];
			$this->ok('user');
		} else {
			print false;
			exit;
		}
/*
 		try { 
			$this->playlists->insert();
			$this->playlists->hash = substr(sha1($this->playlists->id . ":" . $this->playlists->folder_id), 0, 8);
			$this->playlists->save();
			
			$retData = json_encode($this->playlists);
			print $retData;
			exit;
			
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
*/
	}
	
	/** !Route POST, $hash/add */
	function addTracks($hash) {
		
		$input = $this->getInput();
		$d = $this->digest();

//		$assetsArray = json_decode($this->request->input);
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$length = count($this->playlists->tracks());
			//print $length;
			if($d['username'] == "themusicplayground") {
     			foreach($input as $asset) {
    				$a = new mpallassets();
    				$a->file_hash = $asset;
    				if ($a->exists()) {
    				    $n = $this->getAsset($a->metadata()->first(), 6);
    					
    					if($a->asset_key != $n->asset_key) {
    						$a->asset_key = $n->asset_key;
    						$a->asset_id = $n->id;
    						$a->save();
    					}
    					
    					$t = new tracks();
    					$t->playlist_id = $this->playlists->id;
    					$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
    					$t->asset_id = $n->id;
    					$t->db_id = $n->db_id;
    					$t->track_id = $n->track_id;
    					$t->file_hash = $a->file_hash;
    					$t->ndx = $length;
    					$t->created = $_SERVER['REQUEST_TIME'];
    					$t->updated = $_SERVER['REQUEST_TIME'];
    					$t->updated_by = $this->playlists->updated_by;
    					$t->save();
    					$length++;
    					
    					$a->playlistadds = $a->playlistadds + 1;
    					$a->save();
    				}
    			}
   			
			} else {
    			foreach($input as $asset) {
    				$a = new assets();
    				$a->asset_key = $asset;
    				if ($a->exists()) {
    				
    					switch($a->db_id) {
    						case 26:
    							$r = new prosfxassetkeys();
    							$r->asset_key = $asset;
    							if($r->exists()) {
    								$n = $this->getAsset($r->metadata(), 26);
    							}
    							break;
    						case 12:
    							$r = new dinerassets();
    							$r->asset_key = $asset;
    							if($r->exists()) {
    								$n = $this->getAsset($r->metadata(), 12);
    							}	
    							break;
    						case 6:
    							$r = new mpallassets();
    							$r->file_hash = $asset;
    							if($r->exists()) {
    								$n = $this->getAsset($r->metadata()->first(), 6);
    							}
    							break;
    					}
    					//$n = $this->getAsset($track);
    					
    					if($r->asset_key != $n->asset_key) {
    						$r->asset_key = $n->asset_key;
    						$r->save();
    					}
    					
    					$t = new tracks();
    					$t->playlist_id = $this->playlists->id;
    					$t->path = $this->playlists->path . '/' . $this->playlists->name . ':' . $this->playlists->id . '/';
    					$t->asset_id = $n->id;
    					$t->db_id = $n->db_id;
    					$t->track_id = $n->track_id;
    					$t->ndx = $length;
    					$t->created = $_SERVER['REQUEST_TIME'];
    					$t->updated = $_SERVER['REQUEST_TIME'];
    					$t->updated_by = $this->playlists->updated_by;
    					$t->save();
    					$length++;
    				}
    			}
    			
			}
			$this->d = $d['username'];
			$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
			$this->ok('details');
		}
	}
	
	/** !Route POST, $hash/remove */
	function removeTracks($hash) {

		$input = $this->getInput();

		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			
			$trackset = $this->tracks->equal('playlist_id', $this->playlists->id)->orderBy('ndx ASC');
/* 			$removeArray = json_decode($this->request->input); */
			$newIndexArray = array();
			$i=0;

			foreach($trackset as $track) {
				if(in_array($track->assets()->asset_key, $input)) {
					$track->delete();
					//print "removed".$track->ndx;
				} else {
					$track->ndx = $i;
					$track->save();
					$i++;
				}
			}
			$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
			$d = $this->digest();
			$this->d = $d['username'];
			if($this->d == "themusicplayground") {
				$this->ok('details-mp');
			} else {
				$this->ok('details');
			}

//			print_r(count($tracks));
		} else {
			print false;
			exit;
		}

	
	}
	
	/** !Route POST, $hash/empty */
	function emptyPlaylist($hash){
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$tracks = $this->tracks->equal('playlist_id', $this->playlists->id);

			foreach($tracks as $track) {
				$track->delete();
			}

			print 'success';
			exit;
/*
			$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
			$this->ok('details');
*/
		} else {
			print 'fail';
			exit;
		}
	
	}
	
	/** !Route POST, $hash/reorder */
	function reOrderPlaylist($hash) {
		
		$input = $this->getInput();
		
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$trackset = $this->tracks->equal('playlist_id', $this->playlists->id)->orderBy('ndx ASC');
/* 			$newTrackOrder = $input; */
			foreach($trackset as $key=>$val) {
				$val->ndx = $input[$key];
				$val->save();
/*
				$t = new tracks();
				$t->id = $v;
				if ($t->exists()) {
					$t->ndx = $i;
					$t->save();
				}
*/
			}
			$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
			$d = $this->digest();
			$this->d = $d['username'];
			if($this->d == "themusicplayground") {
				$this->ok('details-mp');
			} else {
				$this->ok('details');
			}
			//exit;
		} else {
			print "fail";
			exit;
		}
	}
	
	/** !Route POST, $hash/rename */
	function update($hash) {
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$this->playlists->name = $this->request->post['name'];
			$this->playlists->save();
			$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
			$this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'playlists does not exist.');
		}
	}
}
?>