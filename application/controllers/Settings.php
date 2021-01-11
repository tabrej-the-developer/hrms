 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index(){
		if($this->session->has_userdata('LoginId')){
			if($this->getAllCenters() != 'error'){
				$data['permissions'] = $this->fetchPermissions();
				$this->load->view('settings',$data);
				}
				else{
					$data['error'] = 'error';
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
					$this->load->view('settings',$data);
				}
			}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function editPassword(){
		if($this->session->has_userdata('LoginId')){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$this->load->view('editPasswordView');
				}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function changePassword(){
		$input = $this->input->post();
		if($input != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['userid'] = $this->session->userdata('LoginId');
		$data['password'] = $this->input->post('password');
		$data['passcode'] =  $this->input->post('passcode');
		$url = BASE_API_URL."settings/changePassword";
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
			print_r($server_output);
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
		$data['permissions'] = $this->fetchPermissions();
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$this->load->view('editRoomsView',$data);
			}
	else{
		$this->load->view('redirectToLogin');
	}
}


	public function updateRoom(){
		$input = $this->input->post();
		if($input != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['userid'] = $this->session->userdata('LoginId');
		$data['response'] = $this->input->post('response');
		$data['centerid'] = $this->input->post('centerid');
		$data['roomId'] = $this->input->post('roomId');
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
		if($this->session->has_userdata('LoginId')){
			$data['permissions'] = $this->fetchPermissions();
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['states'] = $this->getStates();
			$this->load->view('createCenterProfile',$data);
		}
	else{
		$this->load->view('redirectToLogin');
		}
	}

	public function createCenterProfile(){
		$input = $this->input->post();
		if($input != null){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
		$data['userid'] = $this->session->userdata('LoginId');
		// if( $this->session->userdata('UserType') != SUPERADMIN ){
		// 	$data['superadmin'] = superadmin;
		// }
		$data['center_name'] = $this->input->post('center_name');
		$data['center_city'] = $this->input->post('center_city');
		$data['center_street'] = $this->input->post('center_street');
		$data['center_state'] = $this->input->post('center_state');
		$data['center_zip'] = $this->input->post('center_zip');
		$data['center_phone'] = $this->input->post('center_phone');
		$data['center_mobile'] = $this->input->post('center_mobile');
		$data['center_email'] = $this->input->post('center_email');
		$data['center_abn'] = $this->input->post('center_abn');
		$data['center_acn'] = $this->input->post('center_acn');
		$data['center_se_no'] = $this->input->post('center_se_no');
		$data['center_date_opened'] = $this->input->post('center_date_opened');
		$data['center_capacity'] = $this->input->post('center_capacity');
		if($_FILES['center_approval_doc']['name'] != null && $_FILES['center_approval_doc']['name'] != "")
			$data['center_approval_doc'] = base64_encode(file_get_contents($_FILES['center_approval_doc']['tmp_name']));
		else
			$data['center_approval_doc'] = "";
		if($_FILES['center_ccs_doc']['name'] != null && $_FILES['center_ccs_doc']['name'] != "")
			$data['center_ccs_doc'] = base64_encode(file_get_contents($_FILES['center_ccs_doc']['tmp_name']));
		else
			$data['center_ccs_doc'] = "";
		$data['center_admin_name'] = $this->input->post('center_admin_name');
		$data['centre_nominated_supervisor'] = $this->input->post('centre_nominated_supervisor');
		$data['room_name'] = $this->input->post('room_name');
		$data['capacity_'] = $this->input->post('capacity_');
		$data['minimum_age'] = $this->input->post('minimum_age');
		$data['maximum_age'] = $this->input->post('maximum_age');
		// var_dump($data);
		$url = BASE_API_URL."settings/addCenter";
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
			var_dump($httpcode);
			if($httpcode == 200){
				$this->session->set_flashdata('centerCreated','Center Created Successfully');
				redirect(base_url('settings/createCenter'));
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}			
		}
	}


	public function centersBySuperAdmin(){
		$input = $this->input->post();
		if($input != null){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$data['userid'] = $this->session->userdata('LoginId');
			$data['type'] = $input['type'];
			$data['id'] = $input['id'];
			$url = BASE_API_URL."settings/centersBySuperAdmin";
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
					print_r($server_output);
					curl_close ($ch);
				}
				else if($httpcode == 401){

				}
		}
	}

	public function centerProfile($centerid = null){
		if($this->session->has_userdata('LoginId')){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$data['centers'] = $this->getAllCenters();
			$data['permissions'] = $this->fetchPermissions();
			$data['states'] = $this->getStates();
		  	if($centerid == null){
		  		if(!isset($_SESSION['centerr'])){
							$centerid = json_decode($data['centers'])->centers[0]->centerid;
							$_SESSION['centerr'] =$centerid;
							$data['centerid'] = $centerid;
							$data['centerData'] = $this->editCenterProfile($centerid);
		  		}else{
			  			$centerid = $_SESSION['centerr'];
			  			$data['centerid'] = $centerid;
			  			$data['centerData'] = $this->editCenterProfile($centerid);
		  		}
				}else{
					$_SESSION['centerr'] = $centerid;
					$data['centerid'] = $centerid;
	  			$data['centerData'] = $this->editCenterProfile($centerid);
				}

			// if($centerid == null){
			// 	$data['centerid'] = $centerid;
			// 	$data['centerData'] = $this->editCenterProfile($data['centerid']);
			// }
			// else{
			// 	$data['centerid'] = (json_decode($this->getAllCenters())->centers[0])->centerid;
			// 	$data['centerData'] = $this->editCenterProfile($data['centerid']);
			// }
				$this->load->view('editCenterProfile',$data);
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}	

	function editCenterProfile($centerid){
		if($this->session->has_userdata('LoginId')){
		$url = BASE_API_URL."settings/editCenter/".$centerid."/".$this->session->userdata('LoginId');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
		));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// var_dump($server_output);
		if($httpcode == 200){
			return $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){
			return 'error';
		}
		}
	}	

	public function updateCenter(){
		$input = $this->input->post();
		// if($input != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['center_name'] = $input['center_name'];
		$data['centerid'] = $input['centerid'];
		$data['center_city'] = $input['center_city'];
		$data['center_street'] = $input['center_street'];
		$data['center_state'] = $input['center_state'];
		$data['center_zip'] = $input['center_zip'];
		$data['center_phone'] = $input['center_phone'];
		$data['center_mobile'] = $input['center_mobile'];
		$data['center_email'] = $input['center_email'];
		$data['center_abn'] = $input['center_abn'];
		$data['center_acn'] = $input['center_acn'];
		$data['center_se_no'] = $input['center_se_no'];
		$data['center_date_opened'] = $input['center_date_opened'];
		$data['center_capacity'] = $input['center_capacity'];
		// $data['center_approval_doc'] = $input['center_approval_doc'];
		// $data['center_ccs_doc'] = $input['center_ccs_doc'];
		$data['manager_name'] = $input['manager_name'];
		$data['center_admin_name'] = $input['center_admin_name'];
		$data['centre_nominated_supervisor'] = $input['centre_nominated_supervisor'];
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."settings/updateCenter";
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
			// print_r($server_output);
			if($httpcode == 200){
				curl_close ($ch);
				redirect('settings');
				return $server_output;
			}
			else if($httpcode == 401){

			}
		// }
	}

	public function orgChart(){
		if($this->session->has_userdata('LoginId')){
			if($this->input->post('centerid') != null){
			$data['centerid'] = $this->input->post('centerid');
				}else{
					$data['centerid'] = (json_decode($this->getAllCenters())->centers[0])->centerid;
				}
			$data['permissions'] = $this->fetchPermissions();
			$data['centers'] = $this->getAllCenters();
			$data['orgChart'] = $this->getOrgChart($data['centerid']);
		//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
				$this->load->view('editOrgChartView',$data);
			}
			else{
				$this->load->view('redirectToLogin');
			}
	}

	public function getEmployeesForRoles($roleid){
			$url = BASE_API_URL."settings/getEmployeesForRoles/".$roleid."/".$this->session->userdata('LoginId');
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

	public function changeEmployeeRole(){
		$formData = $this->input->post();
		if($formData != null){
			$data['details'] = $formData['details'];  
			$data['userid'] = $this->session->userdata('LoginId'); 
		$url = BASE_API_URL."/settings/changeEmployeeRole/".$this->session->userdata('LoginId');
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
			print_r($httpcode);
			print_r($server_output);
			if($httpcode == 200){
				print_r($server_output);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['centerid'] = $this->input->post('centerid');;
			$data['isRoomYN'] = $this->input->post('isRoomYN');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['areaName'] = $this->input->post('areaName');

 		$url = BASE_API_URL."settings/addArea";
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
			print_r($server_output);
			if($httpcode == 200){
				print_r($server_output);
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}
	}


	public function UpdateRole(){
	$form_data = $this->input->post();
	if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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



	function getAllRooms($centerid = null){
		if($centerid == null){
			$centerid = (json_decode($this->getAllCenters())->centers[0])->centerid;
		}
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
	function getOrgChart($centerid=null){
		if($centerid == null){
			$centerid = (json_decode($this->getAllCenters())->centers[0])->centerid;
		}
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

		public function getOrgCharts($centerid=null){
			if($centerid == null){
				$centerid = (json_decode($this->getAllCenters())->centers[0])->centerid;
			}
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

	public function changeRolePriority(){
		$input = $this->input->post();
		if($input != null){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
		$data['order'] = $this->input->post('order');
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."settings/changeRolePriority/";
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
			print_r($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				print_r($server_output);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

	function getAreas($centerid=null){
		if($centerid == null){
		$centerid = (json_decode($this->getAllCenters())->centers[0])->centerid;
			}
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
		$data['id'] = $this->input->post('id'); 
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/settings/deleteArea/".$data['id']."/".$data['userid'];
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
				echo $server_output;
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}
	
	public function deleteRole(){
		$input = $this->input->post();
		if($input != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['id'] = $this->input->post('id'); 
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/settings/deleteRole/".$data['id']."/".$data['userid'];
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
			print_r($server_output);
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
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
				$data['centers'] = $this->getAllCenters();
			$data['userid'] = $this->session->userdata('LoginId');
			$data['entitlements'] = $this->getAllEntitlements($data['userid']);
			$data['permissions'] = $this->fetchPermissions();
			$this->load->view('entitlementsView',$data);
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function activityLog(){
		if($this->session->has_userdata('LoginId')){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
		$data['footprints'] = $this->getFootprints($this->session->userdata('LoginId'));
				$data['centers'] = $this->getAllCenters();
			$data['userid'] = $this->session->userdata('LoginId');
			$data['entitlements'] = $this->getAllEntitlements($data['userid']);
			$data['permissions'] = $this->fetchPermissions();
			$this->load->view('activityLog',$data);
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}

		function getFootprints($userid){
		$url = BASE_API_URL."Dashboard/getFootprints/".$userid;
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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

		public function entitlementsMod($level){
			if($this->session->has_userdata('LoginId')){
				$userid = $this->session->userdata('LoginId');
				$data['users'] = $this->userLevel($level);
				$data['entitlements'] = $this->getAllEntitlements($userid); 
			$this->load->view('entitlementsModal',$data);
		}
			else{
				$this->load->view('redirectToLogin');
			}
		}

		public function editEmployeeEntitlements(){
			$form_data = $this->input->post();
			if($form_data != null){
				$id = $this->session->userdata('LoginId');
				$url = BASE_API_URL."/settings/editEmployeeEntitlements";
				$data['userid'] = $this->session->userdata('LoginId');
				$data['empid'] = $form_data['empid'];
				$data['level'] = $form_data['level'];
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
				print_r($server_output);
				if($httpcode == 200){
					// print_r($server_output);
					// return $server_output;
					curl_close ($ch);

				}
				else if($httpcode == 401){

				}
			}
		}

		function userLevel($level){
			$id = $this->session->userdata('LoginId');
			$url = BASE_API_URL."/Payroll/getUserLevels/".$level."/".$id;
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

	// public function oldCreateEmployeeProfile(){
	// 	$input = $this->input->post();
	// 	if($input != null){

	// //footprint start
	// if($this->session->has_userdata('current_url')){
	// 	footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
	// 	$this->session->set_userdata('current_url',currentUrl());
	// }
	// // footprint end
	// 		$data['email'] = $this->load->post('email');
	// 		$data['name'] = $this->load->post('name');
	// 		$data['password'] = $this->load->post('password');
	// 		$data['role'] = $this->load->post('role');
	// 		$data['center'] = $this->load->post('center');
	// 		$data['manager'] = $this->load->post('manager');
	// 		$data['userid'] = $this->session->userdata('userid');
	// 		$data['roleid'] = $this->load->post('roleid');
	// 		$data['levelId'] = $this->load->post('levelId');
	// 		$data['roleName'] = $this->load->post('roleName');
	// 	$url = BASE_API_URL."/settings/addEmployee";
	// 	$ch = curl_init($url);
	// 	curl_setopt($ch, CURLOPT_URL,$url);
	// 	curl_setopt($ch, CURLOPT_POST, 1);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	// 			'x-device-id: '.$this->session->userdata('x-device-id'),
	// 			'x-token: '.$this->session->userdata('AuthToken')
	// 		));
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 		$server_output = curl_exec($ch);
	// 		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// 		if($httpcode == 200){
	// 			return $server_output;
	// 			curl_close ($ch);

	// 		}
	// 		else if($httpcode == 401){

	// 		}			
	// 	}
	// }

		// Old add employee 

// View Employee 
		public function viewEmployee($employeeId=null){
			// $centerid,$employeeid
			// $form_data = $this->input->post();
			// if($form_data != null){
				if($this->session->has_userdata('LoginId')){
					//footprint start
					if($this->session->has_userdata('current_url')){
						footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
						$this->session->set_userdata('current_url',currentUrl());
					}
					// footprint end
					// $data['centerid'] = $centerid;
					// $data['employeeid'] = $employeeid;
					$data['userid'] = $this->session->userdata('LoginId');
					$data['centers'] = $this->getAllCenters();
					$data['employeeId'] = $employeeId;
					if($employeeId != null){
						$data['getEmployeeData'] = $this->getEmployeeProfile($employeeId);
					}
					// $data['areas'] = $this->getAreas($data['centerid']);
					// $data['ordinaryEarningRate'] = $this->getAwardSettings($data['userid']);
					// $data['levels'] = $this->getAllEntitlements($data['userid']);
					// $data['superfunds'] = $this->getSuperfunds($data['userid']);
					$data['permissions'] = $this->fetchPermissions();
					// var_dump($data);
					$this->load->view('viewEmployee',$data);
				}
				else{
					$this->load->view('redirectToLogin');
				}
			// }
		}

	// Edit employee
	public function editEmployee($centerid=null){
			if($this->session->has_userdata('LoginId')){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
	if($centerid == null){
		$centerid = (json_decode($this->getAllCenters())->centers[0])->centerid;
	}
				$data['centerid'] = $centerid;
				$data['userid'] = $this->session->userdata('LoginId');
				$data['centers'] = $this->getAllCenters();
				$data['areas'] = $this->getAreas($data['centerid']);
				$data['ordinaryEarningRate'] = $this->getAwardSettings($data['userid'],$centerid);
				$data['levels'] = $this->getAllEntitlements($data['userid']);
				$data['superfunds'] = $this->getSuperfunds($data['userid'],$centerid);
				$data['permissions'] = $this->fetchPermissions();
				$data['getEmployeeData'] = $this->getEmployeeData($data['userid']);
				// var_dump($data);
				$this->load->view('editEmployee',$data);
			}
			else{
				$this->load->view('redirectToLogin');
			}
		}


	public function updateEmployeeProfile(){
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['title'] = isset($_POST['title']) ? $_POST['title']: "";
		$data['fname'] = isset($_POST['fname']) ? $_POST['fname']: "";
		$data['mname'] = isset($_POST['mname']) ? $_POST['mname']: "";
		$data['lname'] = isset($_POST['lname']) ? $_POST['lname']: "";
		$data['emails'] = isset($_POST['emails']) ? $_POST['emails']: "";
		$data['alias'] = isset($_POST['alias']) ? $_POST['alias']: "";
		$data['dateOfBirth'] = isset($_POST['dateOfBirth']) ? $_POST['dateOfBirth']: "";
		$data['gender'] = isset($_POST['gender']) ? $_POST['gender']: "";
		// $data['jobTitle'] = isset($_POST['jobTitle']) ? $_POST['jobTitle']: "";
		$data['homeAddLine1'] = isset($_POST['homeAddLine1']) ? $_POST['homeAddLine1']: "";
		$data['homeAddLine2'] = isset($_POST['homeAddLine2']) ? $_POST['homeAddLine2']: "";
		$data['homeAddCity'] = isset($_POST['homeAddCity']) ? $_POST['homeAddCity']: "";
		$data['homeAddRegion'] = isset($_POST['homeAddRegion']) ? $_POST['homeAddRegion']: "";
		$data['homeAddPostal'] = isset($_POST['homeAddPostal']) ? $_POST['homeAddPostal']: "";
		$data['homeAddCountry'] = isset($_POST['homeAddCountry']) ? $_POST['homeAddCountry']: "";
		$data['phone'] = isset($_POST['phone']) ? $_POST['phone']: "";
		$data['mobile'] = isset($_POST['mobile']) ? $_POST['mobile']: "";
		$data['terminationDate'] = isset($_POST['terminationDate']) ? $_POST['terminationDate']: "";
		$data['emergency_contact'] = isset($_POST['emergency_contact']) ? $_POST['emergency_contact']: "";
		$data['relationship'] = isset($_POST['relationship']) ? $_POST['relationship']: "";
		$data['emergency_contact_email'] = isset($_POST['emergency_contact_email']) ? $_POST['emergency_contact_email']: "";
		$data['accountName'] = isset($_POST['accountName']) ? $_POST['accountName']: "";
		$data['bsb'] = isset($_POST['bsb']) ? $_POST['bsb']: "";
		$data['accountNumber'] = isset($_POST['accountNumber']) ? $_POST['accountNumber']: "";
		$data['remainderYN'] = isset($_POST['remainderYN']) ? $_POST['remainderYN']: "";
		$data['amount'] = isset($_POST['amount']) ? $_POST['amount']: "";
		$data['superFundId'] = isset($_POST['superFundId']) ? $_POST['superFundId']: "";
		$data['superMembershipId'] = isset($_POST['superMembershipId']) ? $_POST['superMembershipId']: "";
		$data['tfnExemptionType'] = isset($_POST['tfnExemptionType']) ? $_POST['tfnExemptionType']: "";
		$data['taxFileNumber'] = isset($_POST['taxFileNumber']) ? $_POST['taxFileNumber']: "";
		$data['australiantResidentForTaxPurposeYN'] = isset($_POST['australiantResidentForTaxPurposeYN']) ? $_POST['australiantResidentForTaxPurposeYN']: "";
		$data['residencyStatue'] = isset($_POST['residencyStatue']) ? $_POST['residencyStatue']: "";
		$data['taxFreeThresholdClaimedYN'] = isset($_POST['taxFreeThresholdClaimedYN']) ? $_POST['taxFreeThresholdClaimedYN']: "";
		$data['taxOffsetEstimatedAmount'] = isset($_POST['taxOffsetEstimatedAmount']) ? $_POST['taxOffsetEstimatedAmount']: "";
		$data['hasHELPDebtYN'] = isset($_POST['hasHELPDebtYN']) ? $_POST['hasHELPDebtYN']: "";
		$data['hasSFSSDebtYN'] = isset($_POST['hasSFSSDebtYN']) ? $_POST['hasSFSSDebtYN']: "";
		$data['hasTradeSupportLoanDebtYN_'] = isset($_POST['hasTradeSupportLoanDebtYN_']) ? $_POST['hasTradeSupportLoanDebtYN_']: "";
		$data['upwardVariationTaxWitholdingAmount'] = isset($_POST['upwardVariationTaxWitholdingAmount']) ? $_POST['upwardVariationTaxWitholdingAmount']: "";
		$data['eligibleToReceiveLeaveLoadingYN'] = isset($_POST['eligibleToReceiveLeaveLoadingYN']) ? $_POST['eligibleToReceiveLeaveLoadingYN']: "";
		$data['approvedWitholdingVariationPercentage'] = isset($_POST['approvedWitholdingVariationPercentage']) ? $_POST['approvedWitholdingVariationPercentage']: "";
		$data['xeroEmployeeId'] = isset($_POST['xeroEmployeeId']) ? $_POST['xeroEmployeeId']: "";
		$data['employee_no'] = $this->session->userdata('LoginId');
		$res_doc = isset($_FILES['resume_doc']['name']) ? $_FILES['resume_doc']['name']: "";
		if($res_doc != ""){
			$data['resume_doc'] = base64_encode(file_get_contents($_FILES['resume_doc']['tmp_name']));
		}else{
			$data['resume_doc'] = null;
		}
		$cont_doc = isset($_FILES['contract_doc']['name']) ? $_FILES['contract_doc']['name']: "";
		if($cont_doc != ""){
			$data['contract_doc'] = base64_encode(file_get_contents($_FILES['contract_doc']['tmp_name']));
		}else{
			$data['contract_doc'] = null;
		}
		$prof_img = isset($_FILES['profileImage']['name']) ? $_FILES['profileImage']['name'] : "";
		if($prof_img != ""){
			$data['profileImage'] = base64_encode(file_get_contents($_FILES['profileImage']['tmp_name']));
		}else{
			$data['profileImage'] = "";
		}			
		// $data['employement_type'] = isset($_POST['employement_type']) ? $_POST['employement_type']: "";
		$data['highest_qual_held'] = isset($_POST['highest_qual_held']) ? $_POST['highest_qual_held']: "";
		$data['highest_qual_date_obtained'] = isset($_POST['highest_qual_date_obtained']) ? $_POST['highest_qual_date_obtained']: "";
		// $data['highest_qual_cert'] = isset($_POST['highest_qual_cert']) ? $_POST['highest_qual_cert']: "";
		$data['qual_towards_desc'] = isset($_POST['qual_towards_desc']) ? $_POST['qual_towards_desc']: "";
		$data['qual_towards_percent_comp'] = isset($_POST['qual_towards_percent_comp']) ? $_POST['qual_towards_percent_comp']: "";
		$data['classification'] = isset($_POST['classification']) ? $_POST['classification']: "";
		$data['ordinaryEarningRateId'] = isset($_POST['ordinaryEarningRateId']) ? $_POST['ordinaryEarningRateId']: "";
		// $data['payroll_calendar'] = isset($_POST['payroll_calendar']) ? $_POST['payroll_calendar']: "";
		$data['employee_group'] = isset($_POST['employee_group']) ? $_POST['employee_group']: "";
		$data['holiday_group'] = isset($_POST['holiday_group']) ? $_POST['holiday_group']: "";
		$data['visa_holder'] = isset($_POST['holiday_group']) ? $_POST['holiday_group']: "";
		$data['visa_type'] = isset($_POST['visa_holder']) ? $_POST['visa_holder']: "";
		$data['visa_grant_date'] = isset($_POST['visa_grant_date']) ? $_POST['visa_grant_date']: "";
		$data['visa_end_date'] = isset($_POST['visa_end_date']) ? $_POST['visa_end_date']: "";
		$data['visa_conditions'] = isset($_POST['visa_conditions']) ? $_POST['visa_conditions']: "";
		$data['course_name'] = isset($_POST['course_name']) ? $_POST['course_name']: "";
		$data['course_description'] = isset($_POST['course_description']) ? $_POST['course_description']: "";
		$data['course_id'] = isset($_POST['course_id']) ? $_POST['course_id']: "";
		$data['date_obtained'] = isset($_POST['date_obtained']) ? $_POST['date_obtained']: "";
		$data['expiry_date'] = isset($_POST['expiry_date']) ? $_POST['expiry_date']: "";
		$data['certificate'] = isset($_FILES['certificate']['tmp_name']) ? $_FILES['certificate']['tmp_name']: "";
		$data['medicareNo'] = isset($_POST['medicareNo']) ? $_POST['medicareNo']: "";
		$data['medicareRefNo'] = isset($_POST['medicareRefNo']) ? $_POST['medicareRefNo']: "";
		$data['healthInsuranceFund'] = isset($_POST['healthInsuranceFund']) ? $_POST['healthInsuranceFund']: "";
		$data['healthInsuranceNo'] = isset($_POST['healthInsuranceNo']) ? $_POST['healthInsuranceNo']: "";
		$data['ambulanceSubscriptionNo'] = isset($_POST['ambulanceSubscriptionNo']) ? $_POST['ambulanceSubscriptionNo']: "";
		$data['medicalConditions'] = isset($_POST['medicalConditions']) ? $_POST['medicalConditions']: "";
		$data['medicalAllergies'] = isset($_POST['medicalAllergies']) ? $_POST['medicalAllergies']: "";
		$data['medication'] = isset($_POST['medication']) ? $_POST['medication']: "";
		$data['dietaryPreferences'] = isset($_POST['dietaryPreferences']) ? $_POST['dietaryPreferences']: "";
		$documents = isset($_POST['addFileName']) ? $_POST['addFileName'] : null;

		if($documents != null && $documents != ""){
				$data['documentNames'] = $_POST['addFileName'];
				$data['docNames'] = $_FILES['addFile']['name'];
				$data['documents'] = []; 
			for($i=0;$i<count($_FILES['addFile']['name']);$i++){
				if(isset($_FILES['addFile']['tmp_name'][$i]) && $_FILES['addFile']['tmp_name'][$i] != "" && $_FILES['addFile']['tmp_name'][$i] != null){
				array_push($data['documents'],base64_encode(file_get_contents($_FILES['addFile']['tmp_name'][$i]))); 
				}
			}	
		}
			$data['userid'] = $this->session->userdata('LoginId');
			$url = BASE_API_URL."settings/updateEmployeeProfile";
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
			// var_dump($server_output);
			if($httpcode == 200){
				redirect(base_url('settings'));
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}  
	}
	// New add Employee

		public function addEmployee($centerid=null){
			if($this->session->has_userdata('LoginId')){
				//footprint start
				if($this->session->has_userdata('current_url')){
					footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
					$this->session->set_userdata('current_url',currentUrl());
				}
				// footprint end
				if($centerid == null){
					$centerid = (json_decode($this->getAllCenters())->centers[0])->centerid;
				}
				$data['centerid'] = $centerid;
				$data['userid'] = $this->session->userdata('LoginId');
				$data['centers'] = $this->getAllCenters();
				$data['areas'] = $this->getAreas($data['centerid']);
				$data['ordinaryEarningRate'] = $this->getAwardSettings($data['userid'],$centerid);
				$data['levels'] = $this->getAllEntitlements($data['userid']);
				$data['superfunds'] = $this->getSuperfunds($data['userid'],$centerid);
				$data['permissions'] = $this->fetchPermissions();
				// var_dump($data['areas']);
				$this->load->view('addEmployee',$data);
			}
			else{
				$this->load->view('redirectToLogin');
			}
		}

	public function createEmployeeProfile(){
		$form_data = $this->input->post();
		if($form_data != null){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
		$data['title'] = isset($_POST['title']) ? $_POST['title']: "";
		$data['fname'] = isset($_POST['fname']) ? $_POST['fname']: "";
		$data['mname'] = isset($_POST['mname']) ? $_POST['mname']: "";
		$data['lname'] = isset($_POST['lname']) ? $_POST['lname']: "";
		$data['emails'] = isset($_POST['emails']) ? $_POST['emails']: "";
		$data['alias'] = isset($_POST['alias']) ? $_POST['alias']: "";
		$data['dateOfBirth'] = isset($_POST['dateOfBirth']) ? $_POST['dateOfBirth']: "";
		$data['gender'] = isset($_POST['gender']) ? $_POST['gender']: "";
		// $data['jobTitle'] = isset($_POST['jobTitle']) ? $_POST['jobTitle']: "";
		$data['homeAddLine1'] = isset($_POST['homeAddLine1']) ? $_POST['homeAddLine1']: "";
		$data['homeAddLine2'] = isset($_POST['homeAddLine2']) ? $_POST['homeAddLine2']: "";
		$data['homeAddCity'] = isset($_POST['homeAddCity']) ? $_POST['homeAddCity']: "";
		$data['homeAddRegion'] = isset($_POST['homeAddRegion']) ? $_POST['homeAddRegion']: "";
		$data['homeAddPostal'] = isset($_POST['homeAddPostal']) ? $_POST['homeAddPostal']: "";
		$data['homeAddCountry'] = isset($_POST['homeAddCountry']) ? $_POST['homeAddCountry']: "";
		$data['phone'] = isset($_POST['phone']) ? $_POST['phone']: "";
		$data['mobile'] = isset($_POST['mobile']) ? $_POST['mobile']: "";
		$data['startDate'] = isset($_POST['startDate']) ? $_POST['startDate']: "";
		$data['terminationDate'] = isset($_POST['terminationDate']) ? $_POST['terminationDate']: "";
		$data['emergency_contact'] = isset($_POST['emergency_contact']) ? $_POST['emergency_contact']: "";
		$data['relationship'] = isset($_POST['relationship']) ? $_POST['relationship']: "";
		$data['emergency_contact_email'] = isset($_POST['emergency_contact_email']) ? $_POST['emergency_contact_email']: "";
		$data['accountName'] = isset($_POST['accountName']) ? $_POST['accountName']: "";
		$data['bsb'] = isset($_POST['bsb']) ? $_POST['bsb']: "";
		$data['accountNumber'] = isset($_POST['accountNumber']) ? $_POST['accountNumber']: "";
		$data['remainderYN'] = isset($_POST['remainderYN']) ? $_POST['remainderYN']: "";
		$data['amount'] = isset($_POST['amount']) ? $_POST['amount']: "";
		$data['superFundId'] = isset($_POST['superFundId']) ? $_POST['superFundId']: "";
		$data['superMembershipId'] = isset($_POST['superMembershipId']) ? $_POST['superMembershipId']: "";
		$data['superfundEmployeeNumber'] = isset($_POST['superfundEmployeeNumber']) ? $_POST['superfundEmployeeNumber'] : "";
		$data['employmentBasis'] = isset($_POST['employmentBasis']) ? $_POST['employmentBasis']: "";
		$data['tfnExemptionType'] = isset($_POST['tfnExemptionType']) ? $_POST['tfnExemptionType']: "";
		$data['taxFileNumber'] = isset($_POST['taxFileNumber']) ? $_POST['taxFileNumber']: "";
		$data['australiantResidentForTaxPurposeYN'] = isset($_POST['australiantResidentForTaxPurposeYN']) ? $_POST['australiantResidentForTaxPurposeYN']: "";
		$data['residencyStatue'] = isset($_POST['residencyStatue']) ? $_POST['residencyStatue']: "";
		$data['taxFreeThresholdClaimedYN'] = isset($_POST['taxFreeThresholdClaimedYN']) ? $_POST['taxFreeThresholdClaimedYN']: "";
		$data['taxOffsetEstimatedAmount'] = isset($_POST['taxOffsetEstimatedAmount']) ? $_POST['taxOffsetEstimatedAmount']: "";
		$data['hasHELPDebtYN'] = isset($_POST['hasHELPDebtYN']) ? $_POST['hasHELPDebtYN']: "";
		$data['hasSFSSDebtYN'] = isset($_POST['hasSFSSDebtYN']) ? $_POST['hasSFSSDebtYN']: "";
		$data['hasTradeSupportLoanDebtYN_'] = isset($_POST['hasTradeSupportLoanDebtYN_']) ? $_POST['hasTradeSupportLoanDebtYN_']: "";
		$data['upwardVariationTaxWitholdingAmount'] = isset($_POST['upwardVariationTaxWitholdingAmount']) ? $_POST['upwardVariationTaxWitholdingAmount']: "";
		$data['eligibleToReceiveLeaveLoadingYN'] = isset($_POST['eligibleToReceiveLeaveLoadingYN']) ? $_POST['eligibleToReceiveLeaveLoadingYN']: "";
		$data['approvedWitholdingVariationPercentage'] = isset($_POST['approvedWitholdingVariationPercentage']) ? $_POST['approvedWitholdingVariationPercentage']: "";
		$data['xeroEmployeeId'] = isset($_POST['xeroEmployeeId']) ? $_POST['xeroEmployeeId']: "";
		$data['employee_no'] = isset($_POST['employee_no']) ? $_POST['employee_no']: "";
		$data['center'] = isset($_POST['center']) ? $_POST['center']: "";
		$data['area'] = isset($_POST['area']) ? $_POST['area']: "";
		$data['role'] = isset($_POST['role']) ? $_POST['role']: "";
		$data['manager'] = isset($_POST['manager']) ? $_POST['manager']: "";
		$data['level'] = isset($_POST['level']) ? $_POST['level']: "";
		$data['bonusRates'] = isset($_POST['bonusRates']) ? $_POST['bonusRates']: "";
		$res_doc = isset($_FILES['resume_doc']['name']) ? $_FILES['resume_doc']['name']: "";
		if($res_doc != ""){
			$data['resume_doc'] = base64_encode(file_get_contents($_FILES['resume_doc']['tmp_name']));
		}else{
			$data['resume_doc'] = "";
		}
		$cont_doc = isset($_FILES['contract_doc']['name']) ? $_FILES['contract_doc']['name']: "";
		if($cont_doc != ""){
			$data['contract_doc'] = base64_encode(file_get_contents($_FILES['contract_doc']['tmp_name']));
		}else{
			$data['contract_doc'] = "";
		}
		$prof_img = isset($_FILES['profileImage']['name']) ? $_FILES['profileImage']['name'] : "";
		if($prof_img != ""){
			$data['profileImage'] = base64_encode(file_get_contents($_FILES['profileImage']['tmp_name']));
		}else{
			$data['profileImage'] = "";
		}		
		$data['employement_type'] = isset($_POST['employement_type']) ? $_POST['employement_type']: "";
		$data['highest_qual_held'] = isset($_POST['highest_qual_held']) ? $_POST['highest_qual_held']: "";
		$data['highest_qual_date_obtained'] = isset($_POST['highest_qual_date_obtained']) ? $_POST['highest_qual_date_obtained']: "";
		$data['highest_qual_cert'] = isset($_POST['highest_qual_cert']) ? $_POST['highest_qual_cert']: "";
		$data['qual_towards_desc'] = isset($_POST['qual_towards_desc']) ? $_POST['qual_towards_desc']: "";
		$data['qual_towards_percent_comp'] = isset($_POST['qual_towards_percent_comp']) ? $_POST['qual_towards_percent_comp']: "";
		$data['classification'] = isset($_POST['classification']) ? $_POST['classification']: "";
		$data['ordinaryEarningRateId'] = isset($_POST['ordinaryEarningRateId']) ? $_POST['ordinaryEarningRateId']: "";
		$data['payroll_calendar'] = isset($_POST['payroll_calendar']) ? $_POST['payroll_calendar']: "";
		$data['visa_holder'] = isset($_POST['visa_holder']) ? $_POST['visa_holder']: "";
		$data['visa_type'] = isset($_POST['visa_type']) ? $_POST['visa_type']: "";
		$data['visa_grant_date'] = isset($_POST['visa_grant_date']) ? $_POST['visa_grant_date']: "";
		$data['visa_end_date'] = isset($_POST['visa_end_date']) ? $_POST['visa_end_date']: "";
		$data['visa_conditions'] = isset($_POST['visa_conditions']) ? $_POST['visa_conditions']: "";
		if(isset($_POST['course_name'])){
			$data['course_name'] = isset($_POST['course_name']) ? $_POST['course_name'] : "";
			$data['course_description'] = $_POST['course_description'];
			$data['date_obtained'] = $_POST['date_obtained'];
			$data['expiry_date'] = $_POST['expiry_date'];
			$data['certificate'] = $_FILES['certificate'];
		}
		$data['medicareNo'] = isset($_POST['medicareNo']) ? $_POST['medicareNo']: "";
		$data['medicareRefNo'] = isset($_POST['medicareRefNo']) ? $_POST['medicareRefNo']: "";
		$data['healthInsuranceFund'] = isset($_POST['healthInsuranceFund']) ? $_POST['healthInsuranceFund']: "";
		$data['healthInsuranceNo'] = isset($_POST['healthInsuranceNo']) ? $_POST['healthInsuranceNo']: "";
		$data['ambulanceSubscriptionNo'] = isset($_POST['ambulanceSubscriptionNo']) ? $_POST['ambulanceSubscriptionNo']: "";
		$data['medicalConditions'] = isset($_POST['medicalConditions']) ? $_POST['medicalConditions']: "";
		$data['medicalAllergies'] = isset($_POST['medicalAllergies']) ? $_POST['medicalAllergies']: "";
		$data['medication'] = isset($_POST['medication']) ? $_POST['medication']: "";
		$data['medicals_id'] = isset($_POST['medicals_id']) ? $_POST['medicals_id']: "";
	$data['dietaryPreferences'] = isset($_POST['dietaryPreferences']) ? $_POST['dietaryPreferences']: "";
			$data['userid'] = $this->session->userdata('LoginId');
		}
			$url = BASE_API_URL."settings/createEmployeeProfile";
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
			var_dump($httpcode);
			var_dump($server_output);
			if($httpcode == 200){
				redirect(base_url('settings'));
				curl_close ($ch);
			}
			else if($httpcode == 401){
				redirect(base_url('settings'));
			}
		}

	public function AddMultipleEmployees(){
		if($this->session->has_userdata('LoginId')){
			$data['permissions'] = $this->fetchPermissions();
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$data['centers'] = $this->getAllCenters();
			$this->load->view('addMultipleEmployees',$data);
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function deleteDocument($docId){
		$input = $this->input->post();
		$userid = $this->session->userdata('LoginId');
		$url = BASE_API_URL."settings/deleteDocument/".$docId."/".$userid;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		var_dump($server_output);
		// print_r($httpcode);
		if($httpcode == 200){
			echo $server_output;
			curl_close ($ch);
		}
		else if($httpcode == 401){

		}
	}

	public function AddEmployeesMultiple(){
		if($this->session->has_userdata('LoginId')){
//var_dump($_FILES);
			if($_FILES['addemployee']['name'] != null && $_FILES['addemployee']['name'] != ""){
				$file = $_FILES['addemployee']['tmp_name'];
				$handle = fopen($file, "r");
				$array['details'] = [];
				$val = 0;
				$array['center'] = $this->input->post('centerid');

				while ($row = fgetcsv($handle)) {
//var_dump($row);
				   // if($val >0){
					if($row[0] != ""){
				   	$array['details'][$val] = $row;
				   	$val++;
				   }
				   // }
				   
				}	
				fclose($handle);
//var_dump($array);
				$url = BASE_API_URL."/settings/addMultipleEmployees/".$this->session->userdata('LoginId');
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($array));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'x-device-id: '.$this->session->userdata('x-device-id'),
						'x-token: '.$this->session->userdata('AuthToken')
					));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				// print_r($server_output);
				if($httpcode == 200){
					redirect(base_url('settings/AddMultipleEmployees'));
					// echo $server_output;
					curl_close ($ch);

				}
				else if($httpcode == 401){

				}
			}
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	function addEmployeesMul($array){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		
	}

	public function savePermission(){
		$input = $this->input->post();
		if($input != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
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

	public function syncXeroEmployees($employeeId=null){
		$input = $this->input->post();
		$data['userid'] = $this->session->userdata('LoginId');
		if(isset($input['centerid']) && $input['centerid'] != null && $input['centerid'] != "")
			$data['centerid'] = $input['centerid'];
		$url = BASE_API_URL."/xero/syncXeroEmployees/".$employeeId;
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
		// var_dump($server_output);
		// print_r($httpcode);
		if($httpcode == 200){
			echo $server_output;
			curl_close ($ch);

		}
		else if($httpcode == 401){

		}
	}

	public function getEmployeeDetails($employeeId){
		if($employeeId != null && $employeeId != ""){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$url = BASE_API_URL."settings/getEmployeeProfile/".$this->session->userdata('LoginId')."/".$employeeId;
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
				print_r($server_output);
				curl_close ($ch);

			}
			else if($httpcode == 401){

			}
		}
	}

	public function changeEmployeeCenter(){
		$input = $this->input->post();
		if($input != null){
			//footprint start
			if($this->session->has_userdata('current_url')){
				footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
				$this->session->set_userdata('current_url',currentUrl());
			}
			// footprint end
			$data['userid'] = $this->session->userdata('LoginId');
			$data['empId'] = $input['empId'];
			$data['centers'] = $input['centers'];
			$url = BASE_API_URL."settings/changeEmployeeCenter";
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
				print_r($server_output);
				if($httpcode == 200){
					print_r($server_output);
					curl_close ($ch);
				}
				else if($httpcode == 401){

				}
		}
	}

	public function permissionSettings(){	
		$data['centers'] = $this->getAllCenters();
		$data['permissions'] = $this->fetchPermissions();
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$this->load->view('permission',$data);
	}

	public function awardSettings($centerid = null){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['centers'] = $this->getAllCenters();
		if($centerid == null){
			$centerid = json_decode($data['centers'])->centers[0]->centerid;
		}
		$data['syncedWithXero'] =$this->SyncedWithXero($centerid);
		$data['awards'] = $this->getAwardSettings($data['userid'],$centerid);
		$data['permissions'] = $this->fetchPermissions();
		$data['centerid'] = $centerid;
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$this->load->view('awardSettings',$data);
	}

	function getEmployeeProfile($employeeId){
		$userid = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/settings/getEmployeeProfile/".$userid."/".$employeeId;
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

	function getEmployeeData($userid){
		$url = BASE_API_URL."/settings/getEmployeeData/".$userid;
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

	function getAwardSettings($userid,$centerid){
		$url = BASE_API_URL."/settings/getAwardSettings/".$userid."/".$centerid;
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

	public function syncXeroAwards($centerid){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/xero/syncXeroAwards/".$centerid;
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
            var_dump($server_output);
            var_dump($httpcode);
			if($httpcode == 200){
				return $server_output;
				curl_close ($ch);

			}
			else if($httpcode == 401){

		}
	}




			// Award settings end

			// Superfunds settings

	public function superfundsSettings($centerid = null){
		$data['userid'] = $this->session->userdata('LoginId');
		$data['centers'] = $this->getAllCenters();
		if($centerid == null && $data['centers'] != null){
			$centerid = json_decode($data['centers'])->centers[0]->centerid;
		}
		$data['superfunds'] = $this->getSuperfunds($data['userid'],$centerid);
		$data['syncedWithXero'] = $this->SyncedWithXero($centerid);
		$data['permissions'] = $this->fetchPermissions();
		$data['centerid'] = $centerid;
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$this->load->view('superfundSettings',$data);
	}

	function getSuperfunds($userid,$centerid){
		$url = BASE_API_URL."settings/getSuperfunds/".$userid."/".$centerid;
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

	public function  syncXeroSuperfunds($centerid){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/xero/syncXeroSuperfunds/".$centerid;
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
		$_SESSION['centerr'] = $centerid;
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

	public function leaveSettings($centerid = null){
		$data['centers'] = $this->getAllCenters();
		if($centerid == null){
			$centerid = json_decode($data['centers'])->centers[0]->centerid;
		}
		$data['syncedWithXero'] = $this->SyncedWithXero($centerid);
		$data['leaveType'] = $this->getLeaveType($centerid);
		$data['permissions'] = $this->fetchPermissions();
		$data['centerid'] = $centerid;
		$this->load->view('leaveSettings',$data);
	}

	function SyncedWithXero($centerid){
		$url = BASE_API_URL."settings/SyncedWithXero/".$centerid."/".$this->session->userdata('LoginId');
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
			return 'failed';
		}
	}

	function getLeaveType($centerid){
		$url = BASE_API_URL."leave/GetLeaveTypesByCenter/".$this->session->userdata('LoginId')."/".$centerid;
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
			return 'failed';
		}
	}

	public function addLeaveType(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			//var_dump($form_data);
			$data['leaveId'] = $form_data['leaveId'];
			$data['name'] = $form_data['leaveName'];
			$data['slug'] = $form_data['leaveSlug'];
			if(!isset($form_data['show_in_payslips']))
				$data['showOnPaySlipYN'] = "N";			
			else
				$data['showOnPaySlipYN'] = $form_data['show_in_payslips'];
			$data['isPaidYN'] = isset($form_data['leaveIsPaid']) ? "Y" : "N";
			$data['userid'] = $this->session->userdata('LoginId');

			if($data['leaveId'] == "")
				$url = BASE_API_URL."leave/createLeaveType";
			else
				$url = BASE_API_URL."leave/editLeaveType";
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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'settings/leaveSettings');
			}
			else if($httpcode == 401){

			}
		}
	}

	public function deleteLeaveType(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			//var_dump($form_data);
			$data['leaveId'] = $form_data['leaveId'];
			$data['userid'] = $this->session->userdata('LoginId');

			$url = BASE_API_URL."leave/deleteLeaveType";

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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url().'settings/leaveSettings');
			}
			else if($httpcode == 401){

			}
		}
	}

	public function xeroSettings(){
			if($this->session->has_userdata('LoginId')){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
		$data['permissions'] = $this->fetchPermissions();
		$data['xeroTokens'] = $this->fetchXeroToken();
		$data['centers'] = $this->getAllCenters();
				$this->load->view('xeroSettings',$data);
					}
			else{
				$this->load->view('redirectToLogin');
			}
	}

	public function viewEmployeeTable(){
			if($this->session->has_userdata('LoginId')){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
				$data['centers'] = $this->getAllCenters();
				$data['permissions'] = $this->fetchPermissions();
				// $data['syncedWithXero'] =$this->SyncedWithXero($centerid);
				$this->load->view('viewEmployeeTable',$data);
					}
			else{
				$this->load->view('redirectToLogin');
			}
	}

	public function updateLeaveApp(){
		$this->load->helper('form');
		$form_data = $this->input->post();
		if($form_data != null){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			//var_dump($form_data);
			$data['leaveApplication'] = $form_data['leaveId'];
			$data['status'] = $form_data['status'];
			$data['userid'] = $this->session->userdata('LoginId');

			$url = BASE_API_URL."leave/UpdateLeaveApplication";

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
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}
	}

	public function deleteCourse($courseId){
			$userid = $this->session->userdata('LoginId');
			$url = BASE_API_URL."settings/deleteCourse/$courseId/".$userid;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			//var_dump($server_output);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
			}
			else if($httpcode == 401){

			}
		}

		public function  syncXeroLeaves($centerid){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['userid'] = $this->session->userdata('LoginId');
		$url = BASE_API_URL."/xero/syncXeroLeaves/".$centerid;
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

	public function checkUserid($userid){
		$url = BASE_API_URL."settings/checkUserid/".$userid;
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
	}

		function fetchXeroToken(){
			$url = BASE_API_URL."xero/fetchXeroToken/".$this->session->userdata('LoginId');
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

		function fetchPermissions(){
			$url = BASE_API_URL."auth/fetchMyPermissions/".$this->session->userdata('LoginId');
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

	function getStates(){
		$url = BASE_API_URL."/settings/getStates/".$this->session->userdata('LoginId');
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

	// public function testRun(){
	// 	file_put_contents('application/file.png',base64_decode(base64_encode(file_get_contents("https://openthread.google.cn/images/ot-contrib-google.png"))));
	// 	}
}