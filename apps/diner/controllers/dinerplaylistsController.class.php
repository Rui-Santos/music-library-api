<?php
Library::import('diner.models.dinerplaylists');
Library::import('diner.models.dinerplaylistassets');
Library::import('diner.models.dineraassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerplaylists/
 * !RoutesPrefix playlists/
 */
class dinerplaylistsController extends Controller {
	
	/** @var dinerplaylists */
	protected $dinerplaylists;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerplaylists = new dinerplaylists();
		$this->dinerplaylistassets = new dinerplaylistassets();
		$this->_form = new ModelForm('dinerplaylists', $this->request->data('dinerplaylists'), $this->dinerplaylists);
	}
	
	/** !Route GET */
	function index() {
		$this->dinerplaylistsSet = $this->dinerplaylists->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, user/$folderID */
	function user($folderID) {
		$this->dinerplaylistsSet = $this->dinerplaylists->equal('folder_id', $folderID);
		$this->dinerplaylistsSet->folder_id = $folderID;
		$this->playlistassets = $this->dinerplaylistassets;
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->dinerplaylists->id = $id;
		$this->dinerplaylists->playlistTracks = $this->dinerplaylists->getTrackAssets();
/* 		$this->dinerplaylists->playlistTracks = $this->dinerplaylists->getTracks(); */
		$this->dinerplaylists->playlistAssets = $this->dinerplaylistassets->equal('playlist_id', $id);
		$trackAssets = $this->dinerplaylists->getTrackAssets();
/*
		foreach ($trackAssets as &$track):
			$tid = getTrackID($id, $track->ndx);
			$track->tr_id = "funky";
		endforeach;
*/
		if($this->dinerplaylists->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, delete/$pid */
	function remove($pid) {
		$this->dinerplaylists->id = $pid;
		if($this->dinerplaylists->delete()) {
			$this->result = true;
		} else {
			$this->result = false;
//			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
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
			$this->dinerplaylists->insert();
			return $this->created($this->urlTo('details', $this->dinerplaylists->id));
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->dinerplaylists->id = $id;
		if($this->dinerplaylists->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylists does not exist.');
		}
	}
	
	/** !Route POST, $id */
	function update($id) {
		$olddinerplaylists = new dinerplaylists($id);
		if($olddinerplaylists->exists()) {
			$olddinerplaylists->copy($this->dinerplaylists)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylists does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->dinerplaylists->id = $id;
		if($this->dinerplaylists->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylists does not exist.');
		}
	}
}
?>