<?php
/**
 * !Database DinerUpload
 * !Table artwork
 */
class dineruploadartwork extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $RecID;

	/** !Column Text */
	public $hash;

	/** !Column Blob */
	public $Picture;

}
?>