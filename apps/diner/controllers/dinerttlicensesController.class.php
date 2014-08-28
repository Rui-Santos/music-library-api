<?php
Library::import('diner.models.dinerttlicenses');
Library::import('diner.models.dinermetadata');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerttlicenses/
 * !RoutesPrefix tunetrucklicenses/
 */
class dinerttlicensesController extends Controller {
	
	/** @var dinerttlicenses */
	protected $dinerttlicenses;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerttlicenses = new dinerttlicenses();
		$this->adminusers = new adminusers();
		$this->dinermetadata = new dinermetadata();
		$this->_form = new ModelForm('dinerttlicenses', $this->request->data('dinerttlicenses'), $this->dinerttlicenses);
	}
	
	/** !Route GET */
	function index() {
		$this->dinerttlicensesSet = $this->dinerttlicenses->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->dinerttlicenses->id = $id;
		if($this->dinerttlicenses->exists()) {
			//return $this->ok('details');
			print json_encode($this->dinerttlicenses);
			exit;
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
		
	/** !Route POST */
	function insert() {

		$input = $this->getInput();
		$d = $this->digest();
		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		$name = '';
		$email = '';
		$user_id = 0;
		if($this->adminusers->exists()) {
			$name = $this->adminusers->user;
			$email = $this->adminusers->email;
			$user_id = $this->adminusers->id;
		} else {
			$name = $input['name'];
			$email = $input['email'];
			$user_id = 2;
		}
		
		$n = new dinerttlicenses();
		$n->date = time();
		$n->name = $name;
		$n->email = $email;
		$n->user_id = $user_id;
		$n->track = $input['track'];
		$n->short_id = $input['short_id'];
		$n->save();
		
		$this->dinermetadata->LongID = $n->short_id;
		if($this->dinermetadata->exists()) {
			$n->composer = $this->dinermetadata->Composer;
			print json_encode($n);
		}
		exit;
	}
	
}
?>