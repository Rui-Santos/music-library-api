<?php
Library::import('admin.models.admincartitems');
Library::import('admin.models.adminusers');
Library::import('admin.models.adminplaylists');
Library::import('admin.models.admintracks');
Library::import('admin.models.adminassets');
Library::import('admin.models.adminlogs');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix admincartitems/
 * !RoutesPrefix cart/
 */
class admincartitemsController extends Controller {
	
	/** @var admincartitems */
	protected $admincartitems;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->admincartitems = new admincartitems();
		$this->user = new adminusers();
		$this->playlists = new adminplaylists();
		$this->tracks = new admintracks();
		$this->assets = new adminassets();
		$this->_form = new ModelForm('admincartitems', $this->request->data('admincartitems'), $this->admincartitems);
	}
	
	/** 
	* !Route GET, user/$id
	* !Route GET, user/$id/$pageNum
	* !Route GET, user/$id/$pageNum/$pageLim
	* */
	function getUserCart($id, $pageNum=1, $pageLim=25) {
/*
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
*/
		$this->user->id = $id;
		if ($this->user->exists()) {
			$this->pageNum = $pageNum;
			$this->pageLim = $pageLim;
			$this->cartSet = $this->admincartitems->equal('user_id', $this->user->id);
			$this->ok('details');
		}
	}
	
	/** 
	* !Route GET
	* !Route GET, $pageNum
	* !Route GET, $pageNum/$pageLim
	* */
	function getCart($pageNum=1, $pageLim=25) {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		//$this->user->id = $id;
		if ($this->user->exists()) {
			$this->pageNum = $pageNum;
			$this->pageLim = $pageLim;
			$this->cartSet = $this->admincartitems->equal('user_id', $this->user->id);
			$this->ok('details');
		}
	}
	
	/** !Route POST */
	function addToCart() {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		if ($this->user->exists()) {
		
			$c = new admincartitems();
			$c->user_id = $this->user->id;
			$c->type = $this->request->post['type'];
			$c->date = time();
			$c->price = floatval($this->request->post['price']);
			
			$d = $this->digest();
			if ($d['username'] == 'apitester') {
				$c->source = 'diner';
			} else {
				$c->source = $d['username'];
			}
			
			if(isset($this->request->post['asset_id'])) {
				$k = $this->request->post['asset_id'];
				$this->assets->asset_key = $k;
				if($this->assets->exists()) {
					$c->asset_id = $this->assets->id;
				}
			}
			if(isset($this->request->post['item_id'])) {
				$c->item_id = $this->request->post['item_id'];
			}
						
			$c->save();
			
			$this->pageNum = 1;
			$this->pageLim = 25;
			$this->cartSet = $this->admincartitems->equal('user_id', $this->user->id);
			$this->ok('details');
			
		} else {
			print 'user does not exist';
			exit;
		}
		
	}
	
	/** !Route POST, delete */
	function deleteFromCart() {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		if ($this->user->exists()) {
		
			$cArray = explode(',', $this->request->post['t']);
			foreach($cArray as $val) {
			
				$c = new admincartitems();
				$c->id = $val;
				$c->delete();
			
			}
			
			$this->pageNum = 1;
			$this->pageLim = 25;
			$this->cartSet = $this->admincartitems->equal('user_id', $this->user->id);
			
			$this->ok('details');
		
		} else {
			print 'user does not exist';
			exit;
		}
		
	}
	
	/** !Route POST, empty */
	function emptyCart() {
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		if ($this->user->exists()) {
		
			$cartSet = $this->admincartitems->equal('user_id',$this->user->id);
			foreach($cartSet as $c) {
				if($c->delete()) {
					print 'success';
				}
			}
			exit;
		
		} else {
			print 'user does not exist';
			exit;
		}
		
	}
	
	/** !Route GET, total */
	function cartTotal(){
		$u = $this->request->headers['USER'];
		$this->user->key = $u;
		$price = 0;
		$status = '';
		if ($this->user->exists()) {
			$this->cartSet = $this->admincartitems->equal('user_id', $this->user->id);
			foreach($this->cartSet as $key => $c) {
				if($key == 0) {
					$status = $c->type;
					$price .= floatval($c->price);
				} else {
					if($c->type == $status) {
						$price .= floatval($c->price);
					} elseif($status == 'asset') {
						$price = floatval($c->price);
						$status = 'mixed';
					} else {
						$price .= floatval($c->price);
						$status = 'mixed';
					}
				}
			}
			
			print $price*100;
			exit;
		
		} else {
			print 'user does not exist';
			exit;
		}
		
	}
	
	/** !Route GET, set-cart-items */
	function setCartItems(){
	
		$p = $this->playlists->equal('type','cart');
		foreach($p as $pl) {
		
			$i = $pl->id;
			
			$tMod = new admintracks();
			$tSet = $tMod->equal('playlist_id',$i);
			if (count($tSet)>0) {
			
				$u = new adminusers();
				$u->folder_id = $pl->folder_id;
				if($u->exists()) {
				
					foreach($tSet as $t) {
					
						$c = new admincartitems();
						$c->user_id = $u->id;
						$c->asset_id = $t->asset_id;
						$c->price = floatval($t->assets()->Notes);
						$c->date = time();
						$c->save();
					
					}
				
				}
			
			}
		
		}
		print 'success';	
		exit;
	}

}
?>