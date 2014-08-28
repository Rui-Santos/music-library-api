<?php
Library::import('musicplayground.models.mpsamplers');
Library::import('musicplayground.models.mpsamplerassets');
Library::import('musicplayground.models.mpart');
Library::import('musicplayground.models.mpassets');
Library::import('musicplayground.models.mpallassets');
Library::import('musicplayground.models.mpsamplershares');
Library::import('admin.models.adminusers');
Library::import('musicplayground.models.mppostinglogs');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpsamplers/
 * !RoutesPrefix samplers/
 */
class mpsamplersController extends Controller {
	
	/** @var mpsamplers */
	protected $mpsamplers;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpsamplers = new mpsamplers();
		$this->mpart = new mpart();
		$this->mpassets = new mpassets();
		$this->mpallassets = new mpallassets();
		$this->mpsamplerassets = new mpsamplerassets();
		$this->mpsamplershares = new mpsamplershares();
		$this->user = new adminusers();
		$this->mppostinglogs = new mppostinglogs();
		$this->_form = new ModelForm('mpsamplers', $this->request->data('mpsamplers'), $this->mpsamplers);
	}
	
	/**
	* !Route GET
	* !Route GET, type/$type
	* !Route GET, type/$type/$pageNum
	* !Route GET, type/$type/$pageNum/$pageLim
	* !Route GET, type/$type/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($type='compilation',$pageNum=1,$pageLim=25,$sortField='date_created',$sortDir='DESC') {
		if($type=='all') {
			$this->mpsamplersSet = $this->mpsamplers->notEqual('state','dead')->orderBy($sortField.' '.$sortDir);
		} else {
			$this->mpsamplersSet = $this->mpsamplers->equal('type',$type)->notEqual('state','dead')->orderBy($sortField.' '.$sortDir);
		}
		$this->pageNumber = $pageNum;
		$this->pageLimit = $pageLim;
		$this->type = $type;
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, query/$term
	* !Route GET, query/$term/$pageNum
	* !Route GET, query/$term/$pageNum/$pageLim
	* !Route GET, query/$term/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function samplerQuery($term, $pageNum=1,$pageLim=25,$sortField='id',$sortDir='ASC') {
		$u = $this->request->headers['USER'];
		$user = new adminusers();
		$user->key = $u;
		if($user->exists()) {
			if($user->role_id==1) {
				$quote = false;
				$quoteArray = explode('"', $term);
				foreach($quoteArray as &$quoteSegment) {
					if($quote){
						$quoteSegment = str_replace(' ', 'brktzspaceztkrb', $quoteSegment);
						$quoteSegment = str_replace("'", "", $quoteSegment);
					}
					$quote = !$quote;
				}
				$searchTermParsed = implode('"', $quoteArray);
			
				$this->searchTerm = $searchTermParsed;
		
				$this->mpsamplersSet = $this->mpsamplers->select()->dinerMatch($searchTermParsed, "", 'mpsamplers')->orderBy($sortField.' '.$sortDir);
				$this->pageNumber = $pageNum;
				$this->pageLimit = $pageLim;
				$this->sortField = $sortField;
				$this->sortDir = $sortDir;
				$this->term = $term;
				$this->ok('index');
			} else {
				print 'fail - not admin';
				exit;
			}
		} else {
			print 'no user';
			exit;
		}
	}
	
	/** !Route GET, $id */
	function details($id) {
		$this->mpsamplers->id = $id;
		$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$id)->orderBy('order_position ASC');
		$this->mpsamplers->samplerCount = count($this->mpsamplers->samplerAssets);
		if($this->mpsamplers->exists()) {
			return $this->ok('details');
		} else {
			return $this->forwardNotFound($this->urlTo('index'));
		}
	}
	
	/** !Route GET, slug/$slug */
	function getFromSlug($slug) {
		$this->mpsamplers->slug = $slug;
		$d = $this->digest();
		if($this->mpsamplers->exists()) {
			$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
			$this->mpsamplers->samplerCount = count($this->mpsamplers->samplerAssets);
			return $this->ok('details');
		} else {
			$this->mpsamplershares->hash = $slug;
			if($this->mpsamplershares->exists()) {
				$this->mpsamplers->id = $this->mpsamplershares->playlist_id;
				if($this->mpsamplers->exists()) {
					if($_SERVER['HTTP_USER_AGENT'] == 'api-curl') {
						$this->mpsamplershares->clicked = 'yes';
						$this->mpsamplershares->save();
						$n = new mppostinglogs();
						$n->date_logged = time();
						$n->src = $d['username'];
						$n->posting_account = $this->mpsamplers->slug;
						$n->share_id = $this->mpsamplershares->id;
						$n->playlist_id = $this->mpsamplers->id;
						$n->email = $this->mpsamplershares->to_email;
						$n->ip = $this->request->headers['HOSTIP'];
						$n->type = 'login';
						$n->save();
					}
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
					$this->mpsamplers->samplerCount = count($this->mpsamplers->samplerAssets);
					return $this->ok('details');
				} else {
					return $this->forwardNotFound($this->urlTo('index'));
				}
			} else {
				return $this->forwardNotFound($this->urlTo('index'));
			}
		}
	}
	
	/** !Route POST, $id */
	function update($id) {
	
		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				$this->mpsamplers->id = $id;
				
				$name = isset($input['name']) ? $input['name'] : false;
				$slug = isset($input['slug']) ? $input['slug'] : false;
				$description = isset($input['description']) ? $input['description'] : false;
				$type = isset($input['type']) ? $input['type'] : false;
				$state = isset($input['state']) ? $input['state'] : false;
				$notes = isset($input['notes']) ? $input['notes'] : false;
				
				$picName = isset($input['picName']) ? $input['picName'] : false;
				
				if($this->mpsamplers->exists()) {
				
					if($this->mpsamplers->slug != $slug && $state != 'dead' ) {
						$n = new mpsamplers();
						$nGroup = $n->equal('slug',$slug);
						foreach($nGroup as $val) {
							if($val->state != 'dead') {
								print 'exists';
								exit;
							}
						}
					}
				
					$this->mpsamplers->name = (!empty($name)) ? $name : $this->mpsamplers->name;
					$this->mpsamplers->slug = (!empty($slug)) ? $slug : $this->mpsamplers->slug;
					$this->mpsamplers->description = (!empty($description)) ? $description : $this->mpsamplers->description;
					$this->mpsamplers->type = (!empty($type)) ? $type : $this->mpsamplers->type;
					$this->mpsamplers->state = (!empty($state)) ? $state : $this->mpsamplers->state;
					$this->mpsamplers->notes = (!empty($notes)) ? $notes : $this->mpsamplers->notes;
					
					if(!empty($picName)) {
						$blob = file_get_contents("/PATH/GOES/HERE/api/uploads/files/".str_replace('%20',' ',$picName));
						$this->mpart->Picture = $blob;
						if($this->mpart->exists()) {
							$this->mpsamplers->artwork = $this->mpart->RecID;
						} else {
							$a = new mpart();
							$a->hash = sha1( uniqid( rand(), true ) );
							$a->Picture = $blob;
							$a->save();
							
							$this->mpsamplers->artwork = $a->RecID;
						}
					}
					
					$this->mpsamplers->date_modified=time();
					$this->mpsamplers->save();
					
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
					
					return $this->ok('details');
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		} else {
			print 'fail';
			exit;
		}


	
	}
	
	/**
	* !Route POST, new
	* !Route POST, new/$type
	* */
	function newSampler($type='compilation') {

		$input = $this->getInput();
/*
		$name = $input['name'];
		$slug = $input['slug'];
*/
		if(!empty($input['slug'])) {
			$n = new mpsamplers();
			$nGroup = $n->equal('slug',$input['slug']);
			foreach($nGroup as $val) {
				if($val->state != 'dead') {
					print 'exists';
					exit;
				}
			}
		}

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				$s = new mpsamplers();
				$t = time();
				$s->date_created = $t;
				$s->date_modified = $t;
				$s->type = $type;
				$s->state = 'draft';
				$s->save();
				$s->name = (!empty($input['name'])) ? $input['name'] : 'sampler-'.$s->id;
				$s->slug = (!empty($input['slug'])) ? $input['slug'] : $s->id;
				//$s->slug = $s->id;
				//$s->name = 'sampler-'.$s->id;
				$s->save();
				$this->mpsamplers->id = $s->id;
				if($this->mpsamplers->exists()) {
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
					return $this->ok('details');
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		} else {
			print 'fail';
			exit;
		}
	}
	
	/** !Route POST, $id/add */
	function addTracks($id) {

		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				$this->mpsamplers->id = $id;
				if($this->mpsamplers->exists()) {
					$length = count($this->mpsamplers->sampler_assets());
					$check = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id);
					foreach($input as $asset) {
						foreach($check as $index=>$val) {
							if ($val->longID==$asset) {
								$this->mpsamplers->duplicate=true;
								$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
								return $this->ok('details');
							}
						}
						
						$this->mpallassets->id = $asset;
						if($this->mpallassets->exists()) {
					
							$t = new mpsamplerassets();
							$t->sampler_id = $id;
							$t->asset_key = $this->mpallassets->asset_key;
							$t->order_position = $length;
							$t->longID = $this->mpallassets->id;
							$t->track_id = $this->mpallassets->track_id;
							$t->file_hash = $this->mpallassets->file_hash;
							$t->save();
							$length++;
							
						} else {
							print 'fail';
							exit;
						}
					}
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
					return $this->ok('details');
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		} else {
			print 'fail';
			exit;
		}
	}
	
	/** !Route POST, $id/add/new */
	function addNew($id) {
		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				$this->mpsamplers->id = $id;
				if($this->mpsamplers->exists()) {
					$length = count($this->mpsamplers->sampler_assets());
					$tArray = array();
					foreach($input as $asset) {
						if(file_exists('/var/www/vhosts/thedinermusic.com/httpdocs/api/uploads/files/'.$asset['filename'])) {
							$t = new mpsamplerassets();
							$t->sampler_id = $id;
							$t->asset_key = 'unsigned-'.substr(sha1($asset['filename']),0,16);
							$t->order_position = $length;
							$t->filename = $asset['filename'];
							$t->filepath = 'uploads/files/'.$asset['filename'];
							$t->artist = $asset['artist'];
							$t->title = $asset['title'];
							
							$t->save();
							array_push($tArray, $t);
							$length++;
						} else {
							print 'no file'.$asset['artist'].' - '.$asset['title'];
							exit;
						}
					}
					//$this->mpsamplers->samplerAssets = $this->mpsamplers->getMetaData();
					//print json_encode($tArray);
					//exit;
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('id',$t->id);
					$this->mpsamplers->samplerCount = 1;
					return $this->ok('details');				
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		} else {
			print 'fail';
			exit;
		}
	}
	
	/** !Route POST, $id/remove */
	function removeTracks($id) {

		$input = $this->getInput();
		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				$this->mpsamplers->id = $id;
				if($this->mpsamplers->exists()) {
			
					$trackset = $this->mpsamplerassets->equal('sampler_id',$id)->orderBy('order_position','ASC');

					$newIndexArray = array();
					$i=0;
		
					foreach($trackset as $track) {
						if(in_array($track->asset_key, $input)) {
							$track->delete();
							//print "removed".$track->ndx;
						} else {
							$track->order_position = $i;
							$track->save();
							$i++;
						}
					}
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
					return $this->ok('details');
		
		//			print_r(count($tracks));
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		} else {
			print 'fail';
			exit;
		}	
	}

	/** !Route POST, $id/order */
	function orderTracks($id) {

		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				
				$tracks = $this->mpsamplerassets->equal('sampler_id',$id)->orderBy('order_position','ASC');
			
				foreach($tracks as $key=>$val) {
					$val->order_position = $input[$key];
					$val->save();
				}
				$this->mpsamplers->id = $id;
				if($this->mpsamplers->exists()) {
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->orderBy('order_position ASC');
					return $this->ok('details');
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		} else {
			print 'fail';
			exit;
		}
	}
				
	/** !Route POST, $id/duplicate */
	function duplicatePosting($id) {
	
		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->user->key = $key;
		if($this->user->exists()) {
			if($this->user->role_id == 1) {
				
				$this->mpsamplers->id = $id;
				if($this->mpsamplers->exists()) {
					$s = new mpsamplers();
					$t = time();
					$s->date_created = $t;
					$s->date_modified = $t;
					$s->type = $this->mpsamplers->type;
					$s->state = 'draft';
					$s->save();
					$s->name = (!empty($input['name'])) ? $input['name'] : $this->mpsamplers->name . ' (Copy)';
					$s->slug = (!empty($input['slug'])) ? $input['slug'] : $this->mpsamplers->slug . '-duplicate-' . $s->id;
					$s->notes = $this->mpsamplers->notes;
					//$s->slug = $s->id;
					//$s->name = 'sampler-'.$s->id;
					$s->save();
					$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id);
					foreach($this->mpsamplers->samplerAssets as $index=>$val) {
						$n = new mpsamplerassets();
						$n->sampler_id = $s->id;
						$n->track_id = $val->track_id;
						$n->longID = $val->longID;
						$n->file_hash = $val->file_hash;
						$n->asset_key = $val->asset_key;
						$n->order_position = $val->order_position;
						$n->filename = $val->filename;
						$n->filepath = $val->filepath;
						$n->title = $val->title;
						$n->artist = $val->artist;
						$n->artist_id = $val->artist_id;
						$n->save();
					}

					$this->mpsamplers->id = $s->id;
					if($this->mpsamplers->exists()) {
						$this->mpsamplers->samplerAssets = $this->mpsamplerassets->equal('sampler_id',$this->mpsamplers->id)->leftOuterJoin('The_Music_Playground.metadata','sampler_assets.longID','metadata.LongID')->orderBy('order_position ASC');
						return $this->ok('details');
					} else {
						print 'fail-not created';
						exit;
					}
				} else {
					print 'fail - no posting';
					exit;
				}

			} else {
				print 'fail - not auth';
				exit;
			}
		} else {
			print 'fail - not user';
			exit;
		}
		
	}
}
?>