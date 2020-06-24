<!DOCTYPE html>
<html>
<head>
	<title>PN101</title>
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
	<?php $permissions = json_decode($permissions); ?>
	   <?php require_once('header.php') ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewCenterProfileYN : "N")== "Y"){ ?>
	<div id="wrapper-element">	 
		<div  id="content-wrapper-element"  style="padding-top: 0px;margin-top: 80px;padding-left: 15px;">
		<div class="container-fluid card_future" style="padding: 20px;">
		<h4 class="row">
			<div class="col-12">
				<a href="">
					<button class="btn back-button"> 
						<img src="">
					</button></a> Enter Center Details
			</div>
		</h4>	
		<form name ="userinput" action="" method="post" enctype="multipart/form-data" >
			<hr>
		 	<span id="centerDetailsYo">
		 		<div class="row">
				<h3 class="col-lg-6">Center </h3>
					
				<div class="w-100" style="padding: 5px;"></div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-school"></i> Center Name</label>
					<input type="text" class="form-control" name="" id="ceter-name" placeholder="Center name" value="" required>
				</div>
		    	<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-city"></i> City</label>
				<input type="text" class="form-control" name="" id="center-city" placeholder = "City" value="">
				</div>
				<div class="col-12 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-road"></i> Street Address</label>
					<textarea class="form-control" name="" id="center-street" placeholder="Street Address"></textarea>
				</div>
			     <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-map-marked-alt"></i> State</label>
					<select class="form-control" name="" id="center-state">
						<option value=""></option>
					</select>
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up"></i> PostCode</label>
					<input class="form-control" type="number" name="" id="center-zip" value="" placeholder = "Postcode" required>
				</div>

			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Logo</label>
				<input class="form-control" type="file" name="" id="center-logo" placeholder="Logo" value="">
			</div>
		</div>


		<hr>
		<div class="row">
			<div class="col-lg-6"><h3>Organize Rooms</h3></div>
			<div class="col-lg-6 text-right">	<div id="AddRoom" ><b style="cursor: pointer;background-color: transparent;background-image: url(https://spotlist.todquest.com/images/button.png);border: 0px solid;color: white;background-size: cover; padding: 10px;"> Add Room</b>
			</div></div>
			<div class="w-100" style="padding: 5px;"></div>
		</div>
			<span id="" class="room-class">
					<div class="row">
					<h4 class="col-12">Room </h4>
		           <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-door-open"></i> Room Name</label>
					<input type="text" class="form-control" name="" id="" value="" placeholder="Room name">
				</div>
		       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-chair"></i> Capacity</label>
								<input type="number" class="form-control" name="" value="" placeholder="Capacity" > 
				</div>
				       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-baby"></i> Minimum Age</label>
					<input type="number" class="form-control" name="" id="" value="" placeholder="Min age in months"></div>
					       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i> Maximum Age</label>
					<input type="number" class="form-control" name="" id="" value="" placeholder="Max age in months" > 
				</div>
					
					<div  class="alert alert-danger" role="alert" style=""></div>
				</div>
			</span>
		 <div  class="alert alert-danger" role="alert" style=""></div>
			 
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
<?php } ?>
<script type="text/javascript">
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
		var url = "http://localhost/PN101/createCenterProfile"
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
</script>
<script type="text/javascript">
  $(document).ready(()=>{
    $('#wrapper-element').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>
