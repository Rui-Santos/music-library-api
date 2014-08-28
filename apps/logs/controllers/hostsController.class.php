<?php
Library::import('logs.models.hosts');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix hosts/
 */
class hostsController extends Controller {
	
	/** @var hosts */
	protected $hosts;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->hosts = new hosts();
		$this->_form = new ModelForm('hosts', $this->request->data('hosts'), $this->hosts);
	}
	
	/** !Route GET */
	function index() {
		$this->hostsSet = $this->hosts->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->hosts->id = $id;
		if($this->hosts->exists()) {
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
			$this->hosts->insert();
			return $this->created($this->urlTo('details', $this->hosts->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->hosts->id = $id;
		if($this->hosts->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'hosts does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldhosts = new hosts($id);
		if($oldhosts->exists()) {
			$oldhosts->copy($this->hosts)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'hosts does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->hosts->id = $id;
		if($this->hosts->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'hosts does not exist.');
		}
	}
}
?>