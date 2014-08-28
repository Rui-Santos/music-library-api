<?php
Library::import('musicplayground.models.mpartistinfo');
Library::import('musicplayground.models.mpmetadata');
Library::import('admin.models.adminusers');
Library::import('musicplayground.models.mpart');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpartistinfo/
 * !RoutesPrefix artistinfo/
 */
class mpartistinfoController extends Controller {
	
	/** @var mpartistinfo */
	protected $mpartistinfo;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpartistinfo = new mpartistinfo();
		$this->mpmetadata = new mpmetadata();
		$this->user = new adminusers();
		$this->mpart = new mpart();
		$this->_form = new ModelForm('mpartistinfo', $this->request->data('mpartistinfo'), $this->mpartistinfo);
	}
	
	/** !Route GET */
	function index() {
		$this->mpartistinfoSet = $this->mpartistinfo->all()->orderBy('artist ASC');
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->mpartistinfo->id = $id;
		if($this->mpartistinfo->exists()) {
			return $this->ok('details');
		} else {
			print 'fail';
			exit;
		}
	}
	
	/** !Route GET, slug/$slug */
	function detailsFromSlug($slug) {
		$this->mpartistinfo->filename = $slug;
		if($this->mpartistinfo->exists()) {
			return $this->ok('details');
		} else {
			print 'fail';
			exit;
		}
	}
	
	/** !Route POST */
	function insert() {
		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {

				$a = new mpartistinfo();
				$a->artist = 'new artist';
				$a->save();
				$a->filename = 'artist-'.$a->id;
				$a->save();
				$this->mpartistinfo = $a;
				return $this->ok('details');

			} else {
				print 'not authorized';
				exit;
			}
		} else {
			print 'not authorized';
			exit;
		}

	}
	
	/** !Route POST, update/$id */
	function update($id) {

		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				
				$this->mpartistinfo->id = $id;
				if($this->mpartistinfo->exists()) {
				
					$aTest = new mpartistinfo();
					$aTest->filename = $input['filename'];
					if($aTest->exists()) {
						if($aTest->id != $id) {
							print 'filename-taken';
							exit;
						}
					}
					
					$this->mpartistinfo->artist = (!empty($input['artist'])) ? $input['artist'] : $this->mpartistinfo->artist;
					$this->mpartistinfo->filename = (!empty($input['filename'])) ? $input['filename'] : $this->mpartistinfo->filename;
					$this->mpartistinfo->bio = (!empty($input['bio'])) ? $input['bio'] : $this->mpartistinfo->bio;
					
					if(!empty($input['photo'])) {
						$blob = file_get_contents("/var/www/vhosts/thedinermusic.com/httpdocs/api/uploads/files/".$input['photo']);
						$this->mpart->Picture = $blob;
						if($this->mpart->exists()) {
							$this->mpartistinfo->photo = $this->mpart->RecID;
						} else {
							$a = new mpart();
							$a->hash = sha1( uniqid( rand(), true ) );
							$a->Picture = $blob;
							$a->save();
							
							$this->mpartistinfo->photo = $a->RecID;
						}
					}
					$this->mpartistinfo->save();
					return $this->ok('details');
				} else {
					return 'does-not-exist';
				}
				
			} else {
				print 'not authorized';
				exit;
			}
		} else {
			print 'not authorized';
			exit;
		}
	}
	
	/** !Route POST, remove/$id */
	function remove($id) {

		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				
				$this->mpartistinfo->id = $id;
				if($this->mpartistinfo->delete()) {
    				print 'success';
    				exit;
				} else {
    				print false;
    				exit;
				}
			} else {
				print 'not authorized';
				exit;
			}
		} else {
			print 'not authorized';
			exit;
		}
	}
}
?>