
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stylesheet.css') ?>" />
	<style type="text/css">
		.select_css::after{
	  content: ' ';
	  position: absolute;
	  background: url(<?php echo base_url('assets/images/icons/down.png') ?>);
	  background-repeat: no-repeat;
	  padding: 15px;
	    margin-left: -28px;
	    margin-top: 10px !important;
	    background-size: 0.6rem 0.6rem;
	    top:0 !important;
	}
	.profileImage_input{
		width: 20%;
	}
	.profileImage{
		width: 20%;
	}
	.employee-details .span-class,.medical-info .span-class,.tax-declaration-class .span-class,.employee-bank-account-section_row .span-class{
		width: 24%;
	}
	.col-3{
		width: 24% !important;
	}
	</style>
</head>
<body class="add_employee_body">
<?php $this->load->view('header'); ?>
<div class="containers">
<span class="d-flex justify-content-between pt-2">
	<span style="top:20px;padding-left: 2rem">
      <a onclick="goBack()">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:0.8rem">Add Employee</span>
        </button>
      </a>
    </span>
    <span class="addEmployee_top_select">
    	<a href="<?php echo base_url('settings/AddMultipleEmployees');?>">
    		<button id="addEmployee_multipleEmployees">Add Multiple Employees</button>
    	</a>
    </span>
</span>
	<div class="addEmployee-container">
	<div class="addEmployee-container-child">
	<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->editEmployeeYN : "N" == "Y"){ ?>
	<section class="tab-buttons">
		<div class="tab-buttons-div">
		<span class="nav-button e-s"><span>Personal</span></span>
		<!-- <span class="nav-button e-b-a-s"><span>Bank Account</span></span> -->
		<!-- <span class="nav-button e-s-s"><span> Superannuation </span></span> -->
		<!-- <span class="nav-button e-t-d-s"><span>Tax Declaration </span></span> -->
		<!-- <span class="nav-button e-u-s"><span>Employment</span></span>	 -->
		<!-- <span class="nav-button m-i"><span>Medical Info</span></span> -->
		</div>	
	</section>
<form method="POST" action="createEmployeeProfile" id="myForm" style="height: 100%" onsubmit="return onFormSubmit(event)" enctype="multipart/form-data">
	<section class="employee-section">	
		<!-- <h3>Personal</h3> -->
		<span class="d-flex">
		<span class="span-class col-3">
			<label class="labels__">Title</label>
			<span class="select_css">
				<select  id="title"  class="" type="text" name="title"> 
					<option value="Ms">Ms</option> 
					<option value="Mr">Mr</option>
					<option value="Mrs">Mrs</option>
				</select>
			</span>
		</span>
	<!-- <span class="span-class name__"> -->

		<!-- <span class=" row row_addEmployee ml-1 "> -->

		<span class="span-class col-3 ">
		<label class="labels__">First Name<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="fname"  class="" type="text" name="fname" >
		</span>

		<span class="span-class col-3 ">
		<label class="labels__">Middle Name</label>
			<input id="mname"  class="" value="" type="text" name="mname" >
		</span>

		<span class="span-class col-3 ">
		<label class="labels__">Last Name<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="lname"  class="" type="text" name="lname" >
		</span>
	<!-- </span> -->
	<!-- </span> -->
</span>
		

		<span class="span-class col-3">
			<label class="labels__">Alias<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="alias"  class="" type="text" name="alias">
		</span>
<!-- 		<span class="span-class col-3">
			<label class="labels__">Date Of Birth</label>
			<input id="dateOfBirth"  class="" type="date" name="dateOfBirth">
		</span> -->
		<span class="span-class col-3">
			<label class="labels__">Gender</label>
			<span class="select_css">
				<select id="gender"  class="" name="gender">
					<option value="N">Not Given</option>
					<option value="M">Male</option>
					<option value="F">Female</option>
					<option value="I">Non binary</option>
				</select>				
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
	
		<!-- <span class="span-class row row_addEmployee "> -->
		<!-- <label class="labels__">Address</label>	 -->
<!-- 			<span class="span-class  col-3">
				<label class="labels__">Home Address Line1</label>
				<input id="homeAddLine1"  class="" type="text" name="homeAddLine1">
			</span>
			<span class="span-class col-3">
				<label class="labels__">Home Address Line2</label>
				<input id="homeAddLine2"  class="" type="text" name="homeAddLine2">
			</span>
			<span class="span-class col-3">
				<label class="labels__">City</label>
				<input  type="text" id="homeAddCity"  class=""  name="homeAddCity">
			</span>				
			<span class="span-class col-3">
				<label class="labels__">Region</label>
				<span class="select_css">
					<select id="homeAddRegion"  class="" type="text" name="homeAddRegion">
						<option value="ACT">Australian Capital Territory</option>
						<option value="NSW">New South Wales</option>
						<option value="NT">Northern Territory</option>
						<option value="QLD">Queensland </option>
						<option value="SA">South Australia</option>
						<option value="TAS">Tasmania </option>
						<option value="VIC">Victoria</option>
						<option value="WA">Western Australia</option>
					</select>
				</span>
			</span>
			<span class="span-class col-3">
				<label class="labels__">Postal</label>
				<input id="homeAddPostal"  class="" type="text" name="homeAddPostal">
			</span>
			<span class="span-class col-3">
				<label class="labels__">Country</label>
				<input id="homeAddCountry"  class="" type="text" name="homeAddCountry">
			</span>
		</span> -->
		<!-- <hr> -->
<!-- 		<span class="span-class col-3">
			<label class="labels__">Phone</label>
			<input id="phone"  class="" type="text" name="phone">
		</span>
		<span class="span-class col-3">
			<label class="labels__">Mobile</label>
			<input id="mobile"  class="" type="text" name="mobile">
		</span> -->
		<span class="span-class col-3">
			<label class="labels__">Email<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="emails"  class="" type="text" name="emails">
		</span>

		<hr> 
		<span class="span-class col-3">
			<label class="labels__">Employee Number<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<input id="employee_no" type="text" name="employee_no">
		</span>
<!-- 		<span class="span-class col-3">
			<label class="labels__">Xero Employee Id</label>
			<input id="xeroEmployeeId" type="text" name="xeroEmployeeId">
		</span> -->
		<span class="span-class col-3">
			<label class="labels__">Center<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<span class="select_css">
				<select id="center" name="center">
					<option>--Center--</option>
					<?php 
						$centers = json_decode($centers);
					foreach($centers->centers as $center){ ?> 
						<option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
					<?php } 
					$centerId = "";
					foreach($centers->centers as $center){ 
							$centerId = $centerId . $center->centerid . "|";
					 } ?>
					<option value="<?php echo $centerId; ?>">All Centers</option>
				</select>
			</span>
		</span>

		<span class="span-class col-3">
			<label class="labels__">Area<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>

				<span class="" id="area-select">
					<span class="select_css">
						<select id="area" name="area">
							<option>--select--</option>
						<?php 
						$areas = json_decode($areas);
						foreach($areas->areas as $area){
						?>
						<option value="<?php echo $area->areaId; ?>" ><?php echo $area->areaName; ?></option>
						<?php } ?>
					</select>
				</span>
			</span>
		</span>

		<span class="span-class col-3">
			<label class="labels__">Role<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<span id="role-select">
				<span class="select_css">
					<select id="role" name="role">
						<option>--select--</option>

						<?php foreach($areas->areas as $roles){?>
							<?php foreach($roles->roles as $role){?>
						<option area-id="<?php print_r($role->areaid); ?>" value="<?php echo $role->roleid ?>"><?php print_r($role->roleName) ?></option>
						<?php } } ?>
					</select>
				</span>
		</span>
		</span>

<!-- 		<span class="span-class col-3">
			<label class="labels__">Manager</label>
			<input id="manager" type="text" name="manager">
		</span>
 -->

		<span class="span-class col-3">
			<label class="labels__">Level<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<span class="select_css">
				<select id="level" name="level">
					<?php $levels = json_decode($levels);
						foreach($levels->entitlements as $level){
						?>
					<option value="<?php echo $level->id; ?>"><?php echo $level->name; ?></option>
					<?php } ?>
				</select>
			</span>
		</span>

		<span class="span-class col-3">
			<label class="labels__">Employment type<sup>
				<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
			</sup></label>
			<span class="select_css">
				<select id="employement_type" name="employement_type" >
					<option value="FT">Full Time</option>
					<option value="PT">Part Time</option>
					<option value="CT">Casual</option>
				</select>
			</span>
		</span>

			<span class="span-class col-3">
				<label class="labels__">Total Hours<sup>
					<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
				</sup></label>
				<span>
					<input id="totalHours" type="number" name="totalHours">
				</span>
			</span>

			<span class="span-class col-3 daysOpen">
				<label class="labels__">Days<sup>
					<img src="<?php echo base_url('assets/images/icons/star.png'); ?>" style="max-height:0.5rem;margin-right:10px">
				</sup></label>
				<span class="d-flex">
					<span>
						<label class="labels__">Mon</label>
						<input id="CT_1" type="checkbox" name="CT_1">
					</span>
					<span>
						<label class="labels__">Tue</label>
						<input id="CT_2" type="checkbox" name="CT_2">
					</span>
					<span>
						<label class="labels__">Wed</label>
						<input id="CT_3" type="checkbox" name="CT_3">
					</span>
					<span>
						<label class="labels__">Thu</label>
						<input id="CT_4" type="checkbox" name="CT_4">
					</span>
					<span>
						<label class="labels__">Fri</label>
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











	<div class="submit_addEmployee">
		<button type="submit" id="subm">
			<i>
				<img src="<?php echo base_url('assets/images/icons/send.png'); ?>" style="max-height:1rem;margin-right:10px">
			</i>Submit</button>
	</div>
</form>
<?php } ?>
		</div>
	</div>
</div>
<div class="notify_">
	<div class="note">
		  <div class="notify_body">
    <span class="_notify_message">
      
    </span>
    <span class="_notify_close" onclick="closeNotification()">
      &times;
    </span>
  </div>
	</div>
</div>
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

// Notification //
    function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
    	if($('.notify_').css('visibility') == 'hidden')
     		$('._notify_message').append(`<li>${message}</li>`)
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
	console.log(url)
	$.ajax({
		url:url,
		type:'GET',
		success:function(response){
			// $('body').html($(response).find('#area'))
			console.log($(response).find('#area').html())
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
				      showNotification();
				      addMessageToNotification('Employee Id Already Exists');
				      setTimeout(closeNotification,5000)
				      falseOrTrue = false;
					}
				}
			}).then(function(){
				if($('#fname').val() == null || $('#fname').val() == "" || 	$('#lname').val() == null || $('#lname').val() == ""){
				$('#fname').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
			    showNotification();
		      addMessageToNotification('All Name Fields are required');
		      setTimeout(closeNotification,5000)
				falseOrTrue = false;
				}
				if($('#emails').val() == null || $('#emails').val() == ""){
					$('#emails').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Enter Email');
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if($('#alias').val() == null || $('#alias').val() == ""){
					$('#alias').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Enter Alias Name');
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
					$('#employee_no').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Enter Employee Number');
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#area').val() == null || $('#area').val() == "" ){
					$('#area').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Select Area');
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#role').val() == null || $('#role').val() == "" ){
					$('#role').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Select Role');
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}
				if( $('#level').val() == null || $('#level').val() == "" ){
					$('#level').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Select Level');
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
					$('#employement_type').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
				      showNotification();
				      addMessageToNotification('Select days');
				      setTimeout(closeNotification,5000)
				      falseOrTrue = false;
			      }
				}
				if( $('#totalHours').val() == null || $('#totalHours').val() <= 1 ){
					$('#level').css({"border-color": "red", 
		             "border-width":"1px", 
		             "border-style":"solid"})
		      showNotification();
		      addMessageToNotification('Enter total hours');
		      setTimeout(closeNotification,5000)
					falseOrTrue = false;
				}

				if(falseOrTrue == true){
					console.log(falseOrTrue)
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


