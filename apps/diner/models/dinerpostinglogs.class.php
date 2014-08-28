<?php
/**
 * !Database Default
 * !Table posting_logs
 * !BelongsTo posting_shares, Class: dinerpostingshares, Key: share_id
 * !BelongsTo postings, Class: dinerpostings, Key: posting_id
 */
class dinerpostinglogs extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $date_logged;

	/** !Column String */
	public $src;

	/** !Column String */
	public $posting_account;

	/** !Column Integer */
	public $share_id;

	/** !Column Integer */
	public $posting_id;

	/** !Column String */
	public $type;

	/** !Column Text */
	public $asset;

	/** !Column String */
	public $ip;

	/** !Column String */
	public $email;

}
?>