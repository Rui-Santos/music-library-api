<?php
/**
 * !Database MMAdmin
 * !Table log
 * !HasMany log_downloads, Class: admindownloads, Key: log_id
 * !HasMany log_searches, Class: adminsearches, Key: log_id
 * !HasMany log_logins, Class: adminsearches, Key: log_id
 * !HasMany shares, Class: adminshares, Key: log_id
 * !HasMany log_messages, Class: adminmessages, Key: log_id
 * !BelongsTo browsers, Class: adminbrowsers, Key: browser_id
 * !BelongsTo hosts, Class: adminhosts, Key: host_id
 */
class adminlogs extends Model {

/*
	public function doLog($browser_info, $browser_model) {
	
		$b = $browser_model->equal('user_agent', $browser_info);
		if(count($b)>0) {
			return $b->first();
		} else {
			return 'doesna exist';
		}
	
		//return $browser_info;
	}
*/

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

	/** !Column String */
	public $source;

}
?>