<?php
Library::import('musicplayground.models.mpsiteadmin');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix mpsiteadmin/
 * !RoutesPrefix siteadmin/
 */
class mpsiteadminController extends Controller {
	
	/** @var mpsiteadmin */
	protected $mpsiteadmin;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->mpsiteadmin = new mpsiteadmin();
		$this->_form = new ModelForm('mpsiteadmin', $this->request->data('mpsiteadmin'), $this->mpsiteadmin);
	}
	
	/** !Route GET */
	function index() {
		
		$this->mpsiteadminSet = $this->mpsiteadmin->equal('status','active');
	}

	/** !Route POST */
	function update() {
		
		$input = $this->getInput();

		$this->mpsiteadminSet = $this->mpsiteadmin->equal('section',$input['section'])->equal('status','active');
		if(count($this->mpsiteadminSet)>0) {
    		foreach($this->mpsiteadminSet as $val) {
        		$val->status = 'inactive';
        		$val->save();
    		}
		}
		$v = new mpsiteadmin;
		$v->section = $input['section'];
		$v->value = $input['value'];
		$v->status = 'active';
		$v->date_created = time();
		$v->save();
		
		$this->ok('index');
	}

}
?>