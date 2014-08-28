<?php
/**
 * !Database TheMusicPlayground
 * !Table sampler_shares
 * !BelongsTo samplers, Class: mpsamplers, Key: playlist_id
 * !HasMany posting_logs, Class: mppostinglogs, Key: share_id
 */
class mpsamplershares extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $date_shared;

	/** !Column Integer */
	public $playlist_id;

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