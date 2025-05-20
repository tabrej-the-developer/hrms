<html>
<head>
<title>Payroll</title>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<!--	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>


<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(4) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(4)::after {
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
	
<div class="wrapperContainer">
 	<?php include 'headerNew.php'; ?>
	<?php
		$payrollTypes = json_decode($payrollTypes);
		// $entitlements = json_decode($entitlements);
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
	<div class="containers scrollY">
		<div class="payrollContainer">
		<?php echo $this->session->userdata('x-device-id'); ?>
	 <?php echo $this->session->userdata('AuthToken'); ?>
	 <?php echo $this->session->userdata('LoginId'); ?>
			<!-- <php echo $this->session->userdata('x-device-id'); ?>
			<php echo $this->session->userdata('AuthToken'); ?> -->
			<div class="d-flex pageHead heading-bar">
				<span class="events_title">Payroll Shifts</span>
				<span class="sort-by rightHeader <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
					<?php 
						if(isset($payrollShifts)){
							$payrollShifts = json_decode($payrollShifts); 
						}
					if((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y"){ 
						if(isset($payrollShifts) && $payrollShifts->payrun == null){
						?>
						<a href="javascript:void(0)" class="d-flex btn btn-default btn-small btnBlue pull-right create" id="publish">
							<span class="material-icons-outlined">file_upload</span>
							Publish
						</a>
					<?php 
							} 
						}
					?>
				</span>
			</div>
			<div class="table-div pageTableDiv">
				<table class="table">
					<?php if(isset($payrollShifts) && $payrollShifts->payrun == null){ ?>
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
												echo $payrollShifts->employees[$i]->userDetails->levelTitle;
											?>
									</td>
									<td class="shift-edit" 
											cal-x="<?php echo $i; ?>">
										<?php
											$rate = 0;
											$rate = $payrollShifts->employees[$i]->userDetails->hourlyRate + $payrollShifts->employees[$i]->userDetails->bonusRate;
											echo "$".$rate."/hr";
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
												// echo intval(($endMins - $startMins)/60)*$rate;
												// $totalTime = $totalTime + (intval(($endMins - $startMins)/60)*$rate + ($rate*((($endMins - $startMins)%60)*(10/6)))/100)*$payrollType->multiplier_amount;
												$totalTime = $totalTime + (intval(($endMins - $startMins)/60)*$rate + ($rate*((($endMins - $startMins)%60)*(10/6)))/100)*1; 
											}
										}
									}

								?>
									<td pay="<?php echo $totalTime; ?>" userid="<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>" timesheetid="<?php  echo $payrollShifts->timesheetid ?>"><?php echo '$ '.sprintf("%.02f",$totalTime); ?></td>
									<?php if($payrollShifts->employees[$i]->payrollShifts[0]->status != 'FLAGGED'){ ?>
									<td style="display: flex;justify-content: center;">
										<button class="button flag_button btn btn-default btn-small btnOrange flagged" userid="<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>"  timesheetid="<?php  echo $payrollShifts->timesheetid ?>" onclick="flag('<?php  echo $payrollShifts->timesheetid ?>','<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>','create')">
										<span class="material-icons-outlined">flag</span> Flag</button>
									</td>
								<?php }else{ ?>
										<td style="display: flex;justify-content: center;" class="FLAGGED_flag" userid="<?php  echo $payrollShifts->employees[$i]->payrollShifts[0]->userid ?>"  timesheetid="<?php  echo $payrollShifts->timesheetid ?>">
											<span>FLAGGED</span>
										</td>
									<?php } ?>
									</tr>
								<?php }?>
							<?php } } ?>
						</tbody>
					<?php } else{ ?>
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
						<?php if(isset($payrollShifts) && $payrollShifts->payslips != null){  ?>
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
								<td style="text-align:center;"><i><img  payslipId="<?php echo $payrollShifts->payslips[$i]->PayslipID ?>" class="print_image" src="<?php echo base_url('assets/images/icons/print.png'); ?>" height="18px" width="18px"></i></td>
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
								<td style="text-align:center;"><i><img  payslipId="<?php echo $payrollShifts->payslips[$i]->PayslipID ?>" class="print_image" src="<?php echo base_url('assets/images/icons/print.png'); ?>" height="18px" width="18px"></i></td>
							</tr>
							<?php }?>
							<?php } ?>
						</tbody>
					<?php	}
					}
				?>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- ----------------------
		Payroll Flag Modal
------------------------ -->
<div id="flag_modal" class="modal modalNew">
	<div class="modal-dialog mw-40">
		<span class="flag_modal modal-content NewFormDesign">
			<div class="flag_modal_heading modal-header ">
				<h3 class="modal-title ">Flagged</h3>
			</div>
			<div class="flag_body modal-body container">
				<div class="col-md-12">
					<div class="form-floating">						
						<textarea id="reason" class="flag_textarea form-control" placeholder="Enter reason for flagging"></textarea>
						<label for="reason">Enter reason</label>
					</div> 
				</div>
				<div class="flag_buttons modal-footer">
					<button  id="flag_modal_save" class="button btn btn-default btn-small btnOrange pull-right">
						<span class="material-icons-outlined">flag</span>
						Flag
					</button>
					<button onclick="closes()" id="flag_modal_close" class="button btn btn-default btn-small pull-right">
						<span class="material-icons-outlined">close</span>
						Close
					</button>
				</div>
			</div>
			
		</span>
	</div>
</div>
<!-- ----------------------
		Payroll Flag Modal
------------------------ -->

<!--This is meant for admin-->
<?php if ((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y") { ?>
	<div id="myModal" class="modal modalNew">
		<div class="modal-dialog mw-75">
	  <!-- Modal content -->
			<div class="modal-content NewFormDesign">
				<span class="titl modal-header">
					<h3 class="box-name">
					</h3>
				</span>
				<div class="modal-body container">
					<div class="modalSpace payrollTemplateTable"></div>
					<div class="modal-footer">
						<span class="close_button button btn btn-default btn-small btnOrange pull-right" >Close</span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<!-- Notification -->
<div class="notify_">
	<div class="note">
		<div class="notify_body">
			<span class="_notify_message"></span>
			<span class="_notify_close" onclick="closeNotification()">&times;</span>
    	</div>
	</div>
</div>
<!-- Notification -->

<!-- Till here -->


	<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );

	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>


<?php if ((isset($permissions->permissions) ? $permissions->permissions->editPayrollYN : "N") == "Y") { ?>
<script type="text/javascript">
				var modal = document.getElementById("myModal");
				var htmlVal = $('timesheet-form').html()
				$(document).on('click','.shift-edit',function(){
					 modal.style.display = "block";
					//var arrayType = $(this).attr('array-type');
					//var v = $(this).attr('name');
					//var w = $('.day').eq($(this).index()).html();
					var x = $(this).attr('cal-x');
					var that = $(this);
					//var y = $(this).attr('cal-p');
					//var eId = $('#employee-id').val($('this').attr('emp-id'))
					//var sDate = $('#start-date').val($(this).attr('curr-date'))
					//var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
					 $.ajax({
					 	url : "<?php echo base_url() ?>payroll/payrollShiftsModal?timesheetId="+"<?php echo $timesheetId; ?>&x="+x,
					 	type : 'GET',
					 	success : function(response){
							 var name = that.parent().children('.shift-edit').html();
							$('.box-name').html(`${name}`);
							$('.modalSpace').html(response);
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

// Notification //
	function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
    	if($('.notify_').css('visibility') == 'hidden'){
     		$('._notify_message').append(`<li>${message}</li>`)
    	}
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }
// Notification //

	$(document).ready(function(){
		$(document).on('click','.create',function(){
			// alert("HELLO");
			if($('.FLAGGED_flag').length == 0){
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
				// console.log(array)
					$.ajax({
						url : url,
						method : 'POST',
						data : {
							array : array
						},
						success : function(response){
							console.log(response);
							var res = jQuery.parseJSON(response);
							console.log(jQuery.parseJSON(response));
							if(res.status == 200){
							var url_publish = "<?php echo base_url() ?>payroll/updateToPublished";
							$.ajax({
								url : url_publish,
								type : 'POST',
								data : {
									array : array
								},
								success : function(res){
									alert('Payroll Published');
									window.location.reload();
									// console.log(array);
									console.log(res);
								}
							})
						}
						else{
							addMessageToNotification('Error While Publishing');
							showNotification();
							setTimeout(closeNotification,5000)
						}
					}
				})
			}else{
		        addMessageToNotification('Unflag before submit');
		      	showNotification();
				setTimeout(closeNotification,5000)
			}
		})
	})

	$(document).on('click','.print_image',function(){
		var timesheetid = '<?php echo $this->input->get('timesheetId') ?>';
		var payslipId = $(this).attr('payslipid');
			window.location.href = "<?php echo base_url();?>"+`payroll/printPayslipPDF/${payslipId}/${timesheetid}`;
	})

	$(document).ready(function(){
		 $(document).on('click','#flag_modal_save',function(){
			 var type = $(this).attr('modalType')
			 if(type == 'create'){
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
			}else{
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
			}
		 })
	})


	function flag(timesheetid,userid,type){
		var docs = document.getElementById('flag_modal');
		var selector = document.getElementById('flag_modal_save');
			selector.setAttribute("timesheetid",timesheetid);
			selector.setAttribute("userid",userid);
			selector.setAttribute("modalType",type);
	  		docs.style.display = "flex";
			if(type == 'create')
			 	$('#flag_modal_save').html(`<span class="material-icons-outlined">flag</span> Flag`);
	}

	function closes(){
		var selector = document.getElementById('flag_modal_save');
			selector.removeAttribute('timesheetid');
			selector.removeAttribute('userid');
			selector.removeAttribute("modalType");
			var docss = document.getElementById('flag_modal');
			$('.flag_textarea').val("");
	  		docss.style.display = "none"
	}

	$(document).on('click','.FLAGGED_flag',function(){
		var timesheetid = $(this).attr('timesheetid');
		var userid = $(this).attr('userid');
		var url = "<?php echo base_url('payroll/getPayrollDetails') ?>";
		$('#flag_modal_save').html(`<span class="material-icons-outlined">flag</span> Unflag`);
		$.ajax({
			url : url,
			type : 'POST',
			data : {
				timesheetid : timesheetid,
				userid : userid
			},
			success : function(res){
				var response = JSON.parse(res);
				flag(timesheetid,userid,'edit');
				$('.flag_textarea').val(response.Message);
			} 
		}) 
	})


</script>
</body>
</html>