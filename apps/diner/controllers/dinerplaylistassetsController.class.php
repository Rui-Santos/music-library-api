<?php
Library::import('diner.models.dinerplaylistassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerplaylistassets/
 */
class dinerplaylistassetsController extends Controller {
	
	/** @var dinerplaylistassets */
	protected $dinerplaylistassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerplaylistassets = new dinerplaylistassets();
		$this->_form = new ModelForm('dinerplaylistassets', $this->request->data('dinerplaylistassets'), $this->dinerplaylistassets);
	}
	
	function getTrackID($playlistID, $ndx) {
		$tracks = $this->dinerplaylistassets->equal('playlist_id', $playlistID);
		$tid = 0;
		foreach ($tracks as $track):
			if($track->ndx == $ndx) {
				$tid = $track->id;
			}
		endforeach;
		return $tid;
	}
	
	/** !Route GET */
	function index() {
		$this->dinerplaylistassetsSet = $this->dinerplaylistassets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->dinerplaylistassets->id = $id;
		if($this->dinerplaylistassets->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, remove/$tid */
	function remove($tid) {
/*
		$this->dinerPlaylistAssetSet = $this->dinerplaylistassets->equal('playlist_id',$pid);
		$tid = 0;
		foreach ($this->dinerPlaylistAssetSet as $track):
			if ($track->ndx == $ndx) {
				$tid = $track->id;
				break;
			}
		endforeach;
*/
		$this->dinerplaylistassets->id = $tid;
		if($this->dinerplaylistassets->delete()) {
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
			$this->dinerplaylistassets->insert();
			return $this->created($this->urlTo('details', $this->dinerplaylistassets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->dinerplaylistassets->id = $id;
		if($this->dinerplaylistassets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
		}
	}
	
	/** !Route POST, $id */
	function update($id) {
		$olddinerplaylistassets = new dinerplaylistassets($id);
		if($olddinerplaylistassets->exists()) {
			$olddinerplaylistassets->copy($this->dinerplaylistassets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
		}
	}
	
	/** !Route GET, update/pid/$pid/ndx/$ndx */
	function updateInPlaylist($pid, $ndx) {
		$this->dinerPlaylistAssetSet = $this->dinerplaylistassets->equal('playlist_id',$pid);
		$tid = 0;
		foreach ($this->dinerPlaylistAssetSet as $track):
			if ($track->ndx == $ndx) {
				$tid = $track->id;
				break;
			}
		endforeach;
		$this->dinerplaylistassets->id = $tid;
/*
		$olddinerplaylistassets = new dinerplaylistassets($tid);
		if($olddinerplaylistassets->exists()) {
			$olddinerplaylistassets->copy($this->dinerplaylistassets)->save();
			$this->result = true;
		} else {
			$this->result = false;
		}
*/
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->dinerplaylistassets->id = $id;
		if($this->dinerplaylistassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
		}
	}

	/** !Route DELETE, pid/$pid/ndx/$ndx */
/*
	function removeFromPlaylist($pid, $ndx) {
		$this->dinerPlaylistAssetSet = $this->dinerplaylistassets->equal('playlist_id',$pid);
		$tid = 0;
		foreach ($this->dinerPlaylistAssetSet as $track):
			if ($track->ndx == $ndx) {
				$tid = $track->id;
				break;
			}
		endforeach;
		$this->dinerplaylistassets->id = $tid;
		if($this->dinerplaylistassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'dinerplaylistassets does not exist.');
		}
	}
*/
	
}
?>