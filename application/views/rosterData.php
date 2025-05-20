<?php 
  $GLOBALS['rolesArray'] = json_decode($roles); 
   $rosterDetails = json_decode($rosterDetails); 
   $editRosterYN = $rosterDetails->isEditYN;
   $GLOBALS['roDetails'] = $rosterDetails;
//    $entitlement = json_decode($entitlements);
   $permissions = json_decode($permissions);
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
      $this->Image(base_url('assets/images/icons/amigo.jpeg'),$leftSpaceLeftImage,6,60);
      $this->Cell($size,20,'Roster '.date('d-M-Y',strtotime($GLOBALS['roDetails']->startDate)).' To '.date('d-M-Y',strtotime($GLOBALS['roDetails']->endDate)),0,0,'C');
      $this->Image(base_url('assets/images/icons/Todquest_logo.png'),$leftSpaceRightImage,10,20);
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
            foreach($rolesArray->roles as $oneRole){
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
$pdf->Output();
 } 
?>

<!-- Print part End -->








<!DOCTYPE html>
<html>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
<head>
<title>Roster</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
<link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<meta content="width=device-width, initial-scale=1" name="viewport" />

<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

  <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(2) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(2)::after {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 3px;
    bottom: 0;
    content: "";
    background: var(--orange1);
}
</style>
</head>
<body>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>


<div class="loading">
  <div class="loader"></div>
</div>

<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
		<div class="containers scrollY" id="containers">
			<div class="rosterContainer ">
				<div class="d-flex pageHead heading-bar" id="center-id" c_id="<?php echo isset($rosterDetails->centerid) ? $rosterDetails->centerid : null; ?>">
				<div class="withBackLink">
					<a href="<?php echo base_url('roster/roster_dashboard');?>">
					<span class="material-icons-outlined">arrow_back</span>
					</a>				
					<span class="events_title">Rosters</span>
				</div>
					<span class=" rightHeader">
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?>
							<button class="editPermission-btn btn btn-default btn-small btnOrange">Permission</button>
							<button class="casualEmploye-btn btn btn-default btn-small btnBlue">Add Employee</button>
							<button class="priority-btn btn btn-default btn-small">
								<span class="material-icons-outlined">sort</span> Priority
							</button>
							<label for="budgetId" class="btn btn-default btn-small btnYellow">Hide Budget&nbsp;&nbsp;<input id="budgetId" type="checkbox" class="showBudget-btn"
								show-budget="<?php 
									if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'Y'){
										echo 'N';
									}
									if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'N'){
										echo 'Y';
									} ?>" <?php 
									if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'Y'){
										echo '';
									}
									if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') == 'N'){
										echo 'checked';
									}
									?>></label>
								<!-- Hide budget -->								
						<?php } ?>  

							<div class="dropdownPrint">
								<button class="print-btn btn btn-default btn-small btnGreen">
									<span class="material-icons-outlined">print</span> Print
								</button>
								<span class="print-hidden-btn">
									<button class="print-landscape btn btn-default btn-small" ><a href="<?php echo base_url('roster/printRosterPDF/'.$rosterid.'/L'); ?>" target="_blank">Landscape</a></button>
									<button class="print-portrait btn btn-default btn-small" ><a href="<?php echo base_url('roster/printRosterPDF/'.$rosterid.'/P'); ?>" target="_blank">Portrait</a></button>
								</span>
							</div>
					</span>
			</div>
		<div class="roster-dates">
			<a href="<?php if($previousRecord == "") { echo 'javascript:void(0);'; }else{ echo base_url('roster/getRosterDetails?rosterId='.$previousRecord.'&showBudgetYN=N'); } ?>" style="all:unset;cursor:pointer;">
				<span class="material-icons-outlined">first_page</span>
			</a>
			<?php 

				//PHP functions //

				function timex( $x) { 
					$output;
					if(($x/100) < 12 ){
						if(($x%100)==0){
							if($x/1200 == 0){
							$output = "12:00 AM";    
							}
							else{
						$output = intval($x/100) . ":00 AM";
							}
						}
						if(($x%100)!=0){
						if(($x%100) < 10){
							$output = intval($x/100) .":0". $x%100 . " AM";
						}
						if(($x%100) >= 10){
							$output = intval($x/100) .":". $x%100 . " AM";
						}
						}
					} else if($x/100>12){
						if(($x%100)==0){
							$output = intval($x/100)-12 . ":00 PM";
						}
						if(($x%100)!=0 && intval($x/100)!=12){
							if(($x%100) < 10){
								$output = intval($x/100)-12 .":0". $x%100 . " PM";
							}
							if(($x%100) >= 10){
								$output = intval($x/100)-12 .":". $x%100 . " PM";
							}
						}
						if(($x%100)!=0 && intval($x/100)==12){
							if(($x%100) < 10){
								$output = intval($x/100) .":0". $x%100 . " PM";
							}
							if(($x%100) >= 10){
								$output = intval($x/100) .":". $x%100 . " PM";
							}
						}
					} else{
						if(($x%100)==0){
							$output = intval($x/100) . ": 00 PM";
						}
						if(($x%100)!=0){
							if(($x%100) < 10){
							$output = intval($x/100) . ":0". $x%100 . " PM";
							}
							if(($x%100) >= 10){
							$output = intval($x/100) . ":". $x%100 . " PM";
							}
						}
					}
					return $output;
				}

				function dateToDay($date){
					$date = explode("-",$date);
					return date(", M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
				}

				//PHP functions //
				if(isset($rosterDetails->startDate)){
					$str1 = $rosterDetails->startDate;
					if(isset($rosterDetails->endDate)){
						$str2 = $rosterDetails->endDate; 
						$v1 = explode("-",$str1);
						$v2 = explode("-",$str2);
						echo date("M d",mktime(0,0,0,$v1[1],intval($v1[2]),(intval($v1[0]))))." to ". 
						date("M d , Y",mktime(0,0,0,$v2[1],intval($v2[2]),(intval($v2[0]))));
					}
				} ?> 

				<a href="<?php if($nextRecord == ""){ echo 'javascript:void(0)'; }else{ echo base_url('roster/getRosterDetails?rosterId='.$nextRecord.'&showBudgetYN=N'); }?>" style="all:unset;cursor:pointer;">
					<span class="material-icons-outlined">
					last_page
					</span>
				</a>

		</div>
		<div class="table-div pageTableDiv hideScroll" style="height: calc(100vh - 214px); overflow: auto; ">
			<table>
				<tr class="day-row">
					<th id="table-id-1" class="day" style="width:16vw">Employees</th>	
						<?php $x=0;
						if(isset($rosterDetails->startDate)){
							$startDate = date('Y-m-d', strtotime($rosterDetails->startDate));
						?>
					<th id="table-id-2" class="day" style="width:12vw">Mon<?php echo dateToDay($rosterDetails->startDate) ?></th>
					<th id="table-id-3" class="day"  style="width:12vw">Tue<?php  
						$endDate = date( "Y-m-d", strtotime( "$startDate +1 day" ));
						echo dateToDay($endDate); ?></th>
					<th id="table-id-4" class="day"  style="width:12vw">Wed<?php 
						$endDate = date( "Y-m-d", strtotime( "$startDate +2 day" ));
						echo dateToDay($endDate); ?></th>
					<th id="table-id-5" class="day"  style="width:12vw">Thu<?php 
						$endDate = date( "Y-m-d", strtotime( "$startDate +3 day" ));
						echo dateToDay($endDate); ?></th>
					<th id="table-id-6" class="day" style="width:12vw">Fri<?php 
						$endDate = date( "Y-m-d", strtotime( "$startDate +4 day" ));
						echo dateToDay($endDate); }?></th>
					<th id="table-id-7" class="day"  style="width:12vw">
						<span class="column_budget">
							<span class="row d-flex justify-content-center m-0">Budget </span>
							<span class="row d-flex justify-content-center m-0" style="font-size:0.7rem">(Emp wise)</span>
						</span>
					</th>
				</tr>
			
					<?php if(isset($rosterDetails->roster)){
						$count = count($rosterDetails->roster);
					}
					else $count = 0;


					if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){
					$CI = 0; // CI == Current Index
					for($x=0;$x<$count;$x++){  ?>
				
					<tr class="area_name_class">
						<td colspan="7" class="area-name" area-value="<?php echo $rosterDetails->roster[$x]->areaId ?> " ><?php echo $rosterDetails->roster[$x]->areaName ?>
							<span area_id="<?php echo $rosterDetails->roster[$x]->areaId; ?>" class="changeRoleOrder">
								<span class="material-icons-outlined">sort</span>
							</span>
						</td>
					</tr>
				<?php $occupancy = 0; ?>
				<?php
					if($rosterDetails->roster[$x]->isRoomYN == "Y")
						{
				?>
				<tr class="occupancy_css">
					<td>Occupancy</td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[0]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[1]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[2]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[3]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[4]->occupancy?></td>
					<td> </td>
				</tr>
				<?php 
				}
				if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){
						$value = count($rosterDetails->roster[$x]->roles);
				}
				else{
					$value=1;
				}
				$totalHours = 0;
				$_endTime_100 = 0;
				$_startTime_100 = 0;
					for($counter=0;$counter<$value;$counter++){   
				$_endTime_100 = 0;
				$_startTime_100 = 0;       
				$totalHours = 0;?>
				<tr  class="table-row">
					<td   style="width:16vw" class=" cell-boxes left-most">
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?>

						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class="icon" style="<?php echo "background:#A4D9D6; color:#000000";?>">
									<?php 
										if(file_exists("api/application/assets/profileImages/".$rosterDetails->roster[$x]->roles[$counter]->empId.".png")){
											echo "<img src='../api/application/assets/profileImages/".$rosterDetails->roster[$x]->roles[$counter]->empId.".png'>";
										}else{
											echo icon($rosterDetails->roster[$x]->roles[$counter]->empName);
										}
									?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						$variable = isset($rosterDetails->roster[$x]->roles[$counter]->hourlyRate) ? $rosterDetails->roster[$x]->roles[$counter]->hourlyRate : 0 ;
						// foreach($entitlement->entitlements as $e){
						// 		if($e->id == $userLevel ){
						// 			$variable = $e->hourlyRate;
						// 		}
			?>
			<?php } ?>
			<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
				<span class="title hourly row"><?php echo  $variable; // echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span><?php } ?>
							</span>

							<span class=""><?php // echo  $variable?></span>
						</span>
					
					</td>
				
					<?php $weeklyTotal=0; $p=0; $index=0;?>

					<?php for($fiveIterations=0;$fiveIterations<5;$fiveIterations++){
						$variable = 0;
		$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
		$variable = isset($rosterDetails->roster[$x]->roles[$counter]->hourlyRate) ? $rosterDetails->roster[$x]->roles[$counter]->hourlyRate : 0 ;
		// foreach($entitlement->entitlements as $e){
		// 	if($e->id == $userLevel ){
		// 		$variable = $e->hourlyRate;
		// 	}
		// }

		?>
		<?php 
				$date = date('Y-m-d',strtotime($rosterDetails->startDate)); 
				// print_r($date);
			$currentSequenceDate = date('Y-m-d',strtotime("$date".'+'.$fiveIterations.'days'));
			// print_r($currentSequenceDate);
			if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave)){
			  if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" )
			  	{ $currentDate = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate; }
			  else{ 
			  	if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate)){
			  	 $currentDate = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate;
			  	  }
			  	else{ $currentDate = '00-00-00';}
			  	 }
			  	}
			else{$currentDate = '00-00-00';}
			// if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave) == true){

			if($currentSequenceDate  == $currentDate){

        $_endTime_100 = isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime : 0;
          $_endTime_100 = explode(".",sprintf("%.2f",$_endTime_100/100));
          $_endTime_100 = ($_endTime_100[0])*60 + $_endTime_100[1];
        $_startTime_100 = isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime : 0;
          $_startTime_100 = explode(".",sprintf("%.2f",$_startTime_100/100));
          $_startTime_100 = ($_startTime_100[0])*60 + $_startTime_100[1];
     ?>
					<td class="shift-edit cell-boxes count-<?php echo $index+1;?> <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "leave" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status ?>"  style="width:12vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid ?>"  

					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
						<?php if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status) && $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status != "Rejected"){ 
						if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){
							?>
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>" 
					<?php } } ?>
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>" 
					 area-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->areaId;?>"
					 emp-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empId;?>"
           <?php $totalHours = $totalHours + ($_endTime_100 - $_startTime_100 ) ?>
					 >
					 <div class="cell-back-1" >
					 	<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ 	?>
					 		<span class="row m-0 d-flex"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
					 	?>
				<span class="row m-0 d-flex roster_shift_message">
					<?php echo isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message : "";?></span>
					 	<?php
		 if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status) && $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status != "Rejected"){ 
      $eT = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime;
      $sT = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime;
					  $weeklyTotal = $weeklyTotal + ($variable)/60 * ( (intval($eT/100*60) + intval($eT%100)) - (intval($sT/100*60) + intval($sT%100))); ?>
					  				
          <?php } } else{ ?>
            <span class="">
              <?php echo 'On Leave'; ?>
            </span>
        <?php     } ?>

					   </div>
					</td>
					  <?php $p++; $index++;}else{
					  	$p = $p;
					  	$index = $index+1;
					  	 ?>
					  	<td area-id="<?php echo $rosterDetails->roster[$x]->areaId;?>" date="<?php echo $currentSequenceDate; ?>" roster-id="<?php echo $rosterDetails->id; ?>" emp-id="<?php echo  $rosterDetails->roster[$x]->roles[$counter]->empId;?>" level="<?php  $rosterDetails->roster[$x]->roles[$counter]->level;?>" class="__addshift count-<?php echo $index;?>" name3="<?php echo intval(0)/100; ?>"></td>
					  	<?php
					  }  } ?>
					<td class=" " ><?php
					if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){
					 echo "$".number_format((float)$weeklyTotal, 2, '.', '');;
					}
					 ?>
           <?php if($totalHours/60 < $rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek){ ?>
          <div style="font-size:0.75rem;color:#228659"><?php echo sprintf("%.2f",($totalHours/60))."/".(isset($rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek) ? $rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek : 0) ?> hours</div>   
          <?php }else{ ?>
          <div class="orangeNoticeClass" style="font-size:0.75rem;color:#ff7c10"><?php echo sprintf("%.2f",($totalHours/60))."/".(isset($rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek) ? $rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek : 0) ?> hours</div> 
         <?php } ?>  
           </td>

				</tr>
			<?php } }  }?>


	<?php 
	if(isset($rosterDetails->roster)){
		$count = count($rosterDetails->roster);
	}
		 if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N" && $editRosterYN == "N"){
			 if(isset($rosterDetails->roster)) 
				for($x=0;$x<count($rosterDetails->roster);$x++){ ?>
				<tr >
					<td colspan="7" class="area-name"><?php echo $rosterDetails->roster[$x]->areaName ?>
						<span area_id="<?php echo $rosterDetails->roster[$x]->areaId; ?>" class="changeRoleOrder">
							<span class="material-icons-outlined">sort</span>
						</span>
					</td>
				</tr>
				<?php $occupancy = 0; 
 
					if($rosterDetails->roster[$x]->isRoomYN == "Y")
						{
				?>
				<tr class="occupancy_css">
					<td></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[0]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[1]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[2]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[3]->occupancy?></td>
					<td><?php echo $rosterDetails->roster[$x]->occupancy[4]->occupancy?></td>
					<td> </td>
				</tr>
				<?php 
			}
				$value = count($rosterDetails->roster[$x]->roles);
					$totalHours = 0;
					$_endTime_100 = 0;
					$_startTime_100 = 0;
				for($counter=0;$counter<$value;$counter++){ 
					$_endTime_100 = 0;
					$_startTime_100 = 0;       
					$totalHours = 0;
          ?>
				<tr  class="table-row">
					<td   style="width:16vw" class=" cell-boxes left-most 
      <?php if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){
        echo 'fillWithColor';
      } ?>
          ">
						
						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class=" icon" style="
									<?php	echo "background:#A4D9D6; color:#000000";?>"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						$variable = isset($rosterDetails->roster[$x]->roles[$counter]->hourlyRate) ? $rosterDetails->roster[$x]->roles[$counter]->hourlyRate : 0 ;
						// foreach($entitlement->entitlements as $e){
						// 		if($e->id == $userLevel ){
						// 			$variable = $e->hourlyRate;
						// 		} ?>
			<?php if(isset($rosterDetails->roster[$x]->roles[$counter]->empId) && $this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){ ?>
								<span class="title hourly row"><?php echo  $variable; // echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span>
							<?php } ?>
							</span>

							<span class=""><?php // echo  $variable?></span>
						</span>
					</td>
				
					<?php $weeklyTotal=0;$p=0;$index=0; ?>
					<?php for($fiveIterations=0;$fiveIterations<5;$fiveIterations++){
						$variable = 0;
		$userLevel = isset($rosterDetails->roster[$x]->roles[$counter]->level) ? $rosterDetails->roster[$x]->roles[$counter]->level : 0;
		$variable = isset($rosterDetails->roster[$x]->roles[$counter]->hourlyRate) ? $rosterDetails->roster[$x]->roles[$counter]->hourlyRate : 0 ;
		// foreach($entitlement->entitlements as $e){
		// 	if($e->id == $userLevel ){
		// 		$variable = $e->hourlyRate;
		// 	}
		// }
		?>
		<?php 
				$date = date('Y-m-d',strtotime($rosterDetails->startDate)); 
				// print_r($date);
			$currentSequenceDate = date('Y-m-d',strtotime("$date".'+'.$fiveIterations.'days'));
			// print_r($currentSequenceDate);
			if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave)){
			  if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" )
			  	{ 
			  		$currentDate = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate;
			  		 }
			  else{ 
			  	if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate)){
			  	 $currentDate = $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->currentDate;
			  	  }
			  	else{ $currentDate = '00-00-00';}
			  	 }
			  	}
			else{$currentDate = '00-00-00';}
			// if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave) == true){

			if($currentSequenceDate  == $currentDate){
        $_endTime_100 = isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime : 0;
          $_endTime_100 = explode(".",sprintf("%.2f",$_endTime_100/100));
          $_endTime_100 = ($_endTime_100[0])*60 + $_endTime_100[1];
        $_startTime_100 = isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime : 0;
          $_startTime_100 = explode(".",sprintf("%.2f",$_startTime_100/100));
          $_startTime_100 = ($_startTime_100[0])*60 + $_startTime_100[1];
				?>

					<td class="<?php if(isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status) && $this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId && $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status == 'Published'){ ?> shift-edit <?php } ?> cell-boxes count-<?php echo $index+1;?>  <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "leave" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>"  style="width:12vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid?>"  
					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
			<?php if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){ ?>
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : intval($variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100); ?>" 
					<?php } ?>
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>">
              <?php $totalHours = $totalHours + ($_endTime_100 - $_startTime_100 ) ?>
					 <div class="cell-back-1 ">
				<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ ?>
					 	<span class="row m-0 d-flex"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){ 
					  $weeklyTotal = $weeklyTotal + $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?> 
				<span class="row m-0 d-flex roster_shift_message">
					<?php echo isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message : "";?></span>
					<?php } } else{ ?>
            <span class="">
              <?php echo 'On Leave'; ?>
            </span>
			<?php		} ?>
					</div>
					</td>
 <?php $p++; $index++;}else{
					  	$p = $p;
					  		$index = $index+1;
					  	 ?>
					  	<td area-id="<?php echo $rosterDetails->roster[$x]->areaId;?>" date="<?php echo $currentSequenceDate; ?>" roster-id="<?php echo $rosterDetails->id; ?>" emp-id="<?php echo  $rosterDetails->roster[$x]->roles[$counter]->empId;?>" level="<?php  $rosterDetails->roster[$x]->roles[$counter]->level;?>" class="__addshift count-<?php echo $index;?>" name3="<?php echo intval(0)/100; ?>"></td>

										  	<?php
										  
					  }  } ?>
					<td class=" " ><?php echo "$".$weeklyTotal;?>
       
           <?php if($totalHours/60 < $rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek){ ?>
          <div style="font-size:0.75rem;color:#228659"><?php echo sprintf("%.2f",($totalHours/60))."/".(isset($rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek) ? $rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek : 0) ?> hours</div>   
          <?php }else{ ?>
          <div style="font-size:0.75rem;color:#ff7c10"><?php echo sprintf("%.2f",($totalHours/60))."/".(isset($rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek) ? $rosterDetails->roster[$x]->roles[$counter]->maxHoursPerWeek : 0) ?> hours</div> 
         <?php } ?>      
          </td>

				</tr>
			<?php 
				}  
			} 
		} ?>



			</table>
		</div>


		<div class="budget-table-parent">
		<div class="total-budget" style="<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N" && $editRosterYN == "N"){ echo "visibility:hidden;height:1px"; } ?>">
			<table>
				<tr class="total-budget-row">
					<td class="total-budget-box" style="width:16vw ">Total Budget</td>
				<td class="total-budget-box" style="width:12vw" id="count-1" >
					<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
						$
					<?php } ?>
				</td>
				<td class="total-budget-box" style="width:12vw" id="count-2">
					<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
						$
					<?php } ?>
				</td>
				<td class="total-budget-box" style="width:12vw" id="count-3">
					<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
						$
					<?php } ?>
				</td>
				<td class="total-budget-box" style="width:12vw" id="count-4">
					<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
						$
					<?php } ?>
				</td>
				<td class="total-budget-box" style="width:12vw" id="count-5">
					<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>
						$
					<?php } ?>
				</td>
					<td class="total-budget-box" style="width:12vw">---</td>
				</tr>
			</table>
		</div>


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?> 

					<?php 
				if(isset($rosterDetails->status)){
						if($rosterDetails->status === 'Draft'){ ?>
						<div class="buttons d-flex justify-content-end" style="margin-right:5%;">
							<button id="discard-roster" class="roster__ buttonn btn btn-default btn-small ">
								<span class="material-icons-outlined">close</span> Discard
							</button>
							<button id="draft-roster" class="roster__ buttonn btn btn-default btn-small btnOrange">
								<span class="material-icons-outlined">save</span> Save Draft
							</button>
							<button id="publish-roster" class="roster__ buttonn btn btn-default btn-small btnBlue">
								<span class="material-icons-outlined">file_upload</span> Publish
							</button>
						</div>
					<?php } ?>
					<?php if($rosterDetails->status === 'Published') {?>
					<div class="buttons d-flex justify-content-end">
						<button id="discard-roster" class="roster__ buttonn btn btn-default btn-small">
								<span class="material-icons-outlined">close</span> Discard</button>
						<button id="publish-roster" class="roster__ buttonn btn btn-default btn-small btnOrange">
								<span class="material-icons-outlined ">save</span> Save</button>
					</div>
					<?php } }?>
			<?php } ?>
			<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N" && $editRosterYN == "N"){ ?>
			<div class="buttons d-flex justify-content-end">
					<button id="publish-roster" class="roster__ buttonn btn btn-default btn-small btnOrange">
								<span class="material-icons-outlined">save</span> Save</button>
			</div>
				<?php } ?>
			</div>
</div>
</div>
<!--This is meant for admin-->
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?> 
	<div id="myModal" class="modal modalNew">
		<div class="modal-dialog mw-75">
	  		<!-- Modal content -->
			<div class="modal-content NewFormDesign">
				<span class="titl modal-header">
					<h3 class="d-flex box-name-space modal-title col-12">
						<span class="box-name "></span>
						<span class="box-space "></span>
					</h3>
					<!-- <span class="close col-2 d-flex align-items-center" >&times;</span> -->
				</span>
	    
				<div class="modal-body container">
					<!-- <form  id="roster-form"> -->
					<div class="col-md-12">
						<div class="form-floating">
						<input class="form-control" type="time" name="startTime" placeholder="dd-mm-yyyy" id="startTime" >
							<label for="startTime">Start Time</label>
						</div> 
					</div>
					<div class="col-md-12">
						<div class="form-floating">
							<input class="form-control" type="time" name="endTime" placeholder="dd-mm-yyyy" id="endTime" >
							<label for="endTime">End Time</label>
						</div> 
					</div>
					<div class="col-md-12">
						<div class="form-floating formFloatingSelect">
							<select  class="roster_dropdown" name="areaId" id="areaId" >
								<option >Change Area</option>
							</select>
							<label for="areaId">Area</label>
						</div> 
					</div>					
					<div class="col-md-12">
						<div class="form-floating formFloatingSelect">
							<select  name="role" id="role" class="col-7"></select>
							<label for="role">Role</label>
						</div> 
					</div>
					<div class="col-md-12">
						<div class="form-floating">
							<textarea name="message" id="message" class="form-control" type="text" placeholder="Message"></textarea>
							<label for="message">Message</label>
						</div> 
					</div>
					<input type="text" name="shiftId"  id="shiftId" style="display:none">
					<input type="text" name="roleId" id="roleId" style="display:none">
					<input type="text" name="status" value="2"  id="status" style="display:none">
					<input type="text" name="userId"   id="userId" style="display:none">
					<div class="col-md-12 mb30">
						<label class="modal_label">Days</label>
						<span class="col-md-12 edit_shift_modal">
							<span class="d-inline-block">
								<span class="mr-2">Select All</span>
								<input type="checkbox" class="d-block select_all_edit_shift m-auto" checked>
							</span>
							<span class="d-inline-block">
								<span>Mon</span>
								<input type="checkbox" name="days" value="1" class="d-block edit_shift_checkbox_space editShiftDays">
							</span>
							<span class="d-inline-block">
								<span>Tue</span>
								<input type="checkbox" name="days" value="2" class="d-block edit_shift_checkbox_space editShiftDays">
							</span>
							<span class="d-inline-block">
								<span>Wed</span>
								<input type="checkbox" name="days" value="3" class="d-block edit_shift_checkbox_space editShiftDays">
							</span>
							<span class="d-inline-block">
								<span>Thu</span>
								<input type="checkbox" name="days" value="4" class="d-block edit_shift_checkbox_space editShiftDays">
							</span>
							<span class="d-inline-block">
								<span>Fri</span>
								<input type="checkbox" name="days" value="5" class="d-block edit_shift_checkbox_space editShiftDays">
							</span>
						</span>
					</div>
					<div class="modal-footer">
						<button type="button" name="modal-cancel"  value="Cancel"  class="close buttonn btn btn-default btn-small" >
							<span class="material-icons-outlined">close</span> Close
						</button>
						<button type="button" name="shift-submit" id="shift-submit" value="Save" class="button btn btn-default btn-small btnBlue">
							<span class="material-icons-outlined">save</span> Save
						</button>
						<button type="button" name="delete_shift" id="delete_shift" value="Delete" class="buttonn btn btn-default btn-small btnOrange">
							<span class="material-icons-outlined">delete</span> Delete
						</button>
					</div>
					<div class="infoMessage">* Please select area to get roles</div>
					<!-- </form> -->
				</div>
	  		</div>
		</div>
	</div>
<?php } ?>
<!-- Till here -->

<div id="mxModal" class="modal">
 
	  <div class="modal-content">
	  	<div class="row titl">
	  		<div class="col-12 box-name-space">
		  		<div style=""  class="row box-name">Title Here </div>
		  		<div  class="row box-space">Time Here</div>
		  	</div>
		</div>
		   <form  id="user-form">	
    <div class="row p-2">
      <label class="col-4 modal_label">Days</label>
      <span class="col-7">
        <span class="d-inline-block">
          <span>All</span>
          <input type="checkbox"  class="d-block select_all_shift">
        </span>
        <span class="d-inline-block">
          <span>Mon</span>
          <input type="checkbox" name="days" value="1" class="d-block shift_checkbox_space shiftDays" >
        </span>
        <span class="d-inline-block">
          <span>Tue</span>
          <input type="checkbox" name="days" value="2" class="d-block shift_checkbox_space shiftDays" >
        </span>
        <span class="d-inline-block">
          <span>Wed</span>
          <input type="checkbox" name="days" value="3" class="d-block shift_checkbox_space shiftDays" >
        </span>
        <span class="d-inline-block">
          <span>Thu</span>
          <input type="checkbox" name="days" value="4" class="d-block shift_checkbox_space shiftDays" >
        </span>
        <span class="d-inline-block">
          <span>Fri</span>
          <input type="checkbox" name="days" value="5" class="d-block shift_checkbox_space shiftDays" >
        </span>
      </span>
    </div>
		   		<input type="text"  name="" id="starts" style="display: none">
		   		<input type="text"  name="" id="ends" style="display:none">
		 		<input type="text" name="shiftId"  id="shift-Id" style="display:none">
		 		<input type="text" name="roleId" id="role-Id" style="display:none">
		 		<input type="text" name="userId"   id="user-Id" style="display:none">
		 		<button type="button" name="user-submit" id="user-submit" value="Accept" style="width:5rem;display: inline-block !important;margin:1rem 0 !important" class="button updateShiftUser">
					<i>
						<img src="<?php echo base_url('assets/images/icons/tick.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Accept</button>
		 		<button type="button" name="user-deny" id="user-deny" style="width:5rem;display: inline-block !important;margin:1rem 0 !important" value="Deny" class="button updateShiftUser">
					<i>
						<img src="<?php echo base_url('assets/images/icons/rejected.png'); ?>" style="max-height:1rem;margin-right:10px">
					</i>Reject</button>
		 		<button type="button" name="cancel" class="button close" value="Close" style="width:5rem;display: inline-block !important;margin:1rem 0 !important">
					<i>
						<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Close</button>

		 	</form>
	  </div>
</div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="bn btn-default btn-small btnOrnage" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>

<!-- 	-----------------
		Priority Modal
 		-----------------	-->
<div class="mask" ></div>
<div class="modal_priority modal modalNew " >
	<div class="modal-dialog mw-40">
		<div class="modal-content NewFormDesign">
			<span class="modal-header" >
				<h3 class="modal-title">Edit Priority</h3>
			</span>
			<div class="modal-body">
				<div class="priority_areas">

				</div>
				<div class="modal-footer">
					<button class="close_priority btn btn-default btn-small pull-right" role="button">
						<span class="material-icons-outlined">close</span> Cancel
					</button>
					<button class="priority_save btn btn-default btn-small btnBlue pull-right">
						<span class="material-icons-outlined">save</span> Save
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 	-----------------
		Priority Modal
 		-----------------	-->


 <!-- 	-----------------
		Add Shift Modal
 		-----------------	-->
<div class="masked" ></div>
<div class="modal_priorityed modal modalNew" >
	<div class="modal-dialog mw-40">
		<div class="modal-content NewFormDesign">
			<span class="modal-header" >
				<h3 class="modal-title">Add Employee</h3>
			</span>
			<div class="modal-body">
				<?php 
					//   print_r($casualEmployees);
					$casualEmployees = json_decode($casualEmployees); ?>
					<div class="priority_areased">
						<div class="col-md-12">
							<div class="form-floating formFloatingSelectSearch">
								<select id="casualEmp_id" multiple>
								<?php foreach($casualEmployees->casualEmployees as $employee){ ?>
										<option value="<?php echo $employee->empId; ?>" ><?php echo $employee->empName;?></option>
								<?php } ?>
								</select>
								<label for="casualEmp_id">Employee</label>
							</div> 
						</div>
						<div class="col-md-12">
							<div class="form-floating">
								<input class="form-control" type="text" onfocus="(this.type='date')" placeholder="MM/DD/YY" name="" id="casualEmp_date" min="<?php echo $rosterDetails->startDate ?>" max="<?php echo date('Y-m-d',strtotime($rosterDetails->startDate.'+4 days')) ?>" >
								<label for="casualEmp_date">Date</label>
							</div> 
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-floating">
										<input type="time" class="form-control" id="casualEmp_start_time" value="09:00">
										<label for="casualEmp_start_time">Start Time</label>
									</div> 
								</div>
								<div class="col-md-6">
									<div class="form-floating">
									<input type="time" class="form-control" id="casualEmp_end_time" value="17:00">
										<label for="casualEmp_end_time">End Time</label>
									</div> 
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-floating formFloatingSelect">
								<select id="changeArea" class="casualEmploye-area-select">
									<option value="0">Change Area</option>
								</select>
								<label for="changeArea">Area</label>
							</div> 
						</div>

						<div class="col-md-12">
							<div class="form-floating formFloatingSelect">
								<select class="casualEmploye-role-select" id="casualEmp_role_id">
								
								</select>
								<label for="casualEmp_role_id">Role</label>
							</div> 
						</div>
					</div>
					<div class="modal-footer">
						<button class="close_priorityed btn btn-default btn-small pull-right" role="button">
							<span class="material-icons-outlined">close</span> Cancel
						</button>
						<button class="priority_saveed btn btn-default btnBlue btn-small pull-right">
							<span class="material-icons-outlined">save</span>Save
						</button>
					</div>
				<div class="infoMessage">* Please select area to get roles</div>
			</div>
		</div>
	</div>
</div>
<!-- 	-----------------
		Add Shift Modal
 		-----------------	-->
<!-- ---------------------
		Edit Roster Permissions
		------------------- -->
	<div class="modal_outer" >	
	</div>
	<div class="modal_body modal modalNew" >
		<div class="modal-dialog mw-40">
			<div class="modal-content NewFormDesign">
			<span class="modal-header" >
				<h3 class="modal-title">Edit Permission</h3>
			</span>
			<div class="modal-body">
				<div class="modal_main">
				<div class="col-md-12">
					<div class="form-floating formFloatingSelect">
						<select placeholder="Select Center" id="centerValue" onchange="getEmployees()" id="employeeId">
							<?php
								$centers = json_decode($centers);
								foreach($centers->centers as $center){
							?>
							<option value="<?php echo $center->centerid?>"><?php echo $center->name; ?></option>
								<?php }?>
						</select>
						<label for="centerValue">Select Center</label>
					</div> 
				</div>
				<div class="col-md-12">
					<div class="form-floating formFloatingSelectSearch">
							<select placeholder="Select Employees" id="employeeValue" onchange="getPermissions()" multiple>

							</select>
						<label for="employeeValue">Select Employees</label>
					</div> 
				</div>

					<!-- <div id="permissions_id">
						<span>
							<span><input type="checkbox" name="edit_roster" id="edit_roster"></span>
							<span><label>Edit Roster</label></span>
						</span>
					</div> -->
				</div>
				<div class="modal-footer">
					<button class="modal_close btn btn-default btn-small pull-right" role="button">
						<span class="material-icons-outlined">close</span> Cancel
					</button>
					<button id="modal_permission" class="btn btn-default btn-small btnOrange pull-right">
						<span class="material-icons-outlined">save</span> Save
					</button>
				</div>
			</div>
		</div>
		</div>
	</div>
<!-- ---------------------
		Edit Roster Permissions
		------------------- -->
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?>
<div class="masks" ></div>
<div class="modal_prioritys modal" >
	<div>
	<span class="priority_heading" >
	<a class="text-center  edit_priority" style="padding:1rem 0">Add Shift</a>
	</span>
	<div class="priority_areass">
		<!-- rosterid --> 				<!-- <input type="" name="" id="" class=""> -->
		<!-- roster date  -->		<!-- <input type="" name="" id="" class=""> -->
		<!-- userid  -->					<!-- <input type="" name="" id="" class=""> -->
		<span class="add_shift_span d-flex">
			<label class="col-5">Start Time</label>
			<input type="time" name="" id="add_start_time" class="add_start_time col-7">
		</span>
		<span class="add_shift_span d-flex">
			<label class="col-5">End Time</label>
			<input type="time" name="" id="add_end_time" class="add_end_time col-7">
		</span>
		<span class="add_shift_span d-flex">
			<label class="col-5">Area</label>
			<span class="select_css roster_dropdown_parent col-7">
				<select type="" name="" id="add_area_id" class=" roster_dropdown" style="">
					<option>Change Area</option>
				</select>
			</span>
		</span>
		<span class="add_shift_span d-flex">
			<label class="col-5">Role</label>
			<span class="select_css proper_width_select">
				<select type="" name="" id="add_role_id" class="add_role_id col-12">
					
				</select>
			</span>
		</span>

	</div>
	<div class="priority_buttonss">
  	<button class="close_priority" role="button">
			<i>
				<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Cancel</button>
  	<button class="add_shift">
			<i>
				<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
			</i>Save</button>
  </div>
	</div>
</div>


<!-- /*  ------------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */ -->

<div class="changeRolePriority_mask modal" ></div>
<div class="changeRolePriority_modal modal" >
	<span class="changeRolePriority_head" >
		<a class="text-center  changeRolePriority_heading" style="padding:1rem 0">Edit Priority</a>
	</span>
		<div class="changeRolePriority_body"></div>
		<div class="changeRolePriority_buttons">
	  	<button class="changeRolePriority_close" role="button">
				<i>
					<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Cancel</button>
	  	<button class="changeRolePriority_save">
				<i>
					<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Save</button>
	  </div>
</div>

<!-- /*  ------------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */ -->

<!-- /*  ------------------------------
      NOTICE MODAL
    ------------------------------ */ -->

<div class="modal-notice modal">
    <div class="modal-content-notice">
      <div>
          <h5>There are people with total hours more than max hours</h5>
          <h5>Do you want to contine ?</h5>
      </div>
      <div>
        <button class="notice-close buttonn">Close</button>
        <button class="notice-submit buttonn">Submit</button>
      </div>
    </div>
</div>

<!-- /*  ------------------------------
      NOTICE  MODAL
    ------------------------------ */ -->


<?php } ?>
<script type="text/javascript">

  remove_loader_icon();
    function remove_loader_icon(){
    $('.loading').hide();
  };
  function loader_icon(){
    $('.loading').show();
  };

<?php 	if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N" && $editRosterYN == "N"){ ?>

				var model = document.getElementById("mxModal");

	$(document).on('click','.shift-edit',function(){
		 model.style.display = "block";
		for(var i=1;i<=5;i++){
			var checker = $(this).parent().children(`.count-${i}`).attr('status');
			if(checker != null && checker != "Rejected" && checker != "Accepted"){
				$('.shiftDays').eq(i-1).attr('disabled',false)
				$('.shiftDays').eq(i-1).attr('checked',true)
			}else{
				$('.shiftDays').eq(i-1).attr('disabled',true)
				$('.shiftDays').eq(i-1).attr('checked',false)
			}
			console.log("check")
		}
	})

	$(document).on('click','.close',function(){
		 model.style.display = "none";
		 $('#user-form').trigger('reset');
	})
	
	$(document).on('click','.buttons',function(){
		window.location.href = "<?php echo base_url() ?>roster/roster_dashboard"
	})

	$(document).on('click','.shift-edit',function(){
		var starts = $(this).attr('stime');
		var ends = $(this).attr('etime');
		var timings = $(this).text();
		var name = $(this).index();
		var role = $(this).attr('name2');
		var userid = "<?php echo $userid ?>";
		var shiftid = $(this).attr('name4');
			document.getElementsByClassName('box-name')[0].innerHTML = $('th').eq(name).html();
			document.getElementsByClassName('box-space')[0].innerHTML = timings;
			document.getElementById('starts').value = starts; 
			document.getElementById('ends').value = ends;
			document.getElementById('role-Id').value = role;
			document.getElementById('shift-Id').value = shiftid;
	})

  $(document).ready(function(){
    
    $(document).on('click','.updateShiftUser',function(){
      var startTime = parseInt($('#starts').prop('value')) ;
      var endTime = parseInt($('#ends').prop('value'));
      var days = {};
      var day = [];
      for(var i=0;i< ($('.shift_checkbox_space').length);i++){
        obj = {};
        obj.YN = ($('.shift_checkbox_space').eq(i).is(':checked'));
        day.push(obj);
      } 
      days.day = day;
      var shiftid = $('#shift-Id').prop('value');
      var status = $(this).prop('value');
      var userid = "<?php echo $userid ?>";
      var roleid = $('#role-Id').prop('value');

console.log(startTime+" "+endTime+" "+shiftid+" "+status+" "+userid+" "+roleid)
        if(status == 'Accept'){
        status = "3";
        }
        if(status == "Deny"){
          status = "4";
        }
      url = "<?php echo base_url() ?>roster/updateShift";
        loader_icon();
		console.log(days)
		  $.ajax({
        url:url,
        type:'POST',
        data:{
          startTime:startTime,
          endTime:endTime,
          shiftid:shiftid,
          roleid:roleid,
          status:status,
          userid:userid,
          days : days
          
        },
        success:function(response){
            console.log(response)
            window.location.reload();

        }
      }).fail(function(){
          window.location.reload();
      })
    })
    
  })

<?php  } ?>


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?> 
				var modal = document.getElementById("myModal");

				$(document).on('click','.shift-edit',function(){
					if($(this).attr('status')=='Published' || $(this).attr('status')=='Added'){
					 modal.style.display = "block";
					}
				})

				$(document).on('click','.close',function(){
					 modal.style.display = "none";
					 $('#roster-form').trigger('reset');
				})
        
        $(document).on('click','.notice-close',function(){
          $('.modal-notice').css('visibility','hidden');
          $('.modal-notice').css('opacity',0)
        })  

        $(document).on('click','.notice-submit',function(){
          $('#publish-roster').click();
          $('.modal-notice').css('visibility','hidden');
          $('.modal-notice').css('opacity',0)
        })  

<?php }?>
	// function uiFunction(){
 //  if(screen.width > 768){
	//     var sideNav = document.getElementsByClassName('side-nav')[0].offsetWidth
	//     document.getElementById('containers').style.paddingLeft = 60+"px"
	//     document.getElementsByClassName("side-nav")[0].addEventListener("mouseover", mouseOver);
	//     document.getElementsByClassName("side-nav")[0].addEventListener("mouseleave", mouseLeave);
	//   }
	// 		}
	// 		function mouseOver(){
	// 		      document.getElementById('containers').style.paddingLeft = 200+"px"
	// 		}
	// 		function mouseLeave(){
	// 		      document.getElementById('containers').style.paddingLeft = 60+"px"
	// 		}
	// 		// calling the function
	// 		  uiFunction();

  $(document).on('change','.select_all_edit_shift',function(){
    var daysLength = $('.editShiftDays').length;
    if($(this).prop('checked') == false){
		for(i=0;i<daysLength;i++){
			if(typeof $('.editShiftDays').eq(i).attr('disabled') == "undefined"){
				$('.editShiftDays').eq(i).prop('checked',false);
			}
    	}
	}
    if($(this).prop('checked') == true)
      for(i=0;i<daysLength;i++){
		if(typeof $('.editShiftDays').eq(i).attr('disabled') == "undefined"){
       		$('.editShiftDays').eq(i).prop('checked','checked');
		}
      }
  })

  $(document).on('change','.select_all_shift',function(){
    var daysLength = $('.shiftDays').length;
    if($(this).prop('checked') == false){
		for(i=0;i<daysLength;i++){
			if(typeof $('.shiftDays').eq(i).attr('disabled') == "undefined"){
				$('.shiftDays').eq(i).prop('checked',false);
			}
		}
	}
    if($(this).prop('checked') == true){
		for(i=0;i<daysLength;i++){
			if(typeof $('.shiftDays').eq(i).attr('disabled') == "undefined"){
				$('.shiftDays').eq(i).prop('checked','checked');
			}
		}
	}
  })

	$(document).ready(function(){
		$(document).on('click','#delete_shift',function(){
			var shiftId = $("#shiftId").val();
      var days = [];
      var obj = {};
      for(var i=0;i< ($('.edit_shift_checkbox_space').length);i++){
        obj = {};
        obj.YN = ($('.edit_shift_checkbox_space').eq(i).is(':checked'));
        days.push(obj);
      }
			let bool = confirm("confirm delete shift?");
      if(bool == true){
              var url = "<?php echo base_url() ?>roster/deleteShift/"+shiftId;
              loader_icon()
              $.ajax({
              url : url,
              data : {
                days : days
              },
              method : 'POST',
              success: function(response){
                window.location.reload();
                // console.log(response)
              }
            })
  		}	
  	})
  })

<?php if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){ ?>

				$(document).ready(function(){
				var	total = 0;
				var count = $('.count-1').length
				console.log(count)
				for(var i=0;i<count;i++){
					if(isNaN(parseInt($('.count-1').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-1').eq(i).attr('name3'))
				}
			}
				$('#count-1').html('$'+total)
				//
				total = 0;
				 count = $('.count-2').length
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-2').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-2').eq(i).attr('name3'));
				}
			}
				$('#count-2').html('$'+total)
				//
				total = 0;
				 count = $('.count-3').length;
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-3').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-3').eq(i).attr('name3'))
					}
			}
				$('#count-3').html('$'+total)
				//
				total = 0;
				 count = $('.count-4').length
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-4').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-4').eq(i).attr('name3'))
					}
			}
				$('#count-4').html('$'+total)
				//
				total = 0;
				 count = $('.count-5').length
				 console.log(count)
				for( i=0;i<count;i++){
					if(isNaN(parseInt($('.count-5').eq(i).attr('name3')))){
						total = total;
					}
					else{
				total = total + parseInt($('.count-5').eq(i).attr('name3'))
				}
			}
				$('#count-5').html('$'+total)
				})


<?php } ?>

<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?> 

	$(document).ready(function(){


		$(document).on('click','.cell-boxes',function(){
			document.getElementsByClassName('box-name')[0].innerHTML = $(this).attr('name');
			var indexVal = $(this).index();
      var that = $(this)
			document.getElementsByClassName('box-space')[0].innerHTML = $('th').eq(indexVal).html()
			var xvalue = $(this).attr('stime');
			var yvalue = $(this).attr('etime');
			document.getElementById('startTime').value = timer(parseInt(xvalue));
			document.getElementById('endTime').value = timer(parseInt(yvalue));
			document.getElementById('userId').value = "<?php echo $userid ?>";
			document.getElementById('roleId').value = $(this).attr('name2');
			document.getElementById('shiftId').value = $(this).attr('name4');	
			let shiftid = $(this).attr('name4');
			let role = $(this).attr('name2');
			var areaId = $(this).attr('area-id');
			$('#areaId').val(areaId);
			var url = '<?php echo base_url() ?>roster/getShiftDetails/'+shiftid+'/'+role
				$.ajax({
					url: url,
					type: 'GET',
					success : function(response){
						var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var response = JSON.parse(response);
		var data = "";
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('#role').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							if(role != values.roleid ){
								 data = "<option value="+values.roleid+">"+values.roleName+"</option>";
							}
							if(role == values.roleid){
								data = "<option value="+values.roleid+" selected>"+values.roleName+"</option>";
							}

								$('#role').append(data)
										}
									})
          })
            for(var i=1;i<=5;i++){
				var checker = that.parent().children(`.count-${i}`).attr('status');
              if(checker != null && checker != "Rejected" && checker != "Accepted"){
                $('.editShiftDays').eq(i-1).attr('disabled',false)
                $('.editShiftDays').eq(i-1).attr('checked',true)
              }else{
                $('.editShiftDays').eq(i-1).attr('disabled',true)
                $('.editShiftDays').eq(i-1).attr('checked',false)
              }
            }
				}
			})
						$('#message').val(response.shiftDetails.message);
					}
				})
			})


		$(document).on('click','#shift-submit',function(){
			var startingTime = document.getElementById('startTime').value ;
			var endingTime = document.getElementById('endTime').value;
			var alpha = startingTime;
			var beta = alpha.split(':')
			var gamma = parseInt(beta[0]+beta[1]);
			var alphas = endingTime;
			var betas = alphas.split(':')
			var gammas = parseInt(betas[0]+betas[1]);
			var startTime = gamma;
			var endTime = gammas;
			var shiftid = $('#shiftId').val();
			var status = document.getElementById('status').value;
			var userid = "<?php echo $userid ?>";
			var message = $('#message').val();
      var days = [];
      var obj = {};
      for(var i=0;i<$('.edit_shift_checkbox_space').length;i++){
        obj = {};
        obj.YN = $('.edit_shift_checkbox_space').eq(i).is(':checked');
        days.push(obj);
      }
			if($('#role').val() != null || $('#role').val() !=""){
				var roleid = $('#role').val()
			}else{			
						var roleid = $('#roleId').val();
					}
			if($('#role').val() != null || $('#role').val() !=""){
				var areaid = $('#areaId').val()
			}else{			
						var areaid = $(this).attr('area-id');
					}

			url = "<?php echo base_url() ?>roster/updateShift";
			console.log(startTime + " "+ endTime +" "+ shiftid+" "+roleid+" "+status +" "+userid+" "+areaid+ "" + message)
      		loader_icon();
			$.ajax({
				url:url,
				type:'POST',
				data:{
					startTime:startTime,
					endTime:endTime,
					shiftid:shiftid,
					roleid:roleid,
					status:status,
					userid:userid,
					areaid:areaid,
					message:message,
          			days: days
				},
				success:function(response){
					console.log(response)
					$('#roster-form').trigger('reset');
					window.location.reload();
				}
			}).fail(function(){
        		window.location.reload();
      		})
		})
		
	})

	$(document).ready(function(){
		$(document).on('click','.roster__',function(){
			var url = "<?php echo base_url() ?>roster/updateRoster";
			var rosterid = "<?php echo $rosterid; ?>";
			var userid = "<?php echo $userid; ?>";

			if($(this).prop('id') == "discard-roster"){
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterid,
						status: 'Discarded'
					},
					success:function(response){
						window.location.href= "<?php echo base_url() ?>roster/roster_dashboard";
					}

				}).fail(function(){
        			window.location.reload();
      			})
			}
			if($(this).prop('id') == "draft-roster"){
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterid,
						status: 'Draft'
					}
				}).fail(function(){
       				window.location.reload();
      		})
        		window.location.href= "<?php echo base_url() ?>roster/roster_dashboard";
			}
			if($(this).prop('id') == "publish-roster"){
				// alert(rosterid+'-----'+userid+'-----'+$(this).prop('id'));
				if(($('.modal-notice').css('visibility') == 'hidden') && ($('.orangeNoticeClass').length > 0)){
					$('.modal-notice').css('visibility','visible');
					$('.modal-notice').css('opacity',1)
				}
				else{
					loader_icon();
					$.ajax({
						url:url,
						type:'POST',
						async:true,
						data:{
							userid: userid,
							rosterid: rosterid,
							status: 'Published'
						},
						success:function(response){
							// console.log(response);
							var da = jQuery.parseJSON(response);
							if(da.Status == "SUCCESS"){
								alert("Roster Published");
								window.location.href= "<?php echo base_url() ?>roster/roster_dashboard";
							}else if(da.Status == "ERROR"){
								alert(da.message);
								location.reload();
							}
						}
					})
				}
			}
		})
	})

<?php } ?>


    $('.containers').css('paddingLeft',$('.side-nav').width());

  function timer( x)
  { 
      var output="";
      if((x/100) < 12){
          if((x%100)==0 ){
            if((x/100)<10){
           output = "0"+Math.floor(x/100) + ":00" ;
         }
        if((x/100)>9){
          output = Math.floor(x/100) + ":00" ;
        }
      }
      if((x%100)!=0){
          if((x/100)<10){
            if(x%100 <10){
               output = "0"+Math.floor(x/100) + ":0" + String(x%100) ;
            }
            else{
               output = "0"+Math.floor(x/100) + ":" + String(x%100) ;
            }
          }
      }
       if((x/100)>10){
           if(x%100 <10){
               output = Math.floor(x/100) + ":0" + String(x%100) ;
            }
            else{
               output = Math.floor(x/100) + ":" + String(x%100) ;
            }
          }
      }
  
  else if((x/100)>12){
      if((x%100)==0){
      output = x/100 + ":00";
      }
      if((x%100)!=0){
        if(x%100 <10){
               output = Math.floor(x/100) +":0" + x%100 ;
            }
            else{
               output = Math.floor(x/100) +":" + x%100 ;
            }
      
      }
  }
  else{
  if((x%100)==0){
       output = Math.floor(parseInt(x/100)) + ":00";
      }
      if((x%100)!=0){
        if(x%100 <10){
               output = Math.floor(x/100) +":0" + x%100 ;
            }
            else{
               output = Math.floor(x/100) +":" + x%100 ;
            }
      }
  }
  return output;
}

	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
				response['orgchart'].forEach(function(index){
					var data = "<option value="+index.areaId+">"+index.areaName+"</option>";
					$('#areaId').append(data)
				})
			}
		}).fail(function(){
        window.location.reload();
      })
	})


	$(document).ready(function(){
		$(document).on('change','#areaId',function(){
		 var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var areaId = $(this).val();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('#role').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
								$('#role').append(data)
										}
									})
					})
				}
			}).fail(function(){
        window.location.reload();
      })
		})
	})


	$(document).ready(function(){
		let height = $('td[name2 != ""] div').eq(0).height();
		let count =	 $('td[name2 = ""]').length;
		for(let i=0;i<count;i++){
		$('td[name2 = ""] .leave').eq(i).height(height);
			}
			console.log(height)
	})

<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?> 

	$(document).ready(function(){
	  $(document).on('click','.priority-btn',function(){
		let count = $('tr').length ;
		let array = [];
		console.log(count)
		var i =0;
		for(i=1;i<count;i++){
			if($('tr').eq(i).hasClass('area_name_class') == false) {
				// $('tr').eq(i).hide()
				console.log(i)
				}
			 else{
				console.log($('tr').eq(i).text())
				array[i] = $('tr')[i].outerHTML
				// console.log(i)
			 }
		   }
		    $(".priority_areas").sortable();
			$(".priority_areas").disableSelection();
			// console.log(array)
			$(".mask").addClass("active");
			$(".priority_areas").append(array);
	   })
	})


	$(document).ready(function(){
	  $(document).on('click','.priority_save',function(){
	  	console.log($('.priority_areas tr').length);
	  	let count = $('.priority_areas tr').length ;
		console.log(count)
		var i = 0;
		let j = 0;

		for(i=0;i<count;i++){
			if($('.priority_areas tr').eq(i).hasClass('area_name_class') == true) {

				j++;
				areaid = $('.priority_areas tr td').eq(i).attr('area-value')
				priority = j;
				console.log( areaid);
		  $.ajax({
		  		url: '<?php echo base_url() ?>roster/changePriority',
		  		data: {
		  			areaid : areaid,
		  			priority : priority
		  		},
		  		type: 'POST',
		  		success: function(){
		  			closeModal()
		  			window.location.reload();
		  		}
		  	}).fail(function(){
        window.location.reload();
      })
				}}
		  })

	  })

<?php } ?>

	function closeModal(){
	  $(".mask").removeClass("active");
	}

	$(".close_priority").on("click", function(){
		  closeModal();
		  $('.priority_areass input').val('');
		  $('.priority_areass select').val('')
		$(".priority_areas").empty();
	});


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y" || $editRosterYN == "Y"){ ?>

/* ----------------------------------------
						add shift modal 							
	----------------------------------------*/

	$(document).on('click','.__addshift',function(){
		$(".masks").addClass("actives");
    var employeeName = $(this).closest('tr').children('.left-most').children('.name-space').children('.name-role').children('.empname').text();
    var date = $(this).attr('date');
		var dates = [];
		var obj = {};
		var roster_id = $(this).attr('roster-id');
		var emp_id = $(this).attr('emp-id');
    $('.edit_priority').html(employeeName)
			$(document).on('click','.add_shift',function(){
        // FOR MULTIPLE DAYS
		// for(var i=0;i<5;i++){
		// 	obj = {};
		// 	if(date.getMonth() < 10){
		// 	obj.date = `${date.getFullYear()}-0${date.getMonth()+1}-${date.getDate()}`;
		// 		}
		// 		if(date.getMonth >=10 ){
		// 	obj.date = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`;
		// 		}
		// 		if($('.checkbox_space').eq(i).is(':checked') == true){
		// 			obj.status = true;
		// 			dates.push(obj)
		// 		}
		// 	date.setDate(date.getDate() + 1);
		// }
				var add_start_time = $('#add_start_time').val();
				var add_end_time = $('#add_end_time').val();
				add_start_time = parseInt(add_start_time.replace(":",""));
				add_end_time = parseInt(add_end_time.replace(":",""));
				var add_role_id = $('#add_role_id').val();
				// console.log(date+ "---"+roster_id+ "---"+emp_id+ "---"+add_start_time+ "---"+add_end_time+ "---"+add_role_id+)
				console.log(dates)
				var url = "<?php echo base_url() ?>roster/addNewshift";
        loader_icon();
				$.ajax({
					url:url,
					method:'POST',
					data:{
            date : date,
						roster_id : roster_id,
						emp_id : emp_id,
						add_start_time : add_start_time,
						add_end_time : add_end_time,
						add_role_id : add_role_id
					},
					success:function(response){
						window.location.reload();
            // console.log(response)
					}
				}).fail(function(){
        window.location.reload();
        })
			})
	})

	$(document).on('click','.add_shift',function(){
		// $(this).closest();
	})

	function closeAddShitModal(){
		  $(".masks").removeClass("actives");
		}

	$(".close_priority").on("click", function(){
		  closeAddShitModal();
		});

<?php } ?>

<?php if( isset($error) != null){ ?>

		
   var modal = document.querySelector(".modal-logout");
       function toggleModal() {
   	     modal.classList.toggle("show-modal");
    	}
	$(document).ready(function(){
  		toggleModal();	
  		});

<?php }	?>


	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
				response['orgchart'].forEach(function(index){
					var data = "<option value="+index.areaId+">"+index.areaName+"</option>";
					$('#add_area_id').append(data)
				})
			}
		}).fail(function(){
        window.location.reload();
      })
	})


	$(document).ready(function(){
		$(document).on('change','#add_area_id',function(){
		 var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var areaId = $(this).val();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('#add_role_id').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
								$('#add_role_id').append(data)
										}
									})
					})
				}
			}).fail(function(){
        window.location.reload();
      })
		})
	})


$( ".modal_prioritys" ).draggable();
$( ".modal-content" ).draggable();
$( ".modal_priority" ).draggable();
$('.modal_priorityed').draggable();
$('.modal_body').draggable();




	$(document).on('click','.casualEmploye-btn',function(){
			$(".masked").addClass("actived");
			$('.token-search input').attr('placeholder','Search Employees')
		});

	function closeModalEmp(){
	  $(".masked").removeClass("actived");
	}

	$(".close_priorityed").on("click", function(){
	 		 closeModalEmp();
	});


	$(document).ready(function(){
		var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
				response['orgchart'].forEach(function(index){
					var data = "<option value="+index.areaId+">"+index.areaName+"</option>";
					$('.casualEmploye-area-select').append(data)
				})
			}
		}).fail(function(){
        window.location.reload();
      })
	})


	$(document).ready(function(){
		$(document).on('change','.casualEmploye-area-select',function(){
		 var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var areaId = $(this).val();
		var url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
		$.ajax({
			method:'GET',
			url:url,
			dataType: 'JSON',
			success:function(response){
					$('.casualEmploye-role-select').empty()
				response['orgchart'].forEach(function(index){
					index['roles'].forEach(function(values){
						if(areaId == values.areaid){
							var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
								$('.casualEmploye-role-select').append(data)
										}
									})
					})
				}
			}).fail(function(){
        window.location.reload();
      })
		})
	})


	$(document).on('click','.priority_saveed',function(){
		var date = $('#casualEmp_date').val();
		var roster_id = "<?php echo $rosterDetails->id; ?>";
		var emp_id = $('#casualEmp_id').val();
		var casualEmp_start_time = $('#casualEmp_start_time').val();
		var casualEmp_end_time = $('#casualEmp_end_time').val();
		casualEmp_start_time = parseInt(casualEmp_start_time.replace(":",""));
		casualEmp_end_time = parseInt(casualEmp_end_time.replace(":",""));
		var casualEmp_role_id = $('#casualEmp_role_id').val();
		console.log(date+ "---"+roster_id+ "---"+emp_id+ "---"+casualEmp_start_time+ "---"+casualEmp_end_time+ "---"+casualEmp_role_id)
		if(date != null && date != "" && roster_id != null && roster_id != "" && emp_id != null && emp_id != "" && casualEmp_start_time != null && casualEmp_start_time != "" && casualEmp_end_time != null && casualEmp_end_time != "" && casualEmp_role_id != null && casualEmp_role_id != ""){
		var url = "<?php echo base_url() ?>roster/addCasualEmployee";
		$.ajax({
			url:url,
			method:'POST',
			data:{
				date : date,
				roster_id : roster_id,
				emp_id : emp_id,
				casualEmp_start_time : casualEmp_start_time,
				casualEmp_end_time : casualEmp_end_time,
				casualEmp_role_id : casualEmp_role_id
			},
			success:function(response){ 
				if(JSON.parse(response).Status == "REDUNDANT"){
					alert('Shift for this user, for the particular date already exists in another center. Please delete the shift to add a new one');
				}else{
          // console.log(response)
				window.location.reload();
				}
			}
		})
		}else{
			
		}

	})


	$(document).ready(function(){
		// url modifiers
		$(document).on('click','.showBudget-btn',function(){
			let url = new URL(window.location.href);
				parameters = url.searchParams
			if($(this).attr('show-budget') == 'N'){
				parameters.set("showBudgetYN","N");
			}
			if($(this).attr('show-budget') == 'Y'){
				parameters.delete("showBudgetYN");
			}
				url.search = parameters.toString();
				window.location.href= url.href
		})
	})


		//	Printing
	function landscape(){
			var css = '@page { size: landscape; }',
			    head = document.head || document.getElementsByTagName('head')[0],
			    style = document.createElement('style');

			style.type = 'text/css';
			style.media = 'print';

			if (style.styleSheet){
			  style.styleSheet.cssText = css;
			} else {
			  style.appendChild(document.createTextNode(css));
			}

			head.appendChild(style);

			window.print();
	}
	function portrait(){
		var css = '@page { size: portrait; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);

		window.print();
	}


	// Edit Roster Permissions start (e-r-p):key

	$(document).on('click','.editPermission-btn',function(){
			$(".modal_outer").addClass("modal_active");
				getEmployees();
		});

	function close_modal(){
	  $(".modal_outer").removeClass("modal_active");
	}

	$(".modal_close").on("click", function(){
	 		 close_modal();
	});



	var base_url = "<?php echo base_url();?>";
	function getEmployees(){
		var xhttp = new XMLHttpRequest();
		var centerId = document.getElementById("centerValue").value;
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var employees = JSON.parse(xhttp.responseText);
				var finalStr = "";
				for(var i=0;i<employees.employees.length;i++){
					finalStr += '<option value = "' + employees.employees[i].id +  '">' + employees.employees[i].name + '</option>';
				}
				document.getElementById("employeeValue").innerHTML = finalStr;
				getPermissions();
			}
		};
		xhttp.open("GET", base_url+"settings/getEmployeesByCenter/"+centerId, true);
		xhttp.send();
	}



	$(document).ready(function(){
		$(document).on('click','#modal_permission',function(){
			let employeeId = $('#employeeValue').val();
			let editRoster = 'Y';
			let rosterId = "<?php echo $rosterid; ?>";
			let url = '<?php echo base_url() ?>roster/saveRosterPermissions';
			$.ajax({
				url : url,
				method : 'POST',
				data : {
					employeeId : employeeId,
					editRoster : editRoster,
					rosterId : rosterId
				},
				success : function(response){
                  window.location.reload();
				}
			}).fail(function(){
        window.location.reload();
      })
		})
	})


	function getPermissions(){
		let rosterId = "<?php echo $rosterid; ?>";
		let employeeId = $('#employeeValue').val();
		$('.token-search input').attr('placeholder','Search Employees')
		let url = '<?php echo base_url() ?>Roster/getRosterPermissions/'+employeeId+'/'+rosterId;
	 	$.ajax({
	 		url : url,
	 		method : 'GET',
	 		success : function(response){
	 			if(JSON.parse(response).getPermissions[0] != null){
	 			document.getElementById('edit_roster').checked = (((JSON.parse(response).getPermissions[0].editRoster) == 'Y') ? true : false ) ;
	 			console.log(JSON.parse(response).getPermissions[0].editRoster);
          window.location.reload();
	 		}
	 		else{
						document.getElementById('edit_roster').checked = false;
                      window.location.reload();
						}	 			
    	 		}
    	 	})
  	  }


	    $(document).ready(function(){
        $('#casualEmp_id').tokenize2();
        $('#employeeValue').tokenize2();
    });


/*  -----------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */


	function closeChangeRolePriority(){
	  $(".changeRolePriority_mask").removeClass("active");
	}

	$(".changeRolePriority_close").on("click", function(){
	  closeChangeRolePriority();
	  $(".changeRolePriority_body").empty();
	});
/*  -----------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */
	$(document).ready(function(){
		$(document).on('click','.changeRoleOrder',function(){
			$('.changeRolePriority_body').empty();
			$('.changeRolePriority_mask').addClass("active");
			var areaId = $(this).attr('area_id');
			var centerid = $('#center-id').attr('c_id');
			let url = "<?php echo base_url() ?>settings/getOrgCharts/"+centerid;
			$.ajax({
				url : url,
				method : 'GET',
				success : function(response){
					response = JSON.parse(response)
					response.orgchart.forEach(function(item){
						if(item.areaId == areaId){
							item.roles.forEach(function(role){
								var code = `
								<tr class="d-block">
									<td class="change_role_priority area-name" roleId="${role.roleid}">${role.roleName}</td>
								</tr>`;
								$('.changeRolePriority_body').append(code);
							})
						}
					})
					// console.log(response)
				}
			}).fail(function(){
        window.location.reload();
      })
		})
	})
			$('.changeRolePriority_body').sortable()
			$(".changeRolePriority_body").disableSelection();

		$(document).on('click','.changeRolePriority_save',function(){
			var url = "<?php echo base_url() ?>settings/changeRolePriority"
			var order = [];
			var obj = {};
			for(let i=0;i<($('.change_role_priority').length);i++){
				obj = {};
				obj.roleid = $('.change_role_priority').eq(i).attr('roleid');
				obj.priority = i;
				order.push(obj);
			}
			$.ajax({
				url : url,
				method : 'POST',
				data : {
					order : order
				},
				success : function(response){
					console.log(response)
					window.location.reload();
				}
			}).fail(function(){
        window.location.reload();
      })
		})

	// Empty form add employee
	$(document).on('click','.close_priorityed',function(){
		$('.priority_areased').find('input:text').val('')
		$('.priority_areased').find('#casualEmp_id').val([])
		$('.priority_areased').find('.token').remove();
		$('.priority_areased').find('.casualEmploye-area-select').val(0);
		$('.priority_areased').find('.casualEmploye-role-select').val('');
		$('.priority_areased').find('#casualEmp_date').val('')
		$('.priority_areased').find('#casualEmp_start_time').val("09:00")
		$('.priority_areased').find('#casualEmp_end_time').val('17:00')
	})

    <?php if($this->session->flashdata('MemberData') != null){ ?>
      var url = "<?php echo base_url(); ?>api/Util/sendEmails";
      var data = (<?php echo $this->session->flashdata('MemberData') ?>);
      var ud = "<?php echo $this->session->userdata('LoginId'); ?>";
      var period = "<?php echo $this->session->flashdata('period') ?>";
      var loc = "<?php echo $this->session->flashdata('loc') ?>";
      var title = "<?php echo $this->session->flashdata('title') ?>";
      var category = "<?php echo $this->session->flashdata('category') ?>";
	  var arr = <?php echo $this->session->flashdata('arr') ?>;
      var x = [];
      x.push({"userid" : ud,"data" : data,"title":title,"loc":loc,"period":period,"category":category,"arr":arr});
      x = JSON.stringify(x);
      console.log(x)
      $.ajax({
        url : url,
        type : 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data : x,
        success : function(response){
          console.log(response);
        }
      }).fail(function(response){
        console.log(response)
      })
    <?php } ?>

</script>
</body>
</html>


<!-- 334 -->