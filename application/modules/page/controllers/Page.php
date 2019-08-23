<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {

	
	public  function __construct(){

		parent:: __construct();
		$this->load->model('page_mdl');
        $this->module="page";
		
	}


}
