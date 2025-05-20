<!DOCTYPE html>
<html>
<head>
	<title>PN101</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  

  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

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
<body id="page-top">

<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<div id="wrappers" class="containers scrollY ">
		<div class="settingsContainer ">
			<?php $permissions = json_decode($permissions); ?>
			<?php if((isset($permissions->permissions) ? $permissions->permissions->viewCenterProfileYN : "N")== "Y"){ ?>
	
				<span class="d-flex pageHead heading-bar">
					<div class="withBackLink">
					<a onclick="goBack()" class="back_button_a" href="#">
						<span class="material-icons-outlined">arrow_back</span>
					</a>				
								<span class="events_title">Add Center</span>
							</div>
				</span>
				<div  id="content-wrappers-element" >
					<div class="card_future" style="padding: 20px;">
			
						<form name="userinput" action="createCenterProfile" method="post" enctype="multipart/form-data" onsubmit="return onFormSubmit()">
								<span id="centerDetailsYo">
									<div class="row">
									<!-- <span id="addCenter_heading">Center Details</span> -->
										
									<!-- <div class="" style="padding: 5px;"></div> -->
									<div class="col-md-12">
										<div class="form-floating">
											<input type="text" class="form-control" name="center_name" id="center_name" value="" required>
											<label for="center_name">Center Name<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input type="text" class="form-control" name="center_city" id="center_city" value="">
											<label for="center_city">City</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<select class="form-control" name="center_state" id="center_state">
												<option value="1">New South Wales</option>
												<option value="2">Queensland</option>
												<option value="3">South Australia</option>
												<option value="4">Tasmania</option>
												<option value="5" selected>Victoria</option>
												<option value="6">Western Australia</option>
												<option value="7">Australian Capital Territory</option>
												<option value="8">Northern Territory</option>
											</select>
											<label for="center_state">State</label>
										</div> 
									</div>

									<div class="col-md-12">
										<div class="form-floating">
											<textarea class="street_address form-control" name="center_street" id="center_street" ></textarea>
											<label for="center_street">Street Address<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div> 
									</div>

									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="number" name="center_zip" id="center_zip" value="" required>
											<label for="center_zip">Postcode<sup><img src="<?php echo base_url('assets/images/icons/star.png'); ?>"></sup></label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="number" name="center_phone" id="centre_phone_number" value="">
											<label for="centre_phone_number">Centre Phone Number</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="number" name="center_mobile" id="centre_mobile_number" value="" >
											<label for="centre_mobile_number">Centre Mobile Number</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="email" name="center_email" id="Centre_email	" value="">
											<label for="Centre_email">Centre Email</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="text" name="center_abn" id="centre_abn" value="" >
											<label for="centre_abn">Centre ABN</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="text" name="center_acn" id="centre_acn" value="">
											<label for="centre_acn">Centre ACN</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="text" name="center_se_no" id="centre_se_no" value="">
											<label for="centre_se_no">Centre SE Number</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="date" name="center_date_opened" placeholder="dd-mm-yyyy" id="centre_date_opened" value="" placeholder="dd-mm/yyyy">
											<label for="centre_date_opened">Center Date Opened</label>
										</div> 
									</div>
									<div class="col-md-12">
										<div class="form-floating">
											<input class="form-control" type="text" name="center_capacity" id="centre_capacity" value="">
											<label for="centre_capacity">Centre Capacity</label>
										</div> 
									</div>

									<!-- 						<div class="input_box">
										<label>
											<i style="color: #aa63ff;" class=""></i> Centre Approval Doc</label>
										<input class="" type="file" name="center_approval_doc" id="centre_approval_doc"  value="" onchange="validate('centre_approval_doc')">
									</div>
									<div class="input_box">
										<label>
											<i style="color: #aa63ff;" class=""></i> Center CCS Doc</label>
										<input class="" type="file" name="center_ccs_doc" id="centre_ccs_doc"  value="" onchange="validate('centre_ccs_doc')">
									</div> -->
									<!-- <div class="input_box">
										<label>
											<i style="color: #aa63ff;" class=""></i> Manager Name</label>
										<input class="" type="text" name="manager_name" id="manager_name" value="">
									</div> -->
									<!-- <div class="input_box">
										<label>
											<i style="color: #aa63ff;" class=""></i> Center Admin Name</label>
										<input class="" type="text" name="center_admin_name" id="centre_admin_name" placeholder="Center admin-name" value="">
									</div> -->
									<!-- <div class="input_box">
										<label>
											<i style="color: #aa63ff;" class="fas "></i> Center Nominated Supervisor</label>
										<input class="" type="text" name="centre_nominated_supervisor" id="centre_nominated_supervisor" placeholder="Center nominated-supervisor" value="">
									</div> -->
									</div>
									<!-- <hr> -->
										<!-- <div class="row">
										<div class="col-lg-6"><h3>Organize Rooms</h3></div>
											<div class="col-lg-6 text-right">
												<div id="AddRoom" >
													<b style="cursor: pointer;background-color: transparent;background-image: url(https://spotlist.todquest.com/images/button.png);border: 0px solid;color: white;background-size: cover; padding: 10px;"> Add Room</b>
												</div>
											</div>
											<div class="" style="padding: 5px;"></div>
										</div> -->
										<!-- <span id="" class="room-class">
										<div class="row">
										<div class="input_box">
											<label><i style="color: #aa63ff;" class=""></i> Room Name</label>
											<input type="text" class="room_name" name="room_name[]" id="" value="" >
										</div>
										<div class="input_box">
											<label><i style="color: #aa63ff;" class=""></i> Capacity</label>
											<input type="number" class="capacity_" name="capacity_[]" value=""  > 
										</div>
										<div class="input_box">
											<label><i style="color: #aa63ff;" class=""></i> Minimum Age</label>
											<input type="number" class="minimum_age" name="minimum_age[]" id="" value="" placeholder="Min age in months">
										</div>
										<div class="input_box">
											<label>
												<i style="color: #aa63ff;" class=""></i> Maximum Age</label>
											<input type="number" class="maximum_age" name="maximum_age[]" id="" value="" placeholder="Max age in months" > 
										</div>
											</div>
										</span>	 
										<hr>-->

										<div class="formSubmit">
											<button class="btn button_submit btn btn-default btn-small btnOrange btn-success pull-right">Save</button>
										</div>
								</span>
						</form>

					</div>
				</div>	
				<div style="padding: 20px;"></div>
		</div> 
	</div>
</div>

<div class="notify_">
  <div class="notify_body">
    <span class="_notify_message">
      
    </span>
    <span class="_notify_close" onclick="closeNotification()">
      &times;
    </span>
  </div>
</div>

<?php } ?>

<script type="text/javascript">

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
		var newRoom = $('.room-class').html();
		$(document).on('click','#AddRoom',function(){
			var length = $('.room-class').length;
			$('.room-class').eq(length-1).after(newRoom);
		})
	})
  $(document).ready(()=>{
    $('#wrappers').css('paddingLeft',$('.side-nav').width());
});

<?php 
	$flash = $this->session->flashdata('centerCreated');
	if(isset($flash)){ ?>
		addMessageToNotification('<?php echo $flash; ?>');
		showNotification();
		setTimeout(closeNotification,5000)
	<?php	} ?>
	function validate(variable){
		if(($('#'+variable)[0].files[0].size)/(1024*1024) < 2){
			
		}else{
			$('#'+variable).val('');
				addMessageToNotification('File size must be less than 2MB');
				showNotification();
				setTimeout(closeNotification,5000)
		}
	}


function onFormSubmit(){
		if( $('#center_name').val() == null || $('#center_name').val() == "" ){
			$('#center_name').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"});
      showNotification();
      addMessageToNotification('Enter Center Name');
      setTimeout(closeNotification,5000)
			return false;
		}
				if( $('#center_street').val() == null || $('#center_street').val() == "" ){
			$('#center_street').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"});
      showNotification();
      addMessageToNotification('Enter Center Address');
      setTimeout(closeNotification,5000)
			setTimeout(function(){
				$('#center_street').css({"border-color": "#D2D0D0", 
	             "border-width":"1px", 
	             "border-style":"solid"})
			},6000)
			return false;
		}
}
</script>
</body>
</html>