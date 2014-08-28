<?php
Library::import('diner.models.dineruploadmetadata');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dineruploadmetadata/
 */
class dineruploadmetadataController extends Controller {
	
	/** @var dineruploadmetadata */
	protected $dineruploadmetadata;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dineruploadmetadata = new dineruploadmetadata();
		$this->_form = new ModelForm('dineruploadmetadata', $this->request->data('dineruploadmetadata'), $this->dineruploadmetadata);
	}
	
}
?>