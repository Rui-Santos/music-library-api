<?php
Library::import('diner.models.dinertestartwork');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinertestartwork/
 */
class dinertestartworkController extends Controller {
	
	/** @var dinertestartwork */
	protected $dinertestartwork;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinertestartwork = new dinertestartwork();
		$this->_form = new ModelForm('dinertestartwork', $this->request->data('dinertestartwork'), $this->dinertestartwork);
	}
	
}
?>