<?php
/**
 * !Database MMAdmin
 * !Table log_messages
 */
class messages extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Integer */
	public $log_id;

	/** !Column String */
	public $type;

	/** !Column Text */
	public $email;

	/** !Column Text */
	public $name;

	/** !Column Text */
	public $company;

	/** !Column String */
	public $phone;

	/** !Column Text */
	public $client;

	/** !Column Text */
	public $product;

	/** !Column Integer */
	public $num_spots;

	/** !Column Text */
	public $titles;

	/** !Column Text */
	public $description;

	/** !Column Text */
	public $lengths;

	/** !Column Text */
	public $isci;

	/** !Column Text */
	public $num_tracks;

	/** !Column String */
	public $tags;

	/** !Column Text */
	public $territories;

	/** !Column Text */
	public $media;

	/** !Column Text */
	public $date_start;

	/** !Column Text */
	public $duration;

	/** !Column Text */
	public $budget;

	/** !Column String */
	public $post;

	/** !Column Text */
	public $tracks_direction;

	/** !Column Text */
	public $message;

}
?>