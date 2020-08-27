<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roster extends CI_Controller {

	public function index(){
		if($this->session->has_userdata('LoginId')){
			redirect('roster/roster_dashboard');
				}
		else{
			$this->load->view('redirectToLogin');
		}
	}

public function roster_dashboard(){
  if($this->session->has_userdata('LoginId')){
  	if(!isset($_GET['center'])){
							$id = 0;
							$oldid=1;
						}else{
							$id = $_GET['center'];
							$id = intval($id)-1;
							$oldid = $id;
						}
		$var['id'] = $id;
		$var['centerId'] = $oldid;
		$var['userId'] 	= $this->session->userdata('LoginId');
		if( $this->getAllCenters() != 'error'){
			$var['centers'] = $this->getAllCenters();
			$var['center__'] = json_decode($var['centers'])->centers[$id]->centerid;
			$var['rosters'] = $this->getPastRosters(json_decode($var['centers'])->centers[$id]->centerid);
			}
			else{
				$var['error'] = 'error';
			}
		$var['entitlement'] = $this->getAllEntitlements($var['userId']);
	// if($this->session->userdata('UserType') == SUPERADMIN ){
	// 	if(!isset($_GET['center'])){
	// 						$id = 0;
	// 						$oldid=1;
	// 					}else{
	// 						$id = $_GET['center'];
	// 						$id = intval($id)-1;
	// 						$oldid = $id;
	// 					}
	// 	$var['id'] = $id;
	// 	$var['centerId'] = $oldid;
	// 	$var['userId'] 	= $this->session->userdata('LoginId');
	// 	if( $this->getAllCenters() != 'error'){
	// 		$var['centers'] = $this->getAllCenters();
	// 		$var['rosters'] = $this->getPastRosters(json_decode($var['centers'])->centers[$id]->centerid);
	// 		}
	// 		else{
	// 			$var['error'] = 'error';
	// 		}
	// 	$var['entitlement'] = $this->getAllEntitlements($var['userId']);
	// }
	// else if($this->session->userdata('UserType') == ADMIN ){
		
	// 	$var['userId'] 	= $this->session->userdata('LoginId');
	// 	$var['centers'] = $this->getAllCenters();
	// 	$var['rosters'] = $this->getPastRosters(json_decode($var['centers'])->centers[0]->centerid);
	// 	$var['cents'] = json_decode($var['centers'])->centers[0]->centerid;
	// 	$var['entitlement'] = $this->getAllEntitlements($var['userId']);
	// 		}
	// else{
	// 	$var['userId'] 	= $this->session->userdata('LoginId');
	// 	$var['userType'] = $this->session->userdata('UserType');
	// 	$var['centers'] = $this->getAllCenters();
	// 	$var['rosters'] = $this->getPastRosters("1");
	// 	$var['entitlement'] = $this->getAllEntitlements($var['userId']);
	// }
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
	$var['permissions'] = $this->fetchPermissions();
			$this->load->view('rosterView',$var);

	}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	public function changePriority(){
		if($this->session->has_userdata('LoginId')){
			$this->load->helper('form');
			$form_data = $this->input->post();
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		if($form_data != null){
			$data['areaid'] = $this->input->post('areaid');
			$data['newid'] = $this->input->post('priority');
		 		$url = BASE_API_URL."/Rosters/changePriority/".$this->session->userdata('LoginId');
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
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url("roster/roster_dashboard"));
			}
			else if($httpcode == 401){

			}
		}
	}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	function getPastRosters($centerId = 1){
		$url = BASE_API_URL."/rosters/getPastRosters/".$centerId."/".$this->session->userdata('LoginId');
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

public function getRosterDetails(){
	if($this->session->has_userdata('LoginId')){
		$data['rosterid'] = $this->input->get('rosterId');
		$data['userid'] = $this->session->userdata('LoginId');
		$data['centers'] = $this->getAllCenters();
		$data['entitlements'] = $this->getAllEntitlements($data['userid']);
		$data['rosterDetails'] = $this->getRoster($data['rosterid'],$data['userid']);
		$data['permissions'] = $this->fetchPermissions();
		$data['casualEmployees'] = $this->getCasualEmployees($data['rosterid']);
			//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
		if( $this->getAllCenters() != 'error'){
			// $var['centers'] = $this->getAllCenters();
			}
			else{
				$data['error'] = 'error';
			}
			$this->load->view('rosterData',$data);
		}
		else{
			$this->load->view('redirectToLogin');
		}
	}

	 function getCasualEmployees($rosterid){
			$url = BASE_API_URL."/rosters/getCasualEmployees/".$rosterid."/".$this->session->userdata('LoginId');
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

 public function addCasualEmployee(){
 	$form_data = $this->input->post();
	if($form_data != null){
		$data['date'] = $this->input->post('date');
		$data['roster_id'] = $this->input->post('roster_id');
		$data['emp_id'] = $this->input->post('emp_id');
		$data['casualEmp_start_time'] = $this->input->post('casualEmp_start_time');
		$data['casualEmp_end_time'] = $this->input->post('casualEmp_end_time');
		$data['casualEmp_role_id'] = $this->input->post('casualEmp_role_id');
	 		$url = BASE_API_URL."/Rosters/addCasualEmployee/".$this->session->userdata('LoginId');
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
			// $jsonOutput = json_decode($);
			curl_close ($ch);
			echo $server_output;
		}
		else if($httpcode == 401){

		}
	}		
}

	 function getRoster($rosterid,$userid){
		
		$url = BASE_API_URL."/rosters/getRoster/".$rosterid."/".$userid;
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

	public function addNewShift(){
		if($this->session->has_userdata('LoginId')){
		$this->load->helper('form');
		$form_data = $this->input->post();
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		if($form_data != null){
		$data['date'] = $this->input->post('date');
		$data['roster_id'] = $this->input->post('roster_id');
		$data['emp_id'] = $this->input->post('emp_id');
		$data['add_start_time'] = $this->input->post('add_start_time');
		$data['add_end_time'] = $this->input->post('add_end_time');
		$data['add_role_id'] = $this->input->post('add_role_id');
		$data['userid'] = $this->session->userdata('LoginId');
		// print_r($data);
		 		$url = BASE_API_URL."Rosters/addNewShift";
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
				echo "success";
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


public function createRoster(){
		if($this->session->has_userdata('LoginId')){
		$this->load->helper('form');
		$form_data = $this->input->post();
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		if($form_data != null){
			$date = date_create($this->input->post('roster-date'));
			$data['startDate'] = date_format($date,"Y-m-d");
			$data['centerid'] = $this->input->post('centerId');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['staff'] = $this->getUsers();
			$data['message'] = $this->input->post('message');

		 		$url = BASE_API_URL."/Rosters/createRoster";
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
				$jsonOutput = json_decode($server_output);
				curl_close ($ch);
				redirect(base_url("roster/roster_dashboard"));
			}
			else if($httpcode == 401){

			}

		}
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

public	function updateShift(){

		if($this->session->has_userdata('LoginId')){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
			$data['startTime'] = $this->input->post('startTime');
			$data['endTime'] = $this->input->post('endTime');
			$data['status'] = $this->input->post('status');
			$data['roleid'] = $this->input->post('roleid');
			$data['shiftid'] = $this->input->post('shiftid');
			$data['userid'] = $this->session->userdata('LoginId');
			$data['message'] = addslashes($this->input->post('message'));

			$url = BASE_API_URL."rosters/updateShift";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			 curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
				
				curl_close ($ch);
			}
			else if($httpcode == 401){
				

			}
		}
		else{
			$this->load->view('redirectToLogin');
		}
		}

	function getUsers(){
		$url = BASE_API_URL."messenger/getUsers/".$this->session->userdata('LoginId');
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

public function updateRoster(){
	if($this->session->has_userdata('LoginId')){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
		$data['userid'] = $this->input->post('userid');
		$data['rosterid'] = $this->input->post('rosterid');
		$data['status'] = $this->input->post('status');	
		$url = BASE_API_URL."rosters/updateRoster";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'x-device-id: '.$this->session->userdata('x-device-id'),
			'x-token: '.$this->session->userdata('AuthToken')
			));
		$server_output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpcode == 200){
		$jsonOutput = json_decode($server_output);
		curl_close ($ch);
		}
		else if($httpcode == 401){
	
		}
	}
		else{
			$this->load->view('redirectToLogin');
		}
}

	public	function deleteShift($shiftId){
		if($this->session->has_userdata('LoginId')){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
			$userid = $this->session->userdata('LoginId');
			$url = BASE_API_URL."rosters/deleteShift/".$shiftId."/".$userid;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			 curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if($httpcode == 200){
					curl_close ($ch);
				}
				else if($httpcode == 401){
					}
				}
		else{
			$this->load->view('redirectToLogin');
			}
		}

function getAllEntitlements($userid){
		$url = BASE_API_URL."payroll/getAllEntitlements/".$this->session->userdata('LoginId');
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

	public function saveRosterPermissions(){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
			$userid = $this->session->userdata('LoginId');
			$data['employeeId'] = $this->input->post('employeeId');
			$data['editRoster'] = $this->input->post('editRoster');	
			$data['rosterId'] = $this->input->post('rosterId');
			$url = BASE_API_URL."rosters/saveRosterPermissions/".$userid;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
				));
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if($httpcode == 200){
			$jsonOutput = json_decode($server_output);
			curl_close ($ch);
			}
			else if($httpcode == 401){
		
			}
	}

	public function getRosterPermissions($employeeId,$rosterId){
		//footprint start
		if($this->session->has_userdata('current_url')){
			footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
			$this->session->set_userdata('current_url',currentUrl());
		}
		// footprint end
			$userid = $this->session->userdata('LoginId');
			$url = BASE_API_URL."rosters/getRosterPermissions/".$employeeId.'/'.$rosterId.'/'.$userid;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$this->session->userdata('x-device-id'),
				'x-token: '.$this->session->userdata('AuthToken')
			));
			$server_output = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// echo $httpcode;
			if($httpcode == 200){
			echo $server_output;
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

}