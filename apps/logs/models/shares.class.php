<?php
/**
 * !Database MMAdmin
 * !Table shares
 */
class shares extends Model {
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

}
?>