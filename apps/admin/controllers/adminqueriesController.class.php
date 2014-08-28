<?php
Library::import('admin.models.adminqueries');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminqueries/
 */
class adminqueriesController extends Controller {
	
	/** @var adminqueries */
	protected $adminqueries;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminqueries = new adminqueries();
		$this->_form = new ModelForm('adminqueries', $this->request->data('adminqueries'), $this->adminqueries);
	}
	
	/** !Route GET */
	function index() {
		$this->adminqueriesSet = $this->adminqueries->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminqueries->id = $id;
		if($this->adminqueries->exists()) {
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
			$this->adminqueries->insert();
			return $this->created($this->urlTo('details', $this->adminqueries->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminqueries->id = $id;
		if($this->adminqueries->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminqueries does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminqueries = new adminqueries($id);
		if($oldadminqueries->exists()) {
			$oldadminqueries->copy($this->adminqueries)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminqueries does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminqueries->id = $id;
		if($this->adminqueries->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminqueries does not exist.');
		}
	}
}
?>