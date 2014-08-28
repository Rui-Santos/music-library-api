<?php
/**
 * !Database TheMusicPlayground
 * !Table site_admin
 */
class mpsiteadmin extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column String */
	public $section;

	/** !Column String */
	public $value;

	/** !Column String */
	public $status;

	/** !Column DateTime */
	public $date_created;

}
?>