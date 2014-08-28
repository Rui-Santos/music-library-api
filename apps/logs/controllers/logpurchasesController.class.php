<?php
Library::import('logs.models.logpurchases');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix logpurchases/
 */
class logpurchasesController extends Controller {
	
	/** @var logpurchases */
	protected $logpurchases;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->logpurchases = new logpurchases();
		$this->_form = new ModelForm('logpurchases', $this->request->data('logpurchases'), $this->logpurchases);
	}
	
	/** !Route GET */
	function index() {
		$this->logpurchasesSet = $this->logpurchases->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->logpurchases->id = $id;
		if($this->logpurchases->exists()) {
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
			$this->logpurchases->insert();
			return $this->created($this->urlTo('details', $this->logpurchases->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route POST, $stripeID/cancel */
	function cancelSubscription($stripeID) {
		$this->logpurchases->stripe_id = $stripeID;
		if ($this->logpurchases->exists()) {
			$this->logpurchases->status = 'closed';
			$this->logpurchases->save();
		}
		print true;
		exit;
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->logpurchases->id = $id;
		if($this->logpurchases->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logpurchases does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldlogpurchases = new logpurchases($id);
		if($oldlogpurchases->exists()) {
			$oldlogpurchases->copy($this->logpurchases)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logpurchases does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->logpurchases->id = $id;
		if($this->logpurchases->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'logpurchases does not exist.');
		}
	}
}
?>