<?php
Library::import('waveforms.models.wformsall');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix wformsall/
 * !RoutesPrefix get/
 */
class wformsallController extends Controller {
	
	/** @var wformsall */
	protected $wformsall;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->wformsall = new wformsall();
		$this->_form = new ModelForm('wformsall', $this->request->data('wformsall'), $this->wformsall);
	}

	function imgGenx($data, $imagesize) {
		$cachepath = "/PATH/GOES/HERE/api/img_cache/waveforms/";
		$file = $cachepath . "waveform_full_" . $data->RecID . ".png";
	 	$full = $cachepath . 'waveform_full_'.$data->RecID.'.png'; 
	 	$sizepath = $cachepath . "waveform_" . $imagesize . "_" . $data->RecID . ".png";
		if( !file_exists( $file ) ) {
			//$data = $this->wformsall->equal('RecID',$recid)->first();
	 		$fp = fopen( $full, 'wb' ); 
	 		fwrite( $fp, $data->WaveformRep ); 
	 		fclose($fp); 
		}
		if ($imagesize == 0) return true;
		else {
			if (file_exists($sizepath)) return true;
			else {
				$orig = @imagecreatefrompng($file);
			 	$height = imagesy($orig); 
			 	$image = imagecreatetruecolor($imagesize, $height); 
			 	imagealphablending($image, false); 
			 	imagecopyresampled( $image, $orig, 0, 0, 0, 0, $imagesize, $height, imagesx($orig), $height ); 
			 	imagesavealpha($image, true); 
			 	imagepng( $image, $sizepath );
			 	imagedestroy($image);
			 	imagedestroy($orig);
			}
		}
	}
	
	/** !Route GET */
	function index() {
		$this->wformsallSet = $this->wformsall->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $RecID
	* !Route GET, $RecID/$size
	* */
	function imgfull($RecID, $size=0) {
		$this->wformsall->RecID = $RecID;
		if($this->wformsall->exists()) {
			$this->wformsall->imgSize = $size;
			$this->imgGenx($this->wformsall, $size);
			return $this->ok('imgfull');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
}
?>