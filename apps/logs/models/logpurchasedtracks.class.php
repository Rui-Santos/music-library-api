<?php
/**
 * !Database MMAdmin
 * !Table purchased_tracks
 */
class logpurchasedtracks extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $purchase_id;

	/** !Column Integer */
	public $asset_id;

	/** !Column Integer */
	public $user_id;

	/** !Column Integer */
	public $db_id;

	/** !Column DateTime */
	public $created;

}
?>