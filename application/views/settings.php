<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<style type="text/css">
	.top-box{
		width:100%;
	}
	.containers{
		width:100vw;
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

	@media only screen and (max-width: 600px) {
		.title-box{
			display:block;
		}
	}
</style>
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="containers">
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
		<div class="top-box d-flex justify-content-around">
			<div class="tile-box">
				<div>Center Profile</div>
					<div class="d-flex ">
						<a href="<?php echo base_url()?>settings/centerProfile">Center Profile</a>
					</div>
				</div>
			<div class="tile-box">
				<div>Room settings</div>
				<div>
					<a href="<?php echo base_url()?>settings/editRooms">Room Settings</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
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
</script>
</body>
</html>