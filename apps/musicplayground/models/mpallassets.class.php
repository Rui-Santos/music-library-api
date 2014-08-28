<?php
/**
 * !Database TheMusicPlayground
 * !Table all_assets
 * !HasMany metadata, Class: mpmetadata, Key: LongID
 * !HasMany sampler_assets, Class: mpsamplerassets, Key: longID
 */
class mpallassets extends Model {
	/** !Column PrimaryKey, String */
	public $id;

	/** !Column String */
	public $shortID;

	/** !Column String */
	public $file_hash;

	/** !Column Integer */
	public $track_id;

	/** !Column Integer */
	public $asset_id;

	/** !Column String */
	public $asset_key;

	/** !Column Integer */
	public $db_id;

	/** !Column String */
	public $status;

	/** !Column String */
	public $version;

	/** !Column Text */
	public $alt_data;

	/** !Column Integer */
	public $auditions;

	/** !Column Integer */
	public $downloads;

	/** !Column Integer */
	public $playlistadds;

	/** !Column Integer */
	public $shares;

	/** !Column Timestamp */
	public $date_added;

	/** !Column Timestamp */
	public $date_modified;

}
?>