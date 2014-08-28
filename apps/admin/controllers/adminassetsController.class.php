<?php
Library::import('admin.models.adminassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminassets/
 * !RoutesPrefix assets/
 */
class adminassetsController extends Controller {
	
	/** @var adminassets */
	protected $adminassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminassets = new adminassets();
		$this->_form = new ModelForm('adminassets', $this->request->data('adminassets'), $this->adminassets);
	}
	
	/** !Route GET */
	function index() {
		$this->adminassetsSet = $this->adminassets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminassets->id = $id;
		if($this->adminassets->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}

	/** !Route GET, name/$name */
	function name($name) {
	
		$this->asset = $this->adminassets->equal("TrackTitle", $name)->orderBy("id DESC")->first();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
/*
		print $name;
		exit;
*/
	}
	
	/** !Route GET, new */
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
	/** !Route POST */
	function insert() {
		try {
			$this->adminassets->insert();
			return $this->created($this->urlTo('details', $this->adminassets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminassets->id = $id;
		if($this->adminassets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminassets does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminassets = new adminassets($id);
		if($oldadminassets->exists()) {
			$oldadminassets->copy($this->adminassets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminassets does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminassets->id = $id;
		if($this->adminassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminassets does not exist.');
		}
	}
}
?>