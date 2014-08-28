<?php
Library::import('art.models.mpartistart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpartistart/
 * !RoutesPrefix artist/
 */
class mpartistartController extends Controller {
	
	/** @var mpartistart */
	protected $mpartistart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpartistart = new mpartistart();
		$this->_form = new ModelForm('mpartistart', $this->request->data('mpartistart'), $this->mpartistart);
	}
	
	/**
	* !Route GET, $filename
	* !Route GET, $filename/$imgsize
	* */
	function imgsize($filename, $imgsize=0) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else {
			$this->mpartistart->filename = $filename;
			$this->mpartistart->size = $imgsize;
			if ($imgsize==0) {$this->mpartistart->size='full';}
			$path = "THE_MUSIC_PLAYGROUND/artistimages/";
			if($this->mpartistart->exists()) {
				$this->imgGen($this->mpartistart, $imgsize, $path, true);
				return $this->ok('imgsize');
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}

}
?>