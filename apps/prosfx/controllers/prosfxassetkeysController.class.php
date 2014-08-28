<?php
Library::import('prosfx.models.prosfxassetkeys');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxassetkeys/
 */
class prosfxassetkeysController extends Controller {
	
	/** @var prosfxassetkeys */
	protected $prosfxassetkeys;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxassetkeys = new prosfxassetkeys();
		$this->_form = new ModelForm('prosfxassetkeys', $this->request->data('prosfxassetkeys'), $this->prosfxassetkeys);
	}
	
}
?>