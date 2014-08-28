<?php
Library::import('admin.models.adminperms');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminperms/
 */
class adminpermsController extends Controller {
	
	/** @var adminperms */
	protected $adminperms;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminperms = new adminperms();
		$this->_form = new ModelForm('adminperms', $this->request->data('adminperms'), $this->adminperms);
	}
	
	/** !Route GET */
	function index() {
		$this->adminpermsSet = $this->adminperms->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminperms->id = $id;
		if($this->adminperms->exists()) {
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
			$this->adminperms->insert();
			return $this->created($this->urlTo('details', $this->adminperms->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminperms->id = $id;
		if($this->adminperms->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminperms does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminperms = new adminperms($id);
		if($oldadminperms->exists()) {
			$oldadminperms->copy($this->adminperms)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminperms does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminperms->id = $id;
		if($this->adminperms->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminperms does not exist.');
		}
	}
}
?>