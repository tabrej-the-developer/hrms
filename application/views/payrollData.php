
<html>
<head>
	<title></title>
		<?php $this->load->view('header'); ?>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Payroll</title>
<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
		.containers{
		background:	rgb(243, 244, 247);
		height: calc(100vh);
	}
		thead{
			background:#8D91AA;
		}
		tr:nth-child(even){
			background:#D2D0D0 !important;
		}
		tr:nth-child(odd){

			background: #F3F4F7 !important;
		}
		th{
			background: #8D91AA;
			color: #F3F4F7;
		}
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.sort-by{

		}
		
		.table-div{
			height:80vh;
			padding: 0 20px 0 20px;
		}
/*		.center-list{
			display:none;
			box-shadow:0 0 1px 1px rgb(242, 242, 242) ;
		}
		.center-list a{
			display:block;
			position: relative;
			text-decoration: none;
			color:black;			
		}
		.sort-by:hover .center-list{
			display:block;
			background:white;
			position:absolute;
			margin-top:5px;
			margin-left:-15px;
			padding:10px;
		}*/
		.sort-by:hover::after{
			position:absolute;	
		}
		.heading-bar{
			padding: 0 20px 0 20px;
		}

		.filter-icon{
			border:1px solid rgba(0,0,0,0.7);
			padding:8px;
			border-radius: 20px
		}
		.filter-icon span{
			padding: 0 5px;
		}
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
			background: rgb(164, 217, 214);
		}
		.create a{
		    color: rgb(23, 29, 75) !important;
		    font-weight: 700;
		}
		#create-new-roster{
			color:white;
		}
		.data-buttons{
			padding:10px;
		}
		/* The Modal (background) */
.modal {
  display: none; 
  position: fixed;
  z-index: 1; 
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
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}

/* The Close Button */

#ui-datepicker-div{
	background:white;
	color:black;
	background: white;
    padding: 50px;
    border-radius: 30px;
}
.ui-state-default{
	color:black;
	font-size:20px;
}
.ui-datepicker-prev{
	margin:20px;
	padding:10px;
	background:#e0e0e0;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	cursor:pointer;
}
.ui-datepicker-next{
	margin: 20px;
	padding:10px;
	background:#e0e0e0;
	border-top-right-radius: 20px;
	border-bottom-right-radius: 20px;
	cursor:pointer;
}
.ui-datepicker-title{
	text-align: center;
	margin:30px 30px 10px 30px;
}
#down-arrow::after{
		position:relative;
        content: "";
        background: url("<?php echo base_url('/assets/images/calendar.png') ?>");
        background-repeat: no-repeat;
        background-size: 20px;
        padding:10px;
        top: 5px;
        right: 30px;
}

.ui-datepicker-current-day{
	background:skyblue;
	color:white;
}

.ui-datepicker-today{
	background:#307bd3;
}
.ui-datepicker-today a{
	color:white !important;
}
.ui-datepicker-calendar thead tr{
	background: #80B9FF
}
.ui-datepicker-calendar thead th{
	margin:5px;
}
.ui-datepicker-calendar tbody tr:nth-child(even){
	background: white
}
	.button{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  min-width:5rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
	}
	.close_button{
		cursor:pointer;
		display: flex;
		justify-content: center;
	}
	.close_button_div{
		margin-top: 2rem;
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
    td[data-handler="selectDay"]{
    	text-align:center;
    }
    td:hover{
    	cursor: pointer
    }
    #roster-heading{
    	font-size: 1.75rem;
    	font-weight: bold;
    	color: rgb(23, 29, 75) !important;
    }
    select{
	background: rgb(164, 217, 214);
	font-weight: 700;
	color: rgb(23, 29, 75);
	border-radius: 20px;
    padding: 5px;
    padding-left: 20px;
    border: 2px solid #e9e9e9 !important;
		}
		select:hover{
			cursor: pointer;
		}
.dataTables_wrapper {
	height:95%;
	overflow-y: hidden;
	background: white;
	box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);
}
table.dataTable tbody th, table.dataTable tbody td{
	padding:1rem;
	border: none !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1rem;
    border: none !important;
}
table.dataTable.no-footer{
	border: none !important;
}
table.dataTable{
	margin-top: 0 !important;
	margin-bottom: 0 !important;
}
	.dataTables_paginate span .paginate_button{
		background:none !important;
		border:none !important;
		border-color: transparent;
	}
	.dataTables_paginate{
		position: fixed;
		bottom: 0;
		right: 0
	}
	.loader {
	  border: 16px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 16px solid #307bd3;
	  width: 120px;
	  height: 120px;
	  animation: spin 2s linear infinite;
	}
	.loading{
		position: fixed;
		height: 100vh;
		width: 100vw;
		top: 0;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.button{
    border: none;
    color: rgb(23, 29, 75);
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-weight: 700;
    margin: 2px;
    min-width:6rem;
    border-radius: 20px;
    padding: 4px 8px;
    background: rgb(164, 217, 214);
    font-size: 1rem;
  }
/* Sorted flag modal*/
	.flag_textarea{
		height: 60%;
    width: 80%;
    border-radius: 1rem;
    background: #F3F4F7;
    border: 1px solid #D2D0D0;
    padding: 0.5rem;
	}
	.flag_textarea::placeholder{
    text-align: center;
    padding-top: 20%;
	}
	#flag_modal{
	  width: 100%;
	  height: 100%;
	  background: transparent;
	  position: absolute;
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  top: 0;
	  left: 0;
	  display: none;
	}
	.flag_modal_heading{
	  height: 15%;
	  background: #8D91AA;
	  display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    color: #E7E7E7;
	}
	.flag_modal{
	  width: 30%;
	  height: 70%;
	  box-shadow: 0 0 0.5rem 0.5rem rgba(0,0,0,0.1)
	}
	.flag_buttons{
		display: flex;
		justify-content: center;
		align-items: center;
		height: 15%;
	}
	.flag_body{
	  height: 70%;
	  background: #fff;
	  display: flex;
    justify-content: center;
    align-items: center;
	}
/* Sorted flag modal*/

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}
	.flag_button{
		box-shadow: 0px 5px 6px #9a9999;
	}
	.FLAGGED_flag{
		background:#FBECA4;
	}
    @media only screen and (max-width :600px){
    	.modal-content {
		  background-color: #fefefe;
		  margin: auto;
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%;
		}
		table{
			background: white;
			display: block;
		}
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
		.sort-by{
			margin-right:0px !important;
			padding:0 !important;
		}
		#roster-heading{
			font-size: 1.5rem !important;
			margin: 0 !important;
			display: flex;
			align-items: center
		}
		.table  td,.table th{
			padding: 0.75rem;
			border: none;
		}
		.create{
			width: 150px;
			overflow: hidden;
		}
		.center-list{
			width: 100px
		}
		body{
			max-width: 100vw;
			overflow: hidden;
		}
    }
</style>
</head>
<body>
	<?php
		$payrollTypes = json_decode($payrollTypes);
		$entitlements = json_decode($entitlements);
		$permissions = json_decode($permissions);

		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
		function dateToDayAndYear($date){
			$date = explode("-",$date);
			return date("M d, Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
<div class="containers">
	<?php  ?>
	<div class="d-flex heading-bar">
		<span class="m-3" id="roster-heading" style="">Payroll Shifts</span>
		<span class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
<?php 
if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ ?> 
<!-- 			<div class="filter-icon d-flex">
				<span class="">Sort&nbsp;by</span>
				<span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div> -->

						<?php } ?>
		</span>

		<?php 
					if(isset($payrollShifts)){
						$payrollShifts = json_decode($payrollShifts); 
					}
		if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ 
			if(isset($payrollShifts) && $payrollShifts->payrun == null){
			?>
		<span class="btn ml-auto d-flex align-self-center create">
			<a href="javascript:void(0)" id="create-new-roster" class="d-flex" id="publish">
			<i>
				<img src="<?php echo base_url('assets/images/icons/publish.png'); ?>" style="margin-right:10px">
			</i>Publish</a>
		</span>
		<?php } 
			}
		?>
	</div>
	<div class="table-div">
		<table class="table">
		<?php 
		if(isset($payrollShifts) && $payrollShifts->payrun == null){

		 ?>
			<thead>
				<th>Name</th>
				<th>Role</th>
				<th>Entitlement</th>
				<th>Hourly Rate</th>
				<th>Total Pay</th>
				<th>Action</th>
			</thead>
			
			<tbody id="tbody">

				<?php 
				if(isset($payrollShifts)){
					// print_r($payrollTypes);
					// print_r($payrollShifts);
				$centerid = $payrollShifts->centerid;
				for($i=0;$i<count($payrollShifts->employees);$i++){
				?>
				<?php if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ ?>
				<tr id="<?php echo $this->input->get('timesheetId') ?>" >
					<td class="shift-edit" 
							cal-x="<?php echo $i; ?>">
							<?php echo $payrollShifts->employees[$i]->userDetails->name ?>
					</td>
					<td class="shift-edit" 
							cal-x="<?php echo $i; ?>">
						<?php echo $payrollShifts->employees[$i]->userDetails->title ?>
					</td>
					<td class="shift-edit" 
							cal-x="<?php echo $i; ?>">
							<?php 				
						foreach($entitlements->entitlements as $ent){
				 			if($ent->id == $payrollShifts->employees[$i]->userDetails->level){
								 echo $ent->name;
								}
							} ?>
					</td>
					<td class="shift-edit" 
							cal-x="<?php echo $i; ?>">
						<?php
							$rate = 0;

							 foreach($entitlements->entitlements as $ent){
							 	if($ent->id == $payrollShifts->employees[$i]->userDetails->level)
							 	{
							 		$rate = $ent->hourlyRate;
							 		echo "$".$ent->hourlyRate."/hr";
							 	}
							 }
						 ?>	
					</td>

				<?php 
					$totalTime = 0;
					$payrollType = 0;
					foreach($payrollShifts->employees[$i]->payrollShifts as $payrollShift ){
						foreach($payrollTypes->payrollTypes as $payrollType){
							if($payrollType->earningRateId == $payrollShift->payrollType && $centerid == $payrollType->centerid) {
								$startMins = intval(($payrollShift->startTime)/100)*60 + ($payrollShift->startTime)%100;
								$endMins = intval(($payrollShift->endTime)/100)*60 + ($payrollShift->endTime)%100;
								$totalTime = $totalTime + (intval(($endMins - $startMins)/60)*$rate + ($rate*((($endMins - $startMins)%60)*(10/6)))/100); 
							}
						}
					}

				 ?>
					<td pay="<?php echo $totalTime; ?>" userid="<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>" timesheetid="<?php  echo $payrollShifts->timesheetid ?>"><?php echo '$ '.sprintf("%.02f",$totalTime); ?></td>
					<?php if($payrollShifts->employees[$i]->payrollShifts[0]->status != 'FLAGGED'){ ?>
					<td >
						<button class="button flag_button flagged" userid="<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>"  timesheetid="<?php  echo $payrollShifts->timesheetid ?>" onclick="flag('<?php  echo $payrollShifts->timesheetid ?>','<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>')">
							<i>
								<img src="<?php echo base_url('assets/images/icons/flag.png'); ?>" style="max-height:1.3rem;margin-right:10px">
							</i>Flag</button>
					</td>
				<?php }else{ ?>
						<td class="FLAGGED_flag" userid="<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>"  timesheetid="<?php  echo $payrollShifts->timesheetid ?>">
							<span>FLAGGED</span>
						</td>
					<?php } ?>
					</tr>
				<?php }?>
		<?php } } ?>
			</tbody>
	<?php } 
		if(isset($payrollShifts) && $payrollShifts->payslips != null){ 
			?>
			<thead>
				<th>Name</th>
				<th>Wages</th>
				<th>Deductions</th>
				<th>Tax</th>
				<th>Super</th>
				<th>Reimbursement</th>
				<th>NetPay</th>
				<th>Print</th>
			</thead>
			
			<tbody id="tbody">

				<?php 
				$centerid = $payrollShifts->centerid;
				for($i=0;$i<count($payrollShifts->payslips);$i++){
				?>
				<?php if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ ?>
				<tr id="<?php echo $this->input->get('timesheetId') ?>" >
					<td class="shift-edit" >
							<?php echo $payrollShifts->payslips[$i]->FirstName." ".$payrollShifts->payslips[$i]->FirstName ?>
					</td>
					<td class="shift-edit" ><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Wages) ?></td>
					<td class="shift-edit" ><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Deductions) ?></td>
					<td class="shift-edit" ><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Tax) ?></td>
					<td class="shift-edit"><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Super) ?></td>
					<td  class="shift-edit"><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Reimbursements) ?></td>
					<td  class="shift-edit"><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->NetPay) ?></td>
					<td><i><img  payslipId="<?php echo $payrollShifts->payslips[$i]->PayslipID ?>" class="print_image" src="<?php echo base_url('assets/images/icons/print.png'); ?>" height="18px" width="18px"></i></td>
				</tr>
				<?php }?>
				<?php if(((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "N") && ($payrollShifts->payslips[$i]->EmployeeUserid == $this->session->userdata('LoginId'))){ ?>
				<tr id="<?php echo $this->input->get('timesheetId') ?>" >
					<td class="shift-edit" >
							<?php echo $payrollShifts->payslips[$i]->FirstName." ".$payrollShifts->payslips[$i]->FirstName ?>
					</td>
					<td class="shift-edit" ><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Wages) ?></td>
					<td class="shift-edit" ><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Deductions) ?></td>
					<td class="shift-edit" ><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Tax) ?></td>
					<td class="shift-edit"><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Super) ?></td>
					<td  class="shift-edit"><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->Reimbursements) ?></td>
					<td  class="shift-edit"><?php echo '$'.sprintf("%.02f",$payrollShifts->payslips[$i]->NetPay) ?></td>
					<td><i><img  payslipId="<?php echo $payrollShifts->payslips[$i]->PayslipID ?>" class="print_image" src="<?php echo base_url('assets/images/icons/print.png'); ?>" height="18px" width="18px"></i></td>
				</tr>
				<?php }?>
			<?php } ?>
			</tbody>
	<?php	}	?>
		</table>
	</div>
	<div>
	
</div>
</div>

<!-- ----------------------
		Payroll Flag Modal
------------------------ -->
<div id="flag_modal">
    <span class="flag_modal">
      <div class="flag_modal_heading">Flagged</div>
      <div class="flag_body">
      	<textarea class="flag_textarea" placeholder="Enter reason for flagging"></textarea>
      </div>
      <div class="flag_buttons">
          <button onclick="closes()" id="flag_modal_close" class="button">
            <i>
              <img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>Close</button>
          <button  id="flag_modal_save" class="button">
            <i>
              <img src="<?php echo base_url('assets/images/icons/flag.png'); ?>" style="max-height:1.3rem;margin-right:10px">
            </i>Flag</button>
      </div>
    </span>
</div>
<!-- ----------------------
		Payroll Flag Modal
------------------------ -->

<!--This is meant for admin-->
<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')==ADMIN){ ?>
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
	  	<span class="row titl">
	  		<span style="" class="box-name-space col-10">
	  			<span class="box-name row"></span>
	  			<span class="box-space row"></span>
	  		</span>
	  	</span>
	    
	<div class="modalSpace">
		
	</div>
	  		<div class="d-flex justify-content-center close_button_div">
	  			<span class="close_button col-2 d-flex align-items-center button" >Close</span>
	  		</div>
	  </div>
</div>
<?php } ?>
<!-- Till here -->>


	<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>


<?php if($this->session->userdata('UserType') == ADMIN || $this->session->userdata('UserType') == SUPERADMIN){?>
<script type="text/javascript">
				var modal = document.getElementById("myModal");
				var htmlVal = $('timesheet-form').html()
				$(document).on('click','.shift-edit',function(){
					 modal.style.display = "block";
					//var arrayType = $(this).attr('array-type');
					//var v = $(this).attr('name');
					//var w = $('.day').eq($(this).index()).html();
					var x = $(this).attr('cal-x');
					//var y = $(this).attr('cal-p');
					//var eId = $('#employee-id').val($('this').attr('emp-id'))
					//var sDate = $('#start-date').val($(this).attr('curr-date'))
					//var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
					 $.ajax({
					 	url : "<?php echo base_url() ?>payroll/payrollShiftsModal?timesheetId="+"<?php echo $timesheetId; ?>&x="+x,
					 	type : 'GET',
					 	success : function(response){

					 		$('.modalSpace').html(response)
					 	}
					 })
				})

				$(document).on('click','.close_button',function(){
					 modal.style.display = "none";
					 $('.modalSpace').empty();
					// $('timesheet-form').html(htmlVal);
					// $('#timesheet-form').trigger('reset');
				})
</script>

<?php }?>
	<script type="text/javascript">
	$(document).ready(()=>{
	if($(document).width() > 1024){
		$('.containers').css('paddingLeft',$('.side-nav').width());					
		}
	});
	</script>

	<script type="text/javascript">
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


</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.create',function(){
			var length = $('[pay]').length;
			// console.log(length)
			var array = [];
			var object = {};
			var url = '<?php echo base_url() ?>payroll/getAllPayruns/<?php echo $timesheetId ?>';
			for(var i=0;i<length;i++){
				object = {};
				object.pay = $('[pay]').eq(i).attr('pay');
				object.userid = $('[pay]').eq(i).attr('userid')
				object.timesheetid = $('[pay]').eq(i).attr('timesheetid')
				array.push(object)
			}
			console.log(array)
				$.ajax({
					url : url,
					method : 'POST',
					data : {
						array : array
					},
					success : function(response){
						var url_publish = "<?php echo base_url() ?>payroll/updateToPublished"
						$.ajax({
							url : url_publish,
							method : 'POST',
							data : {
								array : array
							},
							success : function(res){
								alert('Payroll Published')
								window.location.reload();
								// console.log(array);
						}
					})
				}
			})
		})
	})

	$(document).ready(function(){
		 $(document).on('click','.FLAGGED_flag',function(){
		 	var timesheetid = $(this).attr('timesheetid');
		 	var userid = $(this).attr('userid')
		 	var url = `<?php echo base_url() ?>payroll/updateShiftStatus/${timesheetid}/${userid}`;
		 	var message = "";
		 		$.ajax({
		 			url : url,
		 			type : 'POST',
		 			data : {
		 				message : message
		 			},
		 			success : function(response){
		 				window.location.reload();
		 			}
		 		})
		 })
	})

	$(document).on('click','.print_image',function(){
		var timesheetid = '<?php echo $this->input->get('timesheetId') ?>';
		var payslipId = $(this).attr('payslipid');
			window.location.href = "<?php echo base_url();?>"+`payroll/getPayslip/${payslipId}/${timesheetid}`;
	})

	$(document).ready(function(){
		 $(document).on('click','#flag_modal_save',function(){
		 	var timesheetid = $(this).attr('timesheetid');
		 	var userid = $(this).attr('userid')
		 	var url = `<?php echo base_url() ?>payroll/updateShiftStatus/${timesheetid}/${userid}`;
		 	var message = $('.flag_textarea').val();
		 		$.ajax({
		 			url : url,
		 			type : 'POST',
		 			data : {
		 				message : message
		 			},
		 			success : function(response){
		 				window.location.reload();
		 			}
		 		})
		 })
	})

</script>
<script type="text/javascript">
	function flag(timesheetid,userid){
		var docs = document.getElementById('flag_modal');
		var selector = document.getElementById('flag_modal_save');
			selector.setAttribute("timesheetid",timesheetid);
			selector.setAttribute("userid",userid);
	  docs.style.display = "flex"
	}
	function closes(){
		var selector = document.getElementById('flag_modal_save');
			selector.removeAttribute('timesheetid');
			selector.removeAttribute('userid');
		var docss = document.getElementById('flag_modal');
	  docss.style.display = "none"
	}
</script>
</body>
</html>







