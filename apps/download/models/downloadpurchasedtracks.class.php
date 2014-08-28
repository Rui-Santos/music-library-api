<?php
/**
 * !Database MMAdmin
 * !Table purchased_tracks
 * !BelongsTo purchases, Class: downloadpurchase, Key: purchase_id
 * !BelongsTo assets, Class: downloadassets, Key: asset_id
 */
class downloadpurchasedtracks extends Model {
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