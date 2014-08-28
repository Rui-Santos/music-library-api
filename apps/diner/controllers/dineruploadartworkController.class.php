<?php
Library::import('diner.models.dineruploadartwork');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dineruploadartwork/
 */
class dineruploadartworkController extends Controller {
	
	/** @var dineruploadartwork */
	protected $dineruploadartwork;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dineruploadartwork = new dineruploadartwork();
		$this->_form = new ModelForm('dineruploadartwork', $this->request->data('dineruploadartwork'), $this->dineruploadartwork);
	}
	
}
?>