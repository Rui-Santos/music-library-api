<?php
/**
 * !Database MMAdmin
 * !Table folders
 */
class adminfolders extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $folder_id;

	/** !Column String */
	public $path;

	/** !Column String */
	public $name;

	/** !Column DateTime */
	public $created;

	/** !Column DateTime */
	public $updated;

	/** !Column Integer */
	public $updated_by;

	/** !Column Integer */
	public $orig_id;

}
?>