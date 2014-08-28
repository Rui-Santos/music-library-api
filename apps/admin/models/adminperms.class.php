<?php
/**
 * !Database MMAdmin
 * !Table perms
 */
class adminperms extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/** !Column Boolean */
	public $user_reports;

	/** !Column Boolean */
	public $select_db;

	/** !Column Boolean */
	public $file_exts;

	/** !Column Boolean */
	public $email_playlists;

	/** !Column Boolean */
	public $group_add;

	/** !Column Boolean */
	public $group_remove;

	/** !Column Boolean */
	public $group_reports;

	/** !Column Boolean */
	public $group_permissions;

	/** !Column Boolean */
	public $admin_home;

	/** !Column Boolean */
	public $admin_users;

	/** !Column Boolean */
	public $admin_reports;

	/** !Column Boolean */
	public $admin_columns;

	/** !Column Boolean */
	public $admin_databases;

	/** !Column Boolean */
	public $admin_site;

	/** !Column Text */
	public $assets;

	/** !Column Text */
	public $columns;

	/** !Column Text */
	public $sort_tracks;

	/** !Column Text */
	public $sort_albums;

	/** !Column String */
	public $opt_home;

	/** !Column String */
	public $opt_view;

	/** !Column String */
	public $opt_vista;

	/** !Column String */
	public $opt_browse;

	/** !Column String */
	public $opt_grouping;

}
?>