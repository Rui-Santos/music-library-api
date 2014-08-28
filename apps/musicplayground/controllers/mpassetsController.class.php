<?php
Library::import('musicplayground.models.mpassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpassets/
 */
class mpassetsController extends Controller {
	
	/** @var mpassets */
	protected $mpassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpassets = new mpassets();
		$this->_form = new ModelForm('mpassets', $this->request->data('mpassets'), $this->mpassets);
	}
	
	/** !Route GET */
	function index() {
		$this->mpassetsSet = $this->mpassets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->mpassets->id = $id;
		if($this->mpassets->exists()) {
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
			$this->mpassets->insert();
			return $this->created($this->urlTo('details', $this->mpassets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->mpassets->id = $id;
		if($this->mpassets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpassets does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldmpassets = new mpassets($id);
		if($oldmpassets->exists()) {
			$oldmpassets->copy($this->mpassets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpassets does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->mpassets->id = $id;
		if($this->mpassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpassets does not exist.');
		}
	}
}
?>