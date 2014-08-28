<?php
Library::import('logs.models.searches');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix searches/
 */
class searchesController extends Controller {
	
	/** @var searches */
	protected $searches;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->searches = new searches();
		$this->_form = new ModelForm('searches', $this->request->data('searches'), $this->searches);
	}
	
	/** !Route GET */
	function index() {
		$this->searchesSet = $this->searches->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $log_id */
	function details($log_id) {
		$this->searches->log_id = $log_id;
		if($this->searches->exists()) {
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
			$this->searches->insert();
			return $this->created($this->urlTo('details', $this->searches->log_id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $log_id/edit */
	function editForm($log_id) {
		$this->searches->log_id = $log_id;
		if($this->searches->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'searches does not exist.');
		}
	}
	
	/** !Route PUT, $log_id */
	function update($log_id) {
		$oldsearches = new searches($log_id);
		if($oldsearches->exists()) {
			$oldsearches->copy($this->searches)->save();
			return $this->forwardOk($this->urlTo('details', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'searches does not exist.');
		}
	}
	
	/** !Route DELETE, $log_id */
	function delete($log_id) {
		$this->searches->log_id = $log_id;
		if($this->searches->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'searches does not exist.');
		}
	}
}
?>