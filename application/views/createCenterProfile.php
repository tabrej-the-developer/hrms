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
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up"></i> Centre-phone-number</label>
					<input class="form-control" type="number" name="" id="centre_phone_number" value="" placeholder = "Centre-phone-number">
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up"></i> Centre-mobile-number</label>
					<input class="form-control" type="number" name="" id="centre_mobile_number" value="" placeholder = "Centre-mobile-number">
				</div>
			    <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-sort-numeric-up"></i> Centre-email	</label>
					<input class="form-control" type="number" name="" id="Centre_email	" value="" placeholder = "Centre-email	">
				</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-ABN</label>
				<input class="form-control" type="text" name="" id="centre_abn" placeholder="Centre-ABN" value="" >
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-ACN</label>
				<input class="form-control" type="text" name="" id="centre_acn" placeholder="Centre-ACN" value="">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-SE-no</label>
				<input class="form-control" type="text" name="" id="centre_se_no" placeholder="Centre-SE-no" value="">
			</div>
	<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-date-opened</label>
				<input class="form-control" type="text" name="" id="centre_date_opened" placeholder="Centre-date-opened" value="">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-capacity</label>
				<input class="form-control" type="text" name="" id="centre_capacity" placeholder="Centre-capacity" value="">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-approval-doc</label>
				<input class="form-control" type="file" name="" id="centre_approval_doc" placeholder="Centre-approval-doc" value="" onchange="validate('centre_approval_doc')">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-CCS-doc</label>
				<input class="form-control" type="file" name="" id="centre_ccs_doc" placeholder="Centre-CCS-doc" value="" onchange="validate('centre_ccs_doc')">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Manager-name</label>
				<input class="form-control" type="text" name="" id="manager_name" placeholder="Manager-name" value="">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-admin-name</label>
				<input class="form-control" type="text" name="" id="centre_admin_name" placeholder="Centre-admin-name" value="">
			</div>
			<div class="col-lg-6 form-group">
				<label>
					<i style="color: #aa63ff;" class="fas "></i> Centre-nominated-supervisor</label>
				<input class="form-control" type="text" name="" id="centre_nominated_supervisor" placeholder="Centre-nominated-supervisor" value="">
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
					<input type="text" class="room_name" name="" id="" value="" placeholder="Room name">
				</div>
		       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-chair"></i> Capacity</label>
								<input type="number" class="capacity_" name="" value="" placeholder="Capacity" > 
				</div>
				       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-baby"></i> Minimum Age</label>
					<input type="number" class="minimum_age" name="" id="" value="" placeholder="Min age in months"></div>
					       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i> Maximum Age</label>
					<input type="number" class="maximum_age" name="" id="" value="" placeholder="Max age in months" > 
				</div>
				</div>
			</span>	
		<hr>
		<div class="row">
			<div class="col-lg-6"><h3>Organize Centre Compliance</h3></div>
			<div class="col-lg-6 text-right">
				<div id="cci" ><b style="cursor: pointer;background-color: transparent;background-image: url(https://spotlist.todquest.com/images/button.png);border: 0px solid;color: white;background-size: cover; padding: 10px;"> Add</b>
			</div></div>
			<div class="w-100" style="padding: 5px;"></div>
		</div>
			<span id="" class="cci-class">
					<div class="row">
					<h4 class="col-12">Centre Compliance Information </h4>
		           <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-door-open"></i>Compliance-name</label>
					<input type="text" class="compliance_name" name="compliance_name" placeholder="Compliance-name">
				</div>
		       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-chair"></i>Compliance-desc</label>
								<input type="text" class="compliance_desc" name="compliance_desc" placeholder="Compliance-desc" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-baby"></i>Compliance-contact-details</label>
					<input type="text" class="compliance_contact_details" name="compliance_contact_details"placeholder="Compliance-contact-details"></div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Compliance-contact-name</label>
					<input type="text" class="compliance_contact_name" name="compliance_contact_name" placeholder="Compliance-contact-name" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Compliance-contact-number</label>
					<input type="text" class="compliance_contact_number" name="compliance_contact_number"  placeholder="Compliance-contact-number" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Compliance-contact-email</label>
					<input type="email" class="compliance_contact_email" name="compliance_contact_email" id="" value="" placeholder="Compliance-contact-email" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Compliance-expiry-renewal-date</label>
					<input type="date" class="compliance_expiry_renewal_date" name="compliance_expiry_renewal_date"  placeholder="Compliance-expiry-renewal-date" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Compliance-document</label>
					<input type="number" class="compliance_document" name="compliance_document"  placeholder="Compliance-document" > 
				</div>
				</div>
			</span>			 
		</span>
		<hr>

		<div class="row">
			<div class="col-lg-6"><h3>Organize Centre Suppliers</h3></div>
			<div class="col-lg-6 text-right">
				<div id="csi" ><b style="cursor: pointer;background-color: transparent;background-image: url(https://spotlist.todquest.com/images/button.png);border: 0px solid;color: white;background-size: cover; padding: 10px;"> Add</b>
			</div></div>
			<div class="w-100" style="padding: 5px;"></div>
		</div>
			<span id="" class="csi-class">
					<div class="row">
					<h4 class="col-12">Centre Supplier Information </h4>
		           <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-door-open"></i>Supplier-desc</label>
					<input type="text" class="supplier_desc" name="supplier_desc"  placeholder="Supplier-desc">
				</div>
		       <div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-chair"></i>Supplier-account-no</label>
								<input type="number" class="supplier_account_no" name="supplier_account_no"  placeholder="Supplier-account-no" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-baby"></i>Supplier-contact-name</label>
					<input type="text" class="supplier_contact_name" name="supplier_contact_name"  placeholder="Supplier-contact-name"></div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Supplier-contact-number</label>
					<input type="number" class="supplier_contact_number" name="supplier_contact_number"  placeholder="Supplier-contact-number" > 
				</div>
				<div class="col-lg-6 form-group">
					<label><i style="color: #aa63ff;" class="fas fa-child"></i>Supplier-contact-email</label>
					<input type="email" class="supplier_contact_email" name="supplier_contact_email" placeholder="Supplier-contact-email" > 
				</div>
				</div>
			</span>			 
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
		var newCCI = $('.cci-class').html();
		$(document).on('click','#cci',function(){
			var length = $('.cci-class').length;
			$('.cci-class').eq(length-1).after(newCCI);
		})
	})

	$(document).ready(function(){
		var newCSI = $('.csi-class').html();
		$(document).on('click','#csi',function(){
			var length = $('.csi-class').length;
			$('.csi-class').eq(length-1).after(newCSI);
		})
	})

	$(document).ready(function(){
		$(document).on('click','.btn-success',function(){
		var addStreet = $('#center-name').val();
		var	addCity =  $('#center-city').val();
		var	addState = $('#center-state').val();
		var	addZip = $('#center-zip').val();
		var	name = $('#center-name').val();
		var centre_phone_number = $('#centre_phone_number').val();
		var centre_mobile_number = $('#centre_mobile_number').val();
		var Centre_email = $('#Centre_email').val();
		var centre_abn = $('#centre_abn').val(); //document
		var centre_acn = $('#centre_acn').val();
		var centre_se_no = $('#centre_se_no').val();
		var centre_date_opened = $('#centre_date_opened').val();
		var centre_capacity = $('#centre_capacity').val();
		var centre_approval_doc = $('#centre_approval_doc').val(); //document
		var centre_ccs_doc = $('#centre_ccs_doc').val(); //document
		var manager_name = $('#manager_name').val();
		var centre_admin_name = $('#centre_admin_name').val();
		var centre_nominated_supervisor = $('#centre_nominated_supervisor').val();

		var roomsLength = $('.room_name').length;
		var complianceLength = $('.compliance_name').length;
		var supplierLength = $('.supplier_desc').length;
		var rooms = [];
		var suppliers = [];
		var compliances = [];

		function room(room_name,
									capacity_,
									minimum_age,
									maximum_age){
			return {
							room_name:room_name,
							capacity_:capacity_,
							minimum_age:minimum_age,
							maximum_age:maximum_age
						};
		}

		function compliance(compliance_name,
											compliance_desc,
											compliance_contact_details,
											compliance_contact_name,
											compliance_contact_number,
											compliance_contact_email,
											compliance_expiry_renewal_date,
											compliance_document){
			return{
				compliance_name : compliance_name,
				compliance_desc : compliance_desc,
				compliance_contact_details : compliance_contact_details,
				compliance_contact_name : compliance_contact_name,
				compliance_contact_number : compliance_contact_number,
				compliance_contact_email : compliance_contact_email,
				compliance_expiry_renewal_date : compliance_expiry_renewal_date,
				compliance_document : compliance_document
			}
		}
		function supplier(supplier_desc,
												supplier_account_no,
												supplier_contact_name,
												supplier_contact_number,
												supplier_contact_email){
			return{
				supplier_desc : supplier_desc,
				supplier_account_no : supplier_account_no,
				supplier_contact_name : supplier_contact_name,
				supplier_contact_number : supplier_contact_number,
				supplier_contact_email : supplier_contact_email
			}
		}

		for(let i=0;i<roomsLength;i++){
			var room_name = $('.room_name').eq(i).val()
			var capacity_ = $('.capacity_').eq(i).val()
			var minimum_age = $('.minimum_age').eq(i).val()
			var maximum_age = $('.maximum_age').eq(i).val()
			rooms.push(room(room_name,capacity_,minimum_age,maximum_age));
		}
		for(let i=0;i<complianceLength;i++){
			var compliance_name = $('.compliance_name').eq(i).val();
			var compliance_desc = $('.compliance_desc').eq(i).val();
			var compliance_contact_details = $('.compliance_contact_details').eq(i).val();
			var compliance_contact_name = $('.compliance_contact_name').eq(i).val();
			var compliance_contact_number = $('.compliance_contact_number').eq(i).val();
			var compliance_contact_email = $('.compliance_contact_email').eq(i).val();
			var compliance_expiry_renewal_date = $('.compliance_expiry_renewal_date').eq(i).val();
			var compliance_document = $('.compliance_document').eq(i).val();
			suppliers.push(supplier(compliance_name,compliance_desc,compliance_contact_details,compliance_contact_name,compliance_contact_number,compliance_contact_email,compliance_expiry_renewal_date,compliance_document));
		}
		for(let i=0;i<supplierLength;i++){
			var supplier_desc = $('.supplier_desc').eq(i).val();
			var supplier_account_no = $('.supplier_account_no').eq(i).val();
			var supplier_contact_name = $('.supplier_contact_name').eq(i).val();
			var supplier_contact_number = $('.supplier_contact_number').eq(i).val();
			var supplier_contact_email = $('.supplier_contact_email').eq(i).val();
			compliances.push(compliance(compliance_name,compliance_desc,compliance_contact_details,compliance_contact_name,compliance_contact_number,compliance_contact_email,compliance_expiry_renewal_date,compliance_document));;
		}

		var url = window.location.origin+"/PN101/settings/createCenterProfile"
		$.ajax({
			url: url,
			type:'POST',
			data:{
					addStreet : addStreet,
					addCity : addCity,
					addState : addState,
					addZip : addZip,
					name : name,
					centre_phone_number : centre_phone_number,
					centre_mobile_number : centre_mobile_number,
					Centre_email : Centre_email,
					centre_abn : centre_abn,
					centre_acn : centre_acn,
					centre_se_no : centre_se_no,
					centre_date_opened : centre_date_opened,
					centre_capacity : centre_capacity,
					centre_approval_doc : centre_approval_doc,
					centre_ccs_doc : centre_ccs_doc,
					manager_name : manager_name,
					centre_admin_name : centre_admin_name,
					centre_nominated_supervisor : centre_nominated_supervisor,	
					rooms : rooms,
					suppliers : suppliers,
					compliances : compliances
			},
			success:function(response) {
				console.log(response)
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
<script type="text/javascript">
	function validate(variable){
		if(($('#'+variable)[0].files[0].size)/(1024*1024) < 4){
			
		}else{
			$('#'+variable).val('');
			alert('File size must be less than 4MB')
		}
	}
</script>
</body>
</html>















