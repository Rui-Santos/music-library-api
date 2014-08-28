<?php
/**
 * !Database MMAdmin
 * !Table log_searches
 * !BelongsTo log, Class: adminlogs, Key: log_id
 */
class adminsearches extends Model {
	/** !Column PrimaryKey, Integer */
	public $log_id;

	/** !Column Integer */
	public $query_id;

	/** !Column Boolean */
	public $lock;

	/** !Column Text */
	public $text;

	/** !Column Integer */
	public $total;

}
?>