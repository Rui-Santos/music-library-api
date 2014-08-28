<?php
Library::import('prosfx.models.prosfxart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxart/
 * !RoutesPrefix art/
 */
class prosfxartController extends Controller {
	
	/** @var prosfxart */
	protected $prosfxart;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxart = new prosfxart();
		$this->_form = new ModelForm('prosfxart', $this->request->data('prosfxart'), $this->prosfxart);
	}
	
/*
	function imgGen($recid, $imagesize) {
		$cachepath = "/Users/thestation/Music/SFX_NEW/art/";
		$file = $cachepath . "image_full_" . $recid . ".jpg";
	 	$full = $cachepath . 'image_full_'.$recid.'.jpg'; 
	 	$sizepath = $cachepath . "image_" . $imagesize . "_" . $recid . ".jpg";
		if( !file_exists( $file ) ) {
			$data = $this->prosfxart->equal('RecID',$recid)->first();
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
		$this->prosfxartSet = $this->prosfxart->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $RecID */
	function imgfull($RecID) {
		$this->imgGen($RecID, 0);
		$this->prosfxart->RecID = $RecID;
		if($this->prosfxart->exists()) {
			return $this->ok('imgfull');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}

	/** !Route GET, $RecID/$imgsize */
	function imgsize($RecID, $imgsize) {
		if(!is_numeric($imgsize)) return $this->forwardNotFound($this->urlTo('index'));
		else $this->imgGen($RecID, $imgsize);
		$this->prosfxart->RecID = $RecID;
		$this->prosfxart->size = $imgsize;
		if($this->prosfxart->exists()) {
			return $this->ok('imgsize');
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
			$this->prosfxart->insert();
			return $this->created($this->urlTo('details', $this->prosfxart->RecID));		
		} catch(Exception $exception) {
			return $this->conflict('editForm');
		}
	}
	
	/** !Route GET, $RecID/edit */
	function editForm($RecID) {
		$this->prosfxart->RecID = $RecID;
		if($this->prosfxart->exists()) {
			$this->_form->to(Methods::PUT, $this->urlTo('update', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxart does not exist.');
		}
	}
	
	/** !Route PUT, $RecID */
	function update($RecID) {
		$oldprosfxart = new prosfxart($RecID);
		if($oldprosfxart->exists()) {
			$oldprosfxart->copy($this->prosfxart)->save();
			return $this->forwardOk($this->urlTo('details', $RecID));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxart does not exist.');
		}
	}
	
	/** !Route DELETE, $RecID */
	function delete($RecID) {
		$this->prosfxart->RecID = $RecID;
		if($this->prosfxart->delete()) {
			return $this->forwardOk($this->urlTo('index'));
		} else {
			return $this->forwardNotFound($this->urlTo('index'), 'prosfxart does not exist.');
		}
	}
}
?>