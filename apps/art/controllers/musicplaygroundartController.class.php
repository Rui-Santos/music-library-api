<?php
Library::import('art.models.musicplaygroundart');
Library::import('musicplayground.models.mpartistinfo');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix musicplaygroundart/
 * !RoutesPrefix musicplayground/
 */
class musicplaygroundartController extends Controller {
	
	/** @var musicplaygroundart */
	protected $musicplaygroundart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->musicplaygroundart = new musicplaygroundart();
		$this->mpartistinfo = new mpartistinfo();
		$this->_form = new ModelForm('musicplaygroundart', $this->request->data('musicplaygroundart'), $this->musicplaygroundart);
	}
	
	/**
	* !Route GET, $RecID
	* !Route GET, $RecID/$imgsize
	* */
	function imgsize($RecID, $imgsize=0) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else {
			$this->musicplaygroundart->RecID = $RecID;
			$this->musicplaygroundart->size = $imgsize;
			if ($imgsize==0) {$this->musicplaygroundart->size='full';}
			$path = "THE_MUSIC_PLAYGROUND/album_art/";
			if($this->musicplaygroundart->exists()) {
				$this->imgGen($this->musicplaygroundart, $imgsize, $path);
				return $this->ok('imgsize');
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}
	
	/**
	* !Route GET, artist/$slug
	* !Route GET, artist/$slug/$imgsize
	* */
	function artist($slug, $imgsize=0) {
	   $this->mpartistinfo->filename = $slug;
	   if($this->mpartistinfo->exists()) {
		$this->musicplaygroundart->RecID = $this->mpartistinfo->photo;
	   } else {
    	   $this->musicplaygroundart->RecID = 0;
	   }
		$this->musicplaygroundart->size = $imgsize;
		if ($imgsize==0) {$this->musicplaygroundart->size='full';}
		$path = "THE_MUSIC_PLAYGROUND/album_art/";
		if($this->musicplaygroundart->exists()) { 
			$this->imgGen($this->musicplaygroundart, $imgsize, $path);
			return $this->ok('imgsize');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
    	   
	}
}
?>