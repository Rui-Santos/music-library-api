<?php
Library::import('logs.models.queries');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix queries/
 */
class queriesController extends Controller {
	
	/** @var queries */
	protected $queries;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->queries = new queries();
		$this->_form = new ModelForm('queries', $this->request->data('queries'), $this->queries);
	}
	
	/** !Route GET */
	function index() {
		$this->queriesSet = $this->queries->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->queries->id = $id;
		if($this->queries->exists()) {
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
			$this->queries->insert();
			return $this->created($this->urlTo('details', $this->queries->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->queries->id = $id;
		if($this->queries->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'queries does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldqueries = new queries($id);
		if($oldqueries->exists()) {
			$oldqueries->copy($this->queries)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'queries does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->queries->id = $id;
		if($this->queries->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'queries does not exist.');
		}
	}
}
?>