<?php
Library::import('recess.framework.Application');

class ProsfxApplication extends Application {
	public function __construct() {
		
		$this->name = 'Pro SFX';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'prosfx/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/prosfx/public/';
		
		$this->modelsPrefix = 'prosfx.models.';
		
		$this->controllersPrefix = 'prosfx.controllers.';
		
		$this->routingPrefix = 'prosfx/';
		
	}
}
?>