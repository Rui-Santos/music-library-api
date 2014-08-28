<?php
Library::import('recess.framework.Application');

class MusicplaygroundApplication extends Application {
	public function __construct() {
		
		$this->name = 'The Music Playground';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'musicplayground/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/musicplayground/public/';
		
		$this->modelsPrefix = 'musicplayground.models.';
		
		$this->controllersPrefix = 'musicplayground.controllers.';
		
		$this->routingPrefix = 'musicplayground/';
		
	}
}
?>