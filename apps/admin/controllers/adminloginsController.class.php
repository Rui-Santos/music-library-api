<?php
Library::import('admin.models.adminlogins');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminlogins/
 */
class adminloginsController extends Controller {
	
	/** @var adminlogins */
	protected $adminlogins;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminlogins = new adminlogins();
		$this->_form = new ModelForm('adminlogins', $this->request->data('adminlogins'), $this->adminlogins);
	}
	
	/** !Route GET */
	function index() {
		$this->adminloginsSet = $this->adminlogins->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $log_id */
	function details($log_id) {
		$this->adminlogins->log_id = $log_id;
		if($this->adminlogins->exists()) {
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
			$this->adminlogins->insert();
			return $this->created($this->urlTo('details', $this->adminlogins->log_id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $log_id/edit */
	function editForm($log_id) {
		$this->adminlogins->log_id = $log_id;
		if($this->adminlogins->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminlogins does not exist.');
		}
	}
	
	/** !Route PUT, $log_id */
	function update($log_id) {
		$oldadminlogins = new adminlogins($log_id);
		if($oldadminlogins->exists()) {
			$oldadminlogins->copy($this->adminlogins)->save();
			return $this->forwardOk($this->urlTo('details', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminlogins does not exist.');
		}
	}
	
	/** !Route DELETE, $log_id */
	function delete($log_id) {
		$this->adminlogins->log_id = $log_id;
		if($this->adminlogins->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminlogins does not exist.');
		}
	}
}
?>