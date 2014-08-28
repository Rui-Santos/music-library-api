<?php
/**
 * !Database MMAdmin
 * !Table log_logins
 * !BelongsTo log, Class: adminlogs, Key: log_id
 */
class adminlogins extends Model {
	/** !Column PrimaryKey, Integer */
	public $log_id;

	/** !Column Integer */
	public $login_id;

	/** !Column String */
	public $method;

}
?>