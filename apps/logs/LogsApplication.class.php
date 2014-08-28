<?php
Library::import('recess.framework.Application');

class LogsApplication extends Application {
	public function __construct() {
		
		$this->name = 'logs';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'logs/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/logs/public/';
		
		$this->modelsPrefix = 'logs.models.';
		
		$this->controllersPrefix = 'logs.controllers.';
		
		$this->routingPrefix = 'logs/';
		
	}
}
?>