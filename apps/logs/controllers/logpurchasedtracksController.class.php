<?php
Library::import('logs.models.logpurchasedtracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix logpurchasedtracks/
 */
class logpurchasedtracksController extends Controller {
	
	/** @var logpurchasedtracks */
	protected $logpurchasedtracks;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->logpurchasedtracks = new logpurchasedtracks();
		$this->_form = new ModelForm('logpurchasedtracks', $this->request->data('logpurchasedtracks'), $this->logpurchasedtracks);
	}
	
	/** !Route GET */
	function index() {
		$this->logpurchasedtracksSet = $this->logpurchasedtracks->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->logpurchasedtracks->id = $id;
		if($this->logpurchasedtracks->exists()) {
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
			$this->logpurchasedtracks->insert();
			return $this->created($this->urlTo('details', $this->logpurchasedtracks->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->logpurchasedtracks->id = $id;
		if($this->logpurchasedtracks->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logpurchasedtracks does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldlogpurchasedtracks = new logpurchasedtracks($id);
		if($oldlogpurchasedtracks->exists()) {
			$oldlogpurchasedtracks->copy($this->logpurchasedtracks)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logpurchasedtracks does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->logpurchasedtracks->id = $id;
		if($this->logpurchasedtracks->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logpurchasedtracks does not exist.');
		}
	}
}
?>