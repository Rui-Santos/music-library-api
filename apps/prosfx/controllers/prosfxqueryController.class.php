<?php
Library::import('prosfx.models.prosfxquery');
Library::import('admin.models.adminusers');
Library::import('logs.models.logpurchasedtracks');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix prosfxquery/
 * !RoutesPrefix query/
 */
class prosfxqueryController extends Controller {
	
	/** @var prosfxquery */
	protected $prosfxquery;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->prosfxquery = new prosfxquery();
		$this->logpurchasedtracks = new logpurchasedtracks();
		$this->_form = new ModelForm('prosfxquery', $this->request->data('prosfxquery'), $this->prosfxquery);
	}
	
	/** !Route GET */
	function index() {
		$this->prosfxquerySet = $this->prosfxquery->all();
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $userkey/$searchTerm
	* !Route GET, $userkey/$searchTerm/$pageNum
	* !Route GET, $userkey/$searchTerm/$pageNum/$pageLim
	* !Route GET, $userkey/$searchTerm/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function results($userkey, $searchTerm, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="DESC") {

		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
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
		
		$this->prosfxquery->searchTerm = $searchTerm;
		$this->prosfxquery->pageNumber = $pageNum;
		$this->prosfxquery->pageLimit = $pageLim;
		
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
	
		$this->prosfxquery->searchTerm = $searchTermParsed;

		$this->prosfxquerySet = $this->prosfxquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'prosfx')->dinerMatch($searchTermParsed, null,'musicplayground')->orderBy($sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/**
	* !Route GET, $userkey/$searchTerm/field/$dinerFieldName
	* !Route GET, $userkey/$searchTerm/field/$dinerFieldName/$pageNum
	* !Route GET, $userkey/$searchTerm/field/$dinerFieldName/$pageNum/$pageLim
	* */
	function fieldresults($userkey, $searchTerm, $dinerFieldName, $pageNum=1, $pageLim=25) {
		if($userkey != 'guest'){
			$user = new adminusers();
			$user->key = $userkey;
			if ($user->exists()) {
				$this->purchased = $user->getPurchasedAssets();
			}
		} else {
			$this->purchased = array();
		}	
		
		$this->prosfxquery->searchTerm = $searchTerm;
		$this->prosfxquery->pageNumber = $pageNum;
		$this->prosfxquery->pageLimit = $pageLim;
		
		if($dinerFieldName == "trackName") {
			$dinerFieldName = "TrackTitle";
		}
		$this->prosfxquerySet = $this->prosfxquery->like($dinerFieldName, '%' . $searchTerm . '%')->orderBy('TrackTitle ASC');
		//$this->ok('results');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

}
?>