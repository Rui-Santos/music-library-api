<?php
/**
 * !Database MMAdmin
 * !Table browsers
 */
class browsers extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column String */
	public $user_agent;

	/** !Column String */
	public $browser;

	/** !Column Float */
	public $version;

	/** !Column Integer */
	public $version_maj;

	/** !Column Integer */
	public $version_min;

	/** !Column String */
	public $platform;

}
?>