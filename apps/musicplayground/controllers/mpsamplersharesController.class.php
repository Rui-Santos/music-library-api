<?php
Library::import('musicplayground.models.mpsamplershares');
Library::import('musicplayground.models.mpsamplers');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpsamplershares/
 * !RoutesPrefix samplershares/
 */
class mpsamplersharesController extends Controller {
	
	/** @var mpsamplershares */
	protected $mpsamplershares;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpsamplershares = new mpsamplershares();
		$this->mpsamplers = new mpsamplers();
		$this->user = new adminusers();
		$this->_form = new ModelForm('mpsamplershares', $this->request->data('mpsamplershares'), $this->mpsamplershares);
	}
	
	/** !Route GET */
	function index() {
		$this->mpsamplersharesSet = $this->mpsamplershares->all()->orderBy('date_shared DESC');
/*
		print count($this->mpsamplersharesSet);
		exit;
*/
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->mpsamplershares->id = $id;
		if($this->mpsamplershares->exists()) {
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
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
			
				$toArray = explode(',', $input['to_email']);
				$retArray = array();
				$retArray['shares'] = array();
				
				foreach($toArray as $key=>$val) {
					$n = new mpsamplershares();
					$n->date_shared = time();
					$n->playlist_id = $input['id'];
					$n->from_email = $this->user->email;
					$n->from_name = $this->user->user;
					$n->to_email = $val;
					
					$hash = sha1($n->to_email . ':' . $n->date_shared . ':' . $n->playlist_id . ':' . uniqid( rand(), true ));
					$hash = substr($hash,0,8);
					
					$n->hash = $hash;
					
					$n->save();
					
					array_push($retArray['shares'], $n);
				}
				
				$this->mpsamplers->id = $input['id'];
				if($this->mpsamplers->exists()) {
					$this->mpsamplers->state='published';
					$this->mpsamplers->save();
				}
				
				$retArray['playlist'] = $this->mpsamplers;
				
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