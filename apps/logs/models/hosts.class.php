<?php
/**
 * !Database MMAdmin
 * !Table hosts
 */
class hosts extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column String */
	public $ip;

	/** !Column String */
	public $name;

}
?>