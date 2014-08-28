<?php
/**
 * !Database MMAdmin
 * !Table playlists
 * !HasMany tracks, Class: downloadtracks, Key: playlist_id
 * !HasMany assets, Class: downloadassets, Through: downloadtracks, Key: playlist_id
 */
class downloadplaylists extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $folder_id;

	/** !Column String */
	public $path;

	/** !Column String */
	public $type;

	/** !Column String */
	public $name;

	/** !Column String */
	public $title;

	/** !Column String */
	public $episode;

	/** !Column String */
	public $episode_no;

	/** !Column String */
	public $production_no;

	/** !Column Date */
	public $airdate;

	/** !Column Time */
	public $length;

	/** !Column String */
	public $program_type;

	/** !Column String */
	public $version_type;

	/** !Column String */
	public $job_no;

	/** !Column String */
	public $station;

	/** !Column String */
	public $producer;

	/** !Column String */
	public $distributor;

	/** !Column String */
	public $director;

	/** !Column String */
	public $isci;

	/** !Column String */
	public $contact;

	/** !Column String */
	public $contact_type;

	/** !Column String */
	public $notes;

	/** !Column DateTime */
	public $created;

	/** !Column DateTime */
	public $updated;

	/** !Column Integer */
	public $updated_by;

	/** !Column Integer */
	public $orig_id;

	/** !Column String */
	public $hash;

	/** !Column String */
	public $source;

}
?>