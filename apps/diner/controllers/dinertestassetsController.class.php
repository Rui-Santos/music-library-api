<?php
Library::import('diner.models.dinertestassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinertestassets/
 */
class dinertestassetsController extends Controller {
	
	/** @var dinertestassets */
	protected $dinertestassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinertestassets = new dinertestassets();
		$this->_form = new ModelForm('dinertestassets', $this->request->data('dinertestassets'), $this->dinertestassets);
	}
	
}
?>