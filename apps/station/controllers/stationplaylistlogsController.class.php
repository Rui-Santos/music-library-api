<?php
Library::import('station.models.stationplaylistlogs');
Library::import('station.models.stationplaylists');
Library::import('station.models.stationplaylistshares');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix stationplaylistlogs/
 * !RoutesPrefix playlistlogs/
 */
class stationplaylistlogsController extends Controller {
	
	/** @var stationplaylistlogs */
	protected $stationplaylistlogs;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->stationplaylistlogs = new stationplaylistlogs();
		$this->stationplaylists = new stationplaylists();
		$this->stationplaylistshares = new stationplaylistshares();
		$this->_form = new ModelForm('stationplaylistlogs', $this->request->data('stationplaylistlogs'), $this->stationplaylistlogs);
	}
	
	/**
	* !Route GET
	* !Route GET, page/$pageNum
	* !Route GET, page/$pageNum/limit/$pageLim
	* !Route GET, page/$pageNum/limit/$pageLim/sort/$sortField/$sortDir
	* */
	function index($pageNum=1,$pageLim=25,$sortField="date_logged",$sortDir="DESC") {
		$this->pageNumber = $pageNum;
		$this->pageLimit = $pageLim;
		$this->sortField = $sortField;
		$this->sortDir = $sortDir;
		$this->stationplaylistlogsSet = $this->stationplaylistlogs->all()->orderBy($sortField . ' ' . $sortDir);;
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->stationplaylistlogs->id = $id;
		if($this->stationplaylistlogs->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route POST */
	function logAudition() {
		$input = $this->getInput();
		$d = $this->digest();

		$this->stationplaylists->slug = $input['slug'];
		if($this->stationplaylists->exists()) {
			$n = new stationplaylistlogs();
			$n->date_logged = time();
			$n->playlist_id = $this->stationplaylists->id;
			$n->ip = $this->request->headers['HOSTIP'];
			$n->type = 'audition';
			$n->asset = $input['asset'];
			$n->save();
			print 'success';
			exit;
		} else {
			$this->stationplaylistshares->hash = $input['slug'];
			if($this->stationplaylistshares->exists()) {
				$this->stationplaylists->id = $this->stationplaylistshares->playlist_id;
				if($this->stationplaylists->exists()) {
					$this->stationplaylistshares->played = 'yes';
					$this->stationplaylistshares->save();
					$n = new stationplaylistlogs();
					$n->date_logged = time();
					$n->share_id = $this->stationplaylistshares->id;
					$n->playlist_id = $this->stationplaylists->id;
					$n->email = $this->stationplaylistshares->to_email;
					$n->ip = $this->request->headers['HOSTIP'];
					$n->type = 'audition';
					$n->asset = $input['asset'];
					$n->save();
					print 'success';
					exit;
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		}
				
	}

}
?>