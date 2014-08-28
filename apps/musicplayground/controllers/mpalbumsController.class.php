<?php
Library::import('musicplayground.models.mpalbums');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpalbums/
 * !RoutesPrefix albums/
 */
class mpalbumsController extends Controller {
	
	/** @var mpalbums */
	protected $mpalbums;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpalbums = new mpalbums();
		$this->_form = new ModelForm('mpalbums', $this->request->data('mpalbums'), $this->mpalbums);
	}
	
	/** !Route GET */
	function index() {
		//$this->mpalbumsSet = $this->mpalbums->select()->distinct()->dinerField('CDTitle, Library, _PictureLink')->orderBy('Library','ASC');
		$this->mpalbumsSet = $this->mpalbums->select()->dinerField('CDTitle, Library, _PictureLink')->groupBy('CDTitle ORDER BY Library ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $CDTitle
	* !Route GET, $CDTitle/$pageNum
	* !Route GET, $CDTitle/$pageNum/$pageLim
	* !Route GET, $CDTitle/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browse($CDTitle, $pageNum=1, $pageLim=25, $sortField='Track, TrackTitle', $sortDir='ASC') {
		$this->mpalbums->albtit = $CDTitle;
		$this->mpalbumsSet = $this->mpalbums->like('CDTitle',$CDTitle.'%')->orderBy($sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
}
?>