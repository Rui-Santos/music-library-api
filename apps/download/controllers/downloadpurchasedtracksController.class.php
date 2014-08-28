<?php
Library::import('download.models.downloadpurchasedtracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadpurchasedtracks/
 */
class downloadpurchasedtracksController extends Controller {
	
	/** @var downloadpurchasedtracks */
	protected $downloadpurchasedtracks;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadpurchasedtracks = new downloadpurchasedtracks();
		$this->_form = new ModelForm('downloadpurchasedtracks', $this->request->data('downloadpurchasedtracks'), $this->downloadpurchasedtracks);
	}
	
	/** !Route GET */
	function index() {
		$this->downloadpurchasedtracksSet = $this->downloadpurchasedtracks->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->downloadpurchasedtracks->id = $id;
		if($this->downloadpurchasedtracks->exists()) {
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
			$this->downloadpurchasedtracks->insert();
			return $this->created($this->urlTo('details', $this->downloadpurchasedtracks->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->downloadpurchasedtracks->id = $id;
		if($this->downloadpurchasedtracks->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadpurchasedtracks does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$olddownloadpurchasedtracks = new downloadpurchasedtracks($id);
		if($olddownloadpurchasedtracks->exists()) {
			$olddownloadpurchasedtracks->copy($this->downloadpurchasedtracks)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadpurchasedtracks does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->downloadpurchasedtracks->id = $id;
		if($this->downloadpurchasedtracks->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'downloadpurchasedtracks does not exist.');
		}
	}
}
?>