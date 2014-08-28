<?php
Library::import('recess.framework.Application');

class ArtistinfoApplication extends Application {
	public function __construct() {
		
		$this->name = 'Music Playground Artists';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'artistinfo/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/artistinfo/public/';
		
		$this->modelsPrefix = 'artistinfo.models.';
		
		$this->controllersPrefix = 'artistinfo.controllers.';
		
		$this->routingPrefix = 'artistinfo/';
		
	}
}
?>