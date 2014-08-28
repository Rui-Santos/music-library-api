<?php
Library::import('download.models.downloadtracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadtracks/
 */
class downloadtracksController extends Controller {
	
	/** @var downloadtracks */
	protected $downloadtracks;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadtracks = new downloadtracks();
		$this->_form = new ModelForm('downloadtracks', $this->request->data('downloadtracks'), $this->downloadtracks);
	}
	
	/** !Route GET */
	function index() {
		$this->downloadtracksSet = $this->downloadtracks->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->downloadtracks->id = $id;
		if($this->downloadtracks->exists()) {
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
			$this->downloadtracks->insert();
			return $this->created($this->urlTo('details', $this->downloadtracks->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->downloadtracks->id = $id;
		if($this->downloadtracks->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadtracks does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$olddownloadtracks = new downloadtracks($id);
		if($olddownloadtracks->exists()) {
			$olddownloadtracks->copy($this->downloadtracks)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadtracks does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->downloadtracks->id = $id;
		if($this->downloadtracks->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadtracks does not exist.');
		}
	}
}
?>