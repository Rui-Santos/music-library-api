<?php
Library::import('recess.framework.Application');

class DinerApplication extends Application {
	public function __construct() {
		
		$this->name = 'The Diner';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'diner/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/diner/public/';
		
		$this->modelsPrefix = 'diner.models.';
		
		$this->controllersPrefix = 'diner.controllers.';
		
		$this->routingPrefix = 'diner/';
		
	}
}
?>