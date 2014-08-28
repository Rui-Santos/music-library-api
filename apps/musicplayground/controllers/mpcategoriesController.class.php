<?php
Library::import('musicplayground.models.mpcategories');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpcategories/
 * !RoutesPrefix categories/
 */
class mpcategoriesController extends Controller {
	
	/** @var mpcategories */
	protected $mpcategories;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpcategories = new mpcategories();
		$this->_form = new ModelForm('mpcategories', $this->request->data('mpcategories'), $this->mpcategories);
	}
	
	/** !Route GET */
	function index() {
		$this->mpcategoriesSet = $this->mpcategories->select()->dinerField('Category')->groupBy('Category ORDER BY Category ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $Category
	* !Route GET, $Category/$pageNum
	* !Route GET, $Category/$pageNum/$pageLim
	* !Route GET, $Category/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browse($Category, $pageNum=1, $pageLim=25, $sortField='Library', $sortDir='ASC') {
		$this->mpcategories->pageNumber = $pageNum;
		$this->mpcategories->pageLimit = $pageLim;

		$this->mpcategories->term = $Category;
		$this->mpcategoriesSet = $this->mpcategories->like('Category','%'.$Category.'%')->orderBy('Library, CDTitle, Track, TrackTitle ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
}
?>