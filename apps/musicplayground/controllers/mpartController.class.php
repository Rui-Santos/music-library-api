<?php
Library::import('musicplayground.models.mpart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpart/
 * !RoutesPrefix art/
 */
class mpartController extends Controller {
	
	/** @var mpart */
	protected $mpart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpart = new mpart();
		$this->_form = new ModelForm('mpart', $this->request->data('mpart'), $this->mpart);
	}
	
/*
	function imgGen($recid, $imagesize) {
		$cachepath = "/Users/thestation/Music/THE_MUSIC_PLAYGROUND/album_art/";
		$file = $cachepath . "image_full_" . $recid . ".jpg";
	 	$full = $cachepath . 'image_full_'.$recid.'.jpg'; 
	 	$sizepath = $cachepath . "image_" . $imagesize . "_" . $recid . ".jpg";
		if( !file_exists( $file ) ) {
			$data = $this->mpart->equal('RecID',$recid)->first();
	 		$fp = fopen( $full, 'wb' ); 
	 		fwrite( $fp, $data->Picture ); 
	 		fclose($fp); 
		}
		if ($imagesize == 0) return true;
		else {
			if (file_exists($sizepath)) return true;
			else {
 				$fsize = getimagesize($full); 
		 		$imageFull = imagecreatefromjpeg($full); 
		 		$msize = $fsize[0] > $imagesize ? $imagesize : $fsize[0]; 
		 		$msize = $fsize[1] > $imagesize ? $imagesize : $fsize[1]; 
		 		$imageMeta = imagecreatetruecolor($msize, $msize); 
		 		imagecopyresampled( $imageMeta, $imageFull, 0, 0, 0, 0, $msize, $msize, $fsize[0], $fsize[1] ); 
		 		imagejpeg( $imageMeta, $sizepath, 90 ); 
		 		imagedestroy($imageMeta);
			}
		}

	}
*/
	
	/** !Route GET */
	function index() {
		$this->mpartSet = $this->mpart->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
		
	/** !Route GET, $RecID */
	function imgfull($RecID) {
		$this->imgGen($RecID, 0);
		$this->mpart->RecID = $RecID;
		if($this->mpart->exists()) {
			return $this->ok('imgfull');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}

	/** !Route GET, $RecID/$imgsize */
	function imgsize($RecID, $imgsize) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else $this->imgGen($RecID, $imgsize);
		$this->mpart->RecID = $RecID;
		$this->mpart->size = $imgsize;
		if($this->mpart->exists()) {
			return $this->ok('imgsize');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
}
?>