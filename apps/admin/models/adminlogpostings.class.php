<?php
/**
 * !Database MMAdmin
 * !Table log_postings
 */
class adminlogpostings extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $date;

	/** !Column String */
	public $src;

	/** !Column String */
	public $posting_account;

	/** !Column Integer */
	public $share_id;

	/** !Column Integer */
	public $playlist_id;

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