<?php
/**
 * !Database MMAdmin
 * !Table tracks
 * !BelongsTo playlists, Class: dinerplaylists, Key: playlist_id
 * !BelongsTo assets, Class: dinerallassets, Key: asset_id
 */
class dinerplaylistassets extends Model {

	public function getID() {
		return $this->id;
	}
	
	public function getAsset() {
		return $this->assets();
	}

	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;
	
	/** !Column Integer */
	public $playlist_id;

	/** !Column String */
	public $path;

	/** !Column Integer */
	public $asset_id;

	/** !Column Integer */
	public $db_id;

	/** !Column Integer */
	public $track_id;

	/** !Column Integer */
	public $ndx;

	/** !Column String */
	public $usage;

	/** !Column Time */
	public $time;

	/** !Column DateTime */
	public $created;

	/** !Column DateTime */
	public $updated;

	/** !Column Integer */
	public $updated_by;

	/** !Column Integer */
	public $orig_id;

}
?>