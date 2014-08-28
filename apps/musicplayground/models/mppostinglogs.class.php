<?php
/**
 * !Database TheMusicPlayground
 * !Table posting_logs
 * !BelongsTo sampler_shares, Class: mpsamplershares, Key: share_id
 * !BelongsTo samplers, Class: mpsamplers, Key: playlist_id
 */
class mppostinglogs extends Model {
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