<?php
/**
 * !Database Default
 * !Table posting_assets
 * !BelongsTo postings, Class: dinerpostings, Key: posting_id
 * !BelongsTo metadata, Class: dinermetadata, Key: track_id
 */
class dinerpostingassets extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $posting_id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $longID;

	/** !Column Integer */
	public $order_position;

	/** !Column Text */
	public $filename;

	/** !Column Text */
	public $filepath;

	/** !Column Text */
	public $title;

}
?>