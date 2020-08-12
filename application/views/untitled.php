<?php

	public function getPayslipsForUser($userid){
	$headers = $this->input->request_headers();
			if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
				$this->load->model('authModel');
				$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
				if($res != null && $res->userid == $userid){
					$this->load->model('timesheetsModel');
					$payslips = $this->timesheetModel->payslipsForUser($userid);
					http_response_code(200);
					echo $timesheets;
				}
				else{
					http_response_code(401);
				}
			}
			else{
				http_response_code(401);
		}
	}

	public function getPayslip($userid,$timesheetid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if($res != null && $res->userid == $userid){
				$this->load->model('timesheetsModel');
				$employeeDetails = $this->timesheetsModel->getEmployeeDetails($userid);
				$payslipId = $this->timesheetsModel->;
				$data['payslipDetails'] = $this->timesheetsModel->getPayslipForId($userid,$payslipId);
				$slipData = $this->getPaySlipFromXero();
				http_response_code(200);
				echo $slipData;
			}
			else{
				http_response_code(401);
			}
		}
		else{
			http_response_code(401);
		}
	}

	public function getTimesheetsForUser($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from timesheet INNER JOIN payslips on  payslips.timesheetId = timesheet.id employeeId = (SELECT employeeId from employee where employeeId.userid = '$userid')");
		return $query;
	}

	public function payslipsForUser($userid){
		$this->load->database();
		$query = $this->db->query("SELECT * from payslips INNER JOIN timesheet on  payslips.timesheetId = timesheet.id employeeId = '$userid");
		return $query;
	}

	public function getPayslipForId($userid,$payslipId){
		$this->load->database();
		$query = $this->db->query("SELECT * from payslips INNER JOIN timesheet on  payslips.timesheetId = timesheet.id employeeId = '$userid");
		return $query;
	}


?>



///////////////////////////////////////////////////////////////////////////////////////////////////////////////






<!-- ------------------
				Payruns
 			------------------  -->
<?php 
				$createPayrun = "";
				$this->load->model('xeroModel');
				$xeroTokens = $this->xeroModel->getXeroToken();
				// var_dump($xeroTokens);
					if($xeroTokens != null){
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
					$createPayrun = $this->getPayRun($data,$access_token,$tenant_id);
					$createPayrun = json_decode($createPayrun);
	 					if($createPayrun != NULL){
	 						if($createPayrun->Status == 401){
	 							$refresh = $this->refreshXeroToken($refresh_token);
	 							$refresh = json_decode($refresh);
	 							$access_token = $refresh->access_token;
	 							$expires_in = $refresh->expires_in;
	 							$refresh_token = $refresh->refresh_token;
	 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
	 							$createPayrun = $this->createPayrun($data,$access_token,$tenant_id);
	 						}
	 						$createPayrun = json_decode($createPayrun);
	 					}
	 						var_dump($createPayrun);
	 				}

if(isset($createPayrun->PayRuns)){
	foreach($createPayrun->PayRuns as $payrun){
		$pays['payRunID'] = $payrun->PayRunID; 
		$pays['payrollCalendarID'] = $payrun->PayrollCalendarID; 
		$pays['payRunPeriodStartDate'] = date("Y-m-d",strtotime(explode("+","", str_replace("/Date(","", $payrun->PayRunPeriodStartDate))[0]); 
		$pays['payRunPeriodEndDate'] = date("Y-m-d",strtotime(explode( "+", "", str_replace("/Date(","", $payrun->PayRunPeriodEndDate))[0]);
		$pays['paymentDate'] = date("Y-m-d",strtotime(explode( "+", "", str_replace("/Date(","", $payrun->PaymentDate))[0]);
		$pays['payRunStatus'] = $payrun->PayRunStatus; 
		$pays['updatedDateUTC'] = date("Y-m-d",strtotime(explode( "+", "", str_replace("/Date(","",$payrun->UpdatedDateUTC))[0]);
	}
}





function createPayrun($data,$access_token,$tenant_id){
	$url = "https://api.xero.com/payroll.xro/1.0/PayRuns";
	$data = '[
				{
				   "PayrollCalendarID": "64a93cd0-70ab-4b95-a7e5-865c0fa91a01"
				}  
			]';
		$ch =  curl_init($url);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
			'Content-Type:application/json',
			'Authorization:Bearer '.$access_token,
			'Xero-tenant-id:'.$tenant_id
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		$server_output = curl_exec($ch);
		return $server_output;
	}




				$this->load->model('xeroModel');
				$xeroTokens = $this->xeroModel->getXeroToken();
				// var_dump($xeroTokens);
					if($xeroTokens != null){
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
					$getPayruns = getPayRun($payrunID,$access_token,$tenant_id);
					$getPayruns = json_decode($val);
	 					if($getPayruns != NULL){
	 						if($val->Status == 401){
	 							$refresh = $this->refreshXeroToken($refresh_token);
	 							$refresh = json_decode($refresh);
	 							$access_token = $refresh->access_token;
	 							$expires_in = $refresh->expires_in;
	 							$refresh_token = $refresh->refresh_token;
	 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
	 							$getPayruns = $this->getPayRun($payrunID,$access_token,$tenant_id);
	 						}
	 					}
	 						 				var_dump($getPayruns);
	 				}


isset($getPayruns)
foreach($getPayruns->PayRuns as $payrun){
	$pay['PayRunID'] = $payrun->PayRunID;
	$pay['PayrollCalendarID'] = $payrun->PayrollCalendarID;
	$pay['PayRunPeriodStartDate'] = date("Y-m-d",strtotime(explode( "+", "", str_replace("/Date(","",$payrun->PayRunPeriodStartDate))[0]));
	$pay['PayRunPeriodEndDate'] = date("Y-m-d",strtotime(explode( "+", "", str_replace("/Date(","",$payrun->PayRunPeriodEndDate))[0]));
	$pay['PaymentDate'] = $payrun->PaymentDate;
	$pay['Wages'] = $payrun->Wages;
	$pay['Deductions'] = $payrun->Deductions;
	$pay['Tax'] = $payrun->Tax;
	$pay['Super'] = $payrun->Super;
	$pay['Reimbursement'] = $payrun->Reimbursement;
	$pay['NetPay'] = $payrun->NetPay;
	$pay['PayRunStatus'] = $payrun->PayRunStatus;
	$pay['UpdatedDateUTC'] = $payrun->UpdatedDateUTC;
		foreach($payrun->Payslips as $payslip){
			$emp['EmployeeID'] = $Payslips->EmployeeID;
			$emp['PayslipID'] = $Payslips->PayslipID;
			$emp['FirstName'] = $Payslips->FirstName;
			$emp['LastName'] = $Payslips->LastName;
			$emp['Wages'] = $Payslips->Wages;
			$emp['Deductions'] = $Payslips->Deductions;
			$emp['Tax'] = $Payslips->Tax;
			$emp['Super'] = $Payslips->Super;
			$emp['Reimbursements'] = $Payslips->Reimbursements;
			$emp['NetPay'] = $Payslips->NetPay;
			$emp['UpdatedDateUTC'] = date("Y-m-d",strtotime(explode( "+", "", str_replace("/Date(","",$Payslips->UpdatedDateUTC))[0]));
			$timesheetid = $this->timesheetModel->getTimesheetForPayrun($pay['PayRunPeriodStartDate'] , $pay['PayRunPeriodEndDate'],$emp['EmployeeID']);
				$this->timesheetModel->insertPayslips($timesheetid->id,$Payslips->EmployeeID,$Payslips->PayslipID,$payrun->PayRunID,$pay['PayRunPeriodStartDate']);
		}
}

		function getPayRun($payrunID,$access_token,$tenant_id){
			$url = "https://api.xero.com/payroll.xro/1.0/PayRuns/".$payrunID;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
				'Content-Type:application/json',
				'Authorization:Bearer '.$access_token,
				'Xero-tenant-id:'.$tenant_id
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

      




	public function postTimesheetToXero($timesheetId,$userid){
		$headers = $this->input->request_headers();
		if($headers != null && array_key_exists('x-device-id', $headers) && array_key_exists('x-token', $headers)){
			$this->load->model('authModel');
			$res = $this->authModel->getAuthUserId($headers['x-device-id'],$headers['x-token']);
			if( $res != null && $res->userid == $userid){
				$this->load->model('timesheetModel');
				$this->load->model('settingsModel');
				$this->load->model('rostersModel');
				$this->load->model('utilModel');

				$timesheet = $this->timesheetModel->getTimesheet($timesheetId);
				// var_dump($timesheet);
				$userDetails = $this->utilModel->getUserDetails($userid);
				// var_dump($userDetails);
				$usersList = $this->timesheetModel->getUsersByTimesheetId($timesheetId);
				// var_dump($usersList);
				$startDate = new DateTime($timesheet->startDate);
				$endDate = new DateTime($timesheet->endDate);
				$startDate = "/Date(".$startDate->format('Uu')."+0000)/";
				$endDate = "/Date(".$endDate->format('Uu')."+0000)/";
				$Timesheets['Timesheets'] = [];
				// var_dump($usersList);
				foreach ($usersList as $user) {
					// var_dump($user);
					$payrollTypes = $this->timesheetModel->getPayrollShiftTypesByUser($timesheetId,$user->userid);
					$employeeDetails = $this->timesheetModel->getEmployeeDetails($user->userid);
					// var_dump($employeeDetails);
					$sheet = [];
					$sheet['StartDate'] = $startDate;
					$sheet['EndDate'] = $endDate;
					$sheet['EmployeeID'] = isset($employeeDetails->xeroEmployeeId) ? $employeeDetails->xeroEmployeeId : '';
					$sheet['TimesheetLines'] = [];
					// var_dump($sheet);
					foreach ($payrollTypes as $payrollType){
						$currentDay = 0;
						$lines = [];
						// var_dump($payrollType);
					$lines['earningRateId'] = "0fc1b165-938a-4992-8145-5f2e2e698235";
					$lines['NumberOfUnits'] = [];
						while ($currentDay < 14) {
							$unit = 0;
							$currentDate = date( "Y-m-d", strtotime( "$timesheet->startDate +$currentDay day" ));
							$payrollShifts = $this->timesheetModel->getPayrollShiftsById($timesheetId,$currentDate,$user->userid,$payrollType->payrollType);
							if($payrollShifts != null && $payrollShifts != ''){
								// var_dump($payrollShifts);
								foreach ($payrollShifts as $payrollShift) {
									$unit = (intval($payrollShift->clockedOutTime) - intval($payrollShift->clockedInTime))/100;
								array_push($lines['NumberOfUnits'],$unit);
								}
							}
								else{
									array_push($lines['NumberOfUnits'],0);
								}
							$currentDay++;
						}
						// var_dump($lines);
							array_push($sheet['TimesheetLines'],$lines);
						}
						// var_dump($sheet);
						array_push($Timesheets['Timesheets'],$sheet);
					}
					// print_r($Timesheets['Timesheets']);
				$this->load->model('payrollModel');
				$this->load->model('xeroModel');
				$xeroTokens = $this->xeroModel->getXeroToken();
				// var_dump($xeroTokens);
					if($xeroTokens != null){
						$access_token = $xeroTokens->access_token;
						$tenant_id = $xeroTokens->tenant_id;
						$refresh_token = $xeroTokens->refresh_token;
					$val = $this->postTimesheetDataToXero($Timesheets,$access_token,$tenant_id);
					$val = json_decode($val);
	 					if($val != NULL){
	 						if($val->Status == 401){
	 							$refresh = $this->refreshXeroToken($refresh_token);
	 							$refresh = json_decode($refresh);
	 							$access_token = $refresh->access_token;
	 							$expires_in = $refresh->expires_in;
	 							$refresh_token = $refresh->refresh_token;
	 							$this->xeroModel->insertNewToken($access_token,$refresh_token,$tenant_id,$expires_in);
	 							$val = $this->postTimesheetDataToXero($Timesheets,$access_token,$tenant_id);
	 						}
	 					}
	 						 				var_dump($val);
	 				}

				$data['Status'] = "SUCCESS";
				http_response_code(200);
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






