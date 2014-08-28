<?php
Library::import('musicplayground.models.mptest');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mptest/
 */
class mptestController extends Controller {
	
	/** @var mptest */
	protected $mptest;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mptest = new mptest();
		$this->_form = new ModelForm('mptest', $this->request->data('mptest'), $this->mptest);
	}
	
	/** !Route GET */
	function index() {
		$this->mptestSet = $this->mptest->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function details($RecID) {
		$this->mptest->RecID = $RecID;
		if($this->mptest->exists()) {
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
			$this->mptest->insert();
			return $this->created($this->urlTo('details', $this->mptest->RecID));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $RecID/edit */
	function editForm($RecID) {
		$this->mptest->RecID = $RecID;
		if($this->mptest->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mptest does not exist.');
		}
	}
	
	/** !Route PUT, $RecID */
	function update($RecID) {
		$oldmptest = new mptest($RecID);
		if($oldmptest->exists()) {
			$oldmptest->copy($this->mptest)->save();
			return $this->forwardOk($this->urlTo('details', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mptest does not exist.');
		}
	}
	
	/** !Route DELETE, $RecID */
	function delete($RecID) {
		$this->mptest->RecID = $RecID;
		if($this->mptest->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mptest does not exist.');
		}
	}
}
?>