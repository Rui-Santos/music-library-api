<?php
Library::import('diner.models.dinerquery');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerquery/
 * !RoutesPrefix query/
 */
class dinerqueryController extends Controller {
	
	/** @var dinerquery */
	protected $dinerquery;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerquery = new dinerquery();
		$this->_form = new ModelForm('dinerquery', $this->request->data('dinerquery'), $this->dinerquery);
	}
	
	/** !Route GET */
	function index() {
/*
		$this->dinerquerySet = $this->dinerquery->all()->orderBy('TrackTitle ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
*/
		print_r(getallheaders());
		exit;
	}
	
	/**
	* !Route GET, $searchTerm
	* !Route GET, $searchTerm/$pageNum
	* !Route GET, $searchTerm/$pageNum/$pageLim
	* !Route GET, $searchTerm/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function results($searchTerm, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="Desc") {
		$d = $this->digest();

		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		preg_match_all('/D-[a-zA-Z]{2}[0-9]{4}/i', $searchTerm, $matches);
		foreach($matches[0] as $match) {
			$searchTerm = str_replace($match, substr($match, 2), $searchTerm);
		}
/* 		$this->allDinerAssets = $this->assets->equal("db_id", 12); */
		$this->dinerquery->searchTerm = $searchTerm;
		$this->dinerquery->pageNumber = $pageNum;
		$this->dinerquery->pageLimit = $pageLim;
		
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
	
		$this->dinerquery->searchTerm = $searchTermParsed;
		
		$matchConditions = null;
		
		if (!$this->apollo) {
			// use only to exclude apollo
			$matchConditions = " AND Manufacturer != 'Apollo' ";
		}
		
		//$this->dinerquerySet = $this->dinerquery->select()->dinerMatch($searchTermParsed, null)->orderBy($sortField . ' ' . $sortDir);
		//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, null)->orderBy($sortField . ' ' . $sortDir);
		$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions,'diner')->groupBy('TrackTitle ORDER BY ' . $sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/**
	* !Route GET, $searchTerm/timerange/$range
	* !Route GET, $searchTerm/timerange/$range/$pageNum
	* !Route GET, $searchTerm/timerange/$range/$pageNum/$pageLim
	* !Route GET, $searchTerm/timerange/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function resultsRange($searchTerm, $range, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="DESC") {
		$d = $this->digest();
	
		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		preg_match_all('/D-[a-zA-Z]{2}[0-9]{4}/i', $searchTerm, $matches);
		foreach($matches[0] as $match) {
			$searchTerm = str_replace($match, substr($match, 2), $searchTerm);
		}
		$this->dinerquery->searchTerm = $searchTerm;
		$this->dinerquery->pageNumber = $pageNum;
		$this->dinerquery->pageLimit = $pageLim;
		
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
	
		$this->dinerquery->searchTerm = $searchTermParsed;
		
		$rangeArray = explode(',', $range);

		if (count($rangeArray)==0) {
			switch ($rangeArray[0]) {
				case "15":
					$matchConditions = "AND TotalFrames < 1014300 ";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "30":
					$matchConditions = "AND TotalFrames >= 970200 AND TotalFrames <= 1675800 ";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "45":
					$matchConditions = "AND TotalFrames >= 1675800 AND TotalFrames <= 2425500 ";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "60":
					$matchConditions = "AND TotalFrames >= 2205000 AND TotalFrames <= 3528000 ";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "90":
					$matchConditions = "AND TotalFrames >= 3307500 AND TotalFrames <= 4851000 ";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "120":
					$matchConditions = "AND TotalFrames >= 4630500 ";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
			}
		} else {
		
			$matchConditions = "AND (";

			foreach ($rangeArray as $key => $value) {
						
				switch ($value) {
					case "15":
						$matchConditions .= "(TotalFrames < 1014300)";
						break;
					case "30":
						$matchConditions .= "(TotalFrames >= 970200 AND TotalFrames <= 1675800)";
						break;
					case "45":
						$matchConditions .= "(TotalFrames >= 1675800 AND TotalFrames <= 2425500)";
						break;
					case "60":
						$matchConditions .= "(TotalFrames >= 2205000 AND TotalFrames <= 3528000)";
						break;
					case "90":
						$matchConditions .= "(TotalFrames >= 3307500 AND TotalFrames <= 4851000)";
						break;
					case "120":
						$matchConditions .= "(TotalFrames >= 4630500)";
						break;
				}
				
				if ($key == count($rangeArray)-1) {
					$matchConditions .= ") ";
				} else {
					$matchConditions .= " OR ";
				}	
			
			}

		}
		if (!$this->apollo) {
			// use only to exclude apollo
			$matchConditions .= "AND Manufacturer != 'Apollo' ";
		}
/*
		if($d['username']=='tunetruck') {
			$matchConditions .= " AND Conductor REGEXP 'IH|WH' ";
		}
*/

		$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions,'diner')->groupBy('TrackTitle ORDER BY ' . $sortField . ' ' . $sortDir);

		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}

	}

	/**
	* !Route GET, $searchTerm/field/$dinerFieldName
	* !Route GET, $searchTerm/field/$dinerFieldName/$pageNum
	* !Route GET, $searchTerm/field/$dinerFieldName/$pageNum/$pageLim
	* */
	function fieldresults($searchTerm, $dinerFieldName, $pageNum=1, $pageLim=25) {
		$this->dinerquery->searchTerm = $searchTerm;
		$this->dinerquery->searchTerm = $searchTerm;
		$this->dinerquery->pageNumber = $pageNum;
		$this->dinerquery->pageLimit = $pageLim;
		
		if($dinerFieldName == "trackName") {
			$dinerFieldName = "TrackTitle";
		}

		if ($this->apollo) {
			$this->dinerquerySet = $this->dinerquery->like($dinerFieldName, '%' . $searchTerm . '%')->groupBy('TrackTitle ORDER BY Manufacturer DESC, TrackTitle ASC');
		} else {
			// use only to exclude apollo, and comment out previous.
			$this->dinerquerySet = $this->dinerquery->like($dinerFieldName, '%' . $searchTerm . '%')->notEqual('Manufacturer','Apollo')->orderBy('TrackTitle ASC');
		}
		
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/** !Route GET, $searchTerm/field/$dinerFieldName/$searchTerm2/field2/$dinerFieldName2 */
	function fieldresults2($searchTerm, $dinerFieldName, $searchTerm2, $dinerFieldName2) {
		$this->dinerquery->searchTerm = $searchTerm . ', ' . $searchTerm2;

		$this->dinerquerySet = $this->dinerquery->like($dinerFieldName, '%' . $searchTerm . '%')->like($dinerFieldName2, '%' . $searchTerm2 . '%')->orderBy('TrackTitle ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	

}
?>