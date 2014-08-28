<?php
Library::import('recess.framework.Application');

class ArtApplication extends Application {
	public function __construct() {
		
		$this->name = 'art';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'art/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/art/public/';
		
		$this->modelsPrefix = 'art.models.';
		
		$this->controllersPrefix = 'art.controllers.';
		
		$this->routingPrefix = 'art/';
		
	}
}
?>