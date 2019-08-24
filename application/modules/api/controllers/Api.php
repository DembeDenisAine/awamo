<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

	
	public  function __construct(){

		parent:: __construct();
		$this->load->model('api_mdl');
        $this->module="api";

        //Api URL resource
        $this->API_URL = "http://api.mathjs.org/v4/";
		
	}

	//get the form post data function
	public function get_post_data(){
		$post_data = $this->input->post();

		//print_r($post_data);
		//return $post_data;

		//assign variables to each of the post data
		$num1 = $post_data['num1'];
		$num2 = $post_data['num2'];
		$opr = $post_data['operand'];

		//send data to api_post function
		$this->awamo_mathjs_api_post($num1, $num2, $opr);
	}


	//Api post data function
	public function awamo_mathjs_api_post($num1=false, $num2=false, $opr=false){

		//obtain an expression from post data
		$expr = $num1 .$opr. $num2;
		
		//have data into array, 
		$post_request_data= array("expr"=> $expr);

		//then into json object
		$final_post_data=json_encode($post_request_data);


		//the resource: api url
		$resource_Url = $this->API_URL;

	}






}
