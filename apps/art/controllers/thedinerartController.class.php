<?php
Library::import('art.models.thedinerart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix thedinerart/
 * !RoutesPrefix diner/
 */
class thedinerartController extends Controller {
	
	/** @var thedinerart */
	protected $thedinerart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->thedinerart = new thedinerart();
		$this->_form = new ModelForm('thedinerart', $this->request->data('thedinerart'), $this->thedinerart);
	}
	
	/**
	* !Route GET, $RecID
	* !Route GET, $RecID/$imgsize
	* */
	function imgsize($RecID, $imgsize=0) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else {
			$this->thedinerart->RecID = $RecID;
			$this->thedinerart->size = $imgsize;
			if ($imgsize==0) {$this->thedinerart->size='full';}
			$path = "THE_DINER/album_art/";
			if($this->thedinerart->exists()) {
				$this->imgGen($this->thedinerart, $imgsize, $path);
				return $this->ok('imgsize');
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}

}
?>