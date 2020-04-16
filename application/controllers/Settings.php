<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index(){
		$this->load->view('settings');
	}
	public function editPassword(){
		$this->load->view('editPasswordView');
	}

	public function changePassword(){
		$input = $this->input->post();
		if($input != null){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['password'] = md5($this->input->post('password'));
		$data['passcode'] =  md5($this->input->post('passcode'));
		$url = "http://localhost/PN101/api/settings/changePassword";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			if($httpcode == 401){

			}
		}
	}

	public function editRooms(){
		if($this->input->post('centerid') != null){
		$data['centerid'] = $this->input->post('centerid');
	}else{
		$data['centerid'] = 1;
	}
		$data['centers'] = $this->getAllCenters();
		$data['rooms'] = $this->getAllRooms($data['centerid']);
		$this->load->view('editRoomsView',$data);
	}

	public function updateRoom(){
		$input = $this->input->post();
		if($input != null){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['response'] = $this->input->post('response');
		$data['centerid'] = $this->input->post('centerid');
		$data['name'] = $this->input->post('name');
		$data['careAgeFrom'] = $this->input->post('careAgeFrom');
		$data['careAgeTo'] = $this->input->post('careAgeTo');
		$data['capacity'] = $this->input->post('capacity');
		$data['studentRatio'] = $this->input->post('studentRatio');
		$url = BASE_API_URL."/settings/editRoom";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}
	}

	public function createCenter(){
		$this->load->view('createCenterProfile');
	}

	public function createCenterProfile(){
		$input = $this->input->post();
		if($input != null){
			$data['userid'] = $this->session->userdata('LoginId');
			$data['centerid'] = $this->load->post('centerid');
			$data['addStreet'] = $this->load->post('addStreet');
			$data['addCity'] = $this->load->post('addCity');
			$data['addState'] = $this->load->post('addState');
			$data['addZip'] = $this->load->post('addZip');
			$data['name'] = $this->load->post('name');
			$data['logo'] = $this->load->post('logo');
		$url = BASE_API_URL."/settings/addCenter.";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}			
		}
	}

	public function centerProfile($centerid = 1){
		if($this->input->get('centerid') != null){
			$centerid = $this->input->get('centerid');
		}
		$data['centerid'] = $centerid;
		$data['centers'] = $this->getAllCenters();
		$data['center_profile'] = json_decode($data['centers'])->centers[$centerid-1];
		$this->load->view('editCenterProfile',$data);
	}	

	public function updateCenter(){
		$input = $this->input->post();
		if($input != null){
		$data['addStreet'] = $this->input->post('addStreet');
		$data['addCity'] = $this->input->post('addCity');
		$data['addState'] = $this->input->post('addState');
		$data['addZip'] = $this->input->post('addZip');
		$data['name'] = $this->input->post('name');
		$data['logo'] = $this->input->post('logo');
		$data['centerid'] = $this->input->post('centerid'); 
		$data['userid'] = $this->session->userdata('userid');
		$url = BASE_API_URL."/settings/updateCenter.";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}
	}

	public function orgChart(){
		if($this->input->post('centerid') != null){
		$data['centerid'] = $this->input->post('centerid');
		$data['centerx'] = $data['centerid']-1;
	}else{
		$data['centerid'] = 1;
		$data['centerx'] = 0;
	}
		$data['centers'] = $this->getAllCenters();
		$data['orgChart'] = $this->getOrgChart($data['centerid']);
		$this->load->view('editOrgChartView',$data);
	}


		function getAllCenters(){
		$url = BASE_API_URL."util/getAllCenters/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	public function addArea(){
		$form_data = $this->input->post();
		if($form_data != null){
			$data['centerid'] = $this->input->post('centerid');;
			$data['isRoomYN'] = $this->input->post('isRoomYN');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['areaName'] = $this->input->post('areaName');

 		$url = BASE_API_URL."/settings/addArea";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}

	}
	}
		public function addRole(){
		$form_data = $this->input->post();
		if($form_data != null){
			//$data['centerid'] = $this->input->post('centerid');
			$data['areaid'] = $this->input->post('areaid');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['roleName'] = $this->input->post('roleName');

 		$url = BASE_API_URL."/settings/addRole";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}

	}
	}


		public function UpdateRole(){
		$form_data = $this->input->post();
		if($form_data != null){
			//$data['centerid'] = $this->input->post('centerid');
			$data['roleid'] = $this->input->post('roleid');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['roleName'] = $this->input->post('roleName');

 		$url = BASE_API_URL."/settings/UpdateRole";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}

	}
	}


		public function UpdateArea(){
		$form_data = $this->input->post();
		if($form_data != null){
			//$data['centerid'] = $this->input->post('centerid');
			$data['areaid'] = $this->input->post('areaid');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['areaName'] = $this->input->post('areaName');
			$data['isRoomYN'] = $this->input->post('isRoomYN');

 		$url = BASE_API_URL."/settings/UpdateArea";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}

	}
	}





	function getAllRooms($centerid = 1){
		$url = BASE_API_URL."settings/getRooms/".$centerid."/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}
	function getOrgChart($centerid=1){
		$url = BASE_API_URL."settings/getOrgChart/".$centerid."/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}
	
}
