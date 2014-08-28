<?php
Library::import('admin.models.adminfolders');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminfolders/
 */
class adminfoldersController extends Controller {
	
	/** @var adminfolders */
	protected $adminfolders;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminfolders = new adminfolders();
		$this->_form = new ModelForm('adminfolders', $this->request->data('adminfolders'), $this->adminfolders);
	}
	
	/** !Route GET */
	function index() {
		$this->adminfoldersSet = $this->adminfolders->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminfolders->id = $id;
		if($this->adminfolders->exists()) {
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
			$this->adminfolders->insert();
			return $this->created($this->urlTo('details', $this->adminfolders->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminfolders->id = $id;
		if($this->adminfolders->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminfolders does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminfolders = new adminfolders($id);
		if($oldadminfolders->exists()) {
			$oldadminfolders->copy($this->adminfolders)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminfolders does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminfolders->id = $id;
		if($this->adminfolders->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminfolders does not exist.');
		}
	}
}
?>