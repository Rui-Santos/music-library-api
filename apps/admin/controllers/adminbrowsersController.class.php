<?php
Library::import('admin.models.adminbrowsers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminbrowsers/
 */
class adminbrowsersController extends Controller {
	
	/** @var adminbrowsers */
	protected $adminbrowsers;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminbrowsers = new adminbrowsers();
		$this->_form = new ModelForm('adminbrowsers', $this->request->data('adminbrowsers'), $this->adminbrowsers);
	}
	
	/** !Route GET */
	function index() {
		$this->adminbrowsersSet = $this->adminbrowsers->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminbrowsers->id = $id;
		if($this->adminbrowsers->exists()) {
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
			$this->adminbrowsers->insert();
			return $this->created($this->urlTo('details', $this->adminbrowsers->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminbrowsers->id = $id;
		if($this->adminbrowsers->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminbrowsers does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminbrowsers = new adminbrowsers($id);
		if($oldadminbrowsers->exists()) {
			$oldadminbrowsers->copy($this->adminbrowsers)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminbrowsers does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminbrowsers->id = $id;
		if($this->adminbrowsers->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminbrowsers does not exist.');
		}
	}
}
?>