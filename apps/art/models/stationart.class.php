<?php
/**
 * !Database TheStation
 * !Table artwork
 */
class stationart extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $RecID;

	/** !Column Text */
	public $hash;

	/** !Column Blob */
	public $Picture;

}
?>