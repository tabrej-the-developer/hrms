<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	function __construct() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN,X-DEVICE-TYPE, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
		parent::__construct();
	}

	public function createJob(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('JobsModel');
			$res = $this->JobsModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			//var_dump($res);
			// echo "<pre>";
			// echo $headers['x-device-id'];
            // echo "<br>";
			// echo $headers['x-token'];
			//exit;
			// print_r($res[0]->id);
			// exit;
			$json = json_decode(file_get_contents('php://input'));
			if($json != null && $res != null && $res[0]->id == $json->userid){
				$userid = $json->userid;
				$title = $json->title;
				$platform = $json->flatform;
				$enddate = $json->expirydate;
				$uniqueId = uniqid();
				
				$toAPI = $this->postJob($json);
				$userDetails = $this->JobsModel->getUserDetails($userid);
				if($userDetails != null && $userDetails[0]->role == SUPERADMIN){
					$this->load->model('jobsModel');
					$this->jobsModel->createAdvertisement($title,$userid,$platform,$uniqueId,$enddate);
					$data['Status'] = 'SUCCESS';
					$data['response'] = 200;
					http_response_code(200);
					echo json_encode($data);
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
				// http_response_code(200);
				// echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	//public function getCenters(){}

	 function postJob($data){
		if($data != null){
			//var_dump($form_data);
			$url = "https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				$this->load->model('jobsModel');
				$this->jobsModel->addResponseData($jsonOutput->id,$jsonOutput->expiryDate);
			}
			else if($httpcode == 401){

			}
		}
	}
	//https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement/
	public function getAdvertisement($advertisementId){
		if($data != null){
			//var_dump($form_data);
			$url = "https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement/".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			);
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

		public function getAdvertisementByUser($advertiserId){
		if($data != null){
			//var_dump($form_data);
			$url = "https://adposting-integration.cloud.seek.com.au/advertisement?advertiserId=".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			);
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}
	public function getjobs(){
        $headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id',$headers) && array_key_exists('x-token',$headers)){
		$this->load->model('JobsModel');
		$result = $this->JobsModel->getJobs();
		$mdata['data'] = [];
		foreach($result as $r){
			$var['id']  = $r->id;
			$var['title'] =  $r->jobTitle;
			$var['platform'] = $r->platform;
			$var['enddate'] = $r->expiryDate;
			array_push($mdata['data'],$var);
		 }
		 http_response_code(200);
		 echo json_encode($mdata);
		     

		}
		else{
			$data['error'] = 'Sorry Something went wrong';
			http_response_code(401);
            echo json_encode($data);
		}
	}
		public function getData($userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
		$data =  '{
					  "id": "{advertisementId}",
					  "thirdParties": {
					    "advertiserId": "9012",
					    "agentId": "10932"
					  },
					  "advertisementType": "StandOut",
					  "jobTitle": "Exciting Senior Developer role in a great CBD location. Great $$$",
					  "searchJobTitle": "Senior Developer, .NET Core, Scala, Team Leader, Agile Methodologies",
					  "location": {
					    "id": "Melbourne",
					    "areaId": "MelbourneCBDInnerSuburbs"
					  },
					  "subclassificationId": "DevelopersProgrammers",
					  "workType": "FullTime",
					  "salary": {
					    "type": "AnnualPackage",
					    "minimum": 100000,
					    "maximum": 200000,
					    "details": "We will pay you"
					  },
					  "jobSummary": "Developer job",
					  "advertisementDetails": "Exciting, great job to develop stuff that might save the world?",
					  "contact": {
					    "name": "Bindy",
					    "phone": "0431127900",
					    "email": "bindy@auszoo.com"
					  },
					  "video": {
					    "url": "https://www.youtube.com/embed/dVDk7PXNXB8",
					    "position": "Above"
					  },
					  "applicationEmail": "asdf@asdf.com",
					  "applicationFormUrl": "http://apply.com/",
					  "endApplicationUrl": "http://applyFormLocation.com/",
					  "screenId": 20,
					  "jobReference": "JOB1234",
					  "agentJobReference": "AGENTJOB1234",
					  "template": {
					    "id": 99,
					    "items": [
					      {
						"name": "Template Line 1",
						"value": "Template Value 1"
					      },
					      {
						"name": "Template Line 2",
						"value": "Template Value 2"
					      }
					    ]
					  },
					  "standout": {
					    "logoId": 333,
					    "bullets": [
					      "Flexi Hours",
					      "Awesome Location",
					      "Free Parking"
					    ]
					  },
					  "recruiter": {
					    "fullName": "Harry Parker",
					    "email": "a@t.com",
					    "teamName": "Finance"
					  },
					  "additionalProperties": [
					    "ResidentsOnly"
					  ],
					  "expiryDate": "2015-11-06T21:19:00Z",
					  "state": "Open",
					  "_links": {
					    "self": {
					      "href": "/advertisement/{advertisementId}"
					    },
					    "view": {
					      "href": "/advertisement/{advertisementId}/view"
					    }
					  }
					}' ;
				echo $data;
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}

	}
		
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobAdder extends CI_Controller {

	function __construct() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-DEVICE-ID,X-TOKEN, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
		parent::__construct();
	}

	public function CreateJob(){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			$json = json_decode(file_get_contents('php://input'));
			if($json!= null && $res != null && $res->userid == $json->userid){
				$userid = $json->userid;
				$title = $json->title;
				$platform = $json->platform;
				$uniqueId = uniqid();
				$toAPI = $this->postJob($json);
				$userDetails = $this->authModel->getUserDetails($userid);
				if($userDetails != null && $userDetails->role == SUPERADMIN){
					$this->load->model('jobsModel');
					$this->jobsModel->createAdvertisement($title,$userid,$platform,$uniqueId);
					$data['Status'] = 'SUCCESS';
					http_response_code(200);
					echo json_encode($data);
				}
				else{

					$data['Status'] = 'ERROR';
					$data['Message'] = "You are not allowed";
				}
				http_response_code(200);
				echo json_encode($data);
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	//public function getCenters(){}

	 function postJob($data){
		if($data != null){
			//var_dump($form_data);
			$url = "https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				$this->load->model('jobsModel');
				$this->jobsModel->addResponseData($jsonOutput->id,$jsonOutput->expiryDate);
			}
			else if($httpcode == 401){

			}
		}
	}
	//https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement/
	public function getAdvertisement($advertisementId){
		if($data != null){
			//var_dump($form_data);
			$url = "https://private-anon-bfcbbc34bd-adposting.apiary-mock.com/advertisement/".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			));
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

		public function getAdvertisementByUser($advertiserId){
		if($data != null){
			//var_dump($form_data);
			$url = "https://adposting-integration.cloud.seek.com.au/advertisement?advertiserId=".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			));
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

	public function updateAdvertisement($advertisementId,$data){
			$url = "https://adposting-integration.cloud.seek.com.au/advertisement/".$advertisementId;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/vnd.seek.advertisement+json; version=1; charset=utf-8
				 Authorization:Bearer b635a7ea-1361-4cd8-9a07-bc3c12b2cf9e
				 Accept:application/vnd.seek.advertisement+json; version=1; charset=utf-8, application/vnd.seek.advertisement-error+json; version=1; charset=utf-8' )
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				$this->load->model('jobsModel');
				$this->jobsModel->addResponseData($jsonOutput->id,$jsonOutput->expiryDate);
			}
			else if($httpcode == 401){

			}
	}
		
}
