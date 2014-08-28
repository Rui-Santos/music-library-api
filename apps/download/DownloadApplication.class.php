<?php
Library::import('recess.framework.Application');

class DownloadApplication extends Application {
	public function __construct() {
		
		$this->name = 'download';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'download/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/download/public/';
		
		$this->modelsPrefix = 'download.models.';
		
		$this->controllersPrefix = 'download.controllers.';
		
		$this->routingPrefix = 'download/';
		
	}
}
?>