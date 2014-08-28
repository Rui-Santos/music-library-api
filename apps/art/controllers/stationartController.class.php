<?php
Library::import('art.models.stationart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix stationart/
 * !RoutesPrefix station/
 */
class stationartController extends Controller {
	
	/** @var stationart */
	protected $stationart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->stationart = new stationart();
		$this->_form = new ModelForm('stationart', $this->request->data('stationart'), $this->stationart);
	}
	
	/** !Route GET */
	function index() {
		$this->stationartSet = $this->stationart->all();
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
			$this->stationart->RecID = $RecID;
			$this->stationart->size = $imgsize;
			if ($imgsize==0) {$this->stationart->size='full';}
			$path = "station/";
			if($this->stationart->exists()) {
				$this->imgGen($this->stationart, $imgsize, $path);
				return $this->ok('imgsize');
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}
}
?>