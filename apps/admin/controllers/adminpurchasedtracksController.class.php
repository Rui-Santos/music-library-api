<?php
Library::import('admin.models.adminpurchasedtracks');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix adminpurchasedtracks/
 * !RoutesPrefix purchased/
 */
class adminpurchasedtracksController extends Controller {
	
	/** @var adminpurchasedtracks */
	protected $adminpurchasedtracks;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->adminpurchasedtracks = new adminpurchasedtracks();
		$this->user = new adminusers;
		$this->_form = new ModelForm('adminpurchasedtracks', $this->request->data('adminpurchasedtracks'), $this->adminpurchasedtracks);
	}
	
	/**
	* !Route GET, user
	* !Route GET, user/$pageNum
	* !Route GET, user/$pageNum/$pageLim
	* */
	function getUserPurchTracks($pageNum=1, $pageLim=25) {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		if ($this->user->exists()) {
			$this->pageNum = $pageNum;
			$this->pageLim = $pageLim;
			$this->purchSet = $this->adminpurchasedtracks->equal('user_id',$this->user->id)->orderBy('created DESC');
			$this->ok('details');
		}
	}

}
?>