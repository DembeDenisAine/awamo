<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

	
	public  function __construct(){

		parent:: __construct();
		$this->load->model('api_mdl');
        $this->module="api";

        $this->API_BASE_URL = "http://api.mathjs.org/v4/";
		
	}

	//function to recive the POST data from the form
	public function get_post_data(){

		$post_data=$this->input->post();

		//print_r($data);

		//assign variables to each of the post data
		$num1 = $post_data['num1'];
		$num2 = $post_data['num2'];
		$opr = $post_data['operand'];


		//send data to api_post function
		$this->awamo_mathjs_api_post($num1, $num2, $opr);

	 }



	//function to recive the POST data from the form
	public function awamo_mathjs_api_post($num1=false, $num2=false, $opr=false){

		//obtain an expression from post data
		$expr = $num1 .$opr. $num2;

		$result_one  = array('num1' => $num1, 'num2' => $num2);
		
		//have data into array, 
		$post_request_data= array("expr"=> $expr);

		//then into json object
		$final_post_data=json_encode($post_request_data);


		//the resource: api url
		$resource_Url = $this->API_BASE_URL;

		//request header
		$request_header = array();
		$request_header[] = 'Method: POST';
		$request_header[] = 'Content-Type: application/json';

		//echo json_encode($request_headers);

			// Initialize cURL session
			$ch = curl_init($resource_Url);

			// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
			// Option to Return the Result, rather than just true/false
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
			// Set Request Headers 
			curl_setopt($ch, CURLOPT_HTTPHEADER, $request_header);

			//time to while waiting for connection...indefinite
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);

			//allow post
			curl_setopt($ch,CURLOPT_POST,1);

			 //post values
            curl_setopt($ch,CURLOPT_POSTFIELDS,$final_post_data);
	

			//set curl time..processing time out
			curl_setopt($ch, CURLOPT_TIMEOUT, 400);

			ini_set("max_execution_time",0);

			// Perform the request, and save content to $result
			$result = curl_exec($ch);
				
				//curl error handling
				$curl_errno = curl_errno($ch);
                $curl_error = curl_error($ch);

                if ($curl_errno > 0) {

                	echo "CURL Error ($curl_errno): $curl_error\n";

                }

			// Close the cURL resource, and free up system resources!
			curl_close($ch);

			$response=json_decode($result);

			$answer=$response->result;

			$result_one['answer']=$answer;

			echo json_encode($result_one);
			


	}



}
