<?php
Library::import('musicplayground.models.mpallassets');
Library::import('musicplayground.models.mpmetadata');
Library::import('admin.models.adminassets');
Library::import('recess.framework.forms.ModelForm');

require('/var/www/vhosts/thedinermusic.com/httpdocs/api/cloudDL.php');

/**
 * !RespondsWith Layouts
 * !Prefix mpallassets/
 */
class mpallassetsController extends Controller {
	
	/** @var mpallassets */
	protected $mpallassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpallassets = new mpallassets();
		$this->adminassets = new adminassets();
		$this->mpmetadata = new mpmetadata();
		$this->_form = new ModelForm('mpallassets', $this->request->data('mpallassets'), $this->mpallassets);
	}
	
	function getAsset($oldAsset) {

		$tr_id = $oldAsset->RecID;
		$assetSet = $this->adminassets->equal("RecID", $tr_id)->equal("db_id", '6')->orderBy('EntryDate DESC');
		//return $assetSet->first();

		$length = count($assetSet);
		//return $length;
		if($length > 0) {
			$asset = $assetSet->first();
			
			if ($asset->EntryDate != $oldAsset->EntryDate) {
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

	/**
	* !Route GET, updateassets
	* !Route GET, updateassets/$type
	* !Route GET, updateassets/$type/$artist
	* */
	function updateAssets($type="ORIGINAL", $artist) {
	
	   $type = strtoupper($type);
	   
	   if($type=='ORIGINAL') {
		$allTracks = $this->mpmetadata->equal('Version',$type);
	   } else {
		$allTracks = $this->mpmetadata->notEqual('Version','ORIGINAL');
	   }
	   if($artist) {
		   $allTracks = $allTracks->equal('Source',$artist);
	   }
/* 	   print count($allTracks); */
	
		foreach ($allTracks as $key=>$t) {
			$tmod = false;
			if($t->Rating != $t->Location) {
				$t->Rating = $t->Location;
				$tmod = true;
				//$t->save();
			}
			$cdd = $t->Library.' '.$t->CDTitle;
			$cdd = substr($cdd, 0, strrpos($cdd, "(")-1);
			$cdd = trim($cdd);
			$cdd = preg_replace('/( )\1{0,}/','-',$cdd);
			$cdd = preg_replace('/[^A-Za-z0-9\-]/','',$cdd);
			$cdd = strtolower($cdd);
			
			if($t->CDDescription != $cdd) {
				$t->CDDescription = $cdd;
				$tmod = true;
			}
			if($tmod) {
				$t->save();
			}

			$fullAsset = $this->getAsset($t);
			$asset = $t->all_assets();
			
			$e = $this->mpallassets->equal('id',$t->LongID);
			
			if(!$asset && count($e)>0) {
    			print 'error';
    			exit;
			}
			
			if (!$asset) {
			// if(!is_null($t->LongID)){
				$a = new mpallassets();
				$a->id = $t->LongID;
				$a->shortID = $t->ShortID;
				$a->file_hash = md5($t->LongID . rand());
				$a->track_id = $t->RecID;
				$a->asset_id = $fullAsset->id;
				$a->asset_key = $fullAsset->asset_key;
				$a->version = $t->Version;
				$a->date_modified = time();
				$a->insert();
				$b = new mpallassets($t->LongID);
				print $b->id.'<br/>';
			// }
			} else {
				$a = $asset;
				if ($a->asset_id != $fullAsset->id) {
				    $a->asset_id = $fullAsset->id;
					$a->asset_key = $fullAsset->asset_key;
					$a->date_modified = time();
				}
				if($a->track_id != $t->RecID) {
    				$a->track_id = $t->RecID;
    				$a->shortID = $t->ShortID;
    				$a->version = $t->Version;
    				$a->date_modified = time();
				}
				$a->save();
				print $a->id.'<br/>';
			}
			if($t->Version != "ORIGINAL") {
				$o = new mpallassets($t->ShortID);
				if($o->exists()){
    				$in = false;
    				if($o->alt_data != 'NULL' && $o->alt_data != 'none' && !is_null($o->alt_data)) {
        				$d = json_decode($o->alt_data, TRUE);
        				foreach($d as $dx) {
            				if($dx['RecID'] == $t->RecID) {
                				$in = true;
                				break;
            				}
        				}
    				} else {
        				$d = array();
    				}
    				if(!$in) {
        				$val = array();
        				$val['RecID'] = $t->RecID;
        				$val['trackName'] = $t->TrackTitle;
        				$val['duration'] = $t->Duration;
        				$val['version'] = $t->Version;
        				$val['file_hash'] = $a->file_hash;
        				$val['asset_key'] = $fullAsset->asset_key;
        				$val['longID'] = $t->LongID;
        				array_push($d, $val);
        				$o->alt_data = json_encode($d);
        				$o->save();
    				}
    				
				}
			}
			if(!file_exists('/MEDIAPATH/GOES/HERE/media/the_music_playground/'.$t->Filename)) {
				$x=cloudDL($t->Filename,'the_music_playground');
				print $x->name;
			}
		}
        
		print 'success';
		exit;
	}
	
	/**
	* !Route GET, fixalts
	* !Route GET, fixalts/$artist
	* */
	function fixAlts($artist) {
	
	   //$type = strtoupper($type);
	   
/*
	   if($type=='ORIGINAL') {
		$allTracks = $this->mpmetadata->equal('Version',$type);
	   } else {
		$allTracks = $this->mpmetadata->notEqual('Version','ORIGINAL');
	   }
*/
	   if($artist) {
		   $allTracks = $this->mpmetadata->equal('Source',$artist);
	   }
	   print count($allTracks);
	
		foreach ($allTracks as $key=>$t) {
/*
			$t->alt_data = 'none';
			$t->save();
*/
			$o = new mpallassets($t->LongID);
			if($o->exists()){
				$o->alt_data = 'none';
				$o->save();
			}
		}
		foreach ($allTracks as $key=>$t) {
			if($t->Version != "ORIGINAL") {
				$fullAsset = $this->getAsset($t);
				$a = $t->all_assets();
				$o = new mpallassets($t->ShortID);
				if($o->exists()){
    				$in = false;
    				if($o->alt_data != 'NULL' && $o->alt_data != 'none' && !is_null($o->alt_data)) {
        				$d = json_decode($o->alt_data, TRUE);
        				foreach($d as $dx) {
            				if($dx['RecID'] == $t->RecID) {
                				$in = true;
                				break;
            				}
        				}
    				} else {
        				$d = array();
    				}
    				if(!$in) {
        				$val = array();
        				$val['RecID'] = $t->RecID;
        				$val['trackName'] = $t->TrackTitle;
        				$val['duration'] = $t->Duration;
        				$val['version'] = $t->Version;
        				$val['file_hash'] = $a->file_hash;
        				$val['asset_key'] = $fullAsset->asset_key;
        				$val['longID'] = $t->LongID;
        				array_push($d, $val);
        				$o->alt_data = json_encode($d);
        				$o->save();
    				}
    				
				}
			}
		}
        
		print 'success';
		exit;
	}

	/**
	* !Route GET, check
	* !Route GET, check/$lid
	* */
	function check($lid=false) {
    	
    	if($lid) {
    	   if($lid=='reverse') {
        	   $a = $this->mpallassets->all();
        	   foreach ($a as $val) {
            	   if(count($val->metadata()) == 0) {
                	   print $val->id . " - no metadata" . "<br/>";
            	   } else if(count($val->metadata())>1) {
                	   print $val->id . " - " . count($val->metadata()) . " metadata" . "<br/>";
            	   } 
        	   }
    	   } else {
        	$a = $this->mpmetadata->equal('LongID',$lid);
        	//print_r($a->first());
        	$asset = $a->first()->all_assets();
        	if($asset) {
            	print_r($asset);
        	} else {
            	print "no asset";
        	}
           }
    	} else {
        	$a = $this->mpmetadata->all();
        	
        	foreach($a as $val) {
        	   $b = $val->all_assets();
        	   if(!$b) {
            	   print $val->LongID . '<br/>';
        	   }
        	}
    	}
    	
    	exit;
	}
	
}
?>