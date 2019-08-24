<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Page is the defualt controller ->>> page/index
class Page extends MX_Controller {

	
	public  function __construct(){

		parent:: __construct();

		//access the page_model
		$this->load->model('page_mdl');

		//the module
        $this->module="page";
		
	}

	//index function that renders the view
	public function index(){

		$data['module']=$this->module;
		$this->load->view('main',$data);
	}

}
