<?php
/**
 * !Database Default
 * !Table assets
 * !BelongsTo metadata, Class: dinerall, Key: track_id
 * !BelongsTo metadata, Class: dinerquery, Key: track_id
 * !BelongsTo metadata, Class: dinermetadata, Key: track_id
 */
class dinerassets extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $asset_key;

}
?>