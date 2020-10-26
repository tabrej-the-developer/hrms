

<?php 
  $GLOBALS['rolesArray'] = json_decode($roles); 
   $rosterDetails = json_decode($rosterDetails); 
   $GLOBALS['roDetails'] = $rosterDetails;
   $entitlement = json_decode($entitlements);
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
      }
  else if($x/100>12){
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
  }
  else{
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
        for($i=0;$i<5;$i++){
          $date = $GLOBALS['roDetails']->startDate;
          $this->Cell($cellSize,8,date('D',strtotime($date.'+'.$i. 'days'))." ".'('.date('dS',strtotime($date.'+'.$i. 'days')).')',1,0,'C');
          }
          $this->Ln();

          $rolesArray = $GLOBALS['rolesArray'];

    foreach($roster as $ro){
      if(isset($ro->colorcodes)){
      $color = explode(",",$ro->colorcodes);
    }else{
      $color = explode(",","255,255,255");
    }
      $this->SetFillColor(intval($color[0]),intval($color[1]),intval($color[2]));
      $this->Cell($size,8,$ro->areaName,1,0,'C',1);
      $this->Ln();
      $roles = $ro->roles;
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
        for($i=0;$i<5;$i++){
        // foreach($role->shifts as $r){
          if(isset($role->shifts[$i]->startTime)){
          $this->Cell($cellSize,8,$this->timex($role->shifts[$i]->startTime).'-'.$this->timex($role->shifts[$i]->endTime),1,0,'C');
          }
          else{
          $this->Cell($cellSize,8,"",1,0,'C');
          }
        }
          $this->Ln();
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
	<title></title>
		<?php 
      
      $this->load->view('header');
     ?>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Roster</title>
<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
text-align:center;
	}
	body{
		background:#f3f4f7;
	}
.containers{/*
	width:95%;
	*/
	margin-left:20px;
}
			/* The Modal (background) */
.modal {
  display: none; 
  position: fixed;
    padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
/*.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}*/
	.close{
			float: none; 
	    font-size: inherit; 
	    font-weight: inherit; 
	    line-height: inherit; 
	    color: inherit; 
	    text-shadow: inherit; 
	    opacity: inherit; 
	    padding: 0; 
    	background-color: transparent;
	}
	.close:hover{
		background:#9E9E9E;
	}
input[type="text"],input[type=time],select,#casualEmp_date{
	background: #ebebeb;
	border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
    padding-left: 50px !important;
}

table,tr,td{
	border:1px solid rgba(0,0,0,0.1)
}
.heading{
	text-align: left;
	font-weight:bold;
	font-size:2rem;
	display: flex;
}
.roster-dates{
	text-align:left;
	/*background-color: #e3e9f5;*/
	background-color:white;
	/*color:#afb7cd;*/
	color:#171D4B;
	display: flex;
	justify-content: center;
	padding-bottom:10px;
	padding-top:10px;
	font-weight:bolder;
}
.table-div{
	background:white;
	margin-bottom: 200px
}
.area-name{
	background:#A4D9D6;
	color:#171D4B;
	padding:0.25rem 0;
	font-weight: 700;
}
.day{
	background:transparent;
}
.day-row{
	background: #8D91AA;
}
.total-budget{
	padding-top:10px;
}
.hourly{
	font-size:12px;
	text-align: left;
}
.hourly::before{
	content:'$';
}
.hourly::after{
	content:'/hr';
}
.fillWithColor{
  background: khaki;
}
.title{
	font-size:12px;
	padding-left: 1rem
	
}
.icon{
	font-size:1rem;
	display:flex;
	justify-content:center;
	align-self: center;
	border-radius: 50%;
	padding:0.25rem 0;
	color:white;
	height: 2rem;
	width: 2rem;
}
.empname{
	font-size:15px;
	display:flex;
	justify-content:left;
	padding: 0 1rem;
	font-weight: 600;
	color: #707070;
  text-align: left;
}
.modal-content{
max-width:30vw;
	}
	.modal-content .titl{
	width: 100%;
    position: relative;
    top: 0;
    left: 0;
    margin: 0;
    padding: 0;
    background:#8D91AA;
    cursor: move;
	}
	.ui-timepicker-container{
		z-index:999;
	}
	.buttons{
		padding:10px 20px;
		margin:2px;
	}
	.button,.changeRolePriority_save,.changeRolePriority_close{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  min-width:6rem;
      border-radius: 20px;
      padding: 8px;
      background: rgb(164, 217, 214);
      display: flex !important;
}
	.buttonn{
		background-color: #9E9E9E;
	  border: none;
	  color: white;
	  padding: 10px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  margin: 2px;
       float:none; 
     font-size: 1rem; 
     font-weight: bolder; 
     line-height: inherit; 
     text-shadow: none; 
     opacity: 1;
}
.buttonn:hover{
	background-color: #9E9E9E;
	color: white;
}
.shift-edit{
	padding:10px;
}
.cell-back-1{
	margin:0 10px 0 10px;
	font-size: 0.85rem;
	padding:0.2rem;
}
.cell-boxes{
	padding:0.5rem 0;
}
.name-role{
	padding:0;
	margin:0;
}
.left-most{
	border-top:1px solid rgba(0,0,0,0.3);
	border-bottom:1px solid rgba(0,0,0,0.3);
}
.day{
	padding:10px;
	color: #F3F4F7;
}
.icon-parent{
	display: flex;
	align-content: center;
	justify-content: center
	padding:0;
}
.box-name-space{
	width:100%;
}
.box-name{
	display: flex;
    justify-content: center;
    font-size:1.5rem;
    color:#E7E7E7;
}
.box-space{
	display: flex;
    justify-content: center;
    color:white;
}
.total-name{
	display: flex;
    justify-content: center;
    font-size:30px;
}
.total-space{
	display: flex;
    justify-content: center;
}
#roster-form{
	position: relative;
}
.total-budget-row {
		background:#FFFCAD;
		margin:10px;
		color:#434040;
}
.total-budget .total-budget-row td{
	background:#FFF1AE;
	padding:10px;
	font-weight: bolder;
}
#shift-submit,#user-submit{
	background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.Added{
	background:#F3F4F7;
	color: rgba(112, 112, 112, 1) ;
	border-radius: 3px;
	font-weight: 500;
}
/* rgb(112, 112, 112) */
.Published{
	background:rgba(219, 165, 245, 0.4);
	color:rgba(112, 112, 112, 1) !important;
	border-radius: 3px;
	font-weight: 500;
}
/*rgba(219, 165, 245, 1)*/
.Accepted{
	background: rgba(175, 225, 159,0.4);
	color:rgba(112, 112, 112, 1) !important;
	border-radius: 3px;
	font-weight: 500;
}
/* rgb(175, 225, 159) */
.Rejected{
	background: rgba(226, 90, 83, 0.4) ;
	color:rgba(112, 112, 112, 1);
	font-weight: 500;
}
.Added .cell-back-1::before{
	border-left:0.25rem solid rgba(112, 112, 112,0.8);
	content: ' ';
	position: absolute;
	height: 100%;
	left: 0;
	top: 0;	
}
/* rgb(112, 112, 112) */
.Published .cell-back-1::before{
	border-left:0.25rem solid rgba(219, 165, 245, 1);
	content: ' ';
	position: absolute;
	height: 100%;
	left: 0;
	top: 0;	
}
/*rgba(219, 165, 245, 1)*/
.Accepted .cell-back-1::before{
	border-left: 0.25rem solid rgba(175, 225, 159,1);
	content: ' ';
	position: absolute;
	height: 100%;
	left: 0;
	top: 0;	
}
/* rgb(175, 225, 159) */
.Rejected .cell-back-1::before{
	border-left: 0.25rem solid rgba(226, 90, 83, 1) ;
	content: ' ';
	position: absolute;
	height: 100%;
	left: 0;
	top: 0;	
}
/* rgba(226, 90, 83, 1) */
.nav-link{
	text-align:left;
}
td{
	position: relative;
}
.leave{
	background: rgba(253, 179, 93, 0.3);
	color:#707070 !important;
	content: 'On Leave';
	align-items: center;
	justify-content: center;
}
.leave::before{
  border-left: 0.25rem solid rgba(253, 179, 93, 1) ;
  content: ' ';
  position: absolute;
  height: 100%;
  left: 0;
  top: 0; 
}
.budget-table-parent{
	position: fixed;
	bottom: 0;
  background: #f3f4f7;
}


.mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.1);
  z-index: 50;
  visibility: hidden;
  opacity: 0;
  transition: 0.7s;
}
.modal_priority {
  position: fixed;
  top: 30%;
  left: 50%;
  width: 400px;
  min-height: 400px;
  margin-left: -200px;
  margin-top: -150px;
  background: #fff;
  z-index: 100;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s ease-out;
  transform: translateY(45px);
}
.active,.actived {
  visibility: visible !important;
  opacity: 1;
}
.active + .modal_priority {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.actived + .modal_priorityed {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.priority_areas  tr td{
	width: 300px;
	cursor: move;
}
.priority_buttons{
	position:relative;
	bottom: 10px;
	width:100%;
	justify-content: center;
	display: flex;
	padding: 20px 0 0 0;
}
.priority_areas {
	display: flex;
    text-align: center;
    justify-content: center;
    width: 100%;
    flex-wrap: wrap;
}


.masks {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.1);
  z-index: 50;
  visibility: hidden;
  opacity: 0;
  transition: 0.7s;
}
.modal_prioritys {
  position: fixed;
  top: 30%;
  left: 50%;
  width: 400px;
  height: 400px;
  margin-left: -200px;
  margin-top: -150px;
  background: #fff;
  z-index: 100;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s ease-out;
  transform: translateY(45px);
}
.actives {
  visibility: visible;
  opacity: 1;
}
.actives + .modal_prioritys {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.masked {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.1);
  z-index: 50;
  visibility: hidden;
  opacity: 0;
  transition: 0.7s;
}
.modal_priorityed {
  position: fixed;
  top: 30%;
  left: 50%;
  width: 400px;
  min-height: 450px;
  margin-left: -200px;
  margin-top: -150px;
  background: #fff;
  z-index: 100;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s ease-out;
  transform: translateY(45px);
}
.priority_areass  tr td{
	width: 300px;
	cursor: move;
}
.priority_buttonss{
	position:absolute;
	bottom: 10px;
	width:100%;
	justify-content: center;
	display: flex;
	padding: 20px 0 0 0;
}
.priority_areass {
	/*display: flex;*/
    /*position: absolute;*/
    text-align: center;
    /*justify-content: center;*/
    width: 100%;
    flex-wrap: wrap;
}
.priority{
	font-size:1rem;
	width:100%;
}

.print-button,.priority,.casualEmploye-span,.showBudget,.editPermission-span{
	display: flex;
	align-items: center;
}
.top_buttons{
	position: absolute;
	right:0;
	display: flex;
	align-items: center;
	margin-top:0.25rem;
	/*width: 100%;*/
}
.hide_budget{
	font-weight: 700;
	font-size: 1rem;
	padding: 1px 6px;
}
#shift-submit{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  width:8rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem;
}

.buttonn,
.button{
	/*position: absolute;*/
/*	right: 0;*/
	  border: none !important;
	  color: rgb(23, 29, 75) !important;
	  text-align: center !important;
	  text-decoration: none !important;
	  display: inline-block;
	  font-weight: 700 !important;
	  margin: 2px !important;
	  min-width:6rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
}
.roster_shift_message{
	font-style: italic;
	font-size: 0.75rem
}
.checkbox_space{
	display: flex;
	justify-content: center;
}
.casualEmploye-btn,
.priority-btn,
.print-btn,
.showBudget,
.priority_saveed,
.add_shift,
.editPermission-btn,
#modal_permission{
	/*position: absolute;*/
/*	right: 0;*/
	  border: none !important;
	  color: rgb(23, 29, 75) !important;
	  text-align: center !important;
	  text-decoration: none !important;
	  display: inline-block;
	  font-weight: 700 !important;
	  margin: 2px !important;
	  width:8rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
}
.buttons_group{
	padding-top: 1rem;
	padding-bottom: 1rem;
	display: flex !important;
	justify-content: center !important;
}
.showBudget input{
	margin-right:0.3rem;
}
.casualEmployee-span,.showBudget{
	font-size:1rem;
	width:100%;
}
.casualEmploye-btn{
	width:8rem;
}

.close_priority,.priority_save{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  width:8rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
}
.close_priority{
	margin-right: 15px;
}
.close_priorityed{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  width:8rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
      margin-right:15px !important;
}

  #centerValue{
    width: 15rem;
  }
  #employeeValue{
    width: 15rem;
  }

.edit_priority{
	font-size: 1rem
}
   .modal-logout {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transform: scale(1.1);
        transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        text-align: center;
    }
    .modal-content-logout {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 50%;
        border-radius: 0.5rem;
    }
    .show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1.0);
        transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    }

    .add_shift_span{
    	padding: 0.5rem 1rem;

    }
  .priority_heading{
		position: relative;
    width: 100%;
    display: block;
    padding: 0;
    cursor: move
    }
    .priority_buttonsed{
    	padding: 1rem;
    }
    .edit_priority,.edit_prioritys,.edit_priorityed,.changeRolePriority_heading{
    	padding: 0.5rem 0;
	    position: relative;
	    display: block;
	    background: #8D91AA;
	    color: #E7E7E7 !important;
	    font-weight: 100
    }
    label{
    	text-align: left;
    padding: 0 0 0 1rem;
    }
    .modal_label{
    	padding-left:3rem !important;
    	font-weight: 700;
    	color: #171D4B;
    }
    .casualEmployee_label{
    	display: flex;
    	width:100%;
    	padding:10px;
    }
    .casualEmployee_label label{
    	width:35%;
    }
    .casualEmployee_label select{
    	padding-left:50px;
    }
    .casualEmployee_label select{
    	width : 100%
    }
    .proper_width_select{
    	width: 60%;
    }
    .casualEmployee_label input{
    	width:60%;
    }
    #message{
    	min-height: 4rem;
    	max-height: 4rem;
    	border-radius: .5rem;
    	border: 1px solid #D2D0D0;
    	background: #E7E7E7;
    }
		.print-landscape,.print-portrait{
    	display: none;
  	  border: none;
		  color: rgb(23, 29, 75);
		  text-align: center;
		  text-decoration: none;
		  font-weight: 700;
		  margin: 2px;
		  width:8rem;
      font-size: 1rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
    }
    .print-hidden-btn{
    	position: absolute;
    	margin-top:2rem;
    }
		.print-button{
			font-size:1rem;
			width:100%;
			display: flex;
			flex-direction: column;
		}
    .print-button .print-landscape:hover,.print-button .print-portrait:hover{
    	display: block;

    }
    .print-button:hover button{
    	display: block;
    }
    .modal_heading{
    	cursor: move;
    }
    .priority_headinged{
    	cursor: move;
    }

/*  -----------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */
.changeRolePriority_mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.1);
  z-index: 50;
  visibility: hidden;
  opacity: 0;
  transition: 0.7s;
}
.changeRolePriority_modal {
  position: fixed;
  top: 30%;
  left: 50vw;
  width: 30vw;
  min-height: 400px;
  margin-left: -15%;
  margin-top: -150px;
  background: #fff;
  z-index: 100;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s ease-out;
  transform: translateY(45px);
}

.active,.actived {
  visibility: visible !important;
  opacity: 1;
}
.active + .changeRolePriority_modal {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.actived + .changeRolePriority_modaled {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.changeRolePriority_body  tr td{
	width: 30vw;
	cursor: move;
}
.changeRolePriority_buttons{
	position:absolute;
	bottom: 2rem;
	width:100%;
	justify-content: center;
	display: flex;
	padding: 20px 0 0 0;
}
.changeRolePriority_body {
	display: flex;
    text-align: center;
    justify-content: center;
    width: 100%;
    flex-wrap: wrap;
    flex-direction: column;

}
/*  ------------------------------
			CHANGE ROLE PRIORITY	MODAL
		------------------------------ */

  /* Edit Permission Modal */
  .modal_title{
    	padding: 0.5rem 0;
	    position: relative;
	    display: block;
	    background: #8D91AA;
	    color: #E7E7E7 !important;
	    font-weight: 100
    }
    .modal_close{
		  border: none;
		  color: rgb(23, 29, 75);
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-weight: 700;
		  margin: 2px;
		  width:8rem;
	    border-radius: 20px;
	    padding: 4px 8px;
	    background: rgb(164, 217, 214);
	    font-size: 1rem;
	    margin-right:5px !important;
		}
		.modal_outer {
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background: rgba(255,255,255,0.1);
		  z-index: 50;
		  visibility: hidden;
		  opacity: 0;
		  transition: 0.7s;
			}
		.modal_body {
		  position: fixed;
		  top: 30%;
		  left: 40%;
		  width: 50%;
		  min-height: 300px;
		  margin-left: -200px;
		  margin-top: -150px;
		  background: #fff;
		  z-index: 100;
		  visibility: hidden;
		  opacity: 0;
		  transition: 0.5s ease-out;
		  transform: translateY(45px);
		}
		.modal_active{
		  visibility: visible;
		  opacity: 1;
		}
		.modal_active + .modal_body{
		  visibility: visible !important;
		  opacity: 1;
		  transform: translateY(0);
		}
		.modal_buttons{
			position: absolute;
	    bottom: 10%;
	    display: flex;
	    justify-content: center;
	    width: 100%;
    }
		.modal_main{
			margin-top: 10%;
			margin-bottom:10%;
		}
		#permissions_id{
			margin: 10%;
		}
  /* Edit Permission Modal */
.employee-id-class > .tokenize{
	width:100%;
}
.tokens-container{
	width:100%;
	border-radius: 20px;
	background: #ebebeb;
  border: 1px solid #D2D0D0 !important;
  margin-bottom: 0;
}
 .tokenize > .tokens-container > .token-search > input{
  border: none !important;
 }
  .tokenize > .tokens-container > .token-search{
    border: none !important;
    width: 100% !important;
  }
  .roster_dropdown_parent{
  	padding: 0 !important;
  }
  .roster_dropdown{
  	width: 100% !important;
  }
  .select_css.no_drop_icon{
  	width: 60%;
  }
  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #307bd3;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    z-index: 9999;
  }
  .loading{
    position: fixed;
    height: 100vh;
    width: 100vw;
    top: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    background: rgba(0,0,0,0.2)
  }
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

@media print{
.occupancy_css{
  display: none !important;
}
#message{
  border: none !important;
}
  td,th,table,tr{
    border: 0.5px dotted black !important;
  }
  .left-most{
  border-top:0.5px dotted black !important;
  border-bottom:0.5px dotted black !important;
}
  .Published .cell-back-1::before {
    border-left: 0;
    content: ' ';
    position: absolute;
    height: 100%;
    left: 0;
    top: 0;
}
.Added .cell-back-1::before {
    border-left: 0;
    content: ' ';
    position: absolute;
    height: 100%;
    left: 0;
    top: 0;
}
.Accepted .cell-back-1::before {
    border-left: 0;
    content: ' ';
    position: absolute;
    height: 100%;
    left: 0;
    top: 0;
}
  *{
    padding: 0 !important;
     page-break-after: auto;
}
    .heading{
    display: none !important;
    visibility: hidden;
  }
  #center-id{
    display: none !important;
    visibility: hidden;
  }
	td:nth-child(7),th:nth-child(7){
		display: none;
	}
	.budget-table-parent{
		display: none
	}
	.column_budget{
		display: none
	}
	.priority{
		display: none
	}
	.print-btn{
		display: none;
	}
	.hourly{
	display:none;
	}
	.hourly::before{
			display:none;
	}

	nav{
		display: none;
	}

	.containers{
		padding-left: 0 !important;
		width: 100vw !important;
	}
	table{
		width: 100% !important;
	}
	body{
		margin: 0;
	}
		.top_buttons{
			display: none;
		}
}
@media only screen and (max-width: 1050px) {

			.header-top{
			max-width: 100vw !important;
		}
		.table-div{
			padding: 0;
			position: relative;
			max-width: 100vw !important;
   			overflow-x: scroll !important;
		}
				.title{
			display: flex;
   			 justify-content: center;
		}
		.modal-content{
			min-width:100vw;
		}
		.containers {
		     width: 100%;
		    margin: 0px;
		}

		.name-space{
			display: block
		}
		.icon-parent{
			max-width:100%;
			justify-content: center
		}

}
</style>

</head>
<body>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>

<div class="loading">
  <div class="loader"></div>
</div>
	<div class="containers" id="containers">
		<div class="heading" id="center-id" c_id="<?php echo isset($rosterDetails->centerid) ? $rosterDetails->centerid : null; ?>">Rosters
			<span class="top_buttons ml-auto">
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
				<span class="editPermission-span">
					<button class="editPermission-btn">Permission</button>
				</span>
				<span class="casualEmploye-span">
					<button class="casualEmploye-btn">Add Employee</button>
				</span>
				<span class="priority ">
					<button class="priority-btn ">
						<i>
							<img src="<?php echo base_url('assets/images/icons/priority.png'); ?>" style="max-height:0.8rem;margin-right:10px">
						</i>Priority</button>
				</span>
				<span class="showBudget d-flex ">
					<span class="d-flex justify-content-center align-items-center hide_budget">Hide&nbsp;Budget</span>
					<!-- Hide budget -->
					<input type="checkbox" class="showBudget-btn"
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
					 	 ?>>
				</span>
	<?php } ?>  
				<span class="print-button">
					<button class="print-btn">
						<i>
							<img src="<?php echo base_url('assets/images/icons/print.png'); ?>" style="max-height:1rem;margin-right:10px">
						</i>Print</button>
					<span class="print-hidden-btn">
						<button class="print-landscape" ><a href="<?php echo base_url('roster/getRosterDetails?rosterId='.$rosterid.'&showBudgetYN=N&printMode=L'); ?>" target="_blank">Landscape</a></button>
						<button class="print-portrait" ><a href="<?php echo base_url('roster/getRosterDetails?rosterId='.$rosterid.'&showBudgetYN=N&printMode=P'); ?>" target="_blank">Portrait</a></button>
					</span>
				</span>
			</span>
		</div>
		<div class="roster-dates"><?php 

//PHP functions //

function timex( $x)
  { 
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
      }
  else if($x/100>12){
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
  }
  else{
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
		}}
		 ?> </div>
		<div class="table-div" style="">
			<table>
				<tr class="day-row">
					<th id="table-id-1" class="day" style="width:16vw">Employees</th>	<?php $x=0;
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
					</td>
				</tr>
			
				<?php 
				if(isset($rosterDetails->roster)){
						$count = count($rosterDetails->roster);
					}
					else $count = 0;


if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){
					$CI = 0; // CI == Current Index
				for($x=0;$x<$count;$x++){ 
					?>
					<tr>
				<tr class="area_name_class">
					<td colspan="7" class="area-name" area-value="<?php echo $rosterDetails->roster[$x]->areaId ?> " ><?php echo $rosterDetails->roster[$x]->areaName ?>
						<span area_id="<?php echo $rosterDetails->roster[$x]->areaId; ?>" style="position: absolute;right: 3%;cursor:pointer;" class="changeRoleOrder">
						<i>
							<img src="<?php echo base_url('assets/images/icons/priority.png'); ?>" style="max-height:0.8rem;margin-right:10px">
						</i>
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
	if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){
				$value = count($rosterDetails->roster[$x]->roles);
		}
		else{
			$value=1;
		}
				for($counter=0;$counter<$value;$counter++){ ?>
				<tr  class="table-row">
					<td   style="width:16vw" class=" cell-boxes left-most">
						<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>

						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class=" icon" style="
									<?php	echo "background:#A4D9D6; color:#707070";?>"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						foreach($entitlement->entitlements as $e){
								if($e->id == $userLevel ){
									$variable = $e->hourlyRate;
								}
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

		foreach($entitlement->entitlements as $e){
			if($e->id == $userLevel ){
				$variable = $e->hourlyRate;
			}
		}

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

		 ?>

					<td class="shift-edit cell-boxes count-<?php echo $index+1;?> <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "leave" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>"  style="width:12vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid ?>"  

					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
						<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status != "Rejected"){ 
						if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){
							?>
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>" 
					<?php } } ?>
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>" 
					 area-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->areaId;?>"
					 emp-id="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empId;?>"
					 >
					 <div class="cell-back-1" >
					 	<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ 	?>
					 		<span class="row m-0 d-flex justify-content-center"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
					 	?>
				<span class="row m-0 d-flex justify-content-center roster_shift_message">
					<?php echo isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message : "";?></span>
					 	<?php
		 if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status != "Rejected"){ 
					  $weeklyTotal = $weeklyTotal + $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?>
					  				
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
					<td class=" " style="width:12vw;font-weight:bolder"><?php
					if((isset($_GET['showBudgetYN']) ? $_GET['showBudgetYN'] : 'Y') =='Y'){
					 echo "$".number_format((float)$weeklyTotal, 2, '.', '');;
					}
					 ?></td>

				</tr>
			</tr>
			<?php } }  } }?>


	<?php 
	if(isset($rosterDetails->roster)){
		$count = count($rosterDetails->roster);
	}
		 if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N"){ 
				for($x=0;$x<count($rosterDetails->roster);$x++){?>
				<tr >
					<td colspan="7" class="area-name"><?php echo $rosterDetails->roster[$x]->areaName ?>
						<span area_id="<?php echo $rosterDetails->roster[$x]->areaId; ?>" style="position: absolute;right: 3%;cursor:pointer;" class="changeRoleOrder">
						<i>
							<img src="<?php echo base_url('assets/images/icons/priority.png'); ?>" style="max-height:0.8rem;margin-right:10px">
						</i>
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

				for($counter=0;$counter<$value;$counter++){ ?>
				<tr  class="table-row">
					<td   style="width:16vw" class=" cell-boxes left-most 
      <?php if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){
        echo 'fillWithColor';
      } ?>
          ">
						
						<span class="row name-space" style="padding:0;margin:0;">
							<span class="col-4 icon-parent">
								<span class=" icon" style="
									<?php	echo "background:#A4D9D6; color:#707070";?>"><?php echo icon($rosterDetails->roster[$x]->roles[$counter]->empName)?>
								</span>
							</span>
							<span class="col-8 name-role">
								<span class="empname row "><?php echo $rosterDetails->roster[$x]->roles[$counter]->empName?></span>
			<?php
						$variable = 0;
						$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
						foreach($entitlement->entitlements as $e){
								if($e->id == $userLevel ){
									$variable = $e->hourlyRate;
								}
			?>
			<?php } ?>
			<?php if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){ ?>
								<span class="title hourly row"><?php echo  $variable; // echo $rosterDetails->roster[$x]->roles[$counter]->empTitle ?></span>
							<?php } ?>
							</span>

							<span class=""><?php // echo  $variable?></span>
						</span>
					</td>
				
					<?php $weeklyTotal=0;$p=0;$index=0; ?>
					<?php for($fiveIterations=0;$fiveIterations<5;$fiveIterations++){
						$variable = 0;
		$userLevel = $rosterDetails->roster[$x]->roles[$counter]->level;
		foreach($entitlement->entitlements as $e){
			if($e->id == $userLevel ){
				$variable = $e->hourlyRate;
			}
		}
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
				?>

					<td class="<?php if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId && $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status == 'Published'){ ?> shift-edit <?php } ?> cell-boxes count-<?php echo $index+1;?>  <?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "leave" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>"  style="width:12vw" 
					 name4="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->shiftid?>"  
					 name2="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleid ?>"
			<?php if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){ ?>
					 name3="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : intval($variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100); ?>" 
					<?php } ?>
					 stime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime?>" etime="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime?>" 
					 name="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->empName?>"
					 status="<?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave == "Y" ? "" : $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->status?>">

					 <div class="cell-back-1 ">
				<?php if($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->isOnLeave != "Y"){ ?>
					 	<span class="row m-0 d-flex justify-content-center"><?php echo $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->roleName;?></span>
					 	<?php echo timex(intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)). "-" .timex( intval($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime));
if($this->session->userdata('LoginId') == $rosterDetails->roster[$x]->roles[$counter]->empId){ 
					  $weeklyTotal = $weeklyTotal + $variable * ($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->endTime - $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->startTime)/100; ?> 
				<span class="row m-0 d-flex justify-content-center roster_shift_message">
					<?php echo isset($rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message) ? $rosterDetails->roster[$x]->roles[$counter]->shifts[$p]->message : "";?></span>
					<?php } } else{ ?>
            <span class="leave">
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
					<td class=" " style="width:12vw;font-weight:bolder"><?php echo "$".$weeklyTotal;?></td>

				</tr>
			<?php }  } }?>



			</table>
		</div>


		<div class="budget-table-parent">
		<div class="total-budget" >
			<table>
				<tr class="total-budget-row">
					<td class="total-budget-box" style="width:16vw">Total Budget</td>
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


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 

					<?php 
				if(isset($rosterDetails->status)){
						if($rosterDetails->status === 'Draft'){ ?>
						<div class="buttons d-flex justify-content-end">
							<button id="discard-roster" class="roster__ buttonn">
								<i>
									<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Discard</button>
							<button id="draft-roster" class="roster__ buttonn">
								<i>
									<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Save Draft</button>
							<button id="publish-roster" class="roster__ buttonn">
								<i>
									<img src="<?php echo base_url('assets/images/icons/publish.svg'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Publish</button>
						</div>
					<?php } ?>
					<?php if($rosterDetails->status === 'Published') {?>
					<div class="buttons d-flex justify-content-end">
						<button id="discard-roster" class="roster__ buttonn">
								<i>
									<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Discard</button>
						<button id="publish-roster" class="roster__ buttonn">
						<i>
							<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
						</i>Save</button>
					</div>
					<?php } }?>
			<?php } ?>
			<?php if($this->session->userdata('UserType') == STAFF){?>
			<div class="buttons d-flex justify-content-end">
					<button id="publish-roster" class="roster__ buttonn">
						<i>
							<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
						</i>Save</button>
			</div>
				<?php } ?>
			</div>
</div>
<!--This is meant for admin-->
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
	  	<span class="row titl">
	  		<span style="" class="box-name-space col-12">
	  			<span class="box-name row"></span>
	  			<span class="box-space row"></span>
	  		</span>
	  		<!-- <span class="close col-2 d-flex align-items-center" >&times;</span> -->
	  	</span>
	    
	    <!-- <form  id="roster-form"> -->
			<div class="row p-2">
				<label class="col-4 modal_label">Start Time</label>
				<input class="col-7" type="time" name="startTime" id="startTime" >
			</div>
			<div class="row p-2">
				<label class="col-4 modal_label">End Time</label>
				<input class="col-7" type="time" name="endTime" id="endTime" >
			</div>
			<div class="row p-2">
				<label class="col-4 modal_label">Area</label>
				<span class="select_css roster_dropdown_parent col-7">
					<select  class="roster_dropdown" name="areaId" id="areaId" style="padding-left:60px">
						<option >Change Area</option>
					</select>
				</span>
			</div>
			<div class="row p-2">
				<label class="col-4 modal_label">Role</label>
				<select  name="role" id="role" class="col-7">				</select>
			</div>
			<div class="row p-2">
				<label class="col-4 modal_label">Message</label>
				<textarea name="message" id="message" class="col-7" type="text"></textarea>
			</div>
	 		<input type="text" name="shiftId"  id="shiftId" style="display:none">
	 		<input type="text" name="roleId" id="roleId" style="display:none">
	 		<input type="text" name="status" value="2"  id="status" style="display:none">
	 		<input type="text" name="userId"   id="userId" style="display:none">
    <div class="row p-2">
      <label class="col-4 modal_label">Days</label>
      <span class="col-7">
        <span class="d-inline-block">
          <span>Mon</span>
          <input type="checkbox" name="days" value="1" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Tue</span>
          <input type="checkbox" name="days" value="2" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Wed</span>
          <input type="checkbox" name="days" value="3" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Thu</span>
          <input type="checkbox" name="days" value="4" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Fri</span>
          <input type="checkbox" name="days" value="5" class="d-block edit_shift_checkbox_space" checked>
        </span>
      </span>
    </div>
			<div class="buttons_group">
				 		<button type="button" name="modal-cancel"  value="Cancel"  class="close buttonn" style="width:5rem">
								<i>
									<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Close</button>
				 		<button type="button" name="shift-submit" id="shift-submit" value="Save" style="margin:30px;width:5rem" class="button">
								<i>
									<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Save</button>
				 		<button type="button" name="delete_shift" id="delete_shift" value="Delete" style="width:5rem" class="buttonn">
								<i>
									<img src="<?php echo base_url('assets/images/icons/delete.png'); ?>" style="max-height:0.8rem;margin-right:10px">
								</i>Delete</button>
			</div>
			<div><i style="font-size: 0.9rem; color:#a2a2a2">* Please select area to get roles</i></div>
	 	<!-- </form> -->
	  </div>
</div>
<?php } ?>
<!-- Till here -->>

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
          <span>Mon</span>
          <input type="checkbox" name="days" value="1" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Tue</span>
          <input type="checkbox" name="days" value="2" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Wed</span>
          <input type="checkbox" name="days" value="3" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Thu</span>
          <input type="checkbox" name="days" value="4" class="d-block edit_shift_checkbox_space" checked>
        </span>
        <span class="d-inline-block">
          <span>Fri</span>
          <input type="checkbox" name="days" value="5" class="d-block edit_shift_checkbox_space" checked>
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
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>

<!-- 	-----------------
		Priority Modal
 		-----------------	-->
<div class="mask" ></div>
<div class="modal_priority" >
	<span class="priority_heading" >
		<a class="text-center  edit_priority" style="padding:1rem 0">Edit Priority</a>
		</span>
		<div class="priority_areas"></div>
		<div class="priority_buttons">
	  	<button class="close_priority" role="button">
				<i>
					<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Cancel</button>
	  	<button class="priority_save">
				<i>
					<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Save</button>
	  </div>
</div>
<!-- 	-----------------
		Priority Modal
 		-----------------	-->


 <!-- 	-----------------
		Add Shift Modal
 		-----------------	-->
<div class="masked" ></div>
<div class="modal_priorityed" >
	<span class="priority_headinged" >
		<a class="text-center  edit_priorityed" style="padding:1rem 0">Add Employee</a>
	</span>
	<?php 
 //   print_r($casualEmployees);
  $casualEmployees = json_decode($casualEmployees); ?>
		<div class="priority_areased">
			<span class="casualEmployee_label">
			<label >Employee</label>
			<span class="select_css no_drop_icon">
				<select id="casualEmp_id" multiple>
				<?php foreach($casualEmployees->casualEmployees as $employee){ ?>
						<option value="<?php echo $employee->empId; ?>" ><?php echo $employee->empName;?></option>
			<?php	} ?>
				</select>
			</span>
			</span>
			<span class="casualEmployee_label">
				<label>Date</label>
				<input type="text" onfocus="(this.type='date')" placeholder="MM/DD/YY" name="" id="casualEmp_date" min="<?php echo $rosterDetails->startDate ?>" max="<?php echo date('Y-m-d',strtotime($rosterDetails->startDate.'+4 days')) ?>" >
			</span>
			<span class="casualEmployee_label">
				<label>Start Time</label>
				<input type="time"  id="casualEmp_start_time" value="09:00">
			</span>
			<span class="casualEmployee_label">
				<label>End Time</label>
				<input type="time"  id="casualEmp_end_time" value="17:00">
			</span>
			<span class="casualEmployee_label">
				<label>Area</label>
				<span class="select_css proper_width_select">
					<select class="casualEmploye-area-select">
						<option>Change Area</option>
					</select>
				</span>
			</span>
			<span class="casualEmployee_label ">
				<label>Role</label>
				<span class="select_css proper_width_select">
					<select class="casualEmploye-role-select" id="casualEmp_role_id">
					
					</select>
				</span>
			</span>
			<span></span>
		</div>
		<div class="priority_buttonsed">
	  		<button class="close_priorityed" role="button">
					<i>
						<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Cancel</button>
	  		<button class="priority_saveed">
					<i>
						<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Save</button>
	  </div>
    <i style="font-size: 0.9rem; color:#a2a2a2">* Please select area to get roles</i>
</div>
<!-- 	-----------------
		Add Shift Modal
 		-----------------	-->
<!-- ---------------------
		Edit Roster Permissions
		------------------- -->
<div class="modal_outer" ></div>
<div class="modal_body" >
	<span class="modal_heading" >
		<a class="text-center  modal_title " style="padding:1rem 0">Edit Permission</a>
	</span>
		<div class="modal_main">
			<div class="d-flex justify-content-around">
				<span class="span-class center-class">
					<span class="select_css">
						<select placeholder="Select Center" id="centerValue" onchange="getEmployees()" id="employeeId">
							<?php
								$centers = json_decode($centers);
								foreach($centers->centers as $center){
							?>
							<option value="<?php echo $center->centerid?>"><?php echo $center->name; ?></option>
								<?php }?>
						</select>
					</span>
			</span>
			<span class="span-class employee-id-class">
				<span class="select_css no_drop_icon">
					<select placeholder="Select Center" id="employeeValue" onchange="getPermissions()" multiple>

					</select>
				</span>
			</span>
			</div>
			<div id="permissions_id">
				<span>
					<span><input type="checkbox" name="edit_roster" id="edit_roster"></span>
					<span><label>Edit Roster</label></span>
				</span>
			</div>
		</div>
		<div class="modal_buttons">
	  		<button class="modal_close" role="button">
					<i>
						<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Cancel</button>
	  		<button id="modal_permission">
					<i>
						<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
					</i>Save</button>
	  </div>
</div>
<!-- ---------------------
		Edit Roster Permissions
		------------------- -->
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
<div class="masks" ></div>
<div class="modal_prioritys" >
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

<div class="changeRolePriority_mask" ></div>
<div class="changeRolePriority_modal" >
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

<?php } ?>
<script type="text/javascript">
  remove_loader_icon();
    function remove_loader_icon(){
    $('.loading').hide();
  };
  function loader_icon(){
    $('.loading').show();
  };

<?php 		 if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N"){ ?>

				var model = document.getElementById("mxModal");

	$(document).on('click','.shift-edit',function(){
		 model.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 model.style.display = "none";
		 ('#user-form').trigger('reset');
	})
	
	$(document).on('click','.buttons',function(){
		window.location.href = window.location.origin+"/PN101/roster/roster_dashboard"
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
      for(var i=0;i< ($('.edit_shift_checkbox_space').length);i++){
        obj = {};
        obj.YN = ($('.edit_shift_checkbox_space').eq(i).is(':checked'));
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
      url = window.location.origin+"/PN101/roster/updateShift";
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


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
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
              var url = window.location.origin+"/PN101/roster/deleteShift/"+shiftId;
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

<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 

	$(document).ready(function(){


		$(document).on('click','.cell-boxes',function(){
			document.getElementsByClassName('box-name')[0].innerHTML = $(this).attr('name');
			var indexVal = $(this).index();
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
			var url = window.location.origin+'/PN101/roster/getShiftDetails/'+shiftid+'/'+role
				$.ajax({
					url: url,
					type: 'GET',
					success : function(response){
						var centerid = $('#center-id').attr('c_id');
		// var userid = $('#user-id-select').text();
		var response = JSON.parse(response);
		var data = "";
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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

			url = window.location.origin+"/PN101/roster/updateShift";
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
			var url = window.location.origin+"/PN101/roster/updateRoster";
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
						window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";
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
					},
					success:function(response){
window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";					}

				}).fail(function(){
        window.location.reload();
      })
			}
			if($(this).prop('id') == "publish-roster"){
        loader_icon();
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterid,
						status: 'Published'
					},
					success:function(response){
						console.log(response);
						window.location.href= window.location.origin+"/PN101/roster/roster_dashboard";
					}

				}).fail(function(){
        window.location.reload();
      })
			}
		})
	})

<?php }?>


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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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

<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 

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
			$(".priority_areas").append(array)
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
		  		url: window.location.origin+'/PN101/roster/changePriority',
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
		$(".priority_areas").empty();
	});


<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>

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
				var url = window.location.origin+"/PN101/roster/addNewshift";
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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		var url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
		var url = window.location.origin+"/PN101/roster/addCasualEmployee";
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
				if(JSON.parse(response).status == "REDUNDANT"){
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
			let editRoster = ($('#edit_roster').is(':checked') == true) ? 'Y' : 'N' ;
			let rosterId = "<?php echo $rosterid; ?>";
			let url = window.location.origin+'/PN101/roster/saveRosterPermissions';
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
		let url = window.location.origin+'/PN101/Roster/getRosterPermissions/'+employeeId+'/'+rosterId;
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
			let url = window.location.origin+"/PN101/settings/getOrgCharts/"+centerid;
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
			var url = window.location.origin+"/PN101/settings/changeRolePriority"
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
</script>
</body>
</html>


<!-- 334 -->