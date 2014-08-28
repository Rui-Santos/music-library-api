<?php
/**
 * !Database MMAdmin
 * !Table purchases
 * !BelongsTo users, Class: adminusers, Key: user_id
 * !HasMany purchased_tracks, Class: adminpurchasedtracks, Key: purchase_id
 * !HasMany assets, Class: adminassets, Through: adminpurchasedtracks, Key: purchase_id
 */
class adminpurchases extends Model {
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

	/** !Column Integer */
	public $dls_remaining;

}
?>