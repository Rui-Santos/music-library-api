<?php
Library::import('recess.framework.controllers.Controller');

/**
 * !RespondsWith Layouts
 * !Prefix Views: home/, Routes: /
 */
class ProsfxHomeController extends Controller {
	
	/** !Route GET */
	function index() {
		
		$this->flash = 'Welcome to your new Recess application!';
		
	}
	
}
?>