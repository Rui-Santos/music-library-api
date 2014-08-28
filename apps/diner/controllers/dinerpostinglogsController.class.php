<?php
Library::import('diner.models.dinerpostinglogs');
Library::import('admin.models.adminusers');
Library::import('diner.models.dinerpostings');
Library::import('diner.models.dinerpostingshares');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerpostinglogs/
 * !RoutesPrefix postinglogs/
 */
class dinerpostinglogsController extends Controller {
	
	/** @var dinerpostinglogs */
	protected $dinerpostinglogs;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerpostinglogs = new dinerpostinglogs();
		$this->adminusers = new adminusers();
		$this->dinerpostings = new dinerpostings();
		$this->dinerpostingshares = new dinerpostingshares();
		$this->_form = new ModelForm('dinerpostinglogs', $this->request->data('dinerpostinglogs'), $this->dinerpostinglogs);
	}
	
	/**
	* !Route GET
	* !Route GET, $type
	* !Route GET, $type/$pageNum
	* !Route GET, $type/$pageNum/$pageLim
	* !Route GET, $type/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($type='all',$pageNum=1,$pageLim=25,$sortField='date_logged',$sortDir='DESC') {
		$input = $this->getInput();
		$d = $this->digest();
		if($d['username'] == 'apitester') {
			$d['username'] = 'thediner';
		}
		$this->pageNumber = $pageNum;
		$this->pageLimit = $pageLim;
		$this->sortField = $sortField;
		$this->sortDir = $sortDir;
		$this->type = $type;
		$this->term = false;
		if($type=='all') {
			$this->postingSet = $this->dinerpostinglogs->all()->orderBy($sortField . ' ' . $sortDir);
		} else {
			$this->postingSet = $this->dinerpostinglogs->equal('type',$type)->orderBy($sortField . ' ' . $sortDir);
		}
		$this->ok('index');
	}

	/**
	* !Route GET, query/$term
	* !Route GET, query/$term/$type
	* !Route GET, query/$term/$type/$pageNum
	* !Route GET, query/$term/$type/$pageNum/$pageLim
	* !Route GET, query/$term/$type/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function postingLogsQuery($term, $type='all', $pageNum=1,$pageLim=25,$sortField='date_logged',$sortDir='DESC') {
		$u = $this->request->headers['USER'];
		$user = new adminusers();
		$user->key = $u;
		if($user->exists()) {
			if($user->role_id==1) {
				$input = $this->getInput();
				$quote = false;
				$quoteArray = explode('"', $term);
				foreach($quoteArray as &$quoteSegment) {
					if($quote){
						$quoteSegment = str_replace(' ', 'brktzspaceztkrb', $quoteSegment);
						$quoteSegment = str_replace("'", "", $quoteSegment);
					}
					$quote = !$quote;
				}
				$searchTermParsed = implode('"', $quoteArray);
			
				$this->searchTerm = $searchTermParsed;
				$addMYSQL = '';
				if($type != 'all') {
					$addMYSQL = "AND type='$type'";
				}
				$this->postingSet = $this->dinerpostinglogs->select()->dinerMatch($searchTermParsed, $addMYSQL, 'dinerpostinglogs')->orderBy($sortField.' '.$sortDir);
				$this->pageNumber = $pageNum;
				$this->pageLimit = $pageLim;
				$this->sortField = $sortField;
				$this->sortDir = $sortDir;
				$this->term = $term;
				$this->type = $type;
				$this->ok('index');
			} else {
				print 'fail - not admin';
				exit;
			}
		} else {
			print 'no user';
			exit;
		}
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
				exit;
			}
		}
		$posting_account = '';
		$share_id = 0;
		$posting_id = 0;
		$email = '';
		if(!empty($input['sharing_hash'])) {
			$this->dinerpostingshares->hash = $input['sharing_hash'];
			if($this->dinerpostingshares->exists()) {
				$this->dinerpostings->id = $this->dinerpostingshares->posting_id;
				if($this->dinerpostings->exists()) {
					$posting_account = $this->dinerpostings->slug;
					$share_id = $this->dinerpostingshares->id;
					$posting_id = $this->dinerpostingshares->posting_id;
					$email = $this->dinerpostingshares->to_email;
				}
				if($input['type']=='audition') {
					$this->dinerpostingshares->played='yes';
					$this->dinerpostingshares->save();
				}
			} else {
				$this->dinerpostings->slug = $input['sharing_hash'];
				if($this->dinerpostings->exists()) {
					$posting_account = $this->dinerpostings->slug;
					$posting_id = $this->dinerpostings->id;
				}
			}
		} else {
			$posting_account = $input['posting_account'];
			$share_id = 0;
			$posting_id = 0;
			$email = 'none';
		}
		$p = new dinerpostinglogs();
		$p->date_logged = time();
		$p->src = $d['username'];
		$p->posting_account = $posting_account;
		$p->type = $input['type'];
		$p->asset = $input['asset'];
		$p->ip = $this->request->headers['HOSTIP'];
		if($share_id!=0) {$p->share_id = $share_id;}
		if($posting_id!=0) {$p->posting_id = $posting_id;}
		if($email!='') {$p->email = $email;}
		$p->save();
		print json_encode($p);
		//print_r($input);
		exit;
		
	}
}
?>