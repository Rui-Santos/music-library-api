<?php
Library::import('admin.models.adminpurchases');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminpurchases/
 * !RoutesPrefix purchases/
 */
class adminpurchasesController extends Controller {
	
	/** @var adminpurchases */
	protected $adminpurchases;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminpurchases = new adminpurchases();
		$this->user = new adminusers();
		$this->_form = new ModelForm('adminpurchases', $this->request->data('adminpurchases'), $this->adminpurchases);
	}
	
	/** !Route GET */
	function index() {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		if ($this->user->exists()) {
			$this->purchaseSet = $this->adminpurchases->equal('user_id',$this->user->id)->orderBy('date DESC');
			return $this->ok('user');
		} else {
			print false;
			exit;
		}
	}
	
	/** !Route GET, $hash */
	function details($hash) {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		if ($this->user->exists()) {
			$this->adminpurchases->hash = $hash;
			if($this->adminpurchases->exists()) {
				if($this->adminpurchases->user_id == $this->user->id) {
					$this->pageNum = 1;
					$this->pageLim = 25;
					$this->purchSet = $this->adminpurchases->assets();
					return $this->ok('details');
				} else {
					print "You are not authorized to access this purchase";
					exit;
				}
			}
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
			$this->adminpurchases->insert();
			return $this->created($this->urlTo('details', $this->adminpurchases->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->adminpurchases->id = $id;
		if($this->adminpurchases->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminpurchases does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldadminpurchases = new adminpurchases($id);
		if($oldadminpurchases->exists()) {
			$oldadminpurchases->copy($this->adminpurchases)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminpurchases does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->adminpurchases->id = $id;
		if($this->adminpurchases->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'adminpurchases does not exist.');
		}
	}
}
?>