<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	 function footprint( $currentUrl,$previousUrl,$userid,$type){
		$data['currentUrl'] = $currentUrl;
		$data['previousUrl'] = $previousUrl;
		$data['userid'] = $userid;
		$data['type'] = $type;
		$data['ip'] = getIpAddress();
		$url = BASE_API_URL."Util/footprint";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'x-device-id: '.$_SESSION['x-device-id'],
				'x-token: '.$_SESSION['AuthToken']
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

	 function currentUrl(){
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			$url = "https://";   
		else  
		    $url = "http://";
		$url.= $_SERVER['HTTP_HOST'];  
		$url.= $_SERVER['REQUEST_URI'];  
			$currentUrl = $url;
			return $currentUrl;
	}

		function getIpAddress(){
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){
					$ip_address = $_SERVER['HTTP_CLIENT_IP'];
				}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
					$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
			else{
				$ip_address = $_SERVER['REMOTE_ADDR'];
				}
				return $ip_address;
	}