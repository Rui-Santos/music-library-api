<?php
Library::import('musicplayground.models.mpartists');
Library::import('musicplayground.models.mpartistinfo');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpartists/
 * !RoutesPrefix artists/
 */
class mpartistsController extends Controller {
	
	/** @var mpartists */
	protected $mpartists;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpartists = new mpartists();
		$this->_form = new ModelForm('mpartists', $this->request->data('mpartists'), $this->mpartists);
	}
	
	/** !Route GET */
	function index() {
		$this->mpartistsSet = $this->mpartists->select()->dinerField('Library, Source')->groupBy('Library ORDER BY Library ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $artist */
	function browse($artist) {
		$artistinfo = new mpartistinfo();
		$this->mpartists->artist = $artist;
		$this->mpartistsSet = $this->mpartists->equal('Library',$artist)->orderBy('CDTitle, Track, TrackTitle ASC ');
		$this->mpartists->infoz = "";
		$this->mpartists->slug = "";
		$artistinfo->filename = $this->mpartistsSet->first()->Source;
		if($artistinfo->exists()) {
			$this->mpartists->infoz = $artistinfo->bio;
			$this->mpartists->slug = $artistinfo->filename;
		}
	}
	
}
?>