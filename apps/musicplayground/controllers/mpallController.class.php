<?php
Library::import('musicplayground.models.mpall');
Library::import('musicplayground.models.mpassets');
Library::import('playlists.models.assets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpall/
 * !RoutesPrefix all/
 */
class mpallController extends Controller {
	
	/** @var mpall */
	protected $mpall;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpall = new mpall();
		$this->mpallassets = new assets();
		$this->_form = new ModelForm('mpall', $this->request->data('mpall'), $this->mpall);
	}
	
	function getAsset($oldAsset) {

		$tr_id = $oldAsset->RecID;
		$assetSet = $this->mpallassets->equal("RecID", $tr_id)->equal("db_id", '6')->orderBy('EntryDate DESC');
		//return $assetSet->first();

		$length = count($assetSet);
		//return $length;
		if($length > 0) {
			$asset = $assetSet->first();
			
			if ($asset->EntryDate < $oldAsset->EntryDate) {
				$newAsset = new adminassets();
				$newAsset->db_id = 6;
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
			$newAsset->db_id = 6;
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
		$this->mpallSet = $this->mpall->all()->orderBy('Library ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function details($RecID) {
		if (substr($RecID, 0, 2) == 'mp'){
			$RecID = substr($RecID, 2);
		}
		$this->mpall->RecID = $RecID;
		if($this->mpall->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, audio/$RecID */
	function audio($RecID) {
/* 		$RecID = substr($RecID, 2); */
		$this->mpall->RecID = $RecID;
/* 		$this->mpall->equal('RecID',$RecID)->first(); */
		if($this->mpall->exists()) {
			return $this->ok('audio');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, updateassets */
	function updateAssets() {
		$allTracks = $this->mpall->all();
		foreach ($allTracks as $key=>$track) {
			if($track->Rating != $track->Location) {
				$track->Rating = $track->Location;
				$track->save();
			}
			$fullAsset = $this->getAsset($track);
			$asset = $track->assets();
			if (count($asset) == 0) {
				$newAsset = new mpassets();
				$newAsset->track_id = $track->RecID;
				$newAsset->asset_key = $fullAsset->asset_key;
				$newAsset->save();
				print $newAsset->id.'<br/>';
			} else {
				$a = $asset->first();
				if ($a->asset_key != $fullAsset->asset_key) {
					$a->asset_key = $fullAsset->asset_key;
					$a->save();
				}
				print $a->id.'<br/>';
			}
		}
		print 'success';
		exit;
	}

	/** !Route GET, new */
/*
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
*/
	/** !Route POST */
/*
	function insert() {
		try {
			$this->mpall->insert();
			return $this->created($this->urlTo('details', $this->mpall->RecID));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
*/
	
	/** !Route GET, $RecID/edit */
/*
	function editForm($RecID) {
		$this->mpall->RecID = $RecID;
		if($this->mpall->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpall does not exist.');
		}
	}
*/
	
	/** !Route PUT, $RecID */
/*
	function update($RecID) {
		$oldmpall = new mpall($RecID);
		if($oldmpall->exists()) {
			$oldmpall->copy($this->mpall)->save();
			return $this->forwardOk($this->urlTo('details', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpall does not exist.');
		}
	}
*/
	
	/** !Route DELETE, $RecID */
/*
	function delete($RecID) {
		$this->mpall->RecID = $RecID;
		if($this->mpall->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpall does not exist.');
		}
	}
*/
}
?>