<?php
Library::import('prosfx.models.prosfxassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxassets/
 */
class prosfxassetsController extends Controller {
	
	/** @var prosfxassets */
	protected $prosfxassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxassets = new prosfxassets();
		$this->_form = new ModelForm('prosfxassets', $this->request->data('prosfxassets'), $this->prosfxassets);
	}
	
	/** !Route GET */
	function index() {
		$this->prosfxassetsSet = $this->prosfxassets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->prosfxassets->id = $id;
		if($this->prosfxassets->exists()) {
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
			$this->prosfxassets->insert();
			return $this->created($this->urlTo('details', $this->prosfxassets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->prosfxassets->id = $id;
		if($this->prosfxassets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxassets does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldprosfxassets = new prosfxassets($id);
		if($oldprosfxassets->exists()) {
			$oldprosfxassets->copy($this->prosfxassets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxassets does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->prosfxassets->id = $id;
		if($this->prosfxassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxassets does not exist.');
		}
	}
}
?>