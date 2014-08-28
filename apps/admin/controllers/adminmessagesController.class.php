<?php
Library::import('admin.models.adminmessages');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminmessages/
 */
class adminmessagesController extends Controller {
	
	/** @var adminmessages */
	protected $adminmessages;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminmessages = new adminmessages();
		$this->_form = new ModelForm('adminmessages', $this->request->data('adminmessages'), $this->adminmessages);
	}
	
	/** !Route GET */
	function index() {
		$this->adminmessagesSet = $this->adminmessages->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminmessages->id = $id;
		if($this->adminmessages->exists()) {
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
			$this->adminmessages->insert();
			return $this->created($this->urlTo('details', $this->adminmessages->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminmessages->id = $id;
		if($this->adminmessages->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminmessages does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminmessages = new adminmessages($id);
		if($oldadminmessages->exists()) {
			$oldadminmessages->copy($this->adminmessages)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminmessages does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminmessages->id = $id;
		if($this->adminmessages->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminmessages does not exist.');
		}
	}
}
?>