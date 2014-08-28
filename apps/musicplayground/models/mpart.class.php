<?php
/**
 * !Database TheMusicPlayground
 * !Table artwork
 */
class mpart extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $RecID;

	/** !Column Text */
	public $hash;

	/** !Column Blob */
	public $Picture;

}
?>