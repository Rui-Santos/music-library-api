<?php
/**
 * !Database MMAdmin
 * !Table log_downloads
 */
class downloads extends Model {
	/** !Column Integer */
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