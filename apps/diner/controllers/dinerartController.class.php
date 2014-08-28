<?php
Library::import('diner.models.dinerart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerart/
 * !RoutesPrefix art/
 */
class dinerartController extends Controller {
	
	/** @var dinerart */
	protected $dinerart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerart = new dinerart();
		$this->_form = new ModelForm('dinerart', $this->request->data('dinerart'), $this->dinerart);
	}
	
/*
	function imgGen($recid, $imagesize) {
		$cachepath = "/Users/thestation/Music/THE_DINER/album_art/";
		$file = $cachepath . "image_full_" . $recid . ".jpg";
	 	$full = $cachepath . 'image_full_'.$recid.'.jpg'; 
	 	$sizepath = $cachepath . "image_" . $imagesize . "_" . $recid . ".jpg";
		if( !file_exists( $file ) ) {
			$data = $this->dinerart->equal('RecID',$recid)->first();
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
		$this->dinerartSet = $this->dinerart->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function imgfull($RecID) {
		$this->imgGen($RecID, 0);
		$this->dinerart->RecID = $RecID;
		if($this->dinerart->exists()) {
			return $this->ok('imgfull');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}

	/** !Route GET, $RecID/$imgsize */
	function imgsize($RecID, $imgsize) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else $this->imgGen($RecID, $imgsize);
		$this->dinerart->RecID = $RecID;
		$this->dinerart->size = $imgsize;
		if($this->dinerart->exists()) {
			return $this->ok('imgsize');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	
}
?>