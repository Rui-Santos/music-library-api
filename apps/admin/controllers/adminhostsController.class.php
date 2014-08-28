<?php
Library::import('admin.models.adminhosts');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminhosts/
 */
class adminhostsController extends Controller {
	
	/** @var adminhosts */
	protected $adminhosts;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminhosts = new adminhosts();
		$this->_form = new ModelForm('adminhosts', $this->request->data('adminhosts'), $this->adminhosts);
	}
	
	/** !Route GET */
	function index() {
		$this->adminhostsSet = $this->adminhosts->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->adminhosts->id = $id;
		if($this->adminhosts->exists()) {
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
			$this->adminhosts->insert();
			return $this->created($this->urlTo('details', $this->adminhosts->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminhosts->id = $id;
		if($this->adminhosts->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminhosts does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminhosts = new adminhosts($id);
		if($oldadminhosts->exists()) {
			$oldadminhosts->copy($this->adminhosts)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminhosts does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminhosts->id = $id;
		if($this->adminhosts->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminhosts does not exist.');
		}
	}
}
?>