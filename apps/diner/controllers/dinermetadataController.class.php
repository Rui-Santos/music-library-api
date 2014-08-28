<?php
Library::import('diner.models.dinermetadata');
Library::import('diner.models.dinerassets');
Library::import('diner.models.dinertestmetadata');
Library::import('diner.models.dinertestartwork');
Library::import('diner.models.dinertestassets');
Library::import('diner.models.dineruploadmetadata');
Library::import('diner.models.dineruploadartwork');
Library::import('diner.models.dinerart');
Library::import('admin.models.adminassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinermetadata/
 * !RoutesPrefix metadata/
 */
class dinermetadataController extends Controller {
	
	/** @var dinermetadata */
	protected $dinermetadata;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinermetadata = new dinermetadata();
		$this->_form = new ModelForm('dinermetadata', $this->request->data('dinermetadata'), $this->dinermetadata);
	}
	
	/** !Route GET, test */
	function test() {
		print json_encode(array('c3e826d86580e312b347df02b2082096', '4cf250ac8380fc630bbd94b5bc55493a'));
		
		exit;
	}
	
	/** 
	* !Route GET 
	* !Route GET, $pageNum
	* !Route GET, $pageNum/$pageLim
	* !Route GET, $pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($pageNum=1, $pageLim=25, $sortField="TrackTitle", $sortDir="ASC") {
		$this->dinermetadataSet = $this->dinermetadata->all()->orderBy($sortField . ' ' . $sortDir);
		$this->dinermetadata->searchTerm = '*';
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		$this->ok('results');
	}
	


	//////////////////////////////////////
	//
	//
	//		ONE TRACK INFO
	//
	//
	//////////////////////////////////////

	/** 
	* !Route GET, info/$longID
	* */
	function info($longID) {
		$this->dinermetadataSet = $this->dinermetadata->equal('LongID', $longID);
		$this->dinermetadata->searchTerm = $longID;
		$this->dinermetadata->pageNumber = 1;
		$this->dinermetadata->pageLimit = 1;
		if(count($this->dinermetadataSet) > 0) {
			$this->ok('results');
		} else {
			print 'fail';
			exit;
		}
	}

	/** !Route GET, filename/$filename */
	function getFromFilename($filename) {
		$this->dinermetadataSet = $this->dinermetadata->equal('Filename',$filename.'.mp3')->limit(1);
		$this->dinermetadata->pageNumber = 1;
		$this->dinermetadata->pageLimit = 0;

		$this->dinermetadata->searchTerm = $filename;

		if(!count($this->dinermetadataSet)) {
			print 'fail';
			exit;
		} else {
			$this->ok('results');			
		}
	}

	//////////////////////////////////////
	//
	//
	//		SEARCH
	//
	//
	//////////////////////////////////////

	/**
	* !Route GET, query/$searchTerm
	* !Route GET, query/$searchTerm/$pageNum
	* !Route GET, query/$searchTerm/$pageNum/$pageLim
	* !Route GET, query/$searchTerm/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function results($searchTerm, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="Desc") {
	
		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		preg_match_all('/D-[a-zA-Z]{2}[0-9]{4}/i', $searchTerm, $matches);
		foreach($matches[0] as $match) {
			$searchTerm = str_replace($match, substr($match, 2), $searchTerm);
		}
/* 		$this->allDinerAssets = $this->assets->equal("db_id", 12); */
		$this->dinermetadata->searchTerm = $searchTerm;
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		
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
	
		$this->dinermetadata->searchTerm = $searchTermParsed;

		$matchConditions = null;
		
		if (!$this->apollo) {
			// use only to exclude apollo
			$matchConditions = " AND Manufacturer != 'Apollo' ";
		}

		//$this->dinermetadataSet = $this->dinermetadata->select()->dinerMatch($searchTermParsed, null)->orderBy($sortField . ' ' . $sortDir);
		//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, null)->orderBy($sortField . ' ' . $sortDir);
		$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions,'diner')->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/**
	* !Route GET, query/$searchTerm/timerange/$range
	* !Route GET, query/$searchTerm/timerange/$range/$pageNum
	* !Route GET, query/$searchTerm/timerange/$range/$pageNum/$pageLim
	* !Route GET, query/$searchTerm/timerange/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function resultsRange($searchTerm, $range, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="DESC") {
	
		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		preg_match_all('/D-[a-zA-Z]{2}[0-9]{4}/i', $searchTerm, $matches);
		foreach($matches[0] as $match) {
			$searchTerm = str_replace($match, substr($match, 2), $searchTerm);
		}
		$this->dinermetadata->searchTerm = $searchTerm;
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		
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
	
		$this->dinermetadata->searchTerm = $searchTermParsed;
		
		$rangeArray = explode(',', $range);

		if (count($rangeArray)==0) {
			switch ($rangeArray[0]) {
				case "15":
					$matchConditions = "AND TotalFrames < 1014300 ";
					//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "30":
					$matchConditions = "AND TotalFrames >= 970200 AND TotalFrames <= 1675800 ";
					//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "45":
					$matchConditions = "AND TotalFrames >= 1675800 AND TotalFrames <= 2425500 ";
					//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "60":
					$matchConditions = "AND TotalFrames >= 2205000 AND TotalFrames <= 3528000 ";
					//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "90":
					$matchConditions = "AND TotalFrames >= 3307500 AND TotalFrames <= 4851000 ";
					//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
					break;
				case "120":
					$matchConditions = "AND TotalFrames >= 4630500 ";
					//$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
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

		$this->dinermetadataSet = $this->dinermetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions,'diner')->groupBy('TrackTitle ORDER BY Manufacturer DESC, ' . $sortField . ' ' . $sortDir);

		$this->ok('results');

	}

	/**
	* !Route GET, query/$searchTerm/field/$dinerFieldName
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum/$pageLim
	* */
	function fieldresults($searchTerm, $dinerFieldName, $pageNum=1, $pageLim=25) {
		$this->dinermetadata->searchTerm = $searchTerm;
		$this->dinermetadata->searchTerm = $searchTerm;
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		
		if($dinerFieldName == "trackName") {
			$dinerFieldName = "TrackTitle";
		}
		if ($this->apollo) {
			$this->dinermetadataSet = $this->dinermetadata->like($dinerFieldName, '%' . $searchTerm . '%')->groupBy('TrackTitle ORDER BY Manufacturer DESC, TrackTitle ASC');
		} else {
			// use only to exclude apollo, and comment out previous.
			$this->dinermetadataSet = $this->dinermetadata->like($dinerFieldName, '%' . $searchTerm . '%')->notEqual('Manufacturer','Apollo')->orderBy('TrackTitle ASC');
		}
		
		$this->ok('results');
	}

	/** !Route GET, query/$searchTerm/field/$dinerFieldName/$searchTerm2/field2/$dinerFieldName2 */
	function fieldresults2($searchTerm, $dinerFieldName, $searchTerm2, $dinerFieldName2) {
		$this->dinermetadata->searchTerm = $searchTerm . ', ' . $searchTerm2;

		$this->dinermetadataSet = $this->dinermetadata->like($dinerFieldName, '%' . $searchTerm . '%')->like($dinerFieldName2, '%' . $searchTerm2 . '%')->orderBy('TrackTitle ASC');

		$this->ok('results');

	}

	//////////////////////////////////////
	//
	//
	//		CATEGORIES
	//
	//
	//////////////////////////////////////


	/** !Route GET, categories */
	function categoriesIndex() {
		if ($this->apollo) {	
			$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->groupBy('Category ORDER BY SubCategory DESC, CDTitle ASC');
		} else {
			// use to exclude apollo
			$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notEqual('Manufacturer','Apollo')->groupBy('Category ORDER BY SubCategory DESC, Category ASC');
		}
		
		$this->ok('categories');
	}

	/** !Route GET, categories/specialty */
	function categoriesSpecialty() {
		if ($this->apollo) {
			$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->like('SubCategory', '%album%')->groupBy('Category ORDER BY SubCategory DESC, Category ASC');
		} else {
			//exclude apollo
			$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->like('SubCategory', '%album%')->notEqual('Manufacturer','Apollo')->groupBy('Category ORDER BY Manufacturer DESC, SubCategory DESC, Category ASC');
		}
		
		$this->ok('categories');

	}
	
	/** !Route GET, categories/normal */
	function categoriesNormal() {
		if ($this->apollo) {
			$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notLike('SubCategory', '%album%')->groupBy('Category ORDER BY SubCategory DESC, Category ASC');
		} else {
			//exclude apollo
			$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notLike('SubCategory', '%album%')->notEqual('Manufacturer','Apollo')->groupBy('Category ORDER BY Manufacturer DESC, SubCategory DESC, Category ASC');
		}

		$this->ok('categories');
	} 

	/**
	* !Route GET, categories/$CDTitle
	* !Route GET, categories/$CDTitle/$pageNum
	* !Route GET, categories/$CDTitle/$pageNum/$pageLim
	* !Route GET, categories/$CDTitle/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function categoriesBrowse($CDTitle, $pageNum=1, $pageLim=25, $sortField='RecID', $sortDir='ASC') {
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;

		$this->dinermetadata->searchTerm = $CDTitle;
		if ($this->apollo) {
			$this->dinermetadataSet = $this->dinermetadata->equal('Category',$CDTitle)->orderBy('Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
		} else {
			//use to exclude apollo
			$this->dinermetadataSet = $this->dinermetadata->equal('Category',$CDTitle)->notEqual('Manufacturer','Apollo')->orderBy($sortField . ' ' . $sortDir);
		}
		$this->ok('results');
	}
	
	/**
	* !Route GET, categories/$CDTitle/timerange/$range
	* !Route GET, categories/$CDTitle/timerange/$range/$pageNum
	* !Route GET, categories/$CDTitle/timerange/$range/$pageNum/$pageLim
	* !Route GET, categories/$CDTitle/timerange/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function categoriesBrowseRange($CDTitle, $range, $pageNum=1, $pageLim=25, $sortField='RecID', $sortDir='ASC') {
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		
		$this->dinermetadata->searchTerm = $CDTitle;

		$rangeArray = explode(',', $range);
		
		$matchConditions='';

		if (count($rangeArray)==0) {
			switch ($rangeArray[0]) {
				case "15":
					$matchConditions = " AND TotalFrames < 1014300";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "30":
					$matchConditions = " AND TotalFrames >= 970200 AND TotalFrames <= 1675800";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "45":
					$matchConditions = " AND TotalFrames >= 1675800 AND TotalFrames <= 2425500";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "60":
					$matchConditions = " AND TotalFrames >= 2205000 AND TotalFrames <= 3528000";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "90":
					$matchConditions = " AND TotalFrames >= 3307500 AND TotalFrames <= 4851000";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "120":
					$matchConditions = " AND TotalFrames >= 4630500";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
			}
		} else {
		
			$matchConditions = " AND (";

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
					$matchConditions .= ")";
				} else {
					$matchConditions .= " OR ";
				}	
			
			}
			
		}

		if (!$this->apollo) {
			// use only to exclude apollo
			$matchConditions .= "AND Manufacturer != 'Apollo' ";
		}

		$this->dinermetadataSet = $this->dinermetadata->equal('Category',$CDTitle)->dinerWhereAdditions($matchConditions)->orderBy('Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
		$this->ok('results');
	}


	//////////////////////////////////////
	//
	//
	//		ALBUMS
	//
	//
	//////////////////////////////////////

	/**
	* !Route GET, albums
	* !Route GET, albums/$type
	* !Route GET, albums/$type/$pageNum
	* */
	function albumsIndex($type='all',$pageNum=1) {
		if(is_numeric($type)) {
			$pageNum = $type;
			$type = 'all';
		}
		$this->pageNumber = $pageNum;
		$this->type = $type;
		switch($type) {
			case 'all':
				$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->groupBy("CDTitle ORDER BY FIELD(Manufacturer,'Diner','Mode','Gega','Apollo','Skumba'), CDTitle ASC");
				break;
			case 'normal':
				$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notLike('SubCategory', '%album%')->groupBy("CDTitle ORDER BY FIELD(Manufacturer,'Diner','Mode','Gega','Apollo','Skumba'), CDTitle ASC");
				break;
			case 'specialty':
				$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->like('SubCategory', '%album%')->groupBy('CDTitle ORDER BY Manufacturer DESC, SubCategory DESC, CDTitle ASC');
				break;
			default:
				$this->dinermetadataSet = $this->dinermetadata->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->like('Manufacturer', $type)->groupBy("CDTitle ORDER BY CDTitle ASC");
				break;
		}
		$this->ok('albums');
	}
	
	/**
	* !Route GET, albums/$CDTitle
	* !Route GET, albums/$CDTitle/$pageNum
	* !Route GET, albums/$CDTitle/$pageNum/$pageLim
	* !Route GET, albums/$CDTitle/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function albumsBrowse($CDTitle, $pageNum=1, $pageLim=25, $sortField='RecID', $sortDir='ASC') {
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		
		$this->dinermetadata->searchTerm = $CDTitle;
		if ($this->apollo) {
			$this->dinermetadataSet = $this->dinermetadata->equal('CDTitle',$CDTitle)->orderBy('Manufacturer DESC, ' . $sortField . ' ' . $sortDir);
		} else {
			//use to exclude apollo
			$this->dinermetadataSet = $this->dinermetadata->equal('CDTitle',$CDTitle)->notEqual('Manufacturer','Apollo')->orderBy($sortField . ' ' . $sortDir);
		}
		
		$this->ok('results');
	}
	
	/**
	* !Route GET, albums/$CDTitle/timerange/$range
	* !Route GET, albums/$CDTitle/timerange/$range/$pageNum
	* !Route GET, albums/$CDTitle/timerange/$range/$pageNum/$pageLim
	* !Route GET, albums/$CDTitle/timerange/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function albumsBrowseRange($CDTitle, $range, $pageNum=1, $pageLim=25, $sortField='RecID', $sortDir='ASC') {
		$this->dinermetadata->pageNumber = $pageNum;
		$this->dinermetadata->pageLimit = $pageLim;
		
		$this->dinermetadata->searchTerm = $CDTitle;

		$rangeArray = explode(',', $range);
		
		$matchConditions='';

		if (count($rangeArray)==0) {
			switch ($rangeArray[0]) {
				case "15":
					$matchConditions = " AND TotalFrames < 1014300";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "30":
					$matchConditions = " AND TotalFrames >= 970200 AND TotalFrames <= 1675800";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "45":
					$matchConditions = " AND TotalFrames >= 1675800 AND TotalFrames <= 2425500";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "60":
					$matchConditions = " AND TotalFrames >= 2205000 AND TotalFrames <= 3528000";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "90":
					$matchConditions = " AND TotalFrames >= 3307500 AND TotalFrames <= 4851000";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
				case "120":
					$matchConditions = " AND TotalFrames >= 4630500";
					//$this->dinerquerySet = $this->dinerquery->select()->selectAs($searchTermParsed, 'Relevance', true, 'diner')->dinerMatch($searchTermParsed, $matchConditions)->orderBy($sortField . ' ' . $sortDir);
					break;
			}
		} else {
		
			$matchConditions = " AND (";

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
					$matchConditions .= ")";
				} else {
					$matchConditions .= " OR ";
				}	
			
			}
			
		}

		if (!$this->apollo) {
			// use only to exclude apollo
			$matchConditions .= "AND Manufacturer != 'Apollo' ";
		}
		
		$this->dinermetadataSet = $this->dinermetadata->equal('CDTitle',$CDTitle)->dinerWhereAdditions($matchConditions)->orderBy('Manufacturer DESC, ' . $sortField . ' ' . $sortDir);

		$this->ok('results');
	}


	//////////////////////////////////////
	//
	//
	//		ADMINISTRATION
	//
	//
	//////////////////////////////////////

	/** !Route GET, admin/pending */
	function adminPending() {
		$this->dineruploadmetadata = new dineruploadmetadata();
		$this->results = $this->dineruploadmetadata->all();
		$this->ok('adminresults');
	}

	/** !Route POST, admin/update/$longID */
	function adminUpdate($longID) {
		$old = new dineruploadmetadata();
		$old->LongID = $longID;
		if($old->exists()) {
			//$this->dinermetadata = new dinertestmetadata();
			$this->dinermetadata->LongID = $longID;
			if($this->dinermetadata->exists()) {
				$new = $this->dinermetadata;
				foreach ($old as $index=>$val) {
					switch ($index) {
						case 'RecID':
							break;
						case 'Filename':
							$new->Filename = $old->TrackTitle . '.mp3';
							break;
						case 'Pathname':
							$new->Pathname = '/MEDIAPATH/GOES/HERE/media/'.$old->cloudPrefixes()->{$old->Manufacturer}['path'];
							break;
						case 'FileType':
							$new->FileType = 'MP3';
							break;
						case 'CreationDate':
							$new->CreationDate = time();
							break;
						case 'ModificationDate':
							$new->ModificationDate = time();
							break;
						case '_PictureLink':
							break;
						case 'Library':
							$new->Library = str_replace('thediner.tv', 'thedinermusic.com', $old->Library);
							break;
						default:
							if($old->{$index}) {
								$new->{$index} = $old->{$index};
							}
							break;
					}
				}
				$new->save();
				$this->dinermetadata = $new;
			} else {
				$new = new dinermetadata();
				foreach ($old as $index=>$val) {
					switch ($index) {
						case 'RecID':
							break;
						case 'Filename':
							$new->Filename = $old->TrackTitle . '.mp3';
							break;
						case 'Pathname':
							$new->Pathname = '/MEDIAPATH/GOES/HERE/media/'.$old->cloudPrefixes()->{$old->Manufacturer}['path'];
							break;
						case 'FileType':
							$new->FileType = 'MP3';
							break;
						case 'CreationDate':
							$new->CreationDate = time();
							break;
						case 'ModificationDate':
							$new->ModificationDate = time();
							break;
						case '_PictureLink':
							break;
						case 'Library':
							$new->Library = str_replace('thediner.tv', 'thedinermusic.com', $old->Library);
							break;
						case 'SubCategory':
							$new->SubCategory = 'Category';
							break;
						default:
							if($old->{$index}) {
								$new->{$index} = $old->{$index};
							}
							break;
					}
				}
				$new->save();
				$this->dinermetadata = $new;
			}
			$oldart = new dineruploadartwork();
			$newart = new dinerart();
			$oldart->RecID = $old->_PictureLink;
			if($oldart->exists()) {
				$newart->Picture = $oldart->Picture;
				if($newart->exists()) {
					$this->dinermetadata->_PictureLink = $newart->RecID;
					$this->dinermetadata->save();
				} else {
					$newart->hash = sha1( uniqid( rand(), true ) );
					$newart->Picture = $oldart->Picture;
					$newart->save();
					$this->dinermetadata->_PictureLink = $newart->RecID;
					$this->dinermetadata->save();
				}
			}
			$newAsset = new adminassets();
			$newAsset->db_id = 30;
			$newAsset->track_id = $this->dinermetadata->RecID;
			$newAsset->asset_key = MD5(RAND());
			foreach($this->dinermetadata as $key=>$value) {
				$newAsset->{$key} = $value;
			}
			$newAsset->save();
			$this->dinerassets = new dinerassets();
			$this->dinerassets->track_id = $this->dinermetadata->RecID;
			if($this->dinerassets->exists()) {
				$this->dinerassets->asset_key = $newAsset->asset_key;
				$this->dinerassets->save();
			} else {
				$newIntAsset = new dinerassets();
				$newIntAsset->track_id = $this->dinermetadata->RecID;
				$newIntAsset->asset_key = $newAsset->asset_key;
				$newIntAsset->save();
			}
			$oldx = new dineruploadmetadata();
			$oldx->LongID = $longID;
			$oldx->delete();
		}
		//$this->results = $this->dinertestmetadata;
		//$this->ok('adminresults');
		print json_encode($this->dinermetadata);
		exit;

	}

}
?>