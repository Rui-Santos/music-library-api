<?php
Library::import('prosfx.models.prosfxmetadata');
Library::import('admin.models.adminusers');
Library::import('logs.models.logpurchasedtracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxmetadata/
 * !RoutesPrefix metadata/
 */
class prosfxmetadataController extends Controller {
	
	/** @var prosfxmetadata */
	protected $prosfxmetadata;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxmetadata = new prosfxmetadata();
		$this->logpurchasedtracks = new logpurchasedtracks();
		$this->_form = new ModelForm('prosfxmetadata', $this->request->data('prosfxmetadata'), $this->prosfxmetadata);
	}
	
	/** 
	* !Route GET 
	* !Route GET, $pageNum
	* !Route GET, $pageNum/$pageLim
	* !Route GET, $pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($pageNum=1, $pageLim=25, $sortField="TrackTitle", $sortDir="ASC") {
		$this->prosfxmetadataSet = $this->prosfxmetadata->all()->orderBy($sortField . ' ' . $sortDir);
		$this->prosfxmetadata->searchTerm = '*';
		$this->prosfxmetadata->pageNumber = $pageNum;
		$this->prosfxmetadata->pageLimit = $pageLim;
		$this->ok('results');
	}
	
	/**
	* !Route GET, query/$searchTerm
	* !Route GET, query/$searchTerm/$pageNum
	* !Route GET, query/$searchTerm/$pageNum/$pageLim
	* !Route GET, query/$searchTerm/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function results($searchTerm, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="DESC") {

		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		if (isset($this->request->headers['USER'])) {
			$userkey = $this->request->headers['USER'];
		} else {
			$userkey = 'guest';
		}
		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxmetadata->searchTerm = $searchTerm;
		$this->prosfxmetadata->pageNumber = $pageNum;
		$this->prosfxmetadata->pageLimit = $pageLim;
		
		$quote = false;
		$quoteArray = explode('"', $searchTerm);
		foreach($quoteArray as &$quoteSegment) {
			if($quote){
				$quoteSegment = str_replace(' ', 'brktzspaceztkrb', $quoteSegment);
				$quoteSegment = str_replace("'", "", $quoteSegment);
			}
			$quote = !$quote;
		}
		$searchTermParsed = implode('"', $quoteArray);
	
		$this->prosfxmetadata->searchTerm = $searchTermParsed;

		$this->prosfxmetadataSet = $this->prosfxmetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'prosfx')->dinerMatch($searchTermParsed, null,'musicplayground')->orderBy($sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/**
	* !Route GET, query/$searchTerm/field/$dinerFieldName
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum/$pageLim
	* */
	function fieldresults($searchTerm, $dinerFieldName, $pageNum=1, $pageLim=25) {
		if (isset($this->request->headers['USER'])) {
			$userkey = $this->request->headers['USER'];
		} else {
			$userkey = 'guest';
		}
		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxmetadata->searchTerm = $searchTerm;
		$this->prosfxmetadata->pageNumber = $pageNum;
		$this->prosfxmetadata->pageLimit = $pageLim;
		
		if($dinerFieldName == "trackName") {
			$dinerFieldName = "TrackTitle";
		}
		$this->prosfxmetadataSet = $this->prosfxmetadata->like($dinerFieldName, '%' . $searchTerm . '%')->orderBy('TrackTitle ASC');
		$this->ok('results');
/*
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
*/
	}


	//////////////////////////////////////
	//
	//
	//		CATEGORIES
	//
	//
	//////////////////////////////////////

	/** !Route GET, categories */
	function indexCategories() {
		//$this->prosfxmetadataSet = $this->prosfxmetadata->select()->distinct()->dinerField('CDTitle, Category, _PictureLink')->orderBy('CDTitle','ASC');
		$this->prosfxmetadataSet = $this->prosfxmetadata->select()->dinerField('CDTitle, Category, _PictureLink')->groupBy('Category ORDER BY CDTitle, Category');
		$this->ok('categories');
	}
	
	/** 
	* !Route GET, categories/$category
	* !Route GET, categories/$category/$pageNum
	* !Route GET, categories/$category/$pageNum/$pageLim
	* !Route GET, categories/$category/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browse($category, $pageNum=1, $pageLim=25, $sortField='TrackTitle', $sortDir='ASC') {

		if (isset($this->request->headers['USER'])) {
			$userkey = $this->request->headers['USER'];
		} else {
			$userkey = 'guest';
		}
		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxmetadata->searchTerm = $category;
		$this->prosfxmetadata->pageNumber = $pageNum;
		$this->prosfxmetadata->pageLimit = $pageLim;

		$this->prosfxmetadata->CDTitle = $category;
		$this->prosfxmetadataSet = $this->prosfxmetadata->equal('CDTitle',$category)->orderBy($sortField . ' ' . $sortDir);
		$this->ok('results');
	}
		
	/** 
	* !Route GET, categories/$category/sub/$subcat
	* !Route GET, categories/$category/sub/$subcat/$pageNum
	* !Route GET, categories/$category/sub/$subcat/$pageNum/$pageLim
	* !Route GET, categories/$category/sub/$subcat/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browseSub($category, $subcat, $pageNum=1, $pageLim=25, $sortField='TrackTitle', $sortDir='ASC') {

		if (isset($this->request->headers['USER'])) {
			$userkey = $this->request->headers['USER'];
		} else {
			$userkey = 'guest';
		}
		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxmetadata->searchTerm = $category;
		$this->prosfxmetadata->pageNumber = $pageNum;
		$this->prosfxmetadata->pageLimit = $pageLim;

		$this->prosfxmetadata->CDTitle = $category;
			$this->prosfxmetadata->SubCat = $subcat;
			$this->prosfxmetadataSet = $this->prosfxmetadata->equal('CDTitle',$category)->equal('Category', $subcat)->orderBy($sortField . ' ' . $sortDir);
		$this->ok('results');
		//print 'hello';
		//exit;
	}

}
?>