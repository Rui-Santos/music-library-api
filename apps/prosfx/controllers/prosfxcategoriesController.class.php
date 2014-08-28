<?php
Library::import('prosfx.models.prosfxcategories');
Library::import('admin.models.adminusers');
Library::import('logs.models.logpurchasedtracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxcategories/
 * !RoutesPrefix categories/
 */
class prosfxcategoriesController extends Controller {
	
	/** @var prosfxcategories */
	protected $prosfxcategories;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxcategories = new prosfxcategories();
		$this->logpurchasedtracks = new logpurchasedtracks();
		$this->_form = new ModelForm('prosfxcategories', $this->request->data('prosfxcategories'), $this->prosfxcategories);
	}
	
	/** !Route GET */
	function index() {
		//$this->prosfxcategoriesSet = $this->prosfxcategories->select()->distinct()->dinerField('CDTitle, Category, _PictureLink')->orderBy('CDTitle','ASC');
		$this->prosfxcategoriesSet = $this->prosfxcategories->select()->dinerField('CDTitle, Category, _PictureLink')->groupBy('Category ORDER BY CDTitle, Category');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** 
	* !Route GET, $userkey/$category
	* !Route GET, $userkey/$category/$pageNum
	* !Route GET, $userkey/$category/$pageNum/$pageLim
	* !Route GET, $userkey/$category/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browse($userkey, $category, $pageNum=1, $pageLim=25, $sortField='TrackTitle', $sortDir='ASC') {

		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxcategories->pageNumber = $pageNum;
		$this->prosfxcategories->pageLimit = $pageLim;

		$this->prosfxcategories->CDTitle = $category;
		$this->prosfxcategoriesSet = $this->prosfxcategories->equal('CDTitle',$category)->orderBy($sortField . ' ' . $sortDir);
		if($category=='Sound Design') {
			print_r($this->prosfxcategoriesSet);
			exit;
		}
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
		
	/** 
	* !Route GET, $userkey/$category/sub/$subcat
	* !Route GET, $userkey/$category/sub/$subcat/$pageNum
	* !Route GET, $userkey/$category/sub/$subcat/$pageNum/$pageLim
	* !Route GET, $userkey/$category/sub/$subcat/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browseSub($userkey, $category, $subcat, $pageNum=1, $pageLim=25, $sortField='TrackTitle', $sortDir='ASC') {

		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxcategories->pageNumber = $pageNum;
		$this->prosfxcategories->pageLimit = $pageLim;

		$this->prosfxcategories->CDTitle = $category;
			$this->prosfxcategories->SubCat = $subcat;
			$this->prosfxcategoriesSet = $this->prosfxcategories->equal('CDTitle',$category)->equal('Category', $subcat)->orderBy($sortField . ' ' . $sortDir);
		$this->ok('browse');
		//print 'hello';
		//exit;
	}
		
}
?>