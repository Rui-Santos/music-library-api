<?php
/**
 * !Database TheMusicPlayground
 * !Table samplers
 * !HasMany sampler_assets, Class: mpsamplerassets, Key: sampler_id
 * !HasMany all_assets, Class: mpallassets, Through: mpsamplerassets, Key: sampler_id
 * !HasMany metadata, Class: mpmetadata, Through: mpsamplerassets, Key: sampler_id
 * !HasMany sampler_shares, Class: mpsamplershares, Key: playlist_id
 * !HasMany posting_logs, Class: mppostinglogs, Key: playlist_id
 */
class mpsamplers extends Model {

	public function getMetaData() {
		return $this->metadata()->orderBy('sampler_assets.order_position ASC');;
	}

	public function getAssets() {
		return $this->all_assets()->orderBy('sampler_assets.order_position ASC');
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

	/** !Column Text */
	public $notes;

}
?>