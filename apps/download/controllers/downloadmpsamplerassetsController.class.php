<?php
Library::import('download.models.downloadmpsamplerassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadmpsamplerassets/
 */
class downloadmpsamplerassetsController extends Controller {
	
	/** @var downloadmpsamplerassets */
	protected $downloadmpsamplerassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadmpsamplerassets = new downloadmpsamplerassets();
		$this->_form = new ModelForm('downloadmpsamplerassets', $this->request->data('downloadmpsamplerassets'), $this->downloadmpsamplerassets);
	}
	
	/** !Route GET */
	function index() {
		$this->downloadmpsamplerassetsSet = $this->downloadmpsamplerassets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->downloadmpsamplerassets->id = $id;
		if($this->downloadmpsamplerassets->exists()) {
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
			$this->downloadmpsamplerassets->insert();
			return $this->created($this->urlTo('details', $this->downloadmpsamplerassets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->downloadmpsamplerassets->id = $id;
		if($this->downloadmpsamplerassets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadmpsamplerassets does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$olddownloadmpsamplerassets = new downloadmpsamplerassets($id);
		if($olddownloadmpsamplerassets->exists()) {
			$olddownloadmpsamplerassets->copy($this->downloadmpsamplerassets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadmpsamplerassets does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->downloadmpsamplerassets->id = $id;
		if($this->downloadmpsamplerassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadmpsamplerassets does not exist.');
		}
	}
}
?>