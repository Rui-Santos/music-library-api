<?php
/**
 * !Database TheMusicPlayground
 * !Table sampler_assets
 * !BelongsTo samplers, Class: mpsamplers, Key: sampler_id
 * !BelongsTo all_assets, Class: mpallassets, Key: longID
 * !BelongsTo metadata, Class: mpmetadata, Key: track_id
 */
class mpsamplerassets extends Model {

	public function getMetaData() {
		if($this->metadata()) {
			return $this->metadata();
		} else {
			return false;
		}
	}
/*
	public function getMeta() {
		return $this->all_assets()->metadata()->first();
	}
	
	public function getAsset() {
		return $this->all_assets();
	}
*/

	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $sampler_id;

	/** !Column Integer */
	public $track_id;

	/** !Column String */
	public $longID;

	/** !Column String */
	public $file_hash;

	/** !Column String */
	public $asset_key;

	/** !Column Integer */
	public $order_position;

	/** !Column Text */
	public $filename;

	/** !Column Text */
	public $filepath;

	/** !Column Text */
	public $title;

	/** !Column Text */
	public $artist;

	/** !Column Integer */
	public $artist_id;

}
?>