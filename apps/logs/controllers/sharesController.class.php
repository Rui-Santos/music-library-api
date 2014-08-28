<?php
Library::import('logs.models.shares');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix shares/
 */
class sharesController extends Controller {
	
	/** @var shares */
	protected $shares;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->shares = new shares();
		$this->_form = new ModelForm('shares', $this->request->data('shares'), $this->shares);
	}
	
	/** !Route GET */
	function index() {
		$this->sharesSet = $this->shares->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->shares->id = $id;
		if($this->shares->exists()) {
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
			$this->shares->insert();
			return $this->created($this->urlTo('details', $this->shares->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->shares->id = $id;
		if($this->shares->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'shares does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldshares = new shares($id);
		if($oldshares->exists()) {
			$oldshares->copy($this->shares)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'shares does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->shares->id = $id;
		if($this->shares->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'shares does not exist.');
		}
	}
}
?>