<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index(){
	//footprint start
	if($this->session->has_userdata('current_url')){
		footprint(currentUrl(),$this->session->userdata('current_url'),$this->session->userdata('LoginId'),'LoggedIn');
		$this->session->set_userdata('current_url',currentUrl());
	}
	// footprint end
	if($this->getUsers() != 'error'){
		$data['centers'] = $this->getAllCenters();
		if(!isset($_GET['centerid'])){
			if(!isset($_SESSION['centerr'])){
				$id = json_decode($data['centers'])->centers[0]->centerid;
				$_SESSION['centerr'] = $id;
			}else{
				$id = $_SESSION['centerr'];
			}
		}else{
			$id = $_GET['centerid'];
			$_SESSION['centerr'] = $id;
		}
		$data['users'] = $this->getUsers();
		// Need to pass center
		$data['meetings'] = $this->getMeetings($id);
		// Need to pass center
		$data['calendar'] = $this->getCalendar($id);
		$cal = json_decode($data['calendar']);
		// print_r($cal->event[0][2]);die();
		if($cal != null){
			$ar = [];
			$arr = [];
			$store = (Object)[];
			$x=0;
			foreach($cal->event[0] as $key=>$calEvent){
				if(!in_array($calEvent->start,$ar)){
					array_push($ar,$calEvent->start);
					array_push($arr,$calEvent);
				}else{
					if(isset($store->{$calEvent->start})){
						$store->{"$calEvent->start"} = $store->{"$calEvent->start"} + 1;
					}else{
						$store->{"$calEvent->start"} = 1;
					}
					// \array_splice($cal->event[0],$key,$key);
					// $key--;
				}
				$x++;
			}

			foreach($store as $key => $val){
				$ob = (object)[];
				$ob->title = "+$val Events";
				$ob->start = "$key"; 
				if($ob != null){
					$ob = (array)$ob;
					array_push($arr,$ob);
				}
			}

		}
		$cal->event[0] = $arr;
		$data['calendar'] = json_encode($cal);

		// Need to pass center
		$data['moduleEntryCount'] = $this->moduleEntryCounts($id);
		$data['footprints'] = $this->getFootprints($this->session->userdata('LoginId'));
		$data['permissions'] = $this->fetchPermissions();
	}
	else{
		$data['error'] = 'error';
	}
		$this->load->view('dashboard',$data);
	}


    public function getMeetings($centerid){
        $url =  BASE_API_URL."mom/getMeetings/$centerid/".$this->session->userdata('LoginId');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
        ));
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch , CURLINFO_HTTP_CODE);
        if($httpcode == 200){
            return $server_output;
            curl_close($ch);
        }
        else if($httpcode == 401){
                }
    }

	public function getEventsByDate($date,$centerid){
        $url =  BASE_API_URL."Dashboard/getEventsByDate/$date/$centerid/".$this->session->userdata('LoginId');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'x-device-id: '.$this->session->userdata('x-device-id'),
            'x-token: '.$this->session->userdata('AuthToken')
        ));
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch , CURLINFO_HTTP_CODE);
        if($httpcode == 200){
            echo $server_output;
            curl_close($ch);
        }
        else if($httpcode == 401){
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

	function getCalendar($centerid){
		$url = BASE_API_URL."Dashboard/calendarDetails/$centerid/".$this->session->userdata('LoginId');
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

	function moduleEntryCounts($centerid){
		$url = BASE_API_URL."Dashboard/moduleRowCounts/$centerid/".$this->session->userdata('LoginId');
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

			// To find center
		// function getUserDetails($userid){
		// 	$url = BASE_API_URL."Util/getUserDetails/".$userid;
		// 	$ch = curl_init($url);
		// 	curl_setopt($ch, CURLOPT_URL,$url);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 		'x-device-id: '.$this->session->userdata('x-device-id'),
		// 		'x-token: '.$this->session->userdata('AuthToken')
		// 	));
		// 	$server_output = curl_exec($ch);
		// 	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// 	if($httpcode == 200){
		// 		return $server_output;
		// 		curl_close ($ch);
		// 	}
		// 	else if($httpcode == 401){

		// 	}
		// }

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
     		 return 'error';
		}
		else{
     		 return 'error';
		}
	}

}