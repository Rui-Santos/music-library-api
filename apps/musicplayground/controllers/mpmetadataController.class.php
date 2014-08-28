<?php
Library::import('musicplayground.models.mpmetadata');
Library::import('musicplayground.models.mpassets');
Library::import('musicplayground.models.mpallassets');
Library::import('musicplayground.models.mpsamplerassets');
Library::import('musicplayground.models.mpartistinfo');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpmetadata/
 * !RoutesPrefix metadata/
 */
class mpmetadataController extends Controller {
	
	/** @var mpmetadata */
	protected $mpmetadata;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpmetadata = new mpmetadata();
		$this->mpassets = new mpassets();
		$this->mpallassets = new mpallassets();
		$this->mpsamplerassets = new mpsamplerassets();
		$this->_form = new ModelForm('mpmetadata', $this->request->data('mpmetadata'), $this->mpmetadata);
	}
	
	/** 
	* !Route GET 
	* !Route GET, $pageNum
	* !Route GET, $pageNum/$pageLim
	* !Route GET, $pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($pageNum=1, $pageLim=25, $sortField="Library", $sortDir="ASC") {
		$this->mpmetadataSet = $this->mpmetadata->all()->orderBy($sortField . ' ' . $sortDir);
		$this->mpmetadata->searchTerm = '*';
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;
		$this->ok('results');
	}
	
	/**
	* !Route GET, query/$searchTerm
	* !Route GET, query/$searchTerm/$pageNum
	* !Route GET, query/$searchTerm/$pageNum/$pageLim
	* !Route GET, query/$searchTerm/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function results($searchTerm, $pageNum=1, $pageLim=25, $sortField="FLOOR(Relevance)", $sortDir="DESC") {
	
	    switch($sortField) {
    	    case 'Relevance':
			 $sortField = 'FLOOR(Relevance)';
			 break;
			case 'Library':
			case 'CDTitle':
			 $sortField = "LTRIM(Replace(".$sortField.", 'The ', ''))";
			 break;
	    }
/*
		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
*/
	
		$this->mpmetadata->searchTerm = $searchTerm;
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;
		
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
	
		$this->mpmetadata->searchTerm = $searchTermParsed;

		//$this->mpmetadataSet = $this->mpmetadata->select()->dinerMatch($searchTermParsed, null)->orderBy($sortField . ' ' . $sortDir);
		$this->mpmetadataSet = $this->mpmetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'musicplayground')->dinerMatch($searchTermParsed, "AND Version='ORIGINAL'",'musicplayground')->orderBy($sortField . ' ' . $sortDir);
		
		//$this->doLog('search',array('query'=>$searchTerm,'results'=>count($this->mpmetadataSet),'database'=>'THE_MUSIC_PLAYGROUND'));
		
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}

	/**
	* !Route GET, query/$searchTerm/field/$dinerFieldName
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum/$pageLim
	* !Route GET, query/$searchTerm/field/$dinerFieldName/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function fieldresults($searchTerm, $dinerFieldName, $pageNum=1, $pageLim=25, $sortField="Relevance", $sortDir="DESC") {

		if($sortField == 'Relevance') {
			$sortField = 'FLOOR(Relevance)';
		}
	
		$this->mpmetadata->searchTerm = $searchTerm;
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;
		
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
	
		$this->mpmetadata->searchTerm = $searchTermParsed;

		if($dinerFieldName == "trackName") {
			$dinerFieldName = "TrackTitle";
		}
		$this->mpmetadataSet = $this->mpmetadata->select()->selectAs($searchTermParsed, 'Relevance', true, 'musicplayground')->like($dinerFieldName, '%' . $searchTerm . '%')->equal('Version','ORIGINAL')->orderBy($sortField . ' ' . $sortDir);
		$this->ok('results');
	}

	/**
	* !Route GET, query/versions/$shortID
	* !Route GET, query/versions/$shortID/$longID
	* */
	function queryVersions($shortID,$longID=false) {
    	
		$this->mpmetadata->searchTerm = $shortID;
		$this->mpmetadata->pageNumber = 1;
		$this->mpmetadata->pageLimit = 0;
		
    	$this->mpmetadataSet = $this->mpmetadata->equal('ShortID',$shortID)->notEqual('LongID',$shortID);
		$this->ok('results');
    	
	}

	/** 
	* !Route GET, query/path/$file_hash
	* !Route GET, query/path/$file_hash/$type
	* */
	function queryPath($file_hash, $type='http') {
	   
	    $this->mpallassets->file_hash=$file_hash;
        if(substr($file_hash,0,8)!='unsigned') {
            if($this->mpallassets->exists()) {
        	    
    	    	$r = $this->mpallassets->metadata()->first();
    	    	  switch($type) {
    	    	    case 'streaming':
    	    	       print 'http://3fe53bbd7b947c5383b3-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.stream.cf1.rackcdn.com/'.$r->Filename;
    	    	       break;
    	    	    case 'https':
    	    	       print 'https://288763349e1d9895c284-03bc13b1e76a5a9c9ac4fb771e9b7a23.ssl.cf1.rackcdn.com/'.$r->Filename;
    	    	       break;
    	    	    case 'ios':
    	    	       print 'http://eb24d662ea3d83e9147e-03bc13b1e76a5a9c9ac4fb771e9b7a23.iosr.cf1.rackcdn.com/'.$r->Filename;
    	    	       break;
    	    	    default:
    	        	   print 'http://46df4df5f004e00d1369-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.cf1.rackcdn.com/'.$r->Filename;
    	    	  }	        	   //

    	   }
	    } else {
	    	$r = $this->mpsamplerassets->equal('asset_key',$file_hash)->first();
	    	if($r->exists()) {
	        	print 'https://www.thedinermusic.com/api/'.$r->filepath;
	    	} else {
	        	print false;
	    	}
	    }
	    //s$x = $this->doLog('audition',$this->mpallassets);
	    if($type=='test') {
    	    print_r($x);
	    }

    	
    	exit;
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
	* !Route GET, albums/$pageNum
	* !Route GET, albums/$pageNum/$pageLim
	* */
	function albumsIndex($pageNum=1, $pageLim=25) {
		//$this->mpmetadataSet = $this->mpmetadata->select()->distinct()->dinerField('CDTitle, Library, _PictureLink')->orderBy('Library','ASC');
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;
		$this->mpmetadataSet = $this->mpmetadata->select()->dinerField('CDTitle, CDDescription, Library, _PictureLink, Source')->groupBy("CDTitle ORDER BY LTRIM(Replace(CDTitle, 'The ', '')) ASC");
		$this->ok('albums');
	}
	
	/**
	* !Route GET, album/$CDDescription
	* !Route GET, album/$CDDescription/$pageNum
	* !Route GET, album/$CDDescription/$pageNum/$pageLim
	* !Route GET, album/$CDDescription/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function albumsBrowse($CDDescription, $pageNum=1, $pageLim=25, $sortField='Track, TrackTitle', $sortDir='ASC') {
		$this->mpmetadata->searchTerm = $CDDescription;
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;
		$this->mpmetadataSet = $this->mpmetadata->like('CDDescription',$CDDescription.'%')->equal('Version','ORIGINAL')->orderBy($sortField . ' ' . $sortDir);
		$this->ok('results');
	}

	//////////////////////////////////////
	//
	//
	//		Categories
	//
	//
	//////////////////////////////////////

	/** !Route GET, categories */
	function categoriesIndex() {
		$this->mpmetadataSet = $this->mpmetadata->select()->dinerField('Category')->groupBy('Category ORDER BY Category ASC');
		$this->ok('categories');
	}
	
	/**
	* !Route GET, categories/$Category
	* !Route GET, categories/$Category/$pageNum
	* !Route GET, categories/$Category/$pageNum/$pageLim
	* !Route GET, categories/$Category/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function browse($Category, $pageNum=1, $pageLim=25, $sortField='Relevance', $sortDir='DESC') {
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;

		$this->mpmetadata->searchTerm = $Category;
		//$this->mpmetadataSet = $this->mpmetadata->like('Category','%'.$Category.'%')->orderBy($sortField . ' ' . $sortDir . ', RAND()');
		$this->mpmetadataSet = $this->mpmetadata->select()->selectAs($Category, 'Relevance', true, 'musicplayground')->like('Category','%'.$Category.'%')->orderBy($sortField . ' ' . $sortDir . ', RAND()');
		$this->ok('results');
	}
	
	//////////////////////////////////////
	//
	//
	//		Artists
	//
	//
	//////////////////////////////////////

	/** 
	* !Route GET, artists
	* !Route GET, artists/$pageNum
	* !Route GET, artists/$pageNum/$pageLim
	* !Route GET, artists/$pageNum/$pageLim/$orderBy
	* !Route GET, artists/$pageNum/$pageLim/$orderBy/$sortOrder
	* */
	function artistsIndex($pageNum=1, $pageLim=25, $orderBy='Library', $sortOrder='ASC') {
		$this->mpmetadata->pageNumber = $pageNum;
		$this->mpmetadata->pageLimit = $pageLim;
		
		$orderBy = ($orderBy == 'Library') ? "LTRIM(Replace(Library, 'The ', ''))" : $orderBy;

		$this->mpmetadataSet = $this->mpmetadata->select()->dinerField('Library, Source')->groupBy("Library ORDER BY $orderBy $sortOrder");
	}
	
	/** !Route GET, artist/$artist */
	function artistsBrowse($artist) {
		$artistinfo = new mpartistinfo();
		$this->mpmetadata->artist = $artist;
		$this->mpmetadataSet = $this->mpmetadata->equal('Source',$artist)->equal('Version','ORIGINAL')->orderBy('Rating DESC, CDTitle, Track, TrackTitle ASC ');
		$this->mpmetadata->infoz = "";
		$this->mpmetadata->slug = "";
		$this->mpmetadata->photo = 0;
		$artistinfo->filename = $this->mpmetadataSet->first()->Source;
		if($artistinfo->exists()) {
			$this->mpmetadata->infoz = $artistinfo->bio;
			$this->mpmetadata->slug = $artistinfo->filename;
			$this->mpmetadata->photo = $artistinfo->photo;
		}
	}

	//////////////////////////////////////
	//
	//
	//		Admin
	//
	//
	//////////////////////////////////////
	
	/** !Route GET, filename/$filename */
	function getFromFilename($filename) {
		$this->mpmetadataSet = $this->mpmetadata->equal('Filename',$filename.'.mp3')->limit(1);
		$this->mpmetadata->pageNumber = 1;
		$this->mpmetadata->pageLimit = 0;

		$this->mpmetadata->searchTerm = $filename;

		if(!count($this->mpmetadataSet)) {
			print 'fail';
			exit;
		} else {
			$this->ok('results');			
		}
	}

	/** !Route GET, hash/$hash */
	function getFromHash($hash) {
	
		$this->mpallassets->file_hash = $hash;
		if($this->mpallassets->exists()) {
			$this->mpmetadataSet = $this->mpallassets->metadata();
			$this->mpmetadata->pageNumber = 1;
			$this->mpmetadata->pageLimit = 0;
	
			$this->mpmetadata->searchTerm = $hash;
	
			if(!count($this->mpmetadataSet)) {
				print 'fail';
				exit;
			} else {
				$this->ok('results');			
			}
			
		}
	
	}


}
?>