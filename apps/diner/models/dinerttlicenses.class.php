<?php
/**
 * !Database Default
 * !Table tt_licenses
 */
class dinerttlicenses extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $date;

	/** !Column Text */
	public $name;

	/** !Column String */
	public $email;

	/** !Column String */
	public $track;

	/** !Column String */
	public $short_id;

	/** !Column Integer */
	public $user_id;

}
?>