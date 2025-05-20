<!DOCTYPE html>
<html>
<head>
<title>Settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
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
<body>

<body>
<?php
	if(isset($permissions)){
		$permissions = json_decode($permissions);
	}
 ?>
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<div class="containers scrollY ">
		<div class="settingsContainer ">
			<div class="d-flex pageHead heading-bar" id="center-id" >
				<h3 class="events_title">Settings</h3>
			</div>
			<div class="settingViewIcon ps-os-view" style="position: relative;">
				<div class="head">Personal Settings</div>
				<div class="top-box d-flex">
					<div class="tile-box d-md-flex">
						<a href="<?php echo base_url()?>settings/editPassword">
							<div class=" col-12">
							<!-- <a href="<?php // echo base_url('settings/editPassword')?>"> -->
								<img src="<?php echo site_url()?>/assets/images/settings-icons/password.png">
							<!-- </a> -->
							</div>
							<div class="p-s name col-12">
								Password Settings
							</div>
						</a>
					</div>
					
				<?php // if(isset($permissions->permissions) && $permissions->permissions->viewOrgChartYN == "Y"){ ?>
					<div class="tile-box d-md-flex">
						<a href="<?php echo base_url()?>settings/notificationSettings">
							<div class=" col-12">
								<!-- <a href="<?php// echo base_url()?>settings/orgChart"> -->
									<img src="<?php echo site_url()?>/assets/images/settings-icons/notification.png">
								<!-- </a> -->
							</div>
							<div class="p-s name col-12">
								Notification Settings
							</div>
						</a>
					</div>
				<?php // } ?>
				</div>
				<!-- <span style="width: 100%;text-align: center;">
					<span style="border:1px solid rgba(151, 151, 151,0.3);bottom: 0;width: 95%;display: inline-block;"></span>
				</span> -->
			</div>
			<div class="settingViewIcon ps-os-view" style="position: relative;">
				<div class="head">Organizational Settings</div>
				<div class="top-box d-flex">
				
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewOrgChartYN == "Y"){ ?>
					<div class="tile-box d-md-flex">
						<a href="<?php echo base_url()?>settings/orgChart">
							<div class=" col-12">
								<!-- <a href="<?php // echo base_url()?>settings/orgChart"> -->
									<img src="<?php echo site_url()?>/assets/images/settings-icons/organization-chart.png">
								<!-- </a> -->
							</div>
							<div class="p-s name col-12">
								Organizational Settings
							</div>
						</a>
					</div>
				<?php } ?>

					<div class="tile-box d-md-flex">
						<a href="<?php echo base_url()?>settings/companySettings">
							<div class=" col-12">
								<!-- <a href="<?php // echo base_url()?>settings/orgChart"> -->
									<img src="<?php echo site_url()?>/assets/images/settings-icons/company-settings.png">
								<!-- </a> -->
							</div>
							<div class="p-s name col-12">
								Company Settings
							</div>
						</a>
					</div>
				</div>
				<!-- <span style="width: 100%;text-align: center;">
					<span style="border:1px solid rgba(151, 151, 151,0.3);bottom: 0;width: 95%;display: inline-block;"></span>
				</span> -->
			</div>
			<div class="settingViewIcon cp-rs-view">
				<div class="head">Center Level Settings</div>
				<div class="top-box d-flex">
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewCenterProfileYN == "Y"){ ?>
					<div class="tile-box d-md-flex">
						<a href="<?php echo base_url('settings/centerProfile')?>">
							<div class="col-12">
								<!-- <a href="<?php // echo base_url('settings/centerProfile')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/center-profile.png') ?>">
								<!-- </a> -->
							</div>
							<div class="name col-12">
								Center Profile
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewRoomSettingsYN == "Y"){ ?>
					<!-- <div class="tile-box d-md-flex col-3">
						<div class="col-5">
							<a href="<?php echo base_url()?>settings/editRooms">
								<img src="<?php echo site_url('assets/images/settings-icons/room-settings.png') ?>">
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo base_url()?>settings/editRooms">Room Settings</a>
						</div>
					</div> -->
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewEntitlementsYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/viewEntitlements">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/viewEntitlements')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/entitlement-settings.png') ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name">
								Entitlement Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->editEmployeeYN == "Y"){ ?>
					<div class="tile-box  d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/addEmployee">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/addEmployee')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/addemployee.png'); ?>"></div>
								<!-- </a> -->
							<div class="col-12 name">
								Add Employee
							</div>
						</a>
					</div>
					<?php } ?>
					<?php //if((isset($permissions->permissions->editEmployeeYN) ? $permissions->permissions->editEmployeeYN : "N") == "N"){ ?>			
					<div class="tile-box  d-md-flex col-3">
						<a href="<?php echo base_url('settings/editEmployeeProfile/'.$this->session->userdata('LoginId'))?>">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/editEmployeeProfile/'.$this->session->userdata('LoginId'))?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/edit-employee.png'); ?>">
								<!-- </a>	 -->
							</div>
							<div class="col-12 name">
								Edit Profile
							</div>
						</a>
					</div>
					<?php //} ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->editEmployeeYN == "Y"){ ?>			
					<div class="tile-box  d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/viewEmployeeTable">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/viewEmployeeTable')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/view-employee.png'); ?>"></div>
								<!-- </a> -->
							<div class="col-12 name">
								View Employee
							</div>
						</a>
					</div>
					<?php } ?>
					<!-- <button class="add-employee">Add Employee</button></div> -->
					<?php if(isset($permissions->permissions) && $permissions->permissions->xeroYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url().'settings/xeroSettings';?>" >
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/xeroSettings')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/xero.png'); ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name xero_settings">
								Xero Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewAwardsYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/awardSettings">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/awardSettings')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/award-settings.png'); ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name">
								Award Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewSuperfundsYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/superfundsSettings">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/superfundsSettings')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/superfund-settings.png'); ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name">
								Superannuation Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewPermissionYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/permissionSettings">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/permissionSettings')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/permission-settings.png'); ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name">
								Permission Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->viewLeaveTypeYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/leaveSettings">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/leaveSettings')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/leave-settings.png'); ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name">
								Leave Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($permissions->permissions) && $permissions->permissions->kidsoftYN == "Y"){ ?>
					<div class="tile-box d-md-flex col-3">
						<a href="<?php echo base_url()?>settings/kidsoftSettings">
							<div class="col-12">
								<!-- <a href="<?php echo base_url('settings/kidsoftSettings')?>"> -->
									<img src="<?php echo site_url('assets/images/settings-icons/kidsoft_icon.png'); ?>">
								<!-- </a> -->
							</div>
							<div class="col-12 name">
								Kidsoft Settings
							</div>
						</a>
					</div>
					<?php } ?>
					<!-- <div class="tile-box d-md-flex col-3">
						<div class="col-5">
							<a href="<?php echo base_url('settings/activityLog')?>">
								<img src="<?php echo site_url('assets/images/settings-icons/leave-settings.png'); ?>">
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo base_url()?>settings/activityLog">Activity Log</a>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a class="btn btn-default btn-small btnOrange" href="<?php echo base_url(); ?>">Click here</a>&nbsp; &nbsp;to login</h4>
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
      $('.containers').css('paddingLeft',$('.side-nav').width());
  });

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

  <?php 
		$flash = "";
	if($this->session->flashdata('employeeAdded') != null){
		$flash = $this->session->flashdata('employeeAdded');
	}
	if($this->session->flashdata('editEmployee') != null){
		$flash = $this->session->flashdata('editEmployee');
	}
	if(isset($flash) && $flash != ""){ ?>
      addMessageToNotification('<?php echo $flash; ?>');
      showNotification();
      setTimeout(closeNotification,5000)
	<?php	} ?>

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

</body>
</html>


<input type="checkbox" filtertype="me" name="">
<input type="checkbox" filtertype="staff" name="">