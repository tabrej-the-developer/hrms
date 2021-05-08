<!DOCTYPE html>
<html>
<head>
	<title>HRMS101</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{

font-family: 'Open Sans', sans-serif;
	}
</style> 
</head>
<body id="page-top">
	   <?php require_once('header.php') ?>
	<div id="wrapper">	 
		<div  id="content-wrapper"  style="padding-top: 0px;padding-left: 15px;">
		<div class="container-fluid card_future" style="padding: 20px;">
		<h4 class="row">
			<div class="col-12">
				<a href="">
					<button class="btn back-button"> 
						<img src="">
					</button></a> Enter Employee Details
			</div>
		</h4>	
		<form name ="userinput" action="<?php echo base_url();?>createEmployeeProfile" method="post" 
		enctype="multipart/form-data" >
			<hr>
		 	<span id="employeeDetailsYo">
		 		<div class="row">
				<h3 class="col-lg-6">Employee </h3>
					
				<div class="w-100" style="padding: 5px;"></div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-school" ></i> Employee Name</label>
					<input type="text" class="form-control" name="name" placeholder="Employee name"  required>
				</div>
		    	<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-city"></i>Employee Email</label>
				<input type="text" class="form-control"  name="email"   >
				</div>
		    	<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-city" ></i>Password </label>
				<input type="text" class="form-control" name="password"   >
				</div>
		    	<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-city" ></i>Role</label>
				<input type="text" class="form-control" name="role"  >
				</div>

			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up" ></i> Center</label>
					<input type="text" class="form-control"  name="center"   >
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up" ></i> Manager</label>
					<input type="text" class="form-control"  name="manager"   >
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up" ></i> Role Name</label>
					<input type="text" class="form-control"  name="roleName"  >
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up" name="roleid"></i> Role Id</label>
					<input type="text" class="form-control"  name="roleid"    >
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up" ></i> Level Id</label>
					<input type="text" class="form-control"  name="levelId"  >
				</div>


			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Logo</label>
				<input class="form-control" type="file" name="" id="center-logo"  >
			</div>
		</div>


		<hr>
		<div class="row">			 
			</span>
			<div class="row text-center justify-content-center align-self-center">
				<div class="w-100"></div>
				<center><button type="submit" class="btn btn-success" style="padding: 6px 30px;"><i style="color: #fff;" class="fas fa-location-arrow"></i>&nbsp;  Save</button></center>
			</div>
		 
				
			</form>

		</div>
	</div>	
<div style="padding: 20px;"></div>
</div>
<!-- <script type="text/javascript">
	$(document).ready(function(){
		var newRoom = $('.room-class').html();
		$(document).on('click','#AddRoom',function(){
			var length = $('.room-class').length;
			$('.room-class').eq(length-1).after(newRoom);
		})
	})

	$(document).ready(function(){
		$(document).on('click','.btn-success',function(){
		var addStreet = $('#center-name').val();
		var	addCity =  $('#center-city').val();
		var	addState = $('#center-state').val();
		var	addZip = $('#center-zip').val();
		var	name = $('#center-name').val();
		var	logo = $('#center-logo').val();
		var	rooms = $('').val();
		var url = "http://localhost/PN101/createEmployeeProfile"
		$.ajax({
			url: url,
			type:'POST',
			data:{
				addStreet : addStreet,
				addCity : addCity ,
				addState : addState ,
				addZip : addZip ,
				name : name ,
				logo : logo ,
				rooms : rooms ,
			}
		}) 
		})
	})
</script> -->
<script type="text/javascript">
  $(document).ready(()=>{
    $('#page-top').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>
