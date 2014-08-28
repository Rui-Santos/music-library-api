<?php
/**
 * !Database MMAdmin
 * !Table assets
 * !HasMany purchased_tracks, Class: downloadpurchasedtracks, Key: asset_id
 * !HasMany tracks, Class: downloadtracks, Key: asset_id
 */
class downloadassets extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $db_id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $asset_key;

	/** !Column String */
	public $Filename;

	/** !Column String */
	public $Pathname;

	/** !Column Text */
	public $FilePath;

	/** !Column String */
	public $Duration;

	/** !Column String */
	public $FileType;

	/** !Column Date */
	public $CreationDate;

	/** !Column Date */
	public $ModificationDate;

	/** !Column String */
	public $TrackTitle;

	/** !Column String */
	public $Composer;

	/** !Column String */
	public $Publisher;

	/** !Column Integer */
	public $RecID;

	/** !Column Integer */
	public $TotalFrames;

	/** !Column Float */
	public $EntryDate;

	/** !Column Integer */
	public $Popularity;

	/** !Column Integer */
	public $Split;

	/** !Column Integer */
	public $Rating;

	/** !Column Integer */
	public $SampleRate;

	/** !Column Integer */
	public $Channels;

	/** !Column Integer */
	public $BitDepth;

	/** !Column String */
	public $ChannelLayout;

	/** !Column String */
	public $_FlatCategory;

	/** !Column Integer */
	public $_WaveformLink;

	/** !Column Integer */
	public $_PictureLink;

	/** !Column String */
	public $_UMID;

	/** !Column Time */
	public $Time;

	/** !Column String */
	public $Volume;

	/** !Column Integer */
	public $Track;

	/** !Column Integer */
	public $Index;

	/** !Column Integer */
	public $_Dirty;

	/** !Column Text */
	public $Lyrics;

	/** !Column String */
	public $Description;

	/** !Column String */
	public $Source;

	/** !Column String */
	public $Category;

	/** !Column String */
	public $SubCategory;

	/** !Column String */
	public $FXName;

	/** !Column String */
	public $Notes;

	/** !Column String */
	public $Show;

	/** !Column String */
	public $Library;

	/** !Column String */
	public $RecType;

	/** !Column String */
	public $ShortID;

	/** !Column String */
	public $LongID;

	/** !Column String */
	public $RecMedium;

	/** !Column String */
	public $Keywords;

	/** !Column String */
	public $Location;

	/** !Column String */
	public $Microphone;

	/** !Column String */
	public $Arranger;

	/** !Column String */
	public $Conductor;

	/** !Column String */
	public $Performer;

	/** !Column String */
	public $BPM;

	/** !Column String */
	public $Key;

	/** !Column String */
	public $Manufacturer;

	/** !Column String */
	public $Designer;

	/** !Column String */
	public $CDTitle;

	/** !Column String */
	public $CDDescription;

	/** !Column String */
	public $FeaturedInstrument;

	/** !Column String */
	public $Scene;

	/** !Column String */
	public $Take;

	/** !Column String */
	public $Tape;

	/** !Column String */
	public $Mood;

	/** !Column String */
	public $Version;

	/** !Column String */
	public $BWDescription;

	/** !Column String */
	public $BWOriginator;

	/** !Column String */
	public $BWOriginatorRef;

	/** !Column Integer */
	public $BWTimeStamp;

	/** !Column String */
	public $BWTime;

	/** !Column String */
	public $BWDate;

	/** !Column Integer */
	public $SplitChannels;

}
?>