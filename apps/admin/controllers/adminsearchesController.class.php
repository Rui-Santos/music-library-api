<?php
Library::import('admin.models.adminsearches');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminsearches/
 */
class adminsearchesController extends Controller {
	
	/** @var adminsearches */
	protected $adminsearches;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminsearches = new adminsearches();
		$this->_form = new ModelForm('adminsearches', $this->request->data('adminsearches'), $this->adminsearches);
	}
	
	/** !Route GET */
	function index() {
		$this->adminsearchesSet = $this->adminsearches->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $log_id */
	function details($log_id) {
		$this->adminsearches->log_id = $log_id;
		if($this->adminsearches->exists()) {
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
			$this->adminsearches->insert();
			return $this->created($this->urlTo('details', $this->adminsearches->log_id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $log_id/edit */
	function editForm($log_id) {
		$this->adminsearches->log_id = $log_id;
		if($this->adminsearches->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminsearches does not exist.');
		}
	}
	
	/** !Route PUT, $log_id */
	function update($log_id) {
		$oldadminsearches = new adminsearches($log_id);
		if($oldadminsearches->exists()) {
			$oldadminsearches->copy($this->adminsearches)->save();
			return $this->forwardOk($this->urlTo('details', $log_id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminsearches does not exist.');
		}
	}
	
	/** !Route DELETE, $log_id */
	function delete($log_id) {
		$this->adminsearches->log_id = $log_id;
		if($this->adminsearches->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminsearches does not exist.');
		}
	}
}
?>