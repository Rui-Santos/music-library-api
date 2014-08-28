<?php
/**
 * !Database MMAdmin
 * !Table purchases
 * !HasMany purchased_tracks, Class: downloadpurchasedtracks, Key: purchase_id
 * !HasMany assets, Class: downloadassets, Through: downloadpurchasedtracks, Key: purchase_id
 */
class downloadpurchase extends Model {
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

}
?>