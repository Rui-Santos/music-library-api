<?php if(isset($bootstrapped)) unset($bootstrapped); else exit;
/*
 * Welcome to the Recess PHP Framework. Let's have some fun!
 * 
 * For tutorials, documentation, bug reports, feature suggestions:
 * http://www.recessframework.org/
 * 
 * Join the Recess developer community:
 * 		+ IRC: irc.freenode.net #recess
 * 		+ Mailing List: http://groups.google.com/group/recess-framework
 * 		+ Github: http://github.com/recess/recess/
 * 		+ Forum: http://www.recessframework.org/
 * 		+ Twitter: http://twitter.com/RecessFramework
 * 
 * Enjoy! -Kris (http://twitter.com/KrisJordan)
 */

// RecessConf::DEVELOPMENT or RecessConf::PRODUCTION
RecessConf::$mode = RecessConf::DEVELOPMENT; 

RecessConf::$applications 
	= array(	'recess.apps.tools.RecessToolsApplication',
				'welcome.WelcomeApplication',
				'diner.DinerApplication', // <-- ADD THIS LINE  
				'musicplayground.MusicplaygroundApplication', // <-- ADD THIS LINE  
         		'waveforms.WaveformsApplication', // <-- ADD THIS LINE  
				'logs.LogsApplication', // <-- ADD THIS LINE  
				'prosfx.ProsfxApplication', // <-- ADD THIS LINE  
				'download.DownloadApplication', // <-- ADD THIS LINE  
				'art.ArtApplication', // <-- ADD THIS LINE  
				'admin.AdminApplication', // <-- ADD THIS LINE  
				'station.StationApplication', // <-- ADD THIS LINE  
				'playlists.PlaylistsApplication', // <-- ADD THIS LINE  

			);

RecessConf::$defaultTimeZone = 'America/New_York';

RecessConf::$defaultDatabase
	= array(	//'sqlite:' . $_ENV['dir.bootstrap'] . 'data/sqlite/default.db'
				'mysql:host=localhost;dbname=DBNAME', 'DBUSER', 'DBPW'
			);

RecessConf::$namedDatabases
	= array( 	// 'nameFoo' => array('sqlite:' . $_ENV['dir.bootstrap'] . 'data/sqlite/default.db')
				// 'nameBar' => array('mysql:host=localhost;dbname=recess', 'username', 'password')
				 'TheMusicPlayground' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW'),
				 'Waveforms' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW', $driver_options),
				 'MMAdmin' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW', $driver_options),
				 'ProSFX' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW', $driver_options),
				 'TheStation' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW', $driver_options),
				 'DinerTest' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW', $driver_options),
				 'DinerUpload' => array('mysql:host=127.0.0.1;dbname=DBNAME', 'DBUSER', 'DBPW', $driver_options)
			);

// Paths to the recess, plugins, and apps directories
RecessConf::$recessDir = $_ENV['dir.bootstrap'] . 'recess/';
RecessConf::$pluginsDir = $_ENV['dir.bootstrap'] . 'plugins/';
RecessConf::$appsDir = $_ENV['dir.bootstrap'] . 'apps/';
RecessConf::$dataDir = $_ENV['dir.bootstrap'] . 'data/';


// Cache providers are only enabled during DEPLOYMENT mode.
//  Always use at least the Sqlite cache.
RecessConf::$cacheProviders 
	= array(	
				// 'Apc',
				// 'Memcache',
				'Sqlite',
			);

?>
