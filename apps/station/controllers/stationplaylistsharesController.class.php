<?php
Library::import('station.models.stationplaylistshares');
Library::import('station.models.stationplaylists');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix stationplaylistshares/
 * !RoutesPrefix playlistshares/
 */
class stationplaylistsharesController extends Controller {
	
	/** @var stationplaylistshares */
	protected $stationplaylistshares;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->stationplaylistshares = new stationplaylistshares();
		$this->stationplaylists = new stationplaylists();
		$this->user = new adminusers();
		$this->_form = new ModelForm('stationplaylistshares', $this->request->data('stationplaylistshares'), $this->stationplaylistshares);
	}
	
	/** !Route GET */
	function index() {
		$this->stationplaylistsharesSet = $this->stationplaylistshares->all()->orderBy('date_shared DESC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->stationplaylistshares->id = $id;
		if($this->stationplaylistshares->exists()) {
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
					$n = new stationplaylistshares();
					$n->date_shared = time();
					$n->playlist_id = $input['id'];
					$n->from_email = $this->user->email;
					$n->from_name = $this->user->user;
					$n->salesforce_email = $this->user->salesforce_email;
					$n->to_email = $val;
					
					$hash = sha1($n->to_email . ':' . $n->date_shared . ':' . $n->playlist_id . ':' . uniqid( rand(), true ));
					$hash = substr($hash,0,8);
					
					$n->hash = $hash;
					
					$n->save();
					
					array_push($retArray['shares'], $n);
				}
				$retArray['playlist'] = $n->playlists();
				
				$this->stationplaylists->id = $input['id'];
				if($this->stationplaylists->exists()) {
					$this->stationplaylists->state = 'shared';
					$this->stationplaylists->save();
				}
				
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