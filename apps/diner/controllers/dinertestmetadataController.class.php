<?php
Library::import('diner.models.dinertestmetadata');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinertestmetadata/
 */
class dinertestmetadataController extends Controller {
	
	/** @var dinertestmetadata */
	protected $dinertestmetadata;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinertestmetadata = new dinertestmetadata();
		$this->_form = new ModelForm('dinertestmetadata', $this->request->data('dinertestmetadata'), $this->dinertestmetadata);
	}
	
}
?>