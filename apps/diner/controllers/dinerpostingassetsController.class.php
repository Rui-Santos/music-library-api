<?php
Library::import('diner.models.dinerpostingassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerpostingassets/
 */
class dinerpostingassetsController extends Controller {
	
	/** @var dinerpostingassets */
	protected $dinerpostingassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerpostingassets = new dinerpostingassets();
		$this->_form = new ModelForm('dinerpostingassets', $this->request->data('dinerpostingassets'), $this->dinerpostingassets);
	}
	
}
?>