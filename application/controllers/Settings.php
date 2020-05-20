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

		public function addEmployee(){
			if($this->session->has_userdata('LoginId')){
				$data['userid'] = $this->session->userdata('LoginId');
				$data['ordinaryEarningRate'] = $this->getAwardSettings($data['userid']);
				
				$this->load->view('addEmployee',$data);
			}
			else{
				$this->load->view('redirectToLogin');
			}
		}

		public function createEmployeeProfile(){
		$form_data = $this->input->post();
		if($form_data != null){
	$data['userid'] = $this->session->userdata('LoginId');;
	$data['xeroEmployeeId'] = $this->load->input('xeroEmployeeId');
	$data['title'] = $this->load->input('title');
	$data['fname'] = $this->load->input('fname');
	$data['mname'] = $this->load->input('mname');
	$data['lname'] = $this->load->input('lname');
	$data['status'] = $this->load->input('status');
	$data['emails'] = $this->load->input('emails');
	$data['dateOfBirth'] = $this->load->input('dateOfBirth');
	$data['jobTitle'] = $this->load->input('jobTitle');
	$data['gender'] = $this->load->input('gender');
	$data['homeAddLine1'] = $this->load->input('homeAddLine1');
	$data['homeAddLine2'] = $this->load->input('homeAddLine2');
	$data['homeAddCity'] = $this->load->input('homeAddCity');
	$data['homeAddRegion'] = $this->load->input('homeAddRegion');
	$data['homeAddPostal'] = $this->load->input('homeAddPostal');
	$data['homeAddCountry'] = $this->load->input('homeAddCountry');
	$data['phone'] = $this->load->input('phone');
	$data['mobile'] = $this->load->input('mobile');
	$data['startDate'] = $this->load->input('startDate');
	$data['terminationDate'] = $this->load->input('terminationDate');
	$data['ordinaryEarningRateId'] = $this->load->input('ordinaryEarningRateId');
	$data['payrollCalendarId'] = $this->load->input('payrollCalendarId');
	$data['employeeId'] = $this->load->input('employeeId');
	$data['bankAccount'] = $this->load->input('bankAccount');
	$data['employeeId'] = $this->load->input('employeeId');
	$data['superFundId'] = $this->load->input('superFundId');
	$data['employeeNumber'] = $this->load->input('employeeNumber');
	$data['superMembershipId'] = $this->load->input('superMembershipId');
	$data['employeeId'] = $this->load->input('employeeId');
	$data['employmentBasis'] = $this->load->input('employmentBasis');
	$data['tfnExemptionType'] = $this->load->input('tfnExemptionType');
	$data['taxFileNumber'] = $this->load->input('taxFileNumber');
	$data['australiantResidentForTaxPurposeYN'] = $this->load->input('australiantResidentForTaxPurposeYN');
	$data['residencyStatue'] = $this->load->input('residencyStatue');
	$data['taxFreeThresholdClaimedYN'] = $this->load->input('taxFreeThresholdClaimedYN');
	$data['taxOffsetEstimatedAmount'] = $this->load->input('taxOffsetEstimatedAmount');
	$data['hasHELPDebtYN'] = $this->load->input('hasHELPDebtYN');
	$data['hasSFSSDebtYN'] = $this->load->input('hasSFSSDebtYN');
	$data['hasTradeSupportLoanDebtYN'] = $this->load->input('hasTradeSupportLoanDebtYN');
	$data['upwardVariationTaxWitholdingAmount'] = $this->load->input('upwardVariationTaxWitholdingAmount');
	$data['eligibleToReceiveLeaveLoadingYN'] = $this->load->input('eligibleToReceiveLeaveLoadingYN');
$data['approvedWitholdingVariationPercentage']=$this->load->input('approvedWitholdingVariationPercentage');
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

		function ordinaryEarningRate(){

		}
	//	New Add Employee

// Xero settings

			// Award settings 

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

			// Super funds end

// Xero settings

}


