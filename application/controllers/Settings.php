<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

public function index(){
	if($this->session->has_userdata('LoginId')){
		if($this->getAllCenters() != 'error'){
			$this->load->view('settings');
			}
			else{
				$data['error'] = 'error';
				$this->load->view('settings',$data);
			}
		}
	else{
		$this->load->view('redirectToLogin');
	}
}
	public function editPassword(){
		if($this->session->has_userdata('LoginId')){
			$this->load->view('editPasswordView');
				}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function changePassword(){
		$input = $this->input->post();
		if($input != null){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['password'] = $this->input->post('password');
		$data['passcode'] =  $this->input->post('passcode');
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
		if($this->session->has_userdata('LoginId')){
		if($this->input->post('centerid') != null){
		$data['centerid'] = $this->input->post('centerid');
	}else{
		$data['centerid'] = 1;
	}
		$data['centers'] = $this->getAllCenters();
		$data['rooms'] = $this->getAllRooms($data['centerid']);
		$this->load->view('editRoomsView',$data);
			}
	else{
		$this->load->view('redirectToLogin');
	}
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

	public function email(){
		if($this->session->has_userdata('LoginId')){
			$this->load->view('createCenterProfile');
		}
	else{
		$this->load->view('redirectToLogin');
	}
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
		if($this->session->has_userdata('LoginId')){
			if($this->input->get('centerid') != null){
			$centerid = $this->input->get('centerid');
		}
		$data['centerid'] = $centerid;
		$data['centers'] = $this->getAllCenters();
		$data['center_profile'] = json_decode($data['centers'])->centers[$centerid-1];
		$this->load->view('editCenterProfile',$data);
	}
	else{
		$this->load->view('redirectToLogin');
	}
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
		$data['userid'] = $this->session->userdata('LoginId');
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
		if($this->session->has_userdata('LoginId')){
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
	else{
		$this->load->view('redirectToLogin');
	}
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
			return 'error';
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

		public function getOrgCharts($centerid=1){
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
			echo $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	function getAreas($centerid=1){
		$url = BASE_API_URL."settings/getAreas/".$centerid."/".$this->session->userdata('LoginId');
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

	public function deleteRoom(){
		$input = $this->input->post();
		if($input != null){
		$data['id'] = $this->input->post('id'); 
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/settings/deleteRoom/".$data['id']."/".$data['userid'];
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
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

	public function deleteArea(){
		$input = $this->input->post();
		if($input != null){
		$data['id'] = $this->input->post('id'); 
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/settings/deleteRoom/".$data['id']."/".$data['userid'];
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
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
	
	public function deleteRole(){
		$input = $this->input->post();
		if($input != null){
		$data['id'] = $this->input->post('id'); 
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/settings/deleteRoom/".$data['id']."/".$data['userid'];
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
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


	public function viewEntitlements(){
		if($this->session->has_userdata('LoginId')){
			$data['centers'] = $this->getAllCenters();
		$data['userid'] = $this->session->userdata('LoginId');
		$data['entitlements'] = $this->getAllEntitlements($data['userid']);
		$this->load->view('entitlementsView',$data);
	}
	else{
		$this->load->view('redirectToLogin');
	}
	}

		function getAllEntitlements($userid){
			$url = BASE_API_URL."/Payroll/getAllEntitlements/".$userid;
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

	public function deleteEntitlement(){
		$input = $this->input->post();
		if($input != null){
		$data['id'] = $this->input->post('id'); 
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/payroll/deleteEntitlement/".$data['id']."/".$data['userid'];
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
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

	public function updateEntitlement(){
		$form_data = $this->input->post();
		if($form_data != null){
			//$data['centerid'] = $this->input->post('centerid');
			$data['id'] = $this->input->post('id');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['name'] = $this->input->post('name');
			$data['rate'] = $this->input->post('rate');
	 		$url = BASE_API_URL."/payroll/updateEntitlement/".$data['userid'];
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

		public function addEntitlement(){
		$form_data = $this->input->post();
		if($form_data != null){
			$data['userid'] = $this->session->userdata('LoginId');
			$data['name'] = $this->input->post('name');
			$data['rate'] = $this->input->post('rate');
	 		$url = BASE_API_URL."/payroll/addEntitlement";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'x-device-id:'.$this->session->userdata('x-device-id'),
					'x-token:'.$this->session->userdata('AuthToken')
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

		public function entitlementsMod($x){
			if($this->session->has_userdata('LoginId')){
				$data['users'] = $this->userLevel($x);
			$this->load->view('entitlementsModal',$data);
		}
	else{
		$this->load->view('redirectToLogin');
	}
		}

		function userLevel($x){
			$id = $this->session->userdata('LoginId');
			$url = BASE_API_URL."/Payroll/getUserLevels/".$x."/".$id;
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

		// Old addEmployee 

	public function oldAddEmployee(){
		if($this->session->has_userdata('LoginId')){
			$this->load->view('oldCreateEmployeeProfile');
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function oldCreateEmployeeProfile(){
		$input = $this->input->post();
		if($input != null){
			$data['email'] = $this->load->post('email');
			$data['name'] = $this->load->post('name');
			$data['password'] = $this->load->post('password');
			$data['role'] = $this->load->post('role');
			$data['center'] = $this->load->post('center');
			$data['manager'] = $this->load->post('manager');
			$data['userid'] = $this->session->userdata('userid');
			$data['roleid'] = $this->load->post('roleid');
			$data['levelId'] = $this->load->post('levelId');
			$data['roleName'] = $this->load->post('roleName');
		$url = BASE_API_URL."/settings/addEmployee";
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

		// Old add employee 

	// New add Employee

		public function addEmployee($centerid=1){
			if($this->session->has_userdata('LoginId')){
				$data['centerid'] = $centerid;
				$data['userid'] = $this->session->userdata('LoginId');
				$data['centers'] = $this->getAllCenters();
				$data['areas'] = $this->getAreas($data['centerid']);
				$data['ordinaryEarningRate'] = $this->getAwardSettings($data['userid']);
				$data['levels'] = $this->getAllEntitlements($data['userid']);
				$data['superfunds'] = $this->getSuperfunds($data['userid']);
				// var_dump($data);
				$this->load->view('addEmployee',$data);
			}
			else{
				$this->load->view('redirectToLogin');
			}
		}

	public function createEmployeeProfile(){
		$form_data = $this->input->post();
		if($form_data != null){
			$data['userid'] = $this->session->userdata('LoginId');
		$data['title'] = $this->input->post('title'); 
		$data['fname'] = $this->input->post('fname'); 
		$data['mname'] = $this->input->post('mname'); 
		$data['lname'] = $this->input->post('lname'); 
		$data['emails'] = $this->input->post('emails'); 
		$data['dateOfBirth'] = $this->input->post('dateOfBirth'); 
		$data['jobTitle'] = $this->input->post('jobTitle'); 
		$data['gender'] = $this->input->post('gender'); 
		$data['homeAddLine1'] = $this->input->post('homeAddLine1'); 
		$data['homeAddLine2'] = $this->input->post('homeAddLine2'); 
		$data['homeAddCity'] = $this->input->post('homeAddCity'); 
		$data['homeAddRegion'] = $this->input->post('homeAddRegion'); 
		$data['homeAddPostal'] = $this->input->post('homeAddPostal'); 
		$data['homeAddCountry'] = $this->input->post('homeAddCountry'); 
		$data['phone'] = $this->input->post('phone'); 
		$data['mobile'] = $this->input->post('mobile'); 
		$data['startDate'] = $this->input->post('startDate'); 
		$data['terminationDate'] = $this->input->post('terminationDate'); 
		$data['ordinaryEarningRateId'] = $this->input->post('ordinaryEarningRateId'); 
		$data['employeeId'] = uniqid();;
		$data['bankAccount'] = $this->input->post('bankAccount'); 
		$data['superfund'] = $this->input->post('superfund'); 
		$data['employmentBasis'] = $this->input->post('employmentBasis'); 
		$data['tfnExemptionType'] = $this->input->post('tfnExemptionType'); 
		$data['taxFileNumber'] = $this->input->post('taxFileNumber'); 
		$data['australiantResidentForTaxPurposeYN'] = $this->input->post('australiantResidentForTaxPurposeYN'); 
		$data['residencyStatue'] = $this->input->post('residencyStatue'); 
		$data['taxFreeThresholdClaimedYN'] = $this->input->post('taxFreeThresholdClaimedYN'); 
		$data['taxOffsetEstimatedAmount'] = $this->input->post('taxOffsetEstimatedAmount'); 
		$data['hasHELPDebtYN'] = $this->input->post('hasHELPDebtYN'); 
		$data['hasSFSSDebtYN'] = $this->input->post('hasSFSSDebtYN'); 
		$data['hasTradeSupportLoanDebtYN'] = $this->input->post('hasTradeSupportLoanDebtYN'); 
		$data['upwardVariationTaxWitholdingAmount'] = $this->input->post('upwardVariationTaxWitholdingAmount'); 
		$data['eligibleToReceiveLeaveLoadingYN'] = $this->input->post('eligibleToReceiveLeaveLoadingYN'); 
		$data['approvedWitholdingVariationPercentage'] = $this->input->post('approvedWitholdingVariationPercentage');
		$data['center'] = $this->input->post('center');
		$data['area'] = $this->input->post('area');
		$data['role'] = $this->input->post('role');
		$data['manager'] = $this->input->post('manager');
		$data['level'] = $this->input->post('level');
		$data['bonusRates'] = $this->input->post('bonusRates');

					$data['Employees'] = [];
					$employee = [];
					$employee['Title'] =  $data['title'];
					$employee['FirstName'] = $data['fname'] ;
					$employee['LastName'] = $data['lname'] ;
					$employee['Status'] =  'ACTIVE';
					$employee['Email'] =  $data['emails'];
					$employee['DateOfBirth'] =  $data['dateOfBirth'];
					$employee['JobTitle'] = $data['jobTitle'] ;
					$employee['Gender'] =  $data['gender'];
					$employee['HomeAddress'] = [];
					$employee['HomeAddress']['AddressLine1'] =  $data['homeAddLine1'];
					$employee['HomeAddress']['AddressLine2'] = $data['homeAddLine2'];
					$employee['HomeAddress']['City'] = $data['homeAddCity'];
					$employee['HomeAddress']['Region'] = $data['homeAddRegion'];
					$employee['HomeAddress']['PostalCode'] = $data['homeAddPostal'];
					$employee['HomeAddress']['Country'] = $data['homeAddCountry'];
					$employee['Phone'] = $data['phone'];
					$employee['Mobile'] = $data['mobile'];
					$employee['StartDate'] = '/Date('.$data['startDate']->format('Uu').'+0000)/';
					$employee['OrdinaryEarningsRateID'] = $data['ordinaryEarningRateId'];
					$employee['PayrollCalendarID'] = "FIXED";
					$employee['TaxDeclaration'] = [];
					$employee['TaxDeclaration']['AustralianResidentForTaxPurposes'] = $data['australiantResidentForTaxPurposeYN'];
					$employee['TaxDeclaration']['TaxFreeThresholdClaimed'] = $data['taxFreeThresholdClaimedYN'];
					$employee['TaxDeclaration']['HasHELPDebt'] = $data['hasHELPDebtYN'];
					$employee['TaxDeclaration']['HasSFSSDebt'] = $data['hasSFSSDebtYN'];
					$employee['TaxDeclaration']['EligibleToReceiveLeaveLoading'] = $data['eligibleToReceiveLeaveLoadingYN'];
					$employee['TaxDeclaration']['UpdatedDateUTC'] = 
					//$employee['TaxDeclaration']['HasStudentStartupLoan'] = 
					$employee['TaxDeclaration']['ResidencyStatus'] = $data['residencyStatue'];
					$employee['BankAccounts'] = [];
					$bankAccounts = [];
					foreach($data['bankAccount'] as $account ){
					$bankAccounts['StatementText'] =$account['StatementText'];
					$bankAccounts['AccountName'] = $account['AccountName'];
					$bankAccounts['BSB'] = $account['BSB'];
					$bankAccounts['AccountNumber'] = $account['AccountNumber'];
					$bankAccounts['Remainder'] = $account['Remainder'];
					array_push($employee['BankAccounts'],$bankAccounts);
				}
					$employee['SuperMemberships'] = [];

				foreach($data['superfund'] as $superfund){
					$superMemberships = [];
					$superMemberships['SuperMembershipID'] = $superfund['SuperMembershipID']; 
					$superMemberships['SuperFundID'] = $superfund['SuperFundID']; 
					$superMemberships['EmployeeNumber'] = $superfund['EmployeeNumber']; 
					array_push($employee['SuperMemberships'],$superMemberships);
					}
					
					array_push($data['Employees'],$employee);

	 		$url = BASE_API_URL."";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'x-device-id:'.$this->session->userdata('x-device-id'),
					'x-token:'.$this->session->userdata('AuthToken')
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

	public function savePermission(){
		$input = $this->input->post();
		if($input != null){
			$data = $this->input->post();
			$data['userid'] = $this->session->userdata('LoginId');
			$url = BASE_API_URL."/settings/PostEmployeePermission";
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
				echo $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}
	}

	public function permissionSettings(){	
		$data['centers'] = $this->getAllCenters();
		$this->load->view('permission',$data);
	}

	public function awardSettings(){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['awards'] = $this->getAwardSettings($data['userid']);
		$this->load->view('awardSettings',$data);
	}

	function getAwardSettings($userid){
		$url = BASE_API_URL."/settings/getAwardSettings/".$userid;
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

	public function syncXeroAwards(){
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/xero/syncXeroAwards";
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




			// Award settings end

			// Superfunds settings

	public function superfundsSettings(){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['superfunds'] = $this->getSuperfunds($data['userid']);
		$this->load->view('superfundSettings',$data);
	}

	function getSuperfunds($userid){
		$url = BASE_API_URL."settings/getSuperfunds/".$userid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		// var_dump($server_output);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	public function  syncXeroSuperfunds(){
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/xero/syncXeroSuperfunds";
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


	public function getEmployeesByCenter($centerid){
		$url = BASE_API_URL."util/GetAllEmployeesByCenter/".$centerid.'/'.$this->session->userdata('LoginId');
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
			echo $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	public function getPermissionByEmployee($empId){
		$url = BASE_API_URL."settings/GetPermissionForEmployee/".$empId.'/'.$this->session->userdata('LoginId');
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
			echo $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

}


