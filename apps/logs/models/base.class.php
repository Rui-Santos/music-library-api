<?php
/**
 * !Database MMAdmin
 * !Table log
 * !HasMany log_searches, Class: searches, Key: log_id
 * !HasMany log_logins, Class: logins, Key: log_id
 * !BelongsTo users, Class: user, Key: user_id
*/
class base extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column DateTime */
	public $time;

	/** !Column String */
	public $event;

	/** !Column Integer */
	public $user_id;

	/** !Column Integer */
	public $group_id;

	/** !Column Integer */
	public $role_id;

	/** !Column Integer */
	public $host_id;

	/** !Column Integer */
	public $browser_id;

}
?>