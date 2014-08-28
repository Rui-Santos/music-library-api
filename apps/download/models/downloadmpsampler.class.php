<?php
/**
 * !Database TheMusicPlayground
 * !Table samplers
 * !HasMany sampler_assets, Class: downloadmpsamplerassets, Key: sampler_id
 */
class downloadmpsampler extends Model {

	public function getAssets() {
		return $this->sampler_assets()->orderBy('order_position ASC');
	}
	
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column String */
	public $type;

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
	public $main_markdown;

	/** !Column Text */
	public $intro_markdown;

}
?>