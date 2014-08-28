<?php
Library::import('station.models.stationplaylists');
Library::import('station.models.stationartwork');
Library::import('station.models.stationplaylistshares');
Library::import('station.models.stationplaylistlogs');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix stationplaylists/
 * !RoutesPrefix playlists/
 */
class stationplaylistsController extends Controller {
	
	/** @var stationplaylists */
	protected $stationplaylists;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->stationplaylists = new stationplaylists();
		$this->stationartwork = new stationartwork();
		$this->stationplaylistshares = new stationplaylistshares();
		$this->user = new adminusers();
		$this->_form = new ModelForm('stationplaylists', $this->request->data('stationplaylists'), $this->stationplaylists);
	}
	
	/**
	* !Route GET
	* !Route GET, page/$pageNum
	* !Route GET, page/$pageNum/limit/$pageLim
	* !Route GET, page/$pageNum/limit/$pageLim/sort/$sortField/$sortDir
	* */
	function index($pageNum=1,$pageLim=25,$sortField="date_created",$sortDir="DESC") {
		$input = $this->getInput();
		$d = $this->digest();
		$this->pageNumber = $pageNum;
		$this->pageLimit = $pageLim;
		$this->stationplaylistsSet = $this->stationplaylists->all()->orderBy($sortField . ' ' . $sortDir);
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $slug */
	function details($slug) {
		$this->stationplaylists->slug = $slug;
		if($this->stationplaylists->exists()) {
			if($_SERVER['HTTP_USER_AGENT'] == 'api-curl') {
				$n = new stationplaylistlogs();
				$n->date_logged = time();
				$n->playlist_id = $this->stationplaylists->id;
				$n->ip = $this->request->headers['HOSTIP'];
				$n->type = 'pageview';
				$n->save();
			}
			return $this->ok('details');
		} else {
			$this->stationplaylistshares->hash = $slug;
			if($this->stationplaylistshares->exists()) {
				$this->stationplaylists->id = $this->stationplaylistshares->playlist_id;
				if($this->stationplaylists->exists()) {
					if($_SERVER['HTTP_USER_AGENT'] == 'api-curl') {
						$this->stationplaylistshares->clicked = 'yes';
						$this->stationplaylistshares->save();
						$n = new stationplaylistlogs();
						$n->date_logged = time();
						$n->share_id = $this->stationplaylistshares->id;
						$n->playlist_id = $this->stationplaylists->id;
						$n->email = $this->stationplaylistshares->to_email;
						$n->ip = $this->request->headers['HOSTIP'];
						$n->type = 'pageview';
						$n->save();
					}
					return $this->ok('details');
				} else {
					return $this->forwardNotFound($this->urlTo('index'));
				}
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}

	/** !Route POST */
	function newPlaylist() {
		$input = $this->getInput();
		$d = $this->digest();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
			
				$n = new stationplaylists();
				$t = time();
				$n->date_created = $t;
				$n->date_modified = $t;
				$n->author = $this->user->email;
				$brand = (!empty($input['brand'])) ? $input['brand'] : 'station';
				$n->brand = $brand;
				$n->save();
				$n->slug = 'playlist-'.$n->id;
				$n->save();
				$this->stationplaylists = $n;
				return $this->ok('details');

			} else {
				print "not authorized";
				exit;
			}
		} else {
			print "not authorized";
			exit;
		}
	}

	/** !Route POST, update/$id */
	function update($id) {
		$input = $this->getInput();
		$d = $this->digest();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
			
				$title = $input['title'];
				$slug = $input['slug'];
				$description = $input['description'];
				$wd_url = $input['wd_url'];
				$brand = (!empty($input['brand'])) ? $input['brand'] : '';
				$state = (!empty($input['state'])) ? $input['state'] : '';
				$downloadable = filter_var($input['downloadable'], FILTER_VALIDATE_BOOLEAN);

				$picName = (!empty($input['picName'])) ? $input['picName'] : 0;

				$this->stationplaylists->id = $id;
				if($this->stationplaylists->exists()) {

					if($this->stationplaylists->slug != $slug ) {
						$n = new stationplaylists();
						$n->slug = $slug;
						if($n->exists() || $slug == 'sort' || $slug == 'limit' || $slug == 'page') {
							print 'exists';
							exit;
						}
					}

					$t = time();

					$this->stationplaylists->title = (!empty($title)) ? $title : $this->stationplaylists->title;
					$this->stationplaylists->slug = (!empty($slug)) ? $slug : $this->stationplaylists->slug;
					$this->stationplaylists->description = (!empty($description)) ? $description : $this->stationplaylists->description;
					$this->stationplaylists->wd_url = (!empty($wd_url)) ? $wd_url : $this->stationplaylists->wd_url;
					$this->stationplaylists->brand = (!empty($brand)) ? $brand : $this->stationplaylists->brand;
					$this->stationplaylists->state = (!empty($state)) ? $state : $this->stationplaylists->state;
					$this->stationplaylists->downloadable = $downloadable;

					if(!empty($picName)) {
						$blob = file_get_contents("/PATH/GOES/HERE/api/uploads/files/".$picName);
						$this->stationartwork->Picture = $blob;
						if($this->stationartwork->exists()) {
							$this->stationplaylists->image_id = $this->stationartwork->RecID;
						} else {
							$a = new stationartwork();
							$a->hash = sha1( uniqid( rand(), true ) );
							$a->Picture = $blob;
							$a->save();
							
							$this->stationplaylists->image_id = $a->RecID;
						}
					}

					$this->stationplaylists->date_modified = $t;
					$this->stationplaylists->save();
					return $this->ok('details');
				} else {
					print 'fail';
					exit;
				}
			
			} else {
				print "not authorized";
				exit;
			}
		} else {
			print "not authorized";
			exit;
		}


	}
	
	/** !Route POST, delete/$id */
	function delete($id) {
		$input = $this->getInput();
		$d = $this->digest();
		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				$p = new stationplaylists();
				$p->id = $id;
				if($p->delete()) {
					$this->pageNumber = 1;
					$this->pageLimit = 0;
					$this->stationplaylistsSet = $this->stationplaylists->all();
					return $this->ok('index');
				} else {
					print 'fail';
					exit;					
				}
		
			} else {
				print "not authorized";
				exit;
			}
		} else {
			print "not authorized";
			exit;
		}
	}
}
?>