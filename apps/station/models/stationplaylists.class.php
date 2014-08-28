<?php
/**
 * !Database TheStation
 * !Table playlists
 * !HasMany playlist_logs, Class: stationplaylistlogs, Key: playlist_id
 * !HasMany playlist_shares, Class: stationplaylistshares, Key: playlist_id
 */
class stationplaylists extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column String */
	public $title;

	/** !Column String */
	public $slug;

	/** !Column String */
	public $wd_url;

	/** !Column String */
	public $brand;

	/** !Column Text */
	public $description;

	/** !Column Integer */
	public $image_id;

	/** !Column String */
	public $author;

	/** !Column Boolean */
	public $downloadable;

	/** !Column DateTime */
	public $date_created;

	/** !Column DateTime */
	public $date_modified;

	/** !Column String */
	public $state;

}
?>