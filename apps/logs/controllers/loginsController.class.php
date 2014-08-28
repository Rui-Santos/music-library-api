<?php
Library::import('logs.models.logins');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix logins/
 */
class loginsController extends Controller {
	
	/** @var logins */
	protected $logins;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->logins = new logins();
		$this->_form = new ModelForm('logins', $this->request->data('logins'), $this->logins);
	}
	
	/** !Route GET */
	function index() {
		$this->loginsSet = $this->logins->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $log_id */
	function details($log_id) {
		$this->logins->log_id = $log_id;
		if($this->logins->exists()) {
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
			$this->logins->insert();
			return $this->created($this->urlTo('details', $this->logins->log_id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $log_id/edit */
	function editForm($log_id) {
		$this->logins->log_id = $log_id;
		if($this->logins->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logins does not exist.');
		}
	}
	
	/** !Route PUT, $log_id */
	function update($log_id) {
		$oldlogins = new logins($log_id);
		if($oldlogins->exists()) {
			$oldlogins->copy($this->logins)->save();
			return $this->forwardOk($this->urlTo('details', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logins does not exist.');
		}
	}
	
	/** !Route DELETE, $log_id */
	function delete($log_id) {
		$this->logins->log_id = $log_id;
		if($this->logins->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logins does not exist.');
		}
	}
}
?>