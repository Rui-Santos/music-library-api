<?php
/**
 * !Database TheStation
 * !Table playlist_logs
 * !BelongsTo playlist_shares, Class: stationplaylistshares, Key: share_id
 * !BelongsTo playlists, Class: stationplaylists, Key: playlist_id
 */
class stationplaylistlogs extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $date_logged;

	/** !Column Integer */
	public $share_id;

	/** !Column Integer */
	public $playlist_id;

	/** !Column String */
	public $email;

	/** !Column String */
	public $ip;

	/** !Column String */
	public $type;

	/** !Column Text */
	public $asset;

}
?>