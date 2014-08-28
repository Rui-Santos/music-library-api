<?php
/**
 * !Database MMAdmin
 * !Table purchases
 */
class logpurchases extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $log_id;

	/** !Column Integer */
	public $user_id;

	/** !Column String */
	public $hash;

	/** !Column String */
	public $stripe_id;

	/** !Column String */
	public $amount;

	/** !Column DateTime */
	public $date;

	/** !Column String */
	public $type;

	/** !Column String */
	public $status;

}
?>