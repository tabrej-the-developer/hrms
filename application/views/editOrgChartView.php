<!DOCTYPE html>
<html>
<head>
<title>Organizational Chart</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<div class="containers scrollY">
		<div class="settingsContainer">
			<?php $centersList = json_decode($centers); ?>
			<span class="d-flex pageHead heading-bar">
				<div class="withBackLink">
					<a href="<?php echo base_url();?>/settings">
						<span class="material-icons-outlined">arrow_back</span>
					</a>				
					<span class="events_title">Organisational Chart</span>
				</div>
				<div class="rightHeader">
					<select class="sellect" > 
						<!-- <option>--Select Center--</option> -->
						<?php foreach($centersList->centers as $centers){ ?>
							<option value="<?php echo $centers->centerid;?>" class="opt"><?php echo $centers->name;?></option>
						<?php } ?>
					</select>
				</div>
			</span>

			<div class="container-child">
				<div class="container-actual-element">
					<?php $permissions = json_decode($permissions); ?>
					<?php if(isset($permissions->permissions) ? $permissions->permissions->viewOrgChartYN : "N" == "Y"){ ?>

						<div class="thisOne">	
							<div class="center-name">
								<span>
									<?php
									if(isset($centerid)){
										foreach($centersList->centers as $center){
											if($center->centerid == $centerid){
												print_r($center->name);
											}
										}
									}
									echo "<br>";
									?>
		 						</span>
		 						<?php if((isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : "N") == "Y"){ ?>
								<span class="d-flex settingsButton pull-right">
									<button onclick="newArea()" class="btn btn-primary btn-default btn-small btnBlue">
										<span class="material-icons-outlined">add</span> Add New Area
									</button>
									<button class="btn btn-primary assign_roles btn btn-default btn-small btnOrange">
										<span class="material-icons-outlined">work_outline</span> Assign Roles
									</button>
								</span>
								<div class="clearfix"></div>
								<?php } ?>
							</div>
							<div id="areas-roles-list">
									<div id="form-space"></div>
									<?php $orgChart = json_decode($orgChart);
									if(isset($orgChart->orgchart)){
									foreach($orgChart->orgchart as $orgChart){ ?>
									<div id="<?php echo $orgChart->areaId .'-'.$orgChart->areaName?>" class="area-id">
										<div id="areas-roles" areaId="<?php echo $orgChart->areaId; ?>" YN="<?php echo $orgChart->isARoomYN; ?>">
											<span class="area-name"><?php echo $orgChart->areaName."<br>"; ?></span>
											<span class="editAreaRole">
												<?php if((isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : "N") == "Y"){ ?>
												<span  class="newRole">
													<a href="javascript:void(0)">
														<span class="material-icons-outlined">add</span>
													</a>
												</span>
												<span class="editArea ">
													<a href="javascript:void(0)">
														<span class="material-icons-outlined">edit</span>
													</a>
												</span>
												<span class="delete-Area" style="padding-right:20px">
													<a class="delete-area" href="javascript:void(0)" d-val="<?php echo $orgChart->areaId ?>">
														<span class="material-icons-outlined">delete</span>
													</a>
												</span>
												<?php } ?>
											</span>
										</div>
										<div areaId="<?php echo $orgChart->areaId;?>" class="areaId"></div>
										<ul>
											<?php foreach($orgChart->roles as $roles){
											echo "<li class='li-c'><span class=\"roleNameClass\"  a_id=".$orgChart->areaId." r_id=".$roles->roleid.">".$roles->roleName."</span><span class=\"roleIdClass\" style=\"display:none\">".$roles->roleid."</span>";
											if((isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : 'N') == 'Y'){
											echo "<span><span class=\"editRole\"><span class=\"material-icons-outlined\">edit</span></span><span class=\"delete-role\" d-val=\"$roles->roleid\"><span class=\"material-icons-outlined\">delete</span></span></span></li>";
												}
											}
											?>
										</ul>
									</div>
									<?php 

									}}
									?>
								</div>
							</div>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ----------------------------
						EMPLOYEES MODAL 
			---------------------------- -->
<div class="mask" ></div>
<div class="modal_priority modal modalNew" >
	<div class="modal-dialog mw-75">
		<div class="modal-content NewFormDesign">
			<div class="modal-header">
				<h3 class="modal-title changeRole_heading"></h3>
			</div>
			<div class="modal-body container">
				<div class="flexCheck">
					<span><input type="checkbox" class="toggleByEmpty"></span>
					<span class="ml-2">Hide Unassigned</span>
				</div>
				<div class="priority_areas"></div>
				<div class="priority_buttons modal-footer">
					<button class="close_priority btn btn-default btn-small pull-right" role="button">
						<span class="material-icons-outlined">close</span>Cancel
					</button>
					<button class="priority_save btn btn-default btn-small btnBlue pull-right">
						<span class="material-icons-outlined">save</span>Save
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ----------------------------
						EMPLOYEES MODAL 
			---------------------------- -->


<script type="text/javascript">
	function reloadPageBody(){
		var centerid = $('.sellect').val();
		var url = '<?php echo base_url();?>settings/orgChart';
		$.ajax({
			url : url,
			type : 'POST',
			data : {
				centerid:centerid
			} ,
			success:function(response){
				$('.thisOne').html($(response).find('.thisOne').html());
				// getEmployeesCountByRole();
			} 
		});
	}

	function newArea(){
		var insertForm = document.createElement('form');
		var formParent = document.getElementById('form-space');
		insertForm.id = "new-area-form";
		insertForm.method = "POST";
		insertForm.action = "<?php echo base_url()."/settings/addArea"?>";
		var getForm = document.getElementById('new-area-form');
		var code = "<div class=\"form-floating\"><input class=\"form-control\" type=\"text\" name=\"areaName\" placeholder=\"Area Name\" id=\"areaName\"><label for=\"areaName\">Area Name</label></div><div class=\"form-floating\"><select class=\"form-control\" name=\"isRoomYN\" id=\"isRoomYN\"><option value=\"Y\">Y</option><option value=\"N\">N</option></select><label for=\"isRoomYN\">Is room Y/N</label><input type=\"text\" name=\"\" class=\"none\"><input type=\"text\" name=\"centerid\" class=\"none\" value=\"<?php echo $centerid;?>\"></div><div class=\"formSubmit\"><input type=\"submit\" value=\"Save\" class=\"btn btn-default btn-small btnBlue pull-right\" id=\"addAreaSubmit\"><input type=\"button\" value=\"Cancel\" class=\"reset btn btn-default btn-small pull-right\" onclick=\"deleteAreaForm()\"></div>"
		if($("#form-space").text().length == 0){
		formParent.insertBefore(insertForm,formParent.firstElementChild);
		insertForm.insertAdjacentHTML('afterbegin',code)
	}
	}
		$(document).on('click','.newRole',function(){
			var parent = $(this).parent().parent();
			var nextElem = parent.next();
			var code = "<div class=\"appendForm\"><span><input type=\"text\" name=\"roleName\" placeholder=\"Role Name\"></span><span><input type=\"text\" name=\"\" class=\"none\"></span><span><input type=\"submit\" value=\"Save\" class=\"addRoleSubmit\"></span><span><input type=\"button\" value=\"Cancel\" class=\"resets\" ></span></div>";
			if($(nextElem).text().length == 0){
			$(nextElem).append(code)
				}
		})
		
		$(document).on('click','.editArea',function(){
			var parent = $(this).parent();
			var parentData = $(parent).html();
			var nameOfArea = $(this).prev().prev().text();
			var idOfArea = $(parent).attr('id');
			var isRoomYN = $(parent).attr('YN');
				$(parent).empty();
			var code = "<span><input type=\"text\" class=\"editClassArea\"></span><span><select  class=\"editClassYN\"><option value='Y'>Y</option><option value='N'>N</option></select></span><span><input type=\"submit\" class=\"editAreaSubmit\"></span><span><input type=\"button\" class=\"editAreaCancel\" value=\"Cancel\"></span>";
			if($(parent).text().length == 0){
			$(parent).append(code)
			$(parent).children().children('input.editClassArea').val(nameOfArea)
			$(parent).children().children('.editClassYN').val(isRoomYN)
			// $(parent).children().children(`input.editClassYN option[value="${isRoomYN}"]`).attr('selected','selected')
				}
			$('span').off('click').on('click','.editAreaCancel',function(){
				var divParent = $(this).parent().parent();
				$(divParent).empty()
				$(divParent).html(parentData);	
	
			})
		})
<?php 
	if((isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : 'N') == 'Y'){
 ?>
		$(document).on('click','.editRole',function(){
			var parent = $(this).parent().parent();
			var parentData = $(parent).html();
			var nameOfRole = $(parent).children('span.roleNameClass')[0].firstChild.nodeValue;
			var idOfRole = $(parent).children('span.roleIdClass').text();

				$(parent).empty();
			var code = "<div class=\"appendForm2\"><span><input type=\"text\" class=\"editClass\"></span><span style=\"display:none\"><input type=\"text\" class=\"editClassId\"></span><span><input type=\"submit\" class=\"editRoleSubmit\"></span><span><input type=\"button\" class=\"editRoleCancel\" value=\"Cancel\"></span></div>";
			if($(parent).text().length == 0){
			$(parent).append(code);
			$(".appendForm2").addClass("active");
			$(parent).children().children().children('input.editClass').val(nameOfRole)
			$(parent).children().children().children('input.editClassId').val(idOfRole)
				}
			$('li').off('click').on('click','.editRoleCancel',function(){
				var liParent = $(this).parent().parent();
				$(".appendForm2").removeClass("active");
				$(liParent).empty()
				$(liParent).html(parentData);	
	
			})
		})

<?php } ?>


		$(document).on('click','.resets',function(){
			var parent = $(this).parent().parent().parent();
			$(parent).empty()
		})

		$(document).on('click','#addAreaSubmit',function(e){
			e.preventDefault();
			var url = "<?php echo base_url();?>settings/addArea";
			var centerid = $('.sellect').prop('value');
			var areaName = $('#areaName').val();
			var isRoomYN = $('#isRoomYN').val();
			$.ajax({
				url:url,
				type:'POST',
				data:{
					centerid:centerid,
					areaName:areaName,
					isRoomYN:isRoomYN,
				},
				success:function(response){
					reloadPageBody()
					// getEmployeesCountByRole()
					// window.location.reload();
				}
			})
		})

		$(document).on('click','.addRoleSubmit',function(e){
			e.preventDefault();
			var url = "<?php echo base_url();?>settings/addRole";
			var areaid = $(this).parent().parent().parent().attr('areaId');
			// var roleName = $(this).parent().parent().children().children().next().val();
			var roleName = $(this).parent().parent().parent().parent().find('input').val();
			// alert(areaid+"||"+roleName);
			$.ajax({
				url:url,
				type:'POST',
				data:{
					areaid:areaid,
					roleName:roleName,
				},
				success:function(response){
					// window.location.reload();
					reloadPageBody()
					// getEmployeesCountByRole()
					// alert(areaid + " " + roleName)
				}
			})
		})


	$(document).on('click','.editAreaSubmit',function(e){
			e.preventDefault();
			var url = "<?php echo base_url();?>settings/UpdateArea";
			var areaid = $(this).parent().parent().attr('areaId');
			var areaName = $(this).parent().prev().prev().children().val();
			var isRoomYN = $(this).parent().prev().children().val();
			$.ajax({
				url:url,
				type:'POST',
				data:{
					areaid   : areaid,
					areaName : areaName,
					isRoomYN : isRoomYN
				},
				success:function(response){
					// window.location.reload();
					reloadPageBody()
					// getEmployeesCountByRole()
				}
			}).fail(function(){
				alert('fail')
			})
		})


		$(document).on('click','.editRoleSubmit',function(e){
			e.preventDefault();
			var url = "<?php echo base_url();?>settings/UpdateRole";
			var roleid = $(this).parent().prev().children().val();
			var roleName = $(this).parent().prev().prev().children().val();
			$.ajax({
				url:url,
				type:'POST',
				data:{
					roleid:roleid,
					roleName:roleName,
				},
				success:function(response){
					// window.location.reload();
					reloadPageBody()
					// getEmployeesCountByRole()
					// alert(roleid + " " + roleName )
				}
			})
		})

		function deleteAreaForm(){
			$('#form-space').empty();
	}

	$(document).on('change','.sellect',function(){

		var url = "<?php echo base_url();?>settings/orgChart";
		var centerid = parseInt($(this).prop('value'));
		var orgurl = "<?php echo base_url();?>settings/getOrgCharts/"+centerid;
		$.ajax({
			url:orgurl,
			type:'GET',
			success:function(response){
				sessionStorage.setItem('orgChartData',response);
			}
		})
		$.ajax({
			url : url,
			type : 'POST',
			data : {
				centerid:centerid
			} ,
			success:function(response){
				$('.thisOne').html($(response).find('.thisOne').html());
				// getEmployeesCountByRole();
			} 
		});
	})

	$(document).on('click','.delete-role',function(){
		var url = "<?php echo base_url();?>settings/deleteRole"
		var id = $(this).attr('d-val');
		$.ajax({
			url : url ,
			type: 'POST',
			data : {
				id : id
			},
			success : function(response){
				// window.location.reload();
				reloadPageBody()
				// getEmployeesCountByRole()
			}
		})
	})

	$(document).on('click','.delete-area',function(){
		var url = "<?php echo base_url();?>settings/deleteArea"
		var id = $(this).attr('d-val');
		$.ajax({
			url : url ,
			type: 'POST',
			data : {
				id : id
			},
			success : function(response){
				 // window.location.reload();
				 reloadPageBody()
				//  getEmployeesCountByRole()
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});


	function closeModal(){
	  $(".mask").removeClass("active");
		}

	$(".close_priority").on("click", function(){
		  closeModal();
			$(".priority_areas").empty();
		});


		function roleChange(roleId=null,areaId,similarity=null,x){
			var centerid = $('.sellect').val();
			// var userid = $('#user-id-select').text();
				var url = "<?php echo base_url();?>settings/getOrgCharts/"+centerid;
				$.ajax({
					method:'GET',
					url:url,
					dataType: 'JSON',
					success:function(response){
						let code = "<option value='0'>--Select Role--</option>";
						response['orgchart'].forEach(function(index){
							index['roles'].forEach(function(values){
								if(areaId == values.areaid){
									if(roleId == values.roleid){
										code += "<option value="+values.roleid+" selected>"+values.roleName+"</option>";
										}
									else{
										code += "<option value="+values.roleid+">"+values.roleName+"</option>";
										}
									}
								})
							})
							if(similarity != null){
								$('.select_role[similarity='+similarity+']').empty();
								$('.select_role[similarity='+similarity+']').append(code)
							}
							else{
								$('.select_role').eq(x).empty();
								$('.select_role').eq(x).append(code)
							}
						}
					})
				}

			function addAreaToSelect(area_id,role_id,centerid,x){
				var data = "";
				// var userid = $('#user-id-select').text();
				var response = sessionStorage.getItem('orgChartData');
				response = JSON.parse(response)
					response['orgchart'].forEach(function(index){
						if(area_id == index.areaId){
							 dat = `<option value="${index.areaId}" selected>${index.areaName}</option>`;
							 data = data+dat;
							roleChange(role_id,index.areaId,x);
						}
						else{
						 dat = `<option value="${index.areaId}" >${index.areaName}</option>`;
						data = data+dat;
						}
					})
					$('.select_area').eq(x).append(data)
			}

		$(document).ready(function(){
			/* --------------------------
						Cache getOrgCharts
					-------------------------- */
			$(document).ready(function(){
				var centerid = $('.sellect').val();
				var url = "<?php echo base_url();?>settings/getOrgCharts/"+centerid;
					$.ajax({
					url:url,
					type:'GET',
					success:function(response){
							sessionStorage.setItem('orgChartData',response);
						}
					})
				})

			/* --------------------------
						Open Assign Roles Modal
				-------------------------- */
			$(document).on('click','.assign_roles',function(e){
				var roleName = "Assign Roles";
				var centerid = $('.sellect').val();
				var employees_array = [];
				var x = 0;
					$('.changeRole_heading').text(roleName);
					$('.priority_areas').empty();
					$('.mask').addClass("active");
				var employees = sessionStorage.getItem('orgChartData');
				console.log(employees);
				var employees = JSON.parse(employees);
				var emp_url = "<?php echo base_url();?>settings/getEmployeesByCenter/"+centerid;
				$.ajax({
					url:emp_url,
					type:'GET',
					success:function(re){
						console.log(re)
					re = JSON.parse(re)
					re.employees.forEach(function(em){
						a=0;
						a++;
						var code = `<div id="change_role">
							<span class="changeRole__" employeeId="${em.id}" role_id="${em.roleid}"  style="width:35%">${em.name}</span>
							<div class="d-flex">
							<select class="select_area" similarity="${x}" >
								<option value="0" selected>--Select Area--</option>
							</select>
							<select class="select_role" similarity="${x}" >
							<option value="0" selected>--Select Role--</option> 
							</select>
						</div>
						</div>`;
						$('.priority_areas').append(code);
							if(em.areaid != null && em.areaid != "")
								addAreaToSelect(em.areaid,em.roleid,centerid,x)
							else
								addAreaToSelect(em.areaid,em.roleid,centerid,x)
						x++;
						})
						}
					})
				})
			})

			/* --------------------------
						Open Assign Roles Modal
				-------------------------- */

		// $(document).ready(function(){
		// 		getEmployeesCountByRole()
		// 	})



		function getEmployeesCountByRole(){
			var count = $('.roleNameClass').length;
			console.log(count)
			var c = 0;
			for(var i=0;i<count;i++){
				var role = $('.roleNameClass').eq(i).attr('r_id');
				url = "<?php echo base_url();?>settings/getEmployeesForRoles/"+role;
				$.ajax({
					url : url,
					type : 'GET',
					success : function(response){
						emps = JSON.parse(response).employees;
						empCount = emps.length;
						string = "";
						$('.roleNameClass').eq(i).append(` <span class="usersWithRole">( ${empCount} <img src="<?php echo base_url('assets/images/icons/customer.png'); ?>" style="max-height:1rem;margin-right:10px">)</span>`);
						emps.forEach(function(e){
							string = string +'\n'+e.name
						})
						$('.roleNameClass').eq(i).attr('title',string)
						c++;
					}
				})
			}
		}

$(document).ajaxStop(function(){

})

	$(document).ready(function(){
		$(document).on('change','.select_area',function(){
				var similarity = $(this).attr('similarity');
				$('.select_role[similarity='+similarity+']').empty()
				roleChange(null,$(this).val(),similarity)
		})
	})

	$(document).ready(function(){
		$(document).on('click','.priority_save',function(){
			var details = [];
			var obj = {};
			for(var i=0;i<$('.changeRole__').length;i++){
				obj = {};
				obj.employeeId = $('.changeRole__').eq(i).attr('employeeId');
				obj.roleId =  $('.select_role').eq(i).val();
				if(obj.roleId  != -21){
					details.push(obj);
				}
			}
			console.log(details)
			var url = "<?php echo base_url();?>settings/changeEmployeeRole"
			$.ajax({
				url : url,
				method : 'POST',
				data : {
					details : details
				},
				success: function(response){
					// console.log(response)
					// window.location.href = window.location.href;
					closeModal();
				}
			})

		})

		$(document).on('click','.toggleByEmpty',function(){
			$('.select_area').each(function(){
				if($(this).val() == 0){
					$(this).parent().parent().toggle();
				}
			})
		})

	})
</script>

</body>
</html>
