<?php
/**
 * !Database TheStation
 * !Table playlist_shares
 * !HasMany playlist_logs, Class: stationplaylistlogs, Key: share_id
 * !BelongsTo playlists, Class: stationplaylists, Key: playlist_id
 */
class stationplaylistshares extends Model {
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