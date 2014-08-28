<?php
Library::import('logs.models.downloads');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloads/
 */
class downloadsController extends Controller {
	
	/** @var downloads */
	protected $downloads;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloads = new downloads();
		$this->_form = new ModelForm('downloads', $this->request->data('downloads'), $this->downloads);
	}
	
	/** !Route GET */
	function index() {
		$this->downloadsSet = $this->downloads->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $log_id */
	function details($log_id) {
		$this->downloads->log_id = $log_id;
		if($this->downloads->exists()) {
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
			$this->downloads->insert();
			return $this->created($this->urlTo('details', $this->downloads->log_id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $log_id/edit */
	function editForm($log_id) {
		$this->downloads->log_id = $log_id;
		if($this->downloads->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloads does not exist.');
		}
	}
	
	/** !Route PUT, $log_id */
	function update($log_id) {
		$olddownloads = new downloads($log_id);
		if($olddownloads->exists()) {
			$olddownloads->copy($this->downloads)->save();
			return $this->forwardOk($this->urlTo('details', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloads does not exist.');
		}
	}
	
	/** !Route DELETE, $log_id */
	function delete($log_id) {
		$this->downloads->log_id = $log_id;
		if($this->downloads->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloads does not exist.');
		}
	}
}
?>