<?php
Library::import('playlists.models.playlists');
Library::import('playlists.models.tracks');
Library::import('playlists.models.assets');
Library::import('prosfx.models.prosfxassetkeys');
Library::import('diner.models.dinerassets');
Library::import('musicplayground.models.mpassets');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix playlists/
 */
class playlistsController extends Controller {
	
	/** @var playlists */
	protected $playlists;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->playlists = new playlists();
		$this->tracks = new tracks();
		$this->assets = new assets();
		$this->user = new adminusers();
		$this->_form = new ModelForm('playlists', $this->request->data('playlists'), $this->playlists);
	}
	
	function getAsset($oldAsset, $db) {

		$tr_id = $oldAsset->RecID;
		$assetSet = $this->assets->equal("RecID", $tr_id)->equal("db_id", $db)->orderBy('EntryDate DESC');
		//return $assetSet->first();

		$length = count($assetSet);
		//return $length;
		if($length > 0) {
			$asset = $assetSet->first();
			
			if ($asset->EntryDate < $oldAsset->EntryDate) {
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
	/** !Route GET */
	function index() {
		$this->playlistsSet = $this->playlists->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, user/$folderID */
	function user($folderID) {
		$this->playlistsSet = $this->playlists->equal('folder_id', $folderID)->equal('source', 'diner')->notEqual('type','cart')->notEqual('type','purchased');
		$this->playlistsSet->folder_id = $folderID;
		$this->playlistassets = $this->tracks;
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, user2/$folderID */
	function user2($folderID) {
		$this->playlistsSet = $this->playlists->equal('folder_id', $folderID)->equal('source', 'diner');
		$this->playlistsSet->folder_id = $folderID;
		$this->playlistassets = $this->tracks;
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $hash */
	function details($hash) {
	
		$this->playlists->hash = $hash;
		$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
		//$trackAssets = $this->playlists->getTrackAssets();
		if($this->playlists->exists()) {
			$this->user->folder_id = $this->playlists->folder_id;
			if ($this->user->exists()) {
				$this->purchased = $this->user->getPurchasedAssets();
			}
			//$this->playlists->playlistAssets = $this->tracks->equal('playlist_id', $this->playlists->id);
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, id/$id */
	function getID($id) {
		$this->playlists->id = $id;
		$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
		$this->playlists->playlistAssets = $this->tracks->equal('playlist_id', $this->playlists->id);
		$trackAssets = $this->playlists->getTrackAssets();
		if($this->playlists->exists()) {
			if (is_null($this->playlists->hash)) {
				$this->playlists->hash = substr(sha1($id . ":" . $this->playlists->folder_id), 0, 8);
				$this->playlists->save();
			}
			return $this->ok('getID');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}

	}	
	
	/** !Route GET, hashID/$hash */
	function getIDFromHash($hash) {
	
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			print $this->playlists->id;
		} else {
			print 'fail';
		}
	
		exit;
	}
	
	/** !Route GET, delete/$pid */
	function remove($pid) {
		$this->playlists->id = $pid;
		if($this->playlists->delete()) {
			$this->result = true;
		} else {
			$this->result = false;
//			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
		}
	}
	
	/** !Route GET, new */
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
	/** !Route GET, download/$id/$format */
	function download($id, $format) {
	
		$playlist = $this->playlists->equal('hash', $id)->first();
		$name = $playlist->name;
		$tracks = $playlist->getTrackAssets();
		
		$zip = new ZipArchive;
		$zipname = 'THEDINER-'.$name.'-'.rand().'.zip';
		if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
			foreach ($tracks as $track):
			
				if ($format == "mp3") {
					if (file_exists($track->Pathname . "/" . $track->Filename)) {
						$zip->addFile($track->Pathname . "/" . $track->Filename, $track->Filename);
					}
				} else if ($format == "aif") {
					if ($track->db_id == '12') {
						$file = str_replace('MP3s', 'AIFFs', $track->Pathname) . '/' . str_replace('.mp3', '.aif', $track->Filename);
						if (file_exists( $file ) ) {
							$zip->addFile( $file );
						}
					} else if ($track->db_id == '25') {
						$file = str_replace('MP3', 'WAV', $track->Pathname) . '/' . str_replace('.mp3', '.wav', $track->Filename);
						if (file_exists( $file ) ) {
							$zip->addFile( $file );
						}
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
			
				chdir('/Users/thestation/Music/tmp/');
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
	
	}
	
	/** !Route POST */
	function insert() {
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
	}
	
	/** !Route POST, $hash/add */
	function addTracks($hash) {
		
		$assetsArray = json_decode($this->request->input);
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$length = count($this->playlists->tracks());
			//print $length;
			foreach($assetsArray as $asset) {
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
							$r = new mpassets();
							$r->asset_key = $asset;
							if($r->exists()) {
								$n = $this->getAsset($r->metadata(), 6);
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
			$this->playlists->playlistTracks = $this->playlists->getTrackAssets();
			$this->ok('details');
		}
	}
	
	/** !Route POST, $hash/remove/$tracks */
	function removeTracks($hash, $tracks) {
		print $tracks;

		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			
			$trackset = $this->tracks->equal('playlist_id', $this->playlists->id)->orderBy('ndx ASC');
			$removeArray = explode(',', $tracks);
			$newIndexArray = array();
			$i=0;

			foreach($trackset as $track) {
				if(in_array($track->ndx, $removeArray)) {
					$track->delete();
					print "removed".$track->ndx;
				} else {
					$track->ndx = $i;
					$track->save();
					$i++;
				}
			}

//			print_r(count($tracks));
		} else {
			print 'fail';
		}

	
		exit;
	}
	
	/** !Route POST, $hash/empty */
	function emptyPlaylist($hash){
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$tracks = $this->tracks->equal('playlist_id', $this->playlists->id);

			foreach($tracks as $track) {
				$track->delete();
			}

			print_r(count($tracks));
		} else {
			print 'fail';
		}
	
		exit;
	}
	
	/** !Route POST, $hash/reorder/$tracks */
	function reOrderPlaylist($hash, $tracks) {
		$this->playlists->hash = $hash;
		if($this->playlists->exists()) {
			$newTrackOrder = explode(',', $tracks);
			foreach ($newTrackOrder as $i=>$v) {
				$t = new tracks();
				$t->id = $v;
				if ($t->exists()) {
					$t->ndx = $i;
					$t->save();
				}
			}
			print "success";
		} else {
			print "fail";
		}
		exit;
	}
	
	/** !Route POST, $id */
	function update($id) {
		$oldplaylists = new playlists($id);
		if($oldplaylists->exists()) {
			$oldplaylists->copy($this->playlists)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'playlists does not exist.');
		}
	}
}
?>