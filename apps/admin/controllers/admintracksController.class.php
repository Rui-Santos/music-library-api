<?php
Library::import('admin.models.admintracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix admintracks/
 */
class admintracksController extends Controller {
	
	/** @var admintracks */
	protected $admintracks;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->admintracks = new admintracks();
		$this->_form = new ModelForm('admintracks', $this->request->data('admintracks'), $this->admintracks);
	}
	
	/** !Route GET */
	function index() {
		$this->admintracksSet = $this->admintracks->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->admintracks->id = $id;
		if($this->admintracks->exists()) {
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
			$this->admintracks->insert();
			return $this->created($this->urlTo('details', $this->admintracks->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->admintracks->id = $id;
		if($this->admintracks->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'admintracks does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadmintracks = new admintracks($id);
		if($oldadmintracks->exists()) {
			$oldadmintracks->copy($this->admintracks)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'admintracks does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->admintracks->id = $id;
		if($this->admintracks->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'admintracks does not exist.');
		}
	}
}
?>