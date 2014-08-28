<?php
Library::import('admin.models.adminshares');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminshares/
 */
class adminsharesController extends Controller {
	
	/** @var adminshares */
	protected $adminshares;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminshares = new adminshares();
		$this->_form = new ModelForm('adminshares', $this->request->data('adminshares'), $this->adminshares);
	}
	
	/** !Route GET */
	function index() {
		$this->adminsharesSet = $this->adminshares->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminshares->id = $id;
		if($this->adminshares->exists()) {
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
			$this->adminshares->insert();
			return $this->created($this->urlTo('details', $this->adminshares->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminshares->id = $id;
		if($this->adminshares->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminshares does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminshares = new adminshares($id);
		if($oldadminshares->exists()) {
			$oldadminshares->copy($this->adminshares)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminshares does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminshares->id = $id;
		if($this->adminshares->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminshares does not exist.');
		}
	}
}
?>