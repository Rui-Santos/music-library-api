<?php
/**
 * !Database MMAdmin
 * !Table purchased_tracks
 * !BelongsTo users, Class: adminusers, Key: user_id
 * !BelongsTo assets, Class: adminassets, Key: asset_id
 * !BelongsTo purchases, Class: adminpurchases, Key: purchase_id
 */
class adminpurchasedtracks extends Model {
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