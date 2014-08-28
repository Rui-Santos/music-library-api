<?php
Library::import('art.models.theprosfxart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix theprosfxart/
 * !RoutesPrefix prosfx/
 */
class theprosfxartController extends Controller {
	
	/** @var theprosfxart */
	protected $theprosfxart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->theprosfxart = new theprosfxart();
		$this->_form = new ModelForm('theprosfxart', $this->request->data('theprosfxart'), $this->theprosfxart);
	}
	
	/**
	* !Route GET, $RecID
	* !Route GET, $RecID/$imgsize
	* */
	function imgsize($RecID, $imgsize=0) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else {
			$this->theprosfxart->RecID = $RecID;
			$this->theprosfxart->size = $imgsize;
			if ($imgsize==0) {$this->theprosfxart->size='full';}
			$path = "SFX_NEW/art/";
			if($this->theprosfxart->exists()) {
				$this->imgGen($this->theprosfxart, $imgsize, $path);
				return $this->ok('imgsize');
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}
}
?>