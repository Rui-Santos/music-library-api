<?php
Library::import('prosfx.models.prosfxtest');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxtest/
 */
class prosfxtestController extends Controller {
	
	/** @var prosfxtest */
	protected $prosfxtest;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxtest = new prosfxtest();
		$this->_form = new ModelForm('prosfxtest', $this->request->data('prosfxtest'), $this->prosfxtest);
	}
	
	/** !Route GET */
	function index() {
		$this->prosfxtestSet = $this->prosfxtest->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function details($RecID) {
		$this->prosfxtest->RecID = $RecID;
		if($this->prosfxtest->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, new */
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
	/** !Route POST */
	function insert() {
		try {
			$this->prosfxtest->insert();
			return $this->created($this->urlTo('details', $this->prosfxtest->RecID));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $RecID/edit */
	function editForm($RecID) {
		$this->prosfxtest->RecID = $RecID;
		if($this->prosfxtest->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxtest does not exist.');
		}
	}
	
	/** !Route PUT, $RecID */
	function update($RecID) {
		$oldprosfxtest = new prosfxtest($RecID);
		if($oldprosfxtest->exists()) {
			$oldprosfxtest->copy($this->prosfxtest)->save();
			return $this->forwardOk($this->urlTo('details', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxtest does not exist.');
		}
	}
	
	/** !Route DELETE, $RecID */
	function delete($RecID) {
		$this->prosfxtest->RecID = $RecID;
		if($this->prosfxtest->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxtest does not exist.');
		}
	}
}
?>