<?php
Library::import('diner.models.dinerpostingshares');
Library::import('diner.models.dinerpostings');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerpostingshares/
 * !RoutesPrefix postingshares/
 */
class dinerpostingsharesController extends Controller {
	
	/** @var dinerpostingshares */
	protected $dinerpostingshares;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerpostingshares = new dinerpostingshares();
		$this->dinerpostings = new dinerpostings();
		$this->adminusers = new adminusers();
		$this->_form = new ModelForm('dinerpostingshares', $this->request->data('dinerpostingshares'), $this->dinerpostingshares);
	}
	
	/** !Route GET */
	function index() {
		$this->dinerpostingsharesSet = $this->dinerpostingshares->all()->orderBy('date_shared DESC');
/*
		print count($this->dinerpostingsharesSet);
		exit;
*/
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->dinerpostingshares->id = $id;
		if($this->dinerpostingshares->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route POST */
	function addShare() {
		$input = $this->getInput();
		$d = $this->digest();
		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
			
				$toArray = explode(',', $input['to_email']);
				$retArray = array();
				$retArray['shares'] = array();
				
				foreach($toArray as $key=>$val) {
					$n = new dinerpostingshares();
					$n->date_shared = time();
					$n->posting_id = $input['id'];
					$n->from_email = $this->adminusers->email;
					$n->from_name = $this->adminusers->user;
					$n->to_email = $val;
					//$n->cc_email = $input['cc_email'];
					
					$hash = sha1($n->to_email . ':' . $n->date_shared . ':' . $n->posting_id . ':' . uniqid( rand(), true ));
					$hash = substr($hash,0,8);
					
					$n->hash = $hash;
					
					$n->save();
					
					$n->salesforce_email = $this->adminusers->salesforce_email;

					array_push($retArray['shares'], $n);
				}
				
				$this->dinerpostings->id = $input['id'];
				if($this->dinerpostings->exists()) {
					$this->dinerpostings->state='posted';
					$this->dinerpostings->save();
				}
				
				$retArray['posting'] = $this->dinerpostings;
				
				print json_encode($retArray);
				//print_r($toArray);
				exit;
				
				
		
			} else {
				print "not authorized";
				exit;
			}
		} else {
			print "not authorized";
			exit;
		}
	}
}
?>