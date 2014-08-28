<?php
Library::import('diner.models.dinercategories');
/* Library::import('playlists.models.assets'); */
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinercategories/
 * !RoutesPrefix categories/
 */
class dinercategoriesController extends Controller {
	
	/** @var dinercategories */
	protected $dinercategories;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinercategories = new dinercategories();
/* 		$this->assets = new assets(); */
		$this->_form = new ModelForm('dinercategories', $this->request->data('dinercategories'), $this->dinercategories);
	}
	
	/** !Route GET */
	function index() {
		$d = $this->digest();
/*
		$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink');
		if(!$this->apollo) {
			$this->dinercategoriesSet = $this->dinercategoriesSet->notEqual('Manufacturer','Apollo');
		}
		if($d['username']=='tunetruck') {
			$this->dinercategoriesSet = $this->dinercategoriesSet->like('Conductor','IH')->like('Conductor','WH');
		}
		
		$this->dinercategoriesSet = $this->dinercategoriesSet->groupBy('CDTitle ORDER BY SubCategory DESC, CDTitle ASC');
*/
		if ($this->apollo) {
			$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->groupBy('Category ORDER BY SubCategory DESC, CDTitle ASC');
		} else {
			//exclude apollo
			$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notEqual('Manufacturer','Apollo')->groupBy('CDTitle ORDER BY SubCategory DESC, CDTitle ASC');
		}

		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
		
	/** !Route GET, specialty */
	function specialty() {
		if ($this->apollo) {
			$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->like('SubCategory', '%album%')->groupBy('Category ORDER BY Manufacturer DESC, SubCategory DESC, Category ASC');
		} else {

			//exclude apollo
			$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->like('SubCategory', '%album%')->notEqual('Manufacturer','Apollo')->groupBy('Category ORDER BY SubCategory DESC, Category ASC');
		}
	
		$this->ok('index');

	}
	
	/** !Route GET, normal */
	function normal() {
		if ($this->apollo) {
			$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notLike('SubCategory', '%album%')->groupBy('Category ORDER BY SubCategory DESC, Category ASC');
		} else {
			//exclude apollo
			$this->dinercategoriesSet = $this->dinercategories->select()->dinerField('CDTitle, Category, SubCategory, _PictureLink')->notLike('SubCategory', '%album%')->notEqual('Manufacturer','Apollo')->groupBy('Category ORDER BY SubCategory DESC, Category ASC');
		}

		$this->ok('index');
	} 

	/**
	* !Route GET, $CDTitle
	* !Route GET, $CDTitle/$pageNum
	* !Route GET, $CDTitle/$pageNum/$pageLim
	* !Route GET, $CDTitle/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browse($CDTitle, $pageNum=1, $pageLim=25, $sortField='Rating', $sortDir='DESC') {

		$d = $this->digest();
		//$d['username']='tunetruck';

		$this->dinercategories->pageNumber = $pageNum;
		$this->dinercategories->pageLimit = $pageLim;

		$this->dinercategories->Category = $CDTitle;
		if ($this->apollo) {
			$this->dinercategoriesSet = $this->dinercategories->equal('Category',$CDTitle)->orderBy($sortField . ' ' . $sortDir);
		} else {
			//use to exclude apollo
			$this->dinercategoriesSet = $this->dinercategories->equal('Category',$CDTitle)->notEqual('Manufacturer','Apollo')->orderBy($sortField . ' ' . $sortDir);
		}
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, $CDTitle/timerange/$range
	* !Route GET, $CDTitle/timerange/$range/$pageNum
	* !Route GET, $CDTitle/timerange/$range/$pageNum/$pageLim
	* !Route GET, $CDTitle/timerange/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browseRange($CDTitle, $range, $pageNum=1, $pageLim=25, $sortField='Rating', $sortDir='DESC') {
		$this->dinercategories->pageNumber = $pageNum;
		$this->dinercategories->pageLimit = $pageLim;
		
		$this->dinercategories->Category = $CDTitle;

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


		$this->dinercategoriesSet = $this->dinercategories->equal('Category',$CDTitle)->dinerWhereAdditions($matchConditions)->orderBy($sortField . ' ' . $sortDir);
		$this->ok('browse');
	}
}
?>