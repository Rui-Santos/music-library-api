<?php
/**
 * !Database MMAdmin
 * !Table log_searches
 * !BelongsTo log, Class: base, Key: id
 */
class searches extends Model {
	/** !Column Integer */
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