<?php
Library::import('logs.models.browsers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix browsers/
 */
class browsersController extends Controller {
	
	/** @var browsers */
	protected $browsers;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->browsers = new browsers();
		$this->_form = new ModelForm('browsers', $this->request->data('browsers'), $this->browsers);
	}
	
	/** !Route GET */
	function index() {
		$this->browsersSet = $this->browsers->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->browsers->id = $id;
		if($this->browsers->exists()) {
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
			$this->browsers->insert();
			return $this->created($this->urlTo('details', $this->browsers->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->browsers->id = $id;
		if($this->browsers->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'browsers does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldbrowsers = new browsers($id);
		if($oldbrowsers->exists()) {
			$oldbrowsers->copy($this->browsers)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'browsers does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->browsers->id = $id;
		if($this->browsers->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'browsers does not exist.');
		}
	}
}
?>