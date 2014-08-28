<?php
/**
 * !Database MMAdmin
 * !Table shares
 * !BelongsTo log, Class: adminlogs, Key: log_id
 */
class adminshares extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $log_id;

	/** !Column String */
	public $type;

	/** !Column String */
	public $value;

	/** !Column String */
	public $method;

	/** !Column Text */
	public $message;

	/** !Column String */
	public $email;

}
?>