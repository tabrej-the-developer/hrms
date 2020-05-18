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
	.top-box{
		width:100%;
	}
	.top-box-bottom{
		width:100%;
		display: flex;
		flex-wrap: wrap
	}
	.containers{
		width:100%;
		padding-top:10px;
		padding-bottom:10px;
		padding-right:10px;
		background:rgba(0,0,0,0.1);
	}
	.ps-os-view{
		background:white;
		display: flex;
    width: 100%;
    flex-wrap: wrap;
    justify-content: center;

	}
	.tile-box{
		margin:20px 0 20px 0;
	}
	.cp-rs-view{
		background:white;
		margin-top:10px;
	}
	.p-s{
		width: 100%;
    display: flex;
    justify-content: center;
    	}
    	.top-box-bottom .tile-box{
		min-width: 50%;
    	max-width: 50%;
    	text-align: center
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
	@media only screen and (max-width: 600px) {
		.title-box{
			display:block;
		}
	}
</style>
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="containers m-2">
	<div class="ps-os-view">
		<div class="top-box d-flex justify-content-around">
			<div class="tile-box">
				<div class="p-s">Personal Settings</div>
				<div class="d-flex ">
					<a href="<?php echo base_url()?>settings/editPassword">Password Settings</a>
				</div>
			</div>
			<div class="tile-box">
				<div>Organizational settings</div>
				<div>
					<a href="<?php echo base_url()?>settings/orgChart">Organizational Chart</a>
				</div>
			</div>
		</div>
	</div>
	<div class="cp-rs-view">
		<div class="top-box top-box-bottom justify-content-right">
			<div class="tile-box">
				<div>Center Profile</div>
					<div class="">
						<a href="<?php echo base_url()?>settings/centerProfile">Center Profile</a>
					</div>
				</div>
			<div class="tile-box">
				<div>Room settings</div>
				<div>
					<a href="<?php echo base_url()?>settings/editRooms">Room Settings</a>
				</div>
			</div>
			<div class="tile-box">
				<div>Entitlement settings</div>
				<div>
					<a href="<?php echo base_url()?>settings/viewEntitlements">Entitlement Settings</a>
				</div>
			</div>
			<div class="tile-box">
				<div>Add Employee</div>
				<div>
					<a href="<?php echo base_url()?>settings/addEmployee">Add Employee</a>
				</div>
			</div>
			<!-- <button class="add-employee">Add Employee</button></div> -->
			<div class="tile-box">
				<div>Xero settings</div>
				<div>
					<a href="<?php echo base_url()?>api/xero/startOauth">Xero settings</a>
				</div>
			</div>
			<div class="tile-box">
				<div>Awards settings</div>
				<div>
					<a href="<?php echo base_url()?>settings/awardsSettings">Awards settings</a>
				</div>
			</div>
			<div class="tile-box">
				<div>Superfunds settings</div>
				<div>
					<a href="<?php echo base_url()?>settings/superfundsSettings">Superfunds settings</a>
				</div>
			</div>
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