<?php
Library::import('musicplayground.models.mpquery');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpquery/
 * !RoutesPrefix query/
 */
class mpqueryController extends Controller {
	
	/** @var mpquery */
	protected $mpquery;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpquery = new mpquery();
		$this->_form = new ModelForm('mpquery', $this->request->data('mpquery'), $this->mpquery);
	}
	
	/** !Route GET */
	function index() {
		$this->mpquerySet = $this->mpquery->all()->orderBy('Library ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $searchTerm
	* !Route GET, $searchTerm/$pageNum
	* !Route GET, $searchTerm/$pageNum/$pageLim
	* !Route GET, $searchTerm/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function results($searchTerm, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="DESC") {
	
		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		$this->mpquery->searchTerm = $searchTerm;
		$this->mpquery->pageNumber = $pageNum;
		$this->mpquery->pageLimit = $pageLim;
		
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
	
		$this->mpquery->searchTerm = $searchTermParsed;

		//$this->mpquerySet = $this->mpquery->select()->dinerMatch($searchTermParsed, null)->orderBy($sortField . ' ' . $sortDir);
		$this->mpquerySet = $this->mpquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'musicplayground')->dinerMatch($searchTermParsed, null,'musicplayground')->orderBy($sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/**
	* !Route GET, $searchTerm/field/$dinerFieldName
	* !Route GET, $searchTerm/field/$dinerFieldName/$pageNum
	* !Route GET, $searchTerm/field/$dinerFieldName/$pageNum/$pageLim
	* !Route GET, $searchTerm/field/$dinerFieldName/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function fieldresults($searchTerm, $dinerFieldName, $pageNum=1, $pageLim=25, $sortField="TrackTitle", $sortDir="ASC") {
		$this->mpquery->searchTerm = $searchTerm;
		$this->mpquery->searchTerm = $searchTerm;
		$this->mpquery->pageNumber = $pageNum;
		$this->mpquery->pageLimit = $pageLim;
		
		if($dinerFieldName == "trackName") {
			$dinerFieldName = "TrackTitle";
		}
		$this->mpquerySet = $this->mpquery->like($dinerFieldName, '%' . $searchTerm . '%')->orderBy($sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	}
?>