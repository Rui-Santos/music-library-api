<?php
Library::import('recess.framework.Application');

class StationApplication extends Application {
	public function __construct() {
		
		$this->name = 'The Station';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'station/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/station/public/';
		
		$this->modelsPrefix = 'station.models.';
		
		$this->controllersPrefix = 'station.controllers.';
		
		$this->routingPrefix = 'station/';
		
	}
}
?>