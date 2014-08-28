<?php
Library::import('recess.framework.Application');

class AdminApplication extends Application {
	public function __construct() {
		
		$this->name = 'admin';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'admin/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/admin/public/';
		
		$this->modelsPrefix = 'admin.models.';
		
		$this->controllersPrefix = 'admin.controllers.';
		
		$this->routingPrefix = 'admin/';
		
	}
}
?>