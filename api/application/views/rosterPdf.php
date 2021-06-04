<?php
  $GLOBALS['rolesArray'] = $rolesArray; 
  $editRosterYN = $editRosterYN;
  $GLOBALS['roDetails'] = $rosterDetails;
  $GLOBALS['fileName'] = $file;
//    $entitlement = json_decode($entitlements);
//   $permissions = json_decode($permissions);
    require(APPPATH.'/libraries/fpdf/fpdf.php');
    if(isset($_GET['printMode']) && ($_GET['printMode'] == 'P' || $_GET['printMode'] == 'L')){
	 // $this->load->library('fpdf');
	 
	 class PDF extends FPDF
	 {
	 
	 function timex( $x)
	   { 
		   $output;
		   if(($x/100) < 12 ){
			   if(($x%100)==0){
				 if($x/1200 == 0){
				   $output = "12:00 AM";    
				 }
				 else{
				$output = sprintf("%02d",intval($x/100)) . ":00 AM";
				 }
			   }
			 if(($x%100)!=0){
			   if(($x%100) < 10){
				 $output = sprintf("%02d",intval($x/100)) .":0". $x%100 . " AM";
			   }
			   if(($x%100) >= 10){
				 $output = sprintf("%02d",intval($x/100)) .":". $x%100 . " AM";
			   }
			   }
		   }
	   else if($x/100>12){
		   if(($x%100)==0){
		   $output = sprintf("%02d",intval($x/100)-12) . ":00 PM";
		   }
		   if(($x%100)!=0 && intval($x/100)!=12){
			 if(($x%100) < 10){
			   $output = sprintf("%02d",intval($x/100)-12) .":0". $x%100 . " PM";
			 }
			 if(($x%100) >= 10){
			   $output = sprintf("%02d",intval($x/100)-12) .":". $x%100 . " PM";
			 }
		   }
		   if(($x%100)!=0 && intval($x/100)==12){
			 if(($x%100) < 10){
			   $output = sprintf("%02d",intval($x/100)) .":0". $x%100 . " PM";
			 }
			 if(($x%100) >= 10){
			   $output = sprintf("%02d",intval($x/100)) .":". $x%100 . " PM";
			 }
		   }
	   }
	   else{
	   if(($x%100)==0){
			$output = intval($x/100) . ": 00 PM";
		   }
		   if(($x%100)!=0){
			 if(($x%100) < 10){
			   $output = sprintf("%02d",intval($x/100)) . ":0". $x%100 . " PM";
			 }
			 if(($x%100) >= 10){
			   $output = sprintf("%02d",intval($x/100)) . ":". $x%100 . " PM";
			 }
		   }
	   }
	   return $output;
	 }
	   function Table()
	   {
		   $mode = $_GET['printMode'];
		   if($mode == 'L'){
			 $cellSize = 57.1428;
			 $size = 400;
			 $leftSpaceLeftImage = 10;
			 $leftSpaceRightImage = 380;
		   }
		   if($mode == 'P'){
			 $cellSize = 39.285;
			 $size = 275;
			 $leftSpaceLeftImage = 10;
			 $leftSpaceRightImage = 260;
		   }
		   $this->SetFont('Arial','B',10);
		   $roster = $GLOBALS['roDetails']->roster; 
				 $this->SetFont('Arial','B',25);
		   
		   $this->Cell($size,20,'Roster '.date('d-M-Y',strtotime($GLOBALS['roDetails']->startDate)).' To '.date('d-M-Y',strtotime($GLOBALS['roDetails']->endDate)),0,0,'C');
					 $this->Ln();
		 /* Header*/
			   $this->SetFont('Arial','B',10);
				   $this->Cell($cellSize,8,'Role',1,0,'C');
				   $this->Cell($cellSize,8,'Name',1,0,'C');
				   $rosterStartDate =  $GLOBALS['roDetails']->startDate;
			 for($i=0;$i<5;$i++){
			   $date = $GLOBALS['roDetails']->startDate;
			   $this->Cell($cellSize,8,date('D',strtotime($date.'+'.$i. 'days'))." ".'('.date('dS',strtotime($date.'+'.$i. 'days')).')',1,0,'C');
			   }
			   $this->Ln();
	 
			   $rolesArray = $GLOBALS['rolesArray'];
	 
		 foreach($roster as $ro){
		   if($ro->colorcodes != null && $ro->colorcodes != ""){
		   $color = explode(",",$ro->colorcodes);
			 }else{
			 $color = explode(",","255,255,255");
			 }
		   $this->SetFillColor(intval($color[0]),intval($color[1]),intval($color[2]));
		   $roles = $ro->roles;
		   if(count($roles)){
		   $this->Cell($size,8,$ro->areaName,1,0,'C',1);
		   $this->Ln();
		   foreach($roles as $role){
			 // print_r($role);
				 $empRoleId = $role->empRole;
				 foreach($rolesArray as $oneRole){
				   if($empRoleId == $oneRole->roleid)
					 $this->Cell($cellSize,8,$oneRole->roleName,1,0,'C');
				 }
				 if(strlen($role->empName) >= 22 && strlen($role->empName) <= 25){
				   $this->SetFont('Arial','B',8);
				   $this->Cell($cellSize,8,$role->empName,1,0,'C');
				 }
				 elseif(strlen($role->empName) >= 25 && strlen($role->empName) <= 30){
				   $this->SetFont('Arial','B',7);
				   $this->Cell($cellSize,8,$role->empName,1,0,'C');
				 }
				 elseif(strlen($role->empName) > 30){
				   $this->SetFont('Arial','B',6);
				   $this->Cell($cellSize,8,$role->empName,1,0,'C');
				 }
				   else{
					 $this->SetFont('Arial','B',10);
					 $this->Cell($cellSize,8,$role->empName,1,0,'C');
				   }
				   $this->SetFont('Arial','B',10);
				   $j = 0;
			 for($i=0;$i<5;$i++){
			 // foreach($role->shifts as $r){
			   $currentDateOfRoster = date('Y-m-d',strtotime($rosterStartDate.'+'.$i.' days'));
			   if(isset($role->shifts[$j]->startTime) || (isset($role->shifts[$j]->leaveStatus) && $role->shifts[$j]->leaveStatus == "2")){
				 if($currentDateOfRoster == $role->shifts[$j]->currentDate){
					 if(isset($role->shifts[$j]->isOnLeave) && $role->shifts[$j]->isOnLeave == 'N'){
						   $this->Cell($cellSize,8,$this->timex($role->shifts[$j]->startTime).'-'.$this->timex($role->shifts[$j]->endTime),1,0,'C');
					 }else{
						 $this->Cell($cellSize,8,"On Leave",1,0,'C');
					 }
				   $j++;
				 }
			   else{
				  $this->Cell($cellSize,8,"",1,0,'C');
				}
			   }
			   else{
				 $this->Cell($cellSize,8,"",1,0,'C');
			   }
			 }
			   $this->Ln();
			  }
		   }
		 }
	 
		 // $this->SetLeftMargin(100);
	 
	 
	   } 
	 }
	 $pdf = new PDF($_GET['printMode'],'mm','A3');
	 $pdf->AddPage();
	 $pdf->Table();
	 $fileName = "uploads/pdfs/".$GLOBALS['fileName'];
	 $pdf->Output($fileName,'F');
	  }