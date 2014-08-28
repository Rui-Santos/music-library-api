<?php
Library::import('musicplayground.models.mplyrics');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mplyrics/
 * !RoutesPrefix lyrics/
 */
class mplyricsController extends Controller {
	
	/** @var mplyrics */
	protected $mplyrics;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mplyrics = new mplyrics();
		$this->_form = new ModelForm('mplyrics', $this->request->data('mplyrics'), $this->mplyrics);
	}
	
	/** !Route GET */
	function index() {
		$this->mplyricsSet = $this->mplyrics->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function details($RecID) {
		$this->mplyrics->RecID = $RecID;
		if($this->mplyrics->exists()) {
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
			$this->mplyrics->insert();
			return $this->created($this->urlTo('details', $this->mplyrics->RecID));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $RecID/edit */
	function editForm($RecID) {
		$this->mplyrics->RecID = $RecID;
		if($this->mplyrics->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mplyrics does not exist.');
		}
	}
	
	/** !Route PUT, $RecID */
	function update($RecID) {
		$oldmplyrics = new mplyrics($RecID);
		if($oldmplyrics->exists()) {
			$oldmplyrics->copy($this->mplyrics)->save();
			return $this->forwardOk($this->urlTo('details', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mplyrics does not exist.');
		}
	}
	
	/** !Route DELETE, $RecID */
	function delete($RecID) {
		$this->mplyrics->RecID = $RecID;
		if($this->mplyrics->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'mplyrics does not exist.');
		}
	}
}
?>