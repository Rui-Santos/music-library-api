<?php
/**
 * !Database TheMusicPlayground
 * !Table artists
 * !HasMany metadata, Class: mpartists, Key: Source
 */
class mpartistinfo extends Model {

	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Text */
	public $artist;

	/** !Column String */
	public $filename;

	/** !Column Text */
	public $bio;

	/** !Column Integer */
	public $photo;

}
?>