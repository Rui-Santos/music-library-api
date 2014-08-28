<?php
Library::import('recess.framework.Application');

class WaveformsApplication extends Application {
	public function __construct() {
		
		$this->name = 'waveforms';
		
		$this->viewsDir = $_ENV['dir.apps'] . 'waveforms/views/';
		
		$this->assetUrl = $_ENV['url.assetbase'] . 'apps/waveforms/public/';
		
		$this->modelsPrefix = 'waveforms.models.';
		
		$this->controllersPrefix = 'waveforms.controllers.';
		
		$this->routingPrefix = 'waveforms/';
		
	}
}
?>