<?php
Library::import('station.models.stationartwork');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix stationartwork/
 * !RoutesPrefix artwork/
 */
class stationartworkController extends Controller {
	
	/** @var stationartwork */
	protected $stationartwork;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->stationartwork = new stationartwork();
		$this->_form = new ModelForm('stationartwork', $this->request->data('stationartwork'), $this->stationartwork);
	}
	
	/** !Route GET */
	function index() {
		$this->stationartworkSet = $this->stationartwork->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $RecID
	* !Route GET, $RecID/$imgsize
	* */
	function imgsize($RecID, $imgsize=0) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else {
			$this->stationartwork->RecID = $RecID;
			$this->stationartwork->size = $imgsize;
			if ($imgsize==0) {$this->stationartwork->size='full';}
			$path = "station/img/";
			if($this->stationartwork->exists()) {
				$this->imgGen($this->stationartwork, $imgsize, $path);
				return $this->ok('imgsize');
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}
}
?>