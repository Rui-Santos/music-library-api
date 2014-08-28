<?php
Library::import('musicplayground.models.mppostinglogs');
Library::import('admin.models.adminusers');
Library::import('musicplayground.models.mpsamplers');
Library::import('musicplayground.models.mpsamplershares');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mppostinglogs/
 * !RoutesPrefix posting/
 */
class mppostinglogsController extends Controller {
	
	/** @var mppostinglogs */
	protected $mppostinglogs;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mppostinglogs = new mppostinglogs();
		$this->adminusers = new adminusers();
		$this->mpsamplers = new mpsamplers();
		$this->mpsamplershares = new mpsamplershares();
		$this->_form = new ModelForm('mppostinglogs', $this->request->data('mppostinglogs'), $this->mppostinglogs);
	}
	
	/**
	* !Route GET
	* !Route GET, $pageNum
	* !Route GET, $pageNum/$pageLim
	* !Route GET, $pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($pageNum=1,$pageLim=25,$sortField='date_logged',$sortDir='DESC') {
		$input = $this->getInput();
		$d = $this->digest();
		if($d['username'] == 'apitester') {
			$d['username'] = 'thediner';
		}
		$this->pageNumber = $pageNum;
		$this->pageLimit = $pageLim;
		$this->postingSet = $this->mppostinglogs->all()->orderBy($sortField . ' ' . $sortDir);
		$this->ok('index');
	}
	/**
	* !Route GET, sampler/$sampler_id */
	function sampler($sampler_id) {
		$input = $this->getInput();
		$d = $this->digest();
		if($d['username'] == 'apitester') {
			$d['username'] = 'thediner';
		}
		$this->pageNumber = 1;
		$this->pageLimit = 0;
		$this->postingSet = $this->mppostinglogs->equal('playlist_id',$sampler_id)->orderBy('date_logged DESC');
		$this->ok('index');
	}

	/** !Route POST */
	function create() {
		if($this->request->headers['HOSTIP'] == '38.96.145.226') {
			print 'local user';
			exit;
		}
		$input = $this->getInput();
		$d = $this->digest();
		if($d['username'] == 'apitester') {
			$d['username'] = 'thediner';
		}
		
		$u = $this->request->headers['USER'];
		$this->adminusers->key = $u;
		if ($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				print 'admin';
				exit;
			}
		}
		$posting_account = '';
		$share_id = 0;
		$playlist_id = 0;
		$email = '';
		if(!empty($input['sharing_hash'])) {
			$this->mpsamplershares->hash = $input['sharing_hash'];
			if($this->mpsamplershares->exists()) {
				$this->mpsamplers->id = $this->mpsamplershares->playlist_id;
				if($this->mpsamplers->exists()) {
					$posting_account = $this->mpsamplers->slug;
					$share_id = $this->mpsamplershares->id;
					$playlist_id = $this->mpsamplershares->playlist_id;
					$email = $this->mpsamplershares->to_email;
				}
				if($input['type']=='audition') {
					$this->mpsamplershares->played='yes';
					$this->mpsamplershares->save();
				}
			} else {
				$this->mpsamplers->slug = $input['sharing_hash'];
				if($this->mpsamplers->exists()) {
					$posting_account = $this->mpsamplers->slug;
					$playlist_id = $this->mpsamplers->id;
				}
			}
		} else {
			$posting_account = $input['posting_account'];
			$share_id = 0;
			$playlist_id = 0;
			$email = 'none';
		}
		$p = new mppostinglogs();
		$p->date_logged = time();
		$p->src = $d['username'];
		$p->posting_account = $posting_account;
		$p->type = $input['type'];
		$p->asset = $input['asset'];
		$p->ip = $this->request->headers['HOSTIP'];
		if($share_id!=0) {$p->share_id = $share_id;}
		if($playlist_id!=0) {$p->playlist_id = $playlist_id;}
		if($email!='') {$p->email = $email;}
		$p->save();
		print json_encode($p);
		//print_r($input);
		exit;
		
	}

}
?>