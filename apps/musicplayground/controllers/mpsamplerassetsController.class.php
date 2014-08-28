<?php
Library::import('musicplayground.models.mpsamplerassets');
Library::import('musicplayground.models.mpallassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpsamplerassets/
 */
class mpsamplerassetsController extends Controller {
	
	/** @var mpsamplerassets */
	protected $mpsamplerassets;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpsamplerassets = new mpsamplerassets();
		$this->_form = new ModelForm('mpsamplerassets', $this->request->data('mpsamplerassets'), $this->mpsamplerassets);
	}
	
	/** !Route GET */
	function index() {
		$this->mpsamplerassetsSet = $this->mpsamplerassets->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->mpsamplerassets->id = $id;
		if($this->mpsamplerassets->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
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
			$this->mpsamplerassets->insert();
			return $this->created($this->urlTo('details', $this->mpsamplerassets->id));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $id/edit */
	function editForm($id) {
		$this->mpsamplerassets->id = $id;
		if($this->mpsamplerassets->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpsamplerassets does not exist.');
		}
	}
	
	/** !Route PUT, $id */
	function update($id) {
		$oldmpsamplerassets = new mpsamplerassets($id);
		if($oldmpsamplerassets->exists()) {
			$oldmpsamplerassets->copy($this->mpsamplerassets)->save();
			return $this->forwardOk($this->urlTo('details', $id));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpsamplerassets does not exist.');
		}
	}
	
	/** !Route DELETE, $id */
	function delete($id) {
		$this->mpsamplerassets->id = $id;
		if($this->mpsamplerassets->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mpsamplerassets does not exist.');
		}
	}
	
	/** !Route GET, fixassets */
	function fixassets() {
		$d = $this->mpsamplerassets->all();
		foreach($d as $val) {

			$a = new mpallassets($val->longID);
			if($a->exists()) {
			if($val->asset_key != $a->asset_key) {
				$val->asset_key = $a->asset_key;
				$val->save();
				print $val->asset_key.'<br/>';
			}
			if($val->track_id != $a->track_id) {
				$val->track_id = $a->track_id;
				$val->save();
				print $val->track_id.'<br/>';
			}
			}
		}
		exit;
	}
}
?>