<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css');?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css');?>">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(9) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(9)::after {
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
<body class="add_employee_body">
	<div class="wrapperContainer">
		<?php include 'headerNew.php'; ?>
		<div class="containers scrollY">
			<div class="settingsContainer ">

			<span class="d-flex pageHead heading-bar">
				<div class="withBackLink">
					<a onclick="goBack()" href="#">
					<span class="material-icons-outlined">arrow_back</span>
					</a>				
					<span class="events_title">Add Employee</span>
				</div>
				<div class="rightHeader">					
					<a class="btn btn-default btn-small btnBlue pull-right" href="<?php echo base_url('settings/AddMultipleEmployees');?>">
						Add Multiple Employees
					</a>
				</div>
			</span>
		
			<div class="addEmployee-container">
				<div class="addEmployee-container-child">
					<?php $permissions = json_decode($permissions); ?>
					<?php if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "Y"){ ?>
					<!-- <section class="tab-buttons">
						<div class="tab-buttons-div">
						<span class="nav-button e-s"><span>Personal</span></span> -->
						<!-- <span class="nav-button e-b-a-s"><span>Bank Account</span></span> -->
						<!-- <span class="nav-button e-s-s"><span> Superannuation </span></span> -->
						<!-- <span class="nav-button e-t-d-s"><span>Tax Declaration </span></span> -->
						<!-- <span class="nav-button e-u-s"><span>Employment</span></span>	 -->
						<!-- <span class="nav-button m-i"><span>Medical Info</span></span> -->
						<!-- </div>	
					</section> -->
					<form method="POST" action="createEmployeeProfile" id="myForm" onsubmit="return onFormSubmit(event)" enctype="multipart/form-data">
						<section class="employee-section">	
							<!-- <h3>Personal</h3> -->
							<span class="d-flex addEmpFlex">
								

								<span class="col-md-3">
									<div class="form-floating">
										<select  id="title"  class="form-control" type="text" name="title"> 
											<option value="Ms">Ms</option> 
											<option value="Mr">Mr</option>
											<option value="Mrs">Mrs</option>
										</select>
										<label  for="title" class="labels__">Title</label>
									</div>
								</span>

						<!-- <span class="span-class name__"> -->

						<!-- <span class=" row row_addEmployee ml-1 "> -->

								<span class="col-md-3 ">
									<div class="form-floating">
										<input id="fname"  class="form-control" placeholder="First Name" type="text" name="fname" required>
										<label class="fname">First Name<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
									</div>
								</span>

								<span class="col-md-3">
									<div class="form-floating">
										<input id="mname"  class="form-control" value="" type="text" name="mname" placeholder="Middle Name" >
										<label for="mname" class="labels__">Middle Name</label>
									</div>
								</span>

								<span class="col-md-3 ">
									<div class="form-floating">
										<input id="lname"  class="form-control" type="text" name="lname" placeholder="Last Name" required>
										<label for="lname" class="labels__">Last Name<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
									</div>
								</span>
								<!-- </span> -->
								<!-- </span> -->
							</span>
		

						<span class="d-flex addEmpFlex">
							<span class="col-md-3">
								<div class="form-floating">
									<input id="alias"  class="form-control" type="text" placeholder="Enter Alias" name="alias" required>
									<label for="alias" class="labels__">Alias<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>" ></sup></label>
								</div>
							</span>
				<!-- 		<span class="span-class col-3">
							<label class="labels__">Date Of Birth</label>
							<input id="dateOfBirth"  class="" type="date" name="dateOfBirth">
						</span> -->
						<span class="col-md-3">
							<div class="form-floating">
								<select id="gender"  class="form-control" name="gender" required>
									<option value="N">Not Given</option>
									<option value="M">Male</option>
									<option value="F">Female</option>
									<option value="I">Non binary</option>
								</select>
								<label for="gender" class="labels__">Gender<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
							</div>	
						</span>
						<span class="col-md-3">
							<div class="form-floating">
								<input class="form-control" type="date" name="dateOfBirth" required>
								<label for="dob" class="labels__">DOB<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
							</div>	
						</span>
						</span>
						<!-- 		<span class="span-class profileImage_input">
									<label class="labels__">Profile Image</label>
									<input id="profileImage"  class="profileImage" type="FILE" name="profileImage">
								</span> -->
									<hr>	
						<!-- 		<span class="span-class col-3">
									<label class="labels__">Job Title<sup>
										<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
									</sup></label>
									<input id="jobTitle"  class="" type="text" name="jobTitle">
								</span> -->
							
								<span class="span-class row row_addEmployee ">
								<label class="labels__">Address</label>	
									<span class="span-class col">
										<div class="form-floating">
											<input id="homeAddLine1" class="form-control" type="text" name="homeAddLine1" required>
											<label class="labels__">Home Address Line1<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div>
									</span>
									<span class="span-class col">
										<div class="form-floating">
											<input  type="text" id="homeAddCity" class="form-control"  name="homeAddCity" required>
											<label class="labels__">City<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div>
									</span>				
									<span class="span-class col">
										<div class="form-floating">
												<select id="homeAddRegion" class="form-control" type="text" name="homeAddRegion" required>
													<option value="ACT">Australian Capital Territory</option>
													<option value="NSW">New South Wales</option>
													<option value="NT">Northern Territory</option>
													<option value="QLD">Queensland </option>
													<option value="SA">South Australia</option>
													<option value="TAS">Tasmania </option>
													<option value="VIC">Victoria</option>
													<option value="WA">Western Australia</option>
												</select>
											<label class="labels__">Region<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div>
									</span>
									<span class="span-class col">
										<div class="form-floating">
											<input id="homeAddPostal" class="form-control" type="text" name="homeAddPostal" required>
											<label class="labels__">Postal<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div>
									</span>
									<span class="span-class col">
										<div class="form-floating">
											<input id="homeAddCountry" class="form-control" type="text" name="homeAddCountry" required>
											<label class="labels__">Country<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div>
									</span>
					</span>
								<!-- <hr> -->
						<!-- 		<span class="span-class col-3">
									<label class="labels__">Phone</label>
									<input id="phone"  class="" type="text" name="phone">
								</span>
								<span class="span-class col-3">
									<label class="labels__">Mobile</label>
									<input id="mobile"  class="" type="text" name="mobile">
								</span> -->
						<span class="d-flex addEmpFlex">
						<span class="col-md-3">
							<div class="form-floating">
								<input id="emails"  class="form-control" type="text" name="emails" required>
								<label for="emails" class="labels__">Email<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
							</div>
						</span>

						<span class="col-md-3">
							<div class="form-floating">
								<input id="employee_no" class="form-control" type="text" name="employee_no" required>
								<label for="employee_no" class="labels__">Employee Id<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
							</div>
						</span>

						<!-- 		<span class="span-class col-3">
									<label class="labels__">Xero Employee Id</label>
									<input id="xeroEmployeeId" type="text" name="xeroEmployeeId">
								</span> -->
						<span class="col-md-3">
							<div class="form-floating">
								<select id="center" class="form-control" name="center" required>
									<option value="0">--Center--</option>
									<?php 
										$centers = json_decode($centers);
									foreach($centers->centers as $center){ ?> 
										<option value="<?php echo $center->centerid;?>" <?php if($_SESSION['centerr'] == $center->centerid){ echo "selected";}?>><?php echo strtoupper($center->name); ?></option>
									<?php } 
									$centerId = "";
									foreach($centers->centers as $center){ 
											$centerId = $centerId . $center->centerid . "|";
									} ?>
									<option value="<?php echo $centerId; ?>">All Centers</option>
								</select>
								<label for="center" class="labels__">Center<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
							</div>
						</span>

						<span class="col-md-3">
							<div class="form-floating">
								<select id="area" class="form-control" name="area" required>
									<option value="0">--select--</option>
								<?php 
								$areas = json_decode($areas);
								foreach($areas->areas as $area){
								?>
								<option value="<?php echo $area->areaId; ?>" ><?php echo $area->areaName; ?></option>
								<?php } ?>
								</select>
								<label for="area" class="labels__">Area<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
							</div>
						</span>

					</span>

					<span class="d-flex addEmpFlex">

					<span class="col-md-3">
						<div class="form-floating">
							<select id="role" class="form-control" name="role" required>
								<option value="0">--select--</option>

								<?php foreach($areas->areas as $roles){?>
									<?php foreach($roles->roles as $role){?>
								<option area-id="<?php print_r($role->areaid); ?>" value="<?php echo $role->roleid ?>"><?php print_r($role->roleName) ?></option>
								<?php } } ?>
							</select>
							<label for="role" class="labels__">Role<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
						</div>
					</span>

					<!-- 		<span class="span-class col-3">
								<label class="labels__">Manager</label>
								<input id="manager" type="text" name="manager">
							</span>
					-->

					<span class="col-md-3">
						<div class="form-floating">
							<select id="level" class="form-control" name="level" required>
								<?php $levels = json_decode($levels);
									foreach($levels->entitlements as $level){
									?>
								<option value="<?php echo $level->id; ?>,<?php echo $level->hourlyRate; ?>"><?php echo $level->name." (".$level->hourlyRate.")"; ?></option>
								<?php } ?>
							</select>
							<label for="level" class="labels__">Level<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
						</div>
					</span>

					<span class="span-class col-md-3">
						<div class="form-floating">
							<select placeholder="Ordinary Earning Rate Id" class="form-control" id="ordinaryEarningRateId" name="ordinaryEarningRateId" required>
									<?php $awardsdata = json_decode($ordinaryEarningRate);
										foreach($awardsdata->awards as $award){
										?>
									<option value="<?php echo $award->earningRateId; ?>"><?php echo $award->name; ?></option>
									<?php } ?>
							</select>
							<label for="ordinaryEarningRateId">Ordinary Earning Rate Id</label>
						</div>
					</span>

					<span class="col-md-3">
						<div class="form-floating">
							<select id="employement_type" class="form-control" name="employement_type" required>
								<option value="FT">Full Time</option>
								<option value="PT">Part Time</option>
								<option value="CT">Casual</option>
							</select>
							<label for="employement_type" class="labels__">Employment type<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
						</div>
					</span>

					<span class="span-class col-md-3">
						<div class="form-floating">
							<input placeholder="Increase of base pay" id="iobp" class="form-control" type="text" name="iobp" value="0">
							<label for="iobp">Increase of base pay (in Dollars)</label>
						</div>
					</span>

					<span class="col-md-3">
						<div class="form-floating">
							<input id="totalHours" class="form-control" placeholder="Total Hours" type="number" name="totalHours" required>
							<label class="labels__">Total Hours<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
						</div>
					</span>
					</span>

					<span class="col-md-12 daysOpen">
						<label class="labels__">Days<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
						<span class="d-flex checkDay">
							<span>
								<label for="CT_1" class="labels__">Mon</label>
								<input id="CT_1" type="checkbox" name="CT_1">
							</span>
							<span>
								<label for="CT_2" class="labels__">Tue</label>
								<input id="CT_2" type="checkbox" name="CT_2">
							</span>
							<span>
								<label for="CT_3" class="labels__">Wed</label>
								<input id="CT_3" type="checkbox" name="CT_3">
							</span>
							<span>
								<label for="CT_4" class="labels__">Thu</label>
								<input id="CT_4" type="checkbox" name="CT_4">
							</span>
							<span>
								<label for="CT_5" class="labels__">Fri</label>
								<input id="CT_5" type="checkbox" name="CT_5">
							</span>
						</span>
					</span>

	</section>
<!-- 		<span class="span-class col-3">
			<label class="labels__">created_at</label>
			<input placeholder="created_at" id="created_at"  class="" type="text">
		</span>
		<span class="span-class col-3">
			<label class="labels__">created_by</label>
			<input placeholder="created_by" id="created_by"  class="" type="text">
		</span> -->
<!-- 		<span class="span-class col-3">
			<label class="labels__">Emergency Contact</label>
		<input id="emergency_contact"  class="" type="text" name="emergency_contact">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Relationship</label>
		<input id="relationship"  class="" type="text" name="relationship">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Emergency Contact Email</label>
			<input id="emergency_contact_email"  class="" type="email" name="emergency_contact_email">
		</span> -->
	</section>











	<div class="formSubmit submit_addEmployee">
		<button type="submit" id="subm" class="btn button_submit btn btn-default btn-small btnOrange pull-right">
			<span class="material-icons-outlined">send</span> Submit
		</button>
	</div>

</form>
<?php } ?>
		</div>
	</div>
</div>
</div>
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
<script type="text/javascript">
	$(document).ready(()=>{
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
});
</script>

<?php if( isset($error) ){ ?>
<script type="text/javascript">
  var modal = document.querySelector(".modal-logout");
    function toggleModal() {
        modal.classList.toggle("show-modal");
    }
	$(document).ready(function(){
	  	toggleModal();	
	  })
		</script>
	<?php }
?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "Y"){ ?>


<script type="text/javascript">

		function empNo(){
			var finalurl = '<?= base_url('api/Settings/getEmployeeId') ?>';
			var xdeviceid = '<?= $this->session->userdata('x-device-id') ?>';
			var xtoken = '<?= $this->session->userdata('AuthToken') ?>';
			var userid = '<?= $this->session->userdata('LoginId') ?>';
			$.ajax({
				url:finalurl,
				type:"POST",
                headers:{
                    "x-device-id":xdeviceid,
                    "x-token":xtoken
                },
				data:JSON.stringify({
					"userid":userid
				}),
				success:function(result,status,xhr){
					console.log(result);
					var da = jQuery.parseJSON(result);
					if(da.Status == "SUCCESS"){
						// alert(da.Data);
						$("#employee_no").val(da.Data);
						// location.reload();
					}else if(da.Status == "ERROR"){
						alert(da.Message);
						location.reload();
					}else{
						alert(da.Message);
						location.reload();
					}
				}
			});
		}
		setInterval(function() {
		// method to be executed;
		empNo();
		}, 500);

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
		$(document).on('click','.e-b-a-s',function(){
			$('.employee-bank-account-section').css('display','block')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','block');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-s-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','block');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-t-d-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','block');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.e-u-s',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','block');
			$('.medical-info').css('display','none');
		})
		$(document).on('click','.m-i',function(){
			$('.employee-bank-account-section').css('display','none')
			$('.employee-section').css('display','none');
			$('.employee-superfund-section').css('display','none');
			$('.employee-tax-declaration-section').css('display','none');
			$('.employee-details').css('display','none');
			$('.medical-info').css('display','block');
		})
	})

	var new_child = $('.parent-child ').html();
	$(document).on('click','.add-row',function(){
		$('.parent-child').append(new_child);
				accountCount();
	});
	$(document)
	function accountCount(){
		var count = $('.statement').length;
			for(x=0 ; x< count ; x++){
			$('.statement').eq(x).text('Account '+ (x+1))
		}
	}

	accountCount();
		

	$(document).ready(function(){
		$(document).on('click','.add-row',function(){
			var count = $('.statement').length;
			if(count > 1){
				$('.amount-class-parent').eq(0).empty();
				$('.remainderYN[value="Y"]').eq(0).prop('checked',true);
				for(i = 1 ; i < count ; i++){
						$('.remainder_parent').eq(i).css('display','none')
						$('.remainderYN[value="Y"]').eq(i).attr('name','remaindeYN-'+i);
						$('.remainderYN[value="N"]').eq(i).attr('name','remaindeYN-'+i);
						$('.remainderYN[value="N"]').eq(i).prop('checked',true);
						$('.remainderYN[value="Y"]').eq(i).attr('disabled',true);
						$('.remainderYN[value="N"]').eq(i).attr('disabled',true);
				}
					
				}
			});
				$('.amount-class').eq(0).css('display','none')
				$('.remainderYN[value="Y"]').eq(0).prop('checked',true);
		});

	
$(document).ready(function(){
	var saved = $('.tax-declaration-class').html();
	$(document).on('change','#tfnExemptionType',function(){
		if($('#tfnExemptionType').val() == 'NONE'){
			$('.tax-declaration-class').append(saved);
		}
		else{
			$('.tax-declaration-class').empty();
		}
	})
	if($('#tfnExemptionType').val() != 'NONE'){
		$('.tax-declaration-class').empty();
	}
})

	$(document).ready(function(){
		$('#center').change(function(){
		var id = this.value;
		var url = "<?php echo base_url('settings/addEmployee/'); ?>"+id;
		console.log(url);
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				// alert(response);
				//console.log(response);
				// $('body').html($(response).find('#area'))
				//console.log($(response).find('#area').html())
				$('#area-select').html($(response).find('#area'))
				$('#role-select').html($(response).find('#role'))
				for(x=0;x<$('#role').children().length;x++){
					$('#role').children('option').eq(x).css('display','none')
				}
					}
				})
			})
	});

	for(x=0;x<$('#role').children().length;x++){
		if($('#role').children('option').eq(x).attr('area-id') == 1){
			
		}
		else{
			$('#role').children('option').eq(x).css('display','none')
		}
	}

	$(document).on('change','#area',function(){
	var areaId = this.value;
	console.log(areaId);
	for(x=0;x<$('#role').children().length;x++){
		if($('#role').children('option').eq(x).attr('area-id') == areaId){
			$('#role').children('option').eq(x).css('display','block')
		}
		else{
			$('#role').children('option').eq(x).css('display','none')
		}

		console.log($('#role').children('option').eq(x).attr('area-id'))
		}
	});

	function onFormSubmit(e){
		e.preventDefault();
		var falseOrTrue = true;
			var employeeId = $('#employee_no').val();
			var checkEnrolled = false;
			var url = "<?php echo base_url('settings/checkUserid/'); ?>"+employeeId;
			$.ajax({
				url : url,
				type : 'GET',
				success : function(response){
					var response = JSON.parse(response);
					if(response.Status == 'EXISTS'){
						localStorage.setItem('checkEnrolled','true');
				      addMessageToNotification('Employee Id Already Exists');
				    showNotification();
				      setTimeout(closeNotification,5000)
				      falseOrTrue = false;
					}
				}
			}).fail(function(){
		      addMessageToNotification('Enter Employee Id');
		      showNotification();
		      setTimeout(closeNotification,5000)
			}).then(function(){
				if($('#fname').val() == null || $('#fname').val() == "" || 	$('#lname').val() == null || $('#lname').val() == ""){
		      addMessageToNotification('All Name Fields are required');
			    showNotification();
		      setTimeout(closeNotification,5000)
				falseOrTrue = false;
				}
				if($('#emails').val() == null || $('#emails').val() == ""){
		        addMessageToNotification('Enter Email');
		      	showNotification();
				setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( !(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/).test($('#emails').val())){
					addMessageToNotification('Invalid Email Pattern');
					showNotification();
					setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if($('#alias').val() == null || $('#alias').val() == ""){
		      addMessageToNotification('Enter Alias Name');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}

				// if($('#startDate').val() == null || $('#startDate').val() == ""){
				// 	$('#startDate').css({"border-color": "red", 
		  //            "border-width":"1px", 
		  //            "border-style":"solid"})
		  //     showNotification();
		  //     addMessageToNotification('Enter Start Date');
		  //     setTimeout(closeNotification,5000)
				// 	return false;
				// }
				if( $('#employee_no').val() == null || $('#employee_no').val() == "" ){
		      addMessageToNotification('Enter Employee Id');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#center').val() == null || $('#center').val() == "" || $('#center').val() == 0 ){
		      addMessageToNotification('Select Center');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#area').val() == null || $('#area').val() == "" || $('#area').val() == 0 ){
		      addMessageToNotification('Select Area');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#role').val() == null || $('#role').val() == "" || $('#role').val() == 0 ){
		      addMessageToNotification('Select Role');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#level').val() == null || $('#level').val() == "" ){
		      addMessageToNotification('Select Level');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#gender').val() == null || $('#gender').val() == "" || $('#gender').val() == "N" ){
		      addMessageToNotification('Select Gender');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#employement_type').val() == 'CT'){
					let check = false;
			      for(var i=1;i<6;i++){
			      	if($(`#CT_${i}`).is(':checked') == true){
						check = true;
						break;
			      	}
			      }
			      if(check == false){
				      addMessageToNotification('Select days');
				      showNotification();
				      setTimeout(closeNotification,5000)
				      falseOrTrue = false;
			      }
				}
				if( $('#totalHours').val() == null || $('#totalHours').val() <= 1 ){
		      addMessageToNotification('Enter total hours');
		      showNotification();
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}

				if(falseOrTrue == true){
					// console.log(falseOrTrue)
					document.getElementById("myForm").submit();
				}
			})
		// 	console.log(falseOrTrue)
		// return falseOrTrue;
	}

	function casualTime(){
		if($('#employement_type').val() == 'CT'){
			$('.daysOpen').css('display','inline-block');
			for(var i=1;i<6;i++){
				$(`#CT_${i}`).attr('checked',true);
			}
		}else{
			$('.daysOpen').css('display','none');
			for(var i=0;i<4;i++){
				$(`#CT_${i}`).attr('checked',false);
			}
		}
	}

	function employmentHours(){
		if($('#employement_type').val() == 'CT'){
			$('#totalHours').val("22");
		}
		if($('#employement_type').val() == 'FT'){
			$('#totalHours').val("38");
		}
		if($('#employement_type').val() == 'PT'){
			$('#totalHours').val("38");
		}
	}

	$(document).ready(function(){
		casualTime();
		employmentHours();
	})
		$('#employement_type').on('change',function(){
			casualTime();
			employmentHours();
		})

	$(document).ready(function(){

		var superfundHTML = $('.superfund-parent').html();
		$(document).on('click','#superfund-add',function(){
		$('.superfund-parent').append(superfundHTML);
		})
	})

	$(document).ready(()=>{
			$('.e-s span').addClass('arrow');
        $('.e-s').click(function(){
        	$('.e-s span').addClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-b-a-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').addClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-s-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').addClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-t-d-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').addClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.e-u-s').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').addClass('arrow');
					$('.m-i span').removeClass('arrow');
        })
        $('.m-i').click(function(){
        	$('.e-s span').removeClass('arrow');
					$('.e-b-a-s span').removeClass('arrow');
					$('.e-s-s span').removeClass('arrow');
					$('.e-t-d-s span').removeClass('arrow');
					$('.e-u-s span').removeClass('arrow');
					$('.m-i span').addClass('arrow');
        })
    });
</script>
<?php } ?>
</body>
</html>


