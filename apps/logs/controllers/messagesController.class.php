<?php
Library::import('logs.models.messages');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix messages/
 */
class messagesController extends Controller {
	
	/** @var messages */
	protected $messages;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->messages = new messages();
		$this->_form = new ModelForm('messages', $this->request->data('messages'), $this->messages);
	}
	
	/** !Route GET */
	function index() {
		$this->messagesSet = $this->messages->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->messages->id = $id;
		if($this->messages->exists()) {
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
			$this->messages->insert();
			return $this->created($this->urlTo('details', $this->messages->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->messages->id = $id;
		if($this->messages->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'messages does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldmessages = new messages($id);
		if($oldmessages->exists()) {
			$oldmessages->copy($this->messages)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'messages does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->messages->id = $id;
		if($this->messages->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'messages does not exist.');
		}
	}
}
?>