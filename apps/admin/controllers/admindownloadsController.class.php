<?php
Library::import('admin.models.admindownloads');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix admindownloads/
 */
class admindownloadsController extends Controller {
	
	/** @var admindownloads */
	protected $admindownloads;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->admindownloads = new admindownloads();
		$this->_form = new ModelForm('admindownloads', $this->request->data('admindownloads'), $this->admindownloads);
	}
	
	/** !Route GET */
	function index() {
		$this->admindownloadsSet = $this->admindownloads->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $log_id */
	function details($log_id) {
		$this->admindownloads->log_id = $log_id;
		if($this->admindownloads->exists()) {
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
			$this->admindownloads->insert();
			return $this->created($this->urlTo('details', $this->admindownloads->log_id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $log_id/edit */
	function editForm($log_id) {
		$this->admindownloads->log_id = $log_id;
		if($this->admindownloads->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'admindownloads does not exist.');
		}
	}
	
	/** !Route PUT, $log_id */
	function update($log_id) {
		$oldadmindownloads = new admindownloads($log_id);
		if($oldadmindownloads->exists()) {
			$oldadmindownloads->copy($this->admindownloads)->save();
			return $this->forwardOk($this->urlTo('details', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'admindownloads does not exist.');
		}
	}
	
	/** !Route DELETE, $log_id */
	function delete($log_id) {
		$this->admindownloads->log_id = $log_id;
		if($this->admindownloads->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'admindownloads does not exist.');
		}
	}
}
?>