<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

	
	public  function __construct(){

		parent:: __construct();
		$this->load->model('api_mdl');
        $this->module="api";

		
	}

	//get the form post data function
	public function get_post_data(){
		$post_data = $this->input->post();

		//print_r($post_data);
		return $post_data;
	}

}
