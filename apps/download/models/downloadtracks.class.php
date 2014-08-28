<?php
/**
 * !Database MMAdmin
 * !Table tracks
 * !BelongsTo playlists, Class: downloadpurchase, Key: playlist_id
 * !BelongsTo assets, Class: downloadassets, Key: asset_id
 */
class downloadtracks extends Model {
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