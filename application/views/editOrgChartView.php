<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header.php');?>
	<title>Organizational Chart</title>
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
	body{
		background: #F2F2F2 !important;
	}
	.area-id::before{
		content: url(../assets/images/arrow-f.svg);
		position: absolute;
		margin:0 0 -80px -30px;
	}
	.li-c{
		list-style:none;
		background: rgba(0,0,255,0.1);
		margin-left: 4rem;
		border-bottom: 1px solid white;
		position: relative;
	}
	.li-c:before{
    position: absolute;
    content: ' ';
    padding:0.8rem;
    border-left: 1px solid black;
    border-bottom: 1px solid black;
    margin: -13px 0px 0px -30px;
	}

	.center-name{
		display: flex;
		font-size: 1.5rem;
		padding-left: 2rem;
		font-weight: 700;
		justify-content: space-between;
	}
	.none{
		display:none;
	}
	#areas-roles{
		display: inline-flex;
		width:100%;
	}
	.editClassArea{
		margin-left: 4rem;
	}
	.area-name{
		font-weight:bolder;
		margin:10px;
		color: #307bd3;
		margin-left: 2rem
	}
	.area-name:before{
		content: '- ';
		color: #307bd3;
	}
	.newRole{
		margin-left:auto;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.editArea{
		margin:0 0.5rem;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.delete-Area{
		display: flex;
		justify-content: center;
		align-items: center;
	}
/*	.newRole:after{
		content:' | ';
	}
	.editArea:after{
		content:" |";
	}*/
	.editRole{
		cursor: pointer;
		position: absolute;
		right: 10px;
		color: rgba(0,0,0,0.7);

	}
	#addAreaSubmit{
		margin-left:auto;
	}
	#new-area-form{
		width:100%;
	}
	.delete-role{
		cursor:pointer;
		position: absolute;
		right: 0;
		color: rgba(0,0,0,0.7);
	}
	input[type=submit],input[type=button]{
  /*position: absolute;*/
/*  right: 0;*/
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
      display: flex;
      align-items: center;
	}
	input[type="text"]{
		background: #ebebeb;
		border-radius: 5px;
	    padding: 5px;
	    border: 1px solid #D2D0D0 !important;
	    border-radius: 20px;
	}
	.select-class{
		padding: 1rem 1.5rem 0 1.5rem;
    position: absolute;
    right: 1rem;
    top: 0;
	}
	.this-one{
		
		padding: 3rem 2rem 2rem 1rem;
	}
	#areas-roles-list{
		height: calc(100% - 3rem);
		overflow-y: auto;
	}
	.container-child{
		padding: 0 2rem 2rem 1rem;
			 height: 90% !important;
	}
	.container-actual-element{
		background: white;
  	height: 100% !important
	}
	.center-select-span{
		font-weight: 700;
	}
.containers{
	height: 100vh;
	overflow: hidden;
	}   

  .thisOne{
  	    height: 100% !important;
  }
.areas-roles-list{
  	height: 100% !important;
    overflow: auto;
  }
	label{
		font-size:0.8rem;
		padding-left: 1rem;
		font-weight: 700;
	}
    select{
	background: rgb(164, 217, 214);
	font-weight: 700;
	color: rgb(23, 29, 75);
	border-radius: 20px;
    padding: 5px;
    padding-left: 20px;
    border: 2px solid #e9e9e9 !important;
		}
	.btn-primary{
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
      border-radius: 20px !important;
      padding: 4px 8px !important;
      background: rgb(164, 217, 214) !important;
      font-size: 1rem !important;
      margin-right:5px !important;
      justify-content: center !important;
      display: flex;
      align-items: center;
}

/*  -----------------------------
						MODAL
		------------------------------ */
.mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.1);
  z-index: 50;
  visibility: hidden;
  opacity: 0;
  transition: 0.7s;
}
.modal_priority {
  position: fixed;
  top: 30%;
  left: 40vw;
  width: 60vw;
  min-height: 90vh;
  margin-left: -15%;
  margin-top: -150px;
  background: #fff;
  z-index: 100;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s ease-out;
  transform: translateY(45px);
}
.active,.actived {
  visibility: visible !important;
  opacity: 1;
}
.active + .modal_priority {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.actived + .modal_priorityed {
  visibility: visible !important;
  opacity: 1;
  transform: translateY(0);
}
.priority_areas  tr td{
	width: 300px;
	cursor: move;
}
.priority_buttons{
	width:100%;
	justify-content: center;
	display: flex;
	padding: 20px 0 0 0;
}
.priority_areas {
	padding-top: 2rem;
	display: block;
    text-align: center;
    justify-content: center;
    width: 100%;
    height: 65vh;
    flex-wrap: wrap;
    overflow-y: scroll;
}
/*  ------------------------------
						MODAL
		------------------------------ */
.fas.fa-trash-alt::before,.fas.fa-plus::before,.fas.fa-pencil-alt::before{
	color: #171d4b;
}
.li-c{
	display: flex;
}
.li-c > span > input[type=text]{
	margin-left: 2rem;
}
.areaId > div{
	display: flex;
}
#new-area-form > div{
	display: flex;
}
.modal {
  display: none; 
  position: fixed;
    padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 30vw;
}

/* The Close Button */
/*.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}*/
	.close{
			float: none; 
	    font-size: inherit; 
	    font-weight: inherit; 
	    line-height: inherit; 
	    color: inherit; 
	    text-shadow: inherit; 
	    opacity: inherit; 
	    padding: 0; 
    	background-color: transparent;
	}
	.close:hover{
		background:#9E9E9E;
	}
	.box-name,.box-space,.changeRole_heading{
		display: flex;
		justify-content: center;
	}
	.buttons_group{
	padding-top: 1rem;
	padding-bottom: 1rem;
	display: flex !important;
	justify-content: center !important;
}
.close_priority,.priority_save{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  width:6rem;
	  height: 2rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
}
.close_priority{
	margin-right: 15px;
}
	.button{
	  border: none !important;
	  color: rgb(23, 29, 75) !important;
	  text-align: center !important;
	  text-decoration: none !important;
	  display: inline-block;
	  font-weight: 700 !important;
	  margin: 2px !important;
	  min-width:6rem !important;
      border-radius: 20px !important;
      padding: 8px !important;
      background: rgb(164, 217, 214) !important;
      display: flex !important;
}
.titl{
	background: #8D91AA;
}
.changeRole_heading{
	background: #8D91AA;

}
.box-name,.changeRole_heading {
    display: flex;
    justify-content: center;
    font-size: 1.5rem;
    color: #E7E7E7 !important;
}
.changeRole_head{
	height: 20vh;
}
.priority_areas{
	height: 65vh;
}
.priority_buttons{
	height: 10vh;
}
.box-space {
    display: flex;
    justify-content: center;
    color: white;
}
.row{
	margin-right: 0px !important; 
	margin-left: 0px  !important;
}
.changeRole__{
	cursor: pointer;
}
#change_role{
	display: flex;
	width: 100%;
}
.back-button{
	padding: 1rem 0 ;
}
.back_span{
		display: flex;
	align-items: center;
	padding-left: 1rem;
}
</style>
</head>
<body>
<div class="containers">
	<?php $centersList = json_decode($centers); ?>
  <span >
		<span class="back_span">
			<a href="<?php echo base_url();?>/settings">
		    <button class="btn back-button">
		      <img src="<?php echo base_url('assets/images/back.svg');?>">
		    </button>
		  </a>
    <span style="	text-align: left;
						font-weight:bold;
						font-size: 1.5rem;
						display: flex; 
						color: #171D4B;">Organisational Chart</span>
		</span>
		<span class="select-class ml-auto">
			<span class="select_css">
				<select class="sellect" > 
					<!-- <option>--Select Center--</option> -->
					<?php foreach($centersList->centers as $centers){ ?>
					<option value="<?php echo $centers->centerid;?>" class="opt"><?php echo $centers->name;?></option>
				<?php } ?>
				</select>
			</span>
		</span>
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
			<span style="position: absolute;right:0;display: flex;right:2rem">
			 <span onclick="newArea()" style="font-size:25px;">
				<a href="javascript:void(0)" >
					<button class="btn btn-primary">
			      <i>
			        <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem;margin-right:10px">
			      </i>Add New Area</button>
				</a>
			 </span>
			 <span>
				<button class="btn btn-primary assign_roles">
			    <i>
			      <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" 
			      		 style="max-height:1rem;margin-right:10px">
			    </i>Assign Roles</button>
			 </span>
			</span>
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
<?php if((isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : "N") == "Y"){ ?>
					<span  class="newRole">
						<a href="javascript:void(0)">
							<i class="" >
								<img height="20px" width="20px" src="<?php echo base_url('assets/images/icons/plus.png'); ?>">
							</i>
						</a>
					</span>
					<span class="editArea ">
						<a href="javascript:void(0)">
							<i class="">
								<img height="20px" width="20px" src="<?php echo base_url('assets/images/icons/pencil.png'); ?>">
							</i>
						</a>
					</span>
					<span class="delete-Area" style="padding-right:20px">
						<a class="delete-area" href="javascript:void(0)" d-val="<?php echo $orgChart->areaId ?>"><i class="" style="color: #ff3b30;">
							<img height="20px" width="20px" src="<?php echo base_url('assets/images/icons/delete__.png'); ?>">
						</i>
						</a>
					</span>
				<?php } ?>
				</div>
				<div areaId="<?php echo $orgChart->areaId;?>" class="areaId"></div>
				<div>
					<?php foreach($orgChart->roles as $roles){
					echo "<li class='li-c'><span class=\"roleNameClass\"  a_id=".$orgChart->areaId." r_id=".$roles->roleid.">".$roles->roleName."</span><span class=\"roleIdClass\" style=\"display:none\">".$roles->roleid."</span>";
					if((isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : 'N') == 'Y'){
					echo "<span class=\"editRole\" style=\"padding-right:25px\"><i><img height=\"20px\" width=\"20px\" src='".base_url('assets/images/icons/pencil.png')."'></i>&nbsp; &nbsp;</span><span class=\"delete-role\" d-val=\"$roles->roleid\" style=\"padding-right:20px\"><i><img height=\"20px\" width=\"20px\" src='".base_url('assets/images/icons/delete__.png') ."'></i></span></li>";
						}
					}
					?>
				</div>
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

<!-- ----------------------------
						EMPLOYEES MODAL 
			---------------------------- -->
<div class="mask" ></div>
<div class="modal_priority" >
	<span class="changeRole_head" >
		<a class="text-center  changeRole_heading" style="padding:1rem 0"></a>
	</span>
		<div class="priority_areas"></div>
		<div class="priority_buttons">
	  	<button class="close_priority" role="button">
				<i>
					<img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Cancel</button>
	  	<button class="priority_save">
				<i>
					<img src="<?php echo base_url('assets/images/icons/save.png'); ?>" style="max-height:0.8rem;margin-right:10px">
				</i>Save</button>
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
		var code = "<div><span class='area-Name'><label>Area Name</label><input type=\"text\" name=\"areaName\" id=\"areaName\"></span><span><label>Is room Y/N</label><select name=\"isRoomYN\" id=\"isRoomYN\"><option value=\"Y\">Y</option><option value=\"N\">N</option></select><input type=\"text\" name=\"\" class=\"none\"><input type=\"text\" name=\"centerid\" class=\"none\" value=\"<?php echo $centerid;?>\"></span><span><input type=\"submit\" value=\"Save\" id=\"addAreaSubmit\"></span><span><input type=\"button\" value=\"Cancel\" class=\"reset\" onclick=\"deleteAreaForm()\"></span></div>"
		if($("#form-space").text().length == 0){
		formParent.insertBefore(insertForm,formParent.firstElementChild);
		insertForm.insertAdjacentHTML('afterbegin',code)
	}
	}
		$(document).on('click','.newRole',function(){
			var parent = $(this).parent();
			var nextElem = parent.next();
			var code = "<div><span><label>Role Name</label><input type=\"text\" name=\"roleName\"></span><span><input type=\"text\" name=\"\" class=\"none\"></span><span><input type=\"submit\" value=\"Save\" class=\"addRoleSubmit\"></span><span><input type=\"button\" value=\"Cancel\" class=\"resets\" ></span></div>";
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
			$(parent).children().children('input.editClassYN').val(isRoomYN)
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
			var parent = $(this).parent();
			var parentData = $(parent).html();
			var nameOfRole = $(parent).children('span.roleNameClass')[0].firstChild.nodeValue;
			var idOfRole = $(parent).children('span.roleIdClass').text();

				$(parent).empty();
			var code = "<span><input type=\"text\" class=\"editClass\"></span><span style=\"display:none\"><input type=\"text\" class=\"editClassId\"></span><span><input type=\"submit\" class=\"editRoleSubmit\"></span><span><input type=\"button\" class=\"editRoleCancel\" value=\"Cancel\"></span>";
			if($(parent).text().length == 0){
			$(parent).append(code)
			$(parent).children().children('input.editClass').val(nameOfRole)
			$(parent).children().children('input.editClassId').val(idOfRole)
				}
			$('li').off('click').on('click','.editRoleCancel',function(){
				var liParent = $(this).parent().parent();
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
			var roleName = $(this).parent().parent().children().children().next().val();
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
							// $('.select_role').empty()
						response['orgchart'].forEach(function(index){
							index['roles'].forEach(function(values){
								if(areaId == values.areaid){
									if(roleId == values.roleid){
										var data = "<option value="+values.roleid+" selected>"+values.roleName+"</option>";
										}
									else{
										var data = "<option value="+values.roleid+">"+values.roleName+"</option>";
									}
									if(similarity != null){
											$('.select_role[similarity='+similarity+']').append(data)
										}
										else{
											$('.select_role').eq(x).append(data)
										}
									}
								})
							})
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
                  <span class="select_css" style="width:30%;">
                    <select class="select_area" similarity="${x}" style="min-width:100% !important;max-width:100%">
                        <option value="0" disabled selected>--Select Area--</option>
                    </select>
                    </span>
                  <span class="select_css" style="width:30%;">
                    <select class="select_role" similarity="${x}" style="min-width:100% !important;max-width:100%">
                       <option value="0" selected>--Select Role--</option> 
                    </select>
                  </span>
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
					window.location.href = window.location.href;
				}
			})

		})
	})
</script>

</body>
</html>
