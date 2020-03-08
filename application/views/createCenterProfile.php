<!DOCTYPE html>
<html>
<head>
	<title>Spotlist</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
</head>
<body id="page-top">
	   <?php require_once('header.php') ?>
	<div id="wrapper">	 
		<div  id="content-wrapper"  style="padding-top: 0px;margin-top: 80px;padding-left: 15px;">
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
			<div id="AddCenter" onclick="addCenter()" class="col-lg-6 text-right"><b style="cursor: pointer;background-color: transparent;background-image: url(https://spotlist.todquest.com/images/button.png);border: 0px solid;color: white;background-size: cover; padding: 10px;"> Add Center</b></div>
		<div class="w-100" style="padding: 5px;"></div>
		<div class="col-lg-6 form-group">
			<label><i style="color: #aa63ff;" class="fas fa-school"></i> Center Name</label>
			<input type="text" class="form-control" name="" id="" placeholder="Center name" value="" required>
		</div>
    	<div class="col-lg-6 form-group">
			<label><i style="color: #aa63ff;" class="fas fa-city"></i> City</label>
		<input type="text" class="form-control" name="" id="" placeholder = "City" value="">
		</div>
		<div class="col-12 form-group">
			<label><i style="color: #aa63ff;" class="fas fa-road"></i> Street Address</label>
			<textarea class="form-control" name="" id="" placeholder="Street Address"></textarea>
		</div>
	     <div class="col-lg-6 form-group">
			<label><i style="color: #aa63ff;" class="fas fa-map-marked-alt"></i> State</label>
			<select class="form-control" name="" id="">
				<option value=""></option>
			</select>
		</div>
	    <div class="col-lg-6 form-group">
			<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up"></i> PostCode</label>
			<input class="form-control" type="number" name="" id="" value="" placeholder = "Postcode" required>
		</div>
		     <div class="col-lg-6 form-group">
			<label><i style="color: #aa63ff;" class="fas fa-dollar-sign"></i> Waitlist Fees</label>
		<input class="form-control" type="number" name="" id="" placeholder="Waitlist fee in AUD" value="" required>
	</div>
</div>


<hr>
<div class="row">
	<div class="col-lg-6"><h3>Organize Rooms</h3></div>
	<div class="col-lg-6 text-right">	<div id="AddRoom" onclick="addRoom()"><b style="cursor: pointer;background-color: transparent;background-image: url(https://spotlist.todquest.com/images/button.png);border: 0px solid;color: white;background-size: cover; padding: 10px;"> Add Room</b>
	</div></div>
	<div class="w-100" style="padding: 5px;"></div>
</div>
	<span id="" >
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
<script>
	     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                	$('#blah').css('display', 'block');
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
	
</body>
</html>
