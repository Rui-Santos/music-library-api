<?php
/**
 * !Database ProSFX
 * !Table assets
 * !BelongsTo metadata, Class: prosfxall, Key: track_id
 * !BelongsTo metadata, Class: prosfxmetadata, Key: track_id
 */
class prosfxassetkeys extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $asset_key;

}
?>