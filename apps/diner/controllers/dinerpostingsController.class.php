<?php
Library::import('diner.models.dinerpostings');
Library::import('diner.models.dinerpostingassets');
Library::import('diner.models.dinerpostingshares');
Library::import('diner.models.dinerpostinglogs');
Library::import('diner.models.dinermetadata');
Library::import('diner.models.dinerart');
Library::import('admin.models.adminusers');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix dinerpostings/
 * !RoutesPrefix postings/
 */
class dinerpostingsController extends Controller {
	
	/** @var dinerpostings */
	protected $dinerpostings;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->dinerpostings = new dinerpostings();
		$this->dinerpostingassets = new dinerpostingassets();
		$this->dinerpostingshares = new dinerpostingshares();
		$this->dinerpostinglogs = new dinerpostinglogs();
		$this->dinermetadata = new dinermetadata();
		$this->dinerart = new dinerart();
		$this->adminusers = new adminusers();
		$this->_form = new ModelForm('dinerpostings', $this->request->data('dinerpostings'), $this->dinerpostings);
	}
	
	/**
	* !Route GET
	* !Route GET, range/$range
	* !Route GET, range/$range/$pageNum
	* !Route GET, range/$range/$pageNum/$pageLim
	* !Route GET, range/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function index($range='active',$pageNum=1,$pageLim=25,$sortField='date_created',$sortDir='DESC') {
		if($range=='active') {
			$this->dinerpostingsSet = $this->dinerpostings->notEqual('state','closed')->orderBy($sortField.' '.$sortDir);
		} else if ($range=='all') {
			$this->dinerpostingsSet = $this->dinerpostings->all()->orderBy('date_created DESC');
		}
		$this->pageNumber = $pageNum;
		$this->pageLimit = $pageLim;
		$this->range = $range;
		$this->sortField = $sortField;
		$this->sortDir = $sortDir;
		if(isset($this->request->get['flash'])) {
			$this->flash = $this->request->get['flash'];
		}
	}
	
	/**
	* !Route GET, query/$term
	* !Route GET, query/$term/$range
	* !Route GET, query/$term/$range/$pageNum
	* !Route GET, query/$term/$range/$pageNum/$pageLim
	* !Route GET, query/$term/$range/$pageNum/$pageLim/$sortField/$sortDir
	* */
	function postingQuery($term, $range='all', $pageNum=1,$pageLim=25,$sortField='date_created',$sortDir='DESC') {
		$u = $this->request->headers['USER'];
		$user = new adminusers();
		$user->key = $u;
		if($user->exists()) {
			if($user->role_id==1) {
				$input = $this->getInput();
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
				$addMYSQL = '';
				if($range != 'all') {
					$addMYSQL = "AND state!='closed'";
				}
				$this->dinerpostingsSet = $this->dinerpostings->select()->dinerMatch($searchTermParsed, $addMYSQL, 'dinerpostings')->orderBy($sortField.' '.$sortDir);
				$this->pageNumber = $pageNum;
				$this->pageLimit = $pageLim;
				$this->sortField = $sortField;
				$this->sortDir = $sortDir;
				$this->term = $term;
				$this->range = $range;
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
	
	/** !Route GET, $slug */
	function getFromSlug($slug) {
		$this->dinerpostings->slug = $slug;
		$d = $this->digest();
		if($this->dinerpostings->exists()) {
			$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
			$this->dinerpostings->postingCount = count($this->dinerpostings->postingAssets);
			if($_SERVER['HTTP_USER_AGENT'] == 'api-curl' && $this->request->headers['HOSTIP'] != '38.96.145.226') {
				$n = new dinerpostinglogs();
				$n->date_logged = time();
				$n->src = $d['username'];
				$n->posting_account = $this->dinerpostings->slug;
				$n->posting_id = $this->dinerpostings->id;
				$n->ip = $this->request->headers['HOSTIP'];
				$n->type = 'login';
				$n->save();
			}
			return $this->ok('details');
		} else {
			$this->dinerpostingshares->hash = $slug;
			if($this->dinerpostingshares->exists()) {
				$this->dinerpostings->id = $this->dinerpostingshares->posting_id;
				if($this->dinerpostings->exists()) {
					if($_SERVER['HTTP_USER_AGENT'] == 'api-curl' && $this->request->headers['HOSTIP'] != '38.96.145.226') {
						$this->dinerpostingshares->clicked = 'yes';
						$this->dinerpostingshares->save();
						$n = new dinerpostinglogs();
						$n->date_logged = time();
						$n->src = $d['username'];
						$n->posting_account = $this->dinerpostings->slug;
						$n->share_id = $this->dinerpostingshares->id;
						$n->posting_id = $this->dinerpostings->id;
						$n->email = $this->dinerpostingshares->to_email;
						$n->ip = $this->request->headers['HOSTIP'];
						$n->type = 'login';
						$n->save();
					}
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
					$this->dinerpostings->postingCount = count($this->dinerpostings->postingAssets);
					return $this->ok('details');
				} else {
					print 'fail';
					exit;
				}
			} else {
				print 'fail';
				exit;
			}
		}
	}
	
	/** !Route POST, $slug */
	function update($slug) {
	
		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				$this->dinerpostings->id = $slug;
				
				$name = isset($input['name']) ? $input['name'] : false;
				$s = isset($input['slug']) ? $input['slug'] : false;
				$description = isset($input['description']) ? $input['description'] : false;
				$notes = isset($input['notes']) ? $input['notes'] : false;
				$state = isset($input['state']) ? $input['state'] : false;

				//$description = ($description!='(empty)') ? $description : '';
				//$notes = ($notes!='(empty)') ? $notes : '';
				
				$picName = isset($input['pic_name']) ? urldecode($input['pic_name']) : false;
				
				if($this->dinerpostings->exists()) {
				
					if($this->dinerpostings->slug != $s && $state != 'closed' ) {
						$n = new dinerpostings();
						$nGroup = $n->equal('slug',$s);
						foreach($nGroup as $val) {
							if($val->state != 'closed') {
								print 'exists';
								exit;
							}
						}
					}
				
					$this->dinerpostings->name = $name ? $name : $this->dinerpostings->name;
					$this->dinerpostings->slug = $s ? $s : $this->dinerpostings->slug;
					$this->dinerpostings->description = $description ? $description : $this->dinerpostings->description;
					$this->dinerpostings->description = ($description!='(empty)') ? $description : '';
					$this->dinerpostings->notes = $notes ? $notes : $this->dinerpostings->notes;
					$this->dinerpostings->notes = ($notes!='(empty)') ? $notes : '';
					$this->dinerpostings->state = $state ? $state : $this->dinerpostings->state;
					
					if($picName) {
						if($picName != 'null') {
							$blob = file_get_contents("/PATH/GOES/HERE/api/uploads/files/".$picName);
							$this->dinerart->Picture = $blob;
							if($this->dinerart->exists()) {
								$this->dinerpostings->artwork = $this->dinerart->RecID;
							} else {
								$a = new dinerart();
								$a->hash = sha1( uniqid( rand(), true ) );
								$a->Picture = $blob;
								$a->save();
								
								$this->dinerpostings->artwork = $a->RecID;
							}
						} else {
							$this->dinerpostings->artwork = 0;
						}
					}
					
					$this->dinerpostings->date_modified=time();
					$this->dinerpostings->save();
					
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
					$this->dinerpostings->postingCount = count($this->dinerpostings->postingAssets);
					
					return $this->ok('details');
				} else {
					print 'fail - not exist';
					exit;
				}
			} else {
				print 'fail - not auth';
				exit;
			}
		} else {
			print 'fail - not valid user';
			exit;
		}


	
	}
	
	/**
	* !Route POST, new */
	function newPosting() {

		$input = $this->getInput();
/*
		$name = $input['name'];
		$slug = $input['slug'];
*/
		if(!empty($input['slug'])) {
			$n = new dinerpostings();
			$nGroup = $n->equal('slug',$input['slug']);
			foreach($nGroup as $val) {
				if($val->state != 'closed') {
					print 'exists';
					exit;
				}
			}
		}

		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				$s = new dinerpostings();
				$t = time();
				$s->date_created = $t;
				$s->date_modified = $t;
				$s->state = 'draft';
				$s->save();
				$s->name = (!empty($input['name'])) ? $input['name'] : 'posting-'.$s->id;
				$s->slug = (!empty($input['slug'])) ? $input['slug'] : $s->id;
				//$s->slug = $s->id;
				//$s->name = 'sampler-'.$s->id;
				$s->save();
				$this->dinerpostings->id = $s->id;
				if($this->dinerpostings->exists()) {
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
					return $this->ok('details');
				} else {
					print 'fail-not created';
					exit;
				}
			} else {
				print 'fail-not admin';
				exit;
			}
		} else {
			print 'fail-user doesn\'t exist';
			exit;
		}
	}
	
	/** !Route POST, $id/add */
	function addTracks($id) {

		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				$this->dinerpostings->id = $id;
				if($this->dinerpostings->exists()) {
					$length = count($this->dinerpostings->posting_assets());
					$num = $length;
					$asset = $input['track'];
					$check = $this->dinerpostings->posting_assets();
					foreach($check as $index=>$val) {
						if ($val->longID==$asset) {
							$this->dinerpostings->duplicate=true;
							$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
							return $this->ok('details');
						}
					}
					//foreach($input as $asset) {
						
						$this->dinermetadata->LongID = $asset;
						if($this->dinermetadata->exists()) {
					
							$t = new dinerpostingassets();
							$t->posting_id = $id;
							$t->order_position = $length;
							$t->longID = $this->dinermetadata->LongID;
							$t->track_id = $this->dinermetadata->RecID;
							$t->save();
							$length++;
							
						} else {
							print 'fail - no track';
							exit;
						}
					//}
					$this->dinerpostings->order=$num;
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
					return $this->ok('details');
				} else {
					print 'fail - no posting';
					exit;
				}
			} else {
				print 'fail - no auth';
				exit;
			}
		} else {
			print 'fail - no user';
			exit;
		}
	}
	
	/** !Route POST, $id/add/new */
	function addNew($id) {
		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				$this->dinerpostings->id = $id;
				if($this->dinerpostings->exists()) {
					$length = count($this->dinerpostings->posting_assets());
					$tArray = array();
					$asset = $input['file'];
					
					//foreach($input as $asset) {
						if(file_exists('/var/www/vhosts/thedinermusic.com/httpdocs/api/uploads/files/'.$asset)) {
							$t = new dinerpostingassets();
							$t->posting_id = $id;
							$t->longID = 'unsigned-'.substr(sha1($asset),0,7);
							$t->order_position = $length;
							$t->filename = $asset;
							$t->filepath = 'uploads/files/'.$asset;
							$t->title = substr($asset,0,-4);
							
							$t->save();
							array_push($tArray, $t);
							$length++;
						} else {
							print 'fail - no file - '.$asset;
							exit;
						}
					//}
					//$this->dinerpostings->samplerAssets = $this->dinerpostings->getMetaData();
					//print json_encode($tArray);
					//exit;
					//$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
					//$this->dinerpostings->postingCount = 1;
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('id',$t->id);
					$this->dinerpostings->postingCount = 1;
					return $this->ok('details');				
				} else {
					print 'fail - no posting';
					exit;
				}
			} else {
				print 'fail - not auth';
				exit;
			}
		} else {
			print 'fail - no user';
			exit;
		}
	}
	
	/** !Route POST, $id/remove */
	function removeTracks($id) {

		$input = $this->getInput();
		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				$this->dinerpostings->id = $id;
				if($this->dinerpostings->exists()) {
			
					$trackset = $this->dinerpostingassets->equal('posting_id',$id)->orderBy('order_position','ASC');

					$newIndexArray = array();
					$i=0;
		
					foreach($trackset as $track) {
						if(in_array($track->longID, $input)) {
							$track->delete();
							//print "removed".$track->ndx;
						} else {
							$track->order_position = $i;
							$track->save();
							$i++;
						}
					}
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
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
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				
				$tracks = $this->dinerpostingassets->equal('posting_id',$id)->orderBy('order_position','ASC');
			
				foreach($tracks as $key=>$val) {
					$val->order_position = $input[$key];
					$val->save();
				}
				$this->dinerpostings->id = $id;
				if($this->dinerpostings->exists()) {
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
					return $this->ok('details');
				} else {
					print 'fail - posting not exist';
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
	
	/** !Route POST, $id/duplicate */
	function duplicatePosting($id) {
	
		$input = $this->getInput();

		$key = $this->request->headers['USER'];
		$this->adminusers->key = $key;
		if($this->adminusers->exists()) {
			if($this->adminusers->role_id == 1) {
				
				$this->dinerpostings->id = $id;
				if($this->dinerpostings->exists()) {
					$s = new dinerpostings();
					$t = time();
					$s->date_created = $t;
					$s->date_modified = $t;
					$s->state = 'draft';
					$s->save();
					$s->name = (!empty($input['name'])) ? $input['name'] : $this->dinerpostings->name . ' (Copy)';
					$s->slug = (!empty($input['slug'])) ? $input['slug'] : $this->dinerpostings->slug . '-duplicate-' . $s->id;
					$s->notes = $this->dinerpostings->notes;
					//$s->slug = $s->id;
					//$s->name = 'sampler-'.$s->id;
					$s->save();
					$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id);
					foreach($this->dinerpostings->postingAssets as $index=>$val) {
						$n = new dinerpostingassets();
						$n->posting_id = $s->id;
						$n->track_id = $val->track_id;
						$n->longID = $val->longID;
						$n->order_position = $val->order_position;
						$n->filename = $val->filename;
						$n->filepath = $val->filepath;
						$n->title = $val->title;
						$n->save();
					}

					$this->dinerpostings->id = $s->id;
					if($this->dinerpostings->exists()) {
						$this->dinerpostings->postingAssets = $this->dinerpostingassets->equal('posting_id',$this->dinerpostings->id)->leftOuterJoin('THE_DINER_2.metadata','posting_assets.longID','metadata.LongID')->orderBy('order_position ASC');
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