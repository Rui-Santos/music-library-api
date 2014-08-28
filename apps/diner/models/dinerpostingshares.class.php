<?php
/**
 * !Database Default
 * !Table posting_shares
 * !BelongsTo postings, Class: dinerpostings, Key: posting_id
 * !HasMany posting_logs, Class: dinerpostinglogs, Key: share_id
 */
class dinerpostingshares extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $date_shared;

	/** !Column Integer */
	public $posting_id;

	/** !Column String */
	public $from_email;

	/** !Column String */
	public $from_name;

	/** !Column String */
	public $to_email;

	/** !Column String */
	public $clicked;

	/** !Column String */
	public $played;

	/** !Column String */
	public $forwarded;

	/** !Column String */
	public $hash;

}
?>