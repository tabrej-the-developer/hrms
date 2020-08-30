<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
	body{
		background: #F2F2F2 !important;
	}
	a{
		text-decoration: none;
	}
	.top-box{
		width: 100%;
	}
	.top-box-bottom{
		width:100%;
		display: flex;
		flex-wrap: wrap;
	}
	.containers{
		width:100%;
		height: 100%;
		background: #F2F2F2;
	}
	.ps-os-view{
		background:transparent;
		display: flex;
	    width: 100%;
	    height: 33%;
	    flex-wrap: wrap;
	    justify-content: start;

	}
	.tile-box{
		border-radius: 5px;
    background: white;
    padding: 2rem 3rem;
    margin-left: 3rem;
    box-shadow: 0px 3px 5px -3px #979797;
	}
	.cp-rs-view{
		background:transparent;
		margin-top:10px;
	}
	.p-s{
		width: 100%;
	    display: flex;
	    justify-content: center;
    	}
  .top-box-bottom .tile-box{
  		margin-top: 1rem;
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
.heading{
	text-align: left;
	font-weight:bold;
	font-size:2rem;
	display: flex; 
	padding-left: 3rem;
	color: #171D4B;
}
a[href*="settings"],.xero_settings a{
	font-weight: 700 !important;
	font-style: normal;
	color: rgba(0,0,0,0.6);
}

	@media only screen and (max-width: 600px) {
		.title-box{
			display:block;
		}
	}
</style>
</head>
<body>
<?php
	$this->load->view('header');
	$permissions = json_decode($permissions);
 ?>
<div class="containers ">
		<div class="heading" id="center-id" >Settings</div>
	<div class="ps-os-view" style="position: relative;">
		<div style="font-size: 1rem;font-weight: 700;margin: 1.5rem 3rem">Organizational Settings</div>
		<div class="top-box d-flex">
			<div class="tile-box col-3 d-md-flex">
				<div class=" col-6">
				<a href="<?php echo base_url()?>settings/editPassword">
					<img src="<?php echo site_url()?>/assets/images/settings-icons/password.png">
				</a>
				</div>
				<div class="p-s col-6">
					<a href="<?php echo base_url()?>settings/editPassword">Password Settings</a>
				</div>
			</div>
			
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewOrgChartYN == "Y"){ ?>
			<div class="tile-box col-3 d-md-flex">
				<div class=" col-6">
					<a href="<?php echo base_url()?>settings/orgChart">
						<img src="<?php echo site_url()?>/assets/images/settings-icons/organization-chart.png">
					</a>
				</div>
				<div class="p-s col-6">
					<a href="<?php echo base_url()?>settings/orgChart">Organizational settings</a>
				</div>
			</div>
		<?php } ?>
		</div>
		<span style="width: 100%;text-align: center;">
			<span style="border:1px solid rgba(151, 151, 151,0.3);bottom: 0;width: 95%;display: inline-block;"></span>
		</span>
	</div>
	<div class="cp-rs-view">
		<div style="font-size: 1rem;font-weight: 700;margin-left: 3rem">Center Level Settings</div>
		<div class="top-box top-box-bottom justify-content-right">
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewCenterProfileYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/centerProfile">
						<img src="<?php echo site_url('assets/images/settings-icons/center-profile.png') ?>">
					</a>
				</div>
					<div class="col-6">
						<a href="<?php echo base_url()?>settings/centerProfile">Center Profile</a>
					</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewRoomSettingsYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/editRooms">
						<img src="<?php echo site_url('assets/images/settings-icons/room-settings.png') ?>">
					</a>
				</div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/editRooms">Room Settings</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewEntitlementsYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6">
					<img src="<?php echo site_url('assets/images/settings-icons/entitlement-settings.png') ?>">
				</div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/viewEntitlements">Entitlement Settings</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->editEmployeeYN == "Y"){ ?>
			<div class="tile-box  d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/add-employee.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/addEmployee">Add Employee</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->editEmployeeYN == "N"){ ?>			
			<div class="tile-box  d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/add-employee.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/editEmployee">Edit Employee</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->editEmployeeYN == "Y"){ ?>			
			<div class="tile-box  d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/add-employee.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/viewEmployee">View Employee</a>
				</div>
			</div>
		<?php } ?>
			<!-- <button class="add-employee">Add Employee</button></div> -->
			<?php if(isset($permissions->permissions) && $permissions->permissions->xeroYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/xero.png'); ?>"></div>
				<div class="col-6 xero_settings">
					<a href="<?php echo base_url().'api/xero/startOauth/'.$this->session->userdata('LoginId');?>" target="_blank">Xero settings</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewAwardsYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/award-settings.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/awardSettings">Awards settings</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewSuperfundsYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/superfund-settings.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/superfundsSettings">Superannuation settings</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewPermissionYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/permission-settings.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/permissionSettings">Permission settings</a>
				</div>
			</div>
		<?php } ?>
			<?php if(isset($permissions->permissions) && $permissions->permissions->viewLeaveTypeYN == "Y"){ ?>
			<div class="tile-box d-md-flex col-3">
				<div class="col-6"><img src="<?php echo site_url('assets/images/settings-icons/leave-settings.png'); ?>"></div>
				<div class="col-6">
					<a href="<?php echo base_url()?>settings/leaveSettings">Leave settings</a>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>

</div>
<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>
<!-- <script type="text/javascript">
	if($(window).width() > '720'){
	var widthOfNav = $('.navbar-nav').width();
	$('.containers').css('padding-left','60px');
$(document).on('mouseover','.navbar-nav',function(){
		$('.containers').css('padding-left','200px');
	})
$(document).on('mouseleave','.navbar-nav',function(){
		$('.containers').css('padding-left','60px');
	})
}
</script> -->
  <script type="text/javascript">
    $(document).ready(()=>{
      $('.containers').css('paddingLeft',$('.side-nav').width());
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

</body>
</html>