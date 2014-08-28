<?php
Library::import('playlists.models.tracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix tracks/
 */
class tracksController extends Controller {
	
	/** @var tracks */
	protected $tracks;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->tracks = new tracks();
		$this->_form = new ModelForm('tracks', $this->request->data('tracks'), $this->tracks);
	}
	
	/** !Route GET */
	function index() {
		$this->tracksSet = $this->tracks->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->tracks->id = $id;
		if($this->tracks->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, remove/$tid */
	function remove($tid) {
		$this->tracks->id = $tid;
		if($this->tracks->delete()) {
			$this->result = true;
		} else {
			$this->result = false;
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
			$this->tracks->insert();
			return $this->created($this->urlTo('details', $this->tracks->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->tracks->id = $id;
		if($this->tracks->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'tracks does not exist.');
		}
	}
	
	/** !Route POST, $id */
	function update($id) {
		$oldtracks = new tracks($id);
		if($oldtracks->exists()) {
			$oldtracks->copy($this->tracks)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'tracks does not exist.');
		}
	}
	
	/** !Route GET, update/pid/$pid/ndx/$ndx */
	function updateInPlaylist($pid, $ndx) {
		$this->trackset = $this->tracks->equal('playlist_id',$pid);
		$tid = 0;
		foreach ($this->trackset as $track):
			if ($track->ndx == $ndx) {
				$tid = $track->id;
				break;
			}
		endforeach;
		$this->tracks->id = $tid;
	}

	/** !Route DELETE, $id */
	function delete($id) {
		$this->tracks->id = $id;
		if($this->tracks->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'tracks does not exist.');
		}
	}
}
?>