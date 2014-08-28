<?php
/**
 * !Database Default
 * !Table postings
 * !HasMany posting_assets, Class: dinerpostingassets, Key: posting_id
 * !HasMany metadata, Class: dinermetadata, Through: dinerpostingassets, Key: posting_id
 * !HasMany posting_shares, Class: dinerpostingshares, Key: posting_id
 * !HasMany posting_logs, Class: dinerpostinglogs, Key: posting_id
 */
class dinerpostings extends Model {

	public function getMetaData() {
		return $this->metadata()->orderBy('posting_assets.order_position ASC');;
	}

	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column String */
	public $state;

	/** !Column Text */
	public $name;

	/** !Column Text */
	public $description;

	/** !Column Integer */
	public $artwork;

	/** !Column DateTime */
	public $date_created;

	/** !Column DateTime */
	public $date_modified;

	/** !Column Text */
	public $slug;

	/** !Column Text */
	public $notes;

}
?>