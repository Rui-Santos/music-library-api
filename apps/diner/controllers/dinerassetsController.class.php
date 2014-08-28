<?php
Library::import('diner.models.dinerassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerassets/
 */
class dinerassetsController extends Controller {
	
	/** @var dinerassets */
	protected $dinerassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerassets = new dinerassets();
		$this->_form = new ModelForm('dinerassets', $this->request->data('dinerassets'), $this->dinerassets);
	}
	
}
?>