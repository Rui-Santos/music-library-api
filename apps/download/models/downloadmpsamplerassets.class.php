<?php
/**
 * !Database TheMusicPlayground
 * !Table sampler_assets
 * !BelongsTo metadata, Class: mpmetadata, Key: track_id
 */
class downloadmpsamplerassets extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $sampler_id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $asset_key;

	/** !Column Integer */
	public $order_position;

	/** !Column Text */
	public $filename;

	/** !Column Text */
	public $filepath;

	/** !Column Text */
	public $title;

	/** !Column Text */
	public $artist;

	/** !Column Integer */
	public $artist_id;

}
?>