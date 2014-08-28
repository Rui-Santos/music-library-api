<?php
Library::import('diner.models.dinertest');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinertest/
 */
class dinertestController extends Controller {
	
	/** @var dinertest */
	protected $dinertest;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinertest = new dinertest();
		$this->_form = new ModelForm('dinertest', $this->request->data('dinertest'), $this->dinertest);
	}
	
	/** !Route GET */
	function index() {
		$this->dinertestSet = $this->dinertest->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function details($RecID) {
		$this->dinertest->RecID = $RecID;
		if($this->dinertest->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, request */
	function showRequest() {
		//print_r($this->request);
		//print json_encode($this->request);
		print $this->request->headers['USER'];
		exit;
	}
		
	/** !Route GET, new */
	function newForm() {
		$this->_form->to(Methods::POST, $this->urlTo('insert'));
		return $this->ok('editForm');
	}
	
	/** !Route POST */
	function insert() {
		try {
			$this->dinertest->insert();
			return $this->created($this->urlTo('details', $this->dinertest->RecID));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $RecID/edit */
	function editForm($RecID) {
		$this->dinertest->RecID = $RecID;
		if($this->dinertest->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinertest does not exist.');
		}
	}
	
	/** !Route PUT, $RecID */
	function update($RecID) {
		$olddinertest = new dinertest($RecID);
		if($olddinertest->exists()) {
			$olddinertest->copy($this->dinertest)->save();
			return $this->forwardOk($this->urlTo('details', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinertest does not exist.');
		}
	}
	
	/** !Route DELETE, $RecID */
	function delete($RecID) {
		$this->dinertest->RecID = $RecID;
		if($this->dinertest->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinertest does not exist.');
		}
	}
}
?>