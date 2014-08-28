<?php
Library::import('playlists.models.assets');
Library::import('diner.models.dinerall');
Library::import('prosfx.models.prosfxall');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix assets/
 */
class assetsController extends Controller {
	
	/** @var assets */
	protected $assets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->assets = new assets();
		$this->diner = new dinerall();
		$this->prosfx = new prosfxall();
		$this->_form = new ModelForm('assets', $this->request->data('assets'), $this->assets);
	}
	
	function getAsset($db_id, $tr_id) {

		$this->assetSet = $this->assets->equal("RecID", $tr_id)->equal("db_id", $db_id)->orderBy('EntryDate DESC');
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
	
	/** !Route GET */
	function index() {
		$this->assetsSet = $this->assets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, name/$name */
	function name($name) {
	
		$this->asset = $this->assets->equal("TrackTitle", $name)->orderBy("id DESC")->first();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
/*
		print $name;
		exit;
*/
	}
	
	/** !Route GET, db/$db_id/tr/$tr_id */
	function addTrackToAssets($db_id, $tr_id) {

		$this->assetSet = $this->assets->equal("RecID", $tr_id)->equal("db_id", $db_id);
		$length = count($this->assetSet);
		if ($db_id == 12) {
			$this->oldAsset = $this->diner->equal("RecID", $tr_id)->first();
		} else if ($db_id == 25) {
			$this->oldAsset = $this->sfx->equal("RecID", $tr_id)->first();
		} else if ($db_id == 26) {
			$this->oldAsset = $this->prosfx->equal("RecID", $tr_id)->first();
		}

		if ($length > 0) {
			$this->asset = $this->assetSet[$length-1];
			
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
				$this->newAsset->TrackTitle = $this->oldAsset->TrackTitle;
				$this->newAsset->Composer = $this->oldAsset->Composer;
				$this->newAsset->Publisher = $this->oldAsset->Publisher;
				$this->newAsset->RecID = $this->oldAsset->RecID;
				$this->newAsset->TotalFrames = $this->oldAsset->TotalFrames;
				$this->newAsset->EntryDate = $this->oldAsset->EntryDate;
				$this->newAsset->Popularity = $this->oldAsset->Popularity;
				$this->newAsset->Split = $this->oldAsset->Split;
				$this->newAsset->Rating = $this->oldAsset->Rating;
				$this->newAsset->SampleRate = $this->oldAsset->SampleRate;
				$this->newAsset->Channels = $this->oldAsset->Channels;
				$this->newAsset->BitDepth = $this->oldAsset->BitDepth;
				$this->newAsset->_WaveformLink = $this->oldAsset->_WaveformLink;
				$this->newAsset->_PictureLink = $this->oldAsset->_PictureLink;
				$this->newAsset->_UMID = $this->oldAsset->_UMID;
				$this->newAsset->Track = $this->oldAsset->Track;
				$this->newAsset->Lyrics = $this->oldAsset->Lyrics;
				$this->newAsset->Description = $this->oldAsset->Description;
				$this->newAsset->Source = $this->oldAsset->Source;
				$this->newAsset->Category = $this->oldAsset->Category;
				$this->newAsset->SubCategory = $this->oldAsset->SubCategory;
				$this->newAsset->Notes = $this->oldAsset->Notes;
				$this->newAsset->Library = $this->oldAsset->Library;
				$this->newAsset->Conductor = $this->oldAsset->Conductor;
				$this->newAsset->Performer = $this->oldAsset->Performer;
				$this->newAsset->BPM = $this->oldAsset->BPM;
				$this->newAsset->Key = $this->oldAsset->Key;
				$this->newAsset->CDTitle = $this->oldAsset->CDTitle;
				$this->newAsset->FeaturedInstrument = $this->oldAsset->FeaturedInstrument;
				$this->newAsset->Mood = $this->oldAsset->Mood;
				$this->newAsset->Version = $this->oldAsset->Version;
				$this->newAsset->BWDescription = $this->oldAsset->BWDescription;
				$this->newAsset->BWTimeStamp = $this->oldAsset->BWTimeStamp;
				$this->newAsset->BWTime = $this->oldAsset->BWTime;
				$this->newAsset->BWDate = $this->oldAsset->BWDate;
				
				$this->newAsset->save();
				$this->result = $this->newAsset->id;
			} else {
				$this->result = $this->asset->id;
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
			$this->newAsset->TrackTitle = $this->oldAsset->TrackTitle;
			$this->newAsset->Composer = $this->oldAsset->Composer;
			$this->newAsset->Publisher = $this->oldAsset->Publisher;
			$this->newAsset->RecID = $this->oldAsset->RecID;
			$this->newAsset->TotalFrames = $this->oldAsset->TotalFrames;
			$this->newAsset->EntryDate = $this->oldAsset->EntryDate;
			$this->newAsset->Popularity = $this->oldAsset->Popularity;
			$this->newAsset->Split = $this->oldAsset->Split;
			$this->newAsset->Rating = $this->oldAsset->Rating;
			$this->newAsset->SampleRate = $this->oldAsset->SampleRate;
			$this->newAsset->Channels = $this->oldAsset->Channels;
			$this->newAsset->BitDepth = $this->oldAsset->BitDepth;
			$this->newAsset->_WaveformLink = $this->oldAsset->_WaveformLink;
			$this->newAsset->_PictureLink = $this->oldAsset->_PictureLink;
			$this->newAsset->_UMID = $this->oldAsset->_UMID;
			$this->newAsset->Track = $this->oldAsset->Track;
			$this->newAsset->Lyrics = $this->oldAsset->Lyrics;
			$this->newAsset->Description = $this->oldAsset->Description;
			$this->newAsset->Source = $this->oldAsset->Source;
			$this->newAsset->Category = $this->oldAsset->Category;
			$this->newAsset->SubCategory = $this->oldAsset->SubCategory;
			$this->newAsset->Notes = $this->oldAsset->Notes;
			$this->newAsset->Library = $this->oldAsset->Library;
			$this->newAsset->Conductor = $this->oldAsset->Conductor;
			$this->newAsset->Performer = $this->oldAsset->Performer;
			$this->newAsset->BPM = $this->oldAsset->BPM;
			$this->newAsset->Key = $this->oldAsset->Key;
			$this->newAsset->CDTitle = $this->oldAsset->CDTitle;
			$this->newAsset->FeaturedInstrument = $this->oldAsset->FeaturedInstrument;
			$this->newAsset->Mood = $this->oldAsset->Mood;
			$this->newAsset->Version = $this->oldAsset->Version;
			$this->newAsset->BWDescription = $this->oldAsset->BWDescription;
			$this->newAsset->BWTimeStamp = $this->oldAsset->BWTimeStamp;
			$this->newAsset->BWTime = $this->oldAsset->BWTime;
			$this->newAsset->BWDate = $this->oldAsset->BWDate;
			
			$this->newAsset->save();
			$this->result = $this->newAsset->id;
		}
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, asset/$db_id/$tr_id */
	function getID($db_id, $tr_id) {
		$this->assetSet = $this->assets->equal("RecID", $tr_id)->equal("db_id", $db_id);
		$length = count($this->assetSet);
		if ($length > 0) {
			$this->asset = $this->assetSet[$length-1];
			$this->result = $this->asset->id;
		} else {
			$this->result = 0;
		}
	}
	
	/** !Route GET, play/$db_id/$tr_id */
	function getPlayUrl($db_id, $tr_id) {
	
		$asset = $this->getAsset($db_id, $tr_id);
		$path = str_replace('/Users/thestation/Music', 'http://'.$_SERVER['SERVER_NAME'], $asset->FilePath);
		print $path;
		
		exit;
	
	}
	
	/** !Route GET, play2/$db_id/$tr_id */
	function getMP3($db_id, $tr_id) {
	
		$this->assets->asset = $this->getAsset($db_id, $tr_id);
	
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->assets->id = $id;
		if($this->assets->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, new */
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
	/** !Route POST */
	function insert() {
		try {
			$this->assets->insert();
			return $this->created($this->urlTo('details', $this->assets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->assets->id = $id;
		if($this->assets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'assets does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldassets = new assets($id);
		if($oldassets->exists()) {
			$oldassets->copy($this->assets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'assets does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->assets->id = $id;
		if($this->assets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'assets does not exist.');
		}
	}
}
?>