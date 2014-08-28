<?php
/**
 * !Database MMAdmin
 * !Table cart_items
 * !BelongsTo users, Class: adminusers, Key: user_id
 * !BelongsTo assets, Class: adminassets, Key: asset_id
 */
class admincartitems extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $user_id;

	/** !Column String */
	public $type;

	/** !Column String */
	public $item_id;

	/** !Column Integer */
	public $asset_id;

	/** !Column DateTime */
	public $date;

	/** !Column String */
	public $source;

}
?>