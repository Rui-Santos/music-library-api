<?php
/**
 * !Database TheMusicPlayground
 * !Table assets
 * !BelongsTo metadata, Class: mpall, Key: track_id
 */
class mpassets extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $asset_key;

}
?>