<?php
Library::import('artistinfo.models.addartist');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix addartist/
 */
class addartistController extends Controller {
	
	/** @var addartist */
	protected $addartist;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->addartist = new addartist();
		$this->_form = new ModelForm('addartist', $this->request->data('addartist'), $this->addartist);
	}
	
	/** !Route GET */
	function index() {
		$this->addartistSet = $this->addartist->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->addartist->id = $id;
		if($this->addartist->exists()) {
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
			$this->addartist->insert();
			return $this->created($this->urlTo('details', $this->addartist->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->addartist->id = $id;
		if($this->addartist->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'addartist does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldaddartist = new addartist($id);
		if($oldaddartist->exists()) {
			$oldaddartist->copy($this->addartist)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'addartist does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->addartist->id = $id;
		if($this->addartist->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'addartist does not exist.');
		}
	}
}
?>