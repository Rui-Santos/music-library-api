<?php
Library::import('recess.framework.Application');

class PlaylistsApplication extends Application {
	public function __construct() {
		
		$this->name = 'Playlists';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'playlists/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/playlists/public/';
		
		$this->modelsPrefix = 'playlists.models.';
		
		$this->controllersPrefix = 'playlists.controllers.';
		
		$this->routingPrefix = 'playlists/';
		
	}
}
?>