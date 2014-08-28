<?php
/**
 * !Database TheStation
 * !Table artwork
 */
class stationartwork extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $RecID;

	/** !Column Text */
	public $hash;

	/** !Column Blob */
	public $Picture;

}
?>