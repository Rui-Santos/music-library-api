<?php
/**
 * !Database MMAdmin
 * !Table log_downloads
 * !BelongsTo log, Class: adminlogs, Key: log_id
 */
class admindownloads extends Model {
	/** !Column PrimaryKey, Integer */
	public $log_id;

	/** !Column Integer */
	public $asset_id;

	/** !Column Integer */
	public $db_id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $file_path;

	/** !Column Integer */
	public $file_size;

	/** !Column String */
	public $file_type;

	/** !Column Boolean */
	public $completed;

}
?>