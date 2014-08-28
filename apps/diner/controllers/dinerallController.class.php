<?php
Library::import('diner.models.dinerall');
Library::import('diner.models.dinerassets');
Library::import('admin.models.adminassets');
Library::import('recess.framework.forms.ModelForm');

//require('/var/www/vhosts/thedinermusic.com/httpdocs/api/cloudDL.php');
//include('/var/www/vhosts/thedinermusic.com/httpdocs/api/cloudDL.php');

/**
 * !RespondsWith Layouts
 * !Prefix dinerall/
 * !RoutesPrefix all/
 */
class dinerallController extends Controller {
	
	/** @var dinerall */
	protected $dinerall;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerall = new dinerall();
		$this->dinerallassets = new assets();
		$this->_form = new ModelForm('dinerall', $this->request->data('dinerall'), $this->dinerall);
	}
	
	function getAsset($oldAsset) {

		$tr_id = $oldAsset->RecID;
		$assetSet = $this->dinerallassets->equal("RecID", $tr_id)->equal("db_id", '12')->orderBy('EntryDate DESC');
		//return $assetSet->first();

		$length = count($assetSet);
		//return $length;
		if($length > 0) {
			$asset = $assetSet->first();
			
			if ($asset->EntryDate < $oldAsset->EntryDate) {
				$newAsset = new adminassets();
				$newAsset->db_id = 12;
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
			$newAsset->db_id = 12;
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
		$this->dinerallSet = $this->dinerall->all()->orderBy('TrackTitle ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function details($RecID) {
		$RecID = substr($RecID, 2);
		$this->dinerall->RecID = $RecID;
		$this->dinerall->assets = $this->dinerallassets->equal('RecID', $RecID);
		if($this->dinerall->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/**
	* !Route GET, updateassets
	* !Route GET, updateassets/$library
	* !Route GET, updateassets/$library/$limit
	* !Route GET, updateassets/$library/$limit/$offset
	* */
	function updateAssets($library='Diner',$limit=1000,$offset=0) {
		$allTracks = $this->dinerall->equal('Manufacturer',$library)->limit($limit)->offset($offset);
		foreach ($allTracks as $key=>$track) {
			$fullAsset = $this->getAsset($track);
			$asset = $track->assets();
			if (count($asset) == 0) {
				$newAsset = new dinerassets();
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
				print $a->TrackTitle.'<br/>';
			}
/*
			$path = $t->cloudPrefixes()->{$t->Manufacturer}['path'];
			if(!file_exists('/MEDIAPATH/GOES/HERE/media/'.$path.'/'.$t->Filename)) {
				$x=cloudDL($t->Filename,$path);
				print $x->name;
			}
*/
		}
		print 'success';
		exit;
	}
	
	/** !Route GET, test/$RecID*/
	function test($RecID) {
		$this->dinerall->RecID = $RecID;
		if($this->dinerall->exists()) {
			print count($this->dinerall->assets()) . "<br/>";
			print $this->dinerall->assets()->first()->asset_key;
		}
		exit;
	}
	
}
?>