<?php
/**
 * !Database TheMusicPlayground
 * !Table artists
 */
class addartist extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Text */
	public $artist;

	/** !Column String */
	public $filename;

	/** !Column Text */
	public $bio;

	/** !Column Blob */
	public $photo;

}
?>