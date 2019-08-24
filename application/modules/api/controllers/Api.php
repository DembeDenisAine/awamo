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

	
		//send data to api_post function
		$finalResponse=$this->awamo_mathjs_api_post($post_data);

		echo $finalResponse;

	 }



	//function to recive the POST data from the form
	public function awamo_mathjs_api_post($post_data){

	   //assign variables to each of the post data
		$num1 = $post_data['num1'];
		$num2 = $post_data['num2'];
		$opr = $post_data['operand'];

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

			$apianswer=$response->result;

		    $expected_answer=$this->perform_computation($num1, $num2, $opr);


			$final_answer= $this->validate_api_results($apianswer);


			$status = "No"; //default value for a Pass
			$row_color_class = "redish";


			if ($final_answer == $expected_answer){
				
				$status = "Yes"; //answer meets the expected
				$row_color_class = "yellowish";
			}



			//final data for the user
			$final_data['num1'] = $num1;
			$final_data['num2'] = $num2;
			$final_data['passed'] = $status;
			$final_data['response'] = $final_answer;
			$final_data['row_color'] = $row_color_class;
			$final_data['expected'] = $expected_answer;

			

			return json_encode($final_data);
			
	}


	public function perform_computation($num1, $num2, $opr){

		//string evaluation Class
		include_once('libs/EvalMath.php'); 

        $evalmath = new EvalMath();
		
		$expected_answ = $evalmath->evaluate($num1.$opr.$num2);

		return $expected_answ;
	}


	public function validate_api_results($apianswer){

		//generate a rondom Number
		$generated_roundomNo = mt_rand(0, 9);

		//roud off the generated Number
		$roundOff = round($generated_roundomNo);

		if($roundOff == 1){
			
			$new_rondomNo = mt_rand(0,9); 

			$new_answer = ceil($new_rondomNo * 4000);

			// overide answer
			return $new_answer;

		}

		//return same answe
		return $apianswer;
	}


}
