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
	.li-c span[class="roleNameClass"]{

	}
	.center-name{
		display: inline-flex;
		font-size: 1.5rem;
		padding-left: 2rem;
		font-weight: 700;
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
		margin:0 1rem;
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
		padding: 1.5rem;
	}
	.this-one{
		
		padding: 3rem 2rem 2rem 1rem;
	}
	#areas-roles-list{
		height: 100%;
		overflow-y: auto;
	}
	.container-child{
		padding: 3rem 2rem 2rem 1rem;
			 height: 100% !important;
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
	}   

  .thisOne{
  	    height: 75% !important;
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
</style>
</head>
<body>
<div class="containers">
  <span style="position: absolute">
	  <a href="<?php echo base_url();?>/settings">
	    <button class="btn back-button">
	      <img src="<?php echo base_url('assets/images/back.svg');?>"> <span style="font-size:0.8rem">Organisational Chart</span>
	    </button>
	  </a>
	</span>
	<div class="container-child">
		<div class="container-actual-element">
	<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->viewOrgChartYN : "N" == "Y"){ ?>
	<div class="select-class">
		<span class="center-select-span">Show Chart for:</span>
		<?php $centersList = json_decode($centers); ?>
		<select class="sellect">
			<!-- <option>--Select Center--</option> -->
			<?php foreach($centersList->centers as $centers){ ?>
			<option value="<?php echo $centers->centerid;?>" class="opt"><?php echo $centers->name;?></option>
		<?php } ?>
		</select>
	</div>
	<div class="thisOne">	
		<div class="center-name">
			<span>
				<?php print_r($centersList->centers[$centerid-1]->name);
				echo "<br>";
		 		?>
		 	</span>
		 	<?php if(isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : "N" == "Y"){ ?>
		 <span onclick="newArea()" style="font-size:25px">
			<a href="javascript:void(0)" >
				<button class="btn btn-primary">
                        <i>
                          <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem;margin-right:10px">
                        </i>Add New Area</button>
			</a>
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
<?php if(isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : "N" == "Y"){ ?>
					<span  class="newRole"><a href="javascript:void(0)"><i class="fas fa-plus" ></i></a></span>
					<span class="editArea "><a href="javascript:void(0)"><i class="fas fa-pencil-alt"></i></a></span>
					<span class="delete-Area" style="padding-right:20px"><a class="delete-area" href="javascript:void(0)" d-val="<?php echo $orgChart->areaId ?>"><i class="fas fa-trash-alt" style="color: #ff3b30;"></i></a></span>
				<?php } ?>
				</div>
				<div areaId="<?php echo $orgChart->areaId;?>" class="areaId"></div>
				<div>
					<?php foreach($orgChart->roles as $roles){
					echo "<li class='li-c'><span class=\"roleNameClass\">".$roles->roleName."</span><span class=\"roleIdClass\" style=\"display:none\">".$roles->roleid."</span>";
					if(isset($permissions->permissions) ? $permissions->permissions->editOrgChartYN : 'N' == 'Y'){
					echo "<span class=\"editRole\" style=\"padding-right:20px\"><i class=\"fas fa-pencil-alt\"></i>&nbsp; &nbsp;</span><span class=\"delete-role\" d-val=\"$roles->roleid\" style=\"padding-right:20px\"><i class=\"fas fa-trash-alt\"></i></span></li>";
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
<script type="text/javascript">
	function newArea(){
		var insertForm = document.createElement('form');
		var formParent = document.getElementById('form-space');
		insertForm.id = "new-area-form";
		insertForm.method = "POST";
		insertForm.action = "<?php echo base_url()."/settings/addArea"?>";
		var getForm = document.getElementById('new-area-form');
		var code = "<div><span class='area-Name'><label>Area Name</label><input type=\"text\" name=\"areaName\" id=\"areaName\"></span><span><label>Is room Y/N</label><select name=\"isRoomYN\" id=\"isRoomYN\"><option>select</option><option value=\"Y\">Y</option><option value=\"N\">N</option></select><input type=\"text\" name=\"\" class=\"none\"><input type=\"text\" name=\"centerid\" class=\"none\" value=\"<?php echo $centerid;?>\"></span><span><input type=\"submit\" value=\"Save\" id=\"addAreaSubmit\"></span><span><input type=\"button\" value=\"Cancel\" class=\"reset\" onclick=\"deleteAreaForm()\"></span></div>"
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
			var code = "<span><input type=\"text\" class=\"editClassArea\"></span><span><input type=\"text\" class=\"editClassYN\"></span><span><input type=\"submit\" class=\"editAreaSubmit\"></span><span><input type=\"button\" class=\"editAreaCancel\" value=\"Cancel\"></span>";
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

		$(document).on('click','.editRole',function(){
			var parent = $(this).parent();
			var parentData = $(parent).html();
			var nameOfRole = $(parent).children('span.roleNameClass').text();
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




		$(document).on('click','.resets',function(){
			var parent = $(this).parent().parent().parent();
			$(parent).empty()
		})

		$(document).on('click','#addAreaSubmit',function(e){
			e.preventDefault();
			var url = window.location.origin+"/PN101/settings/addArea";
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
					window.location.reload();
				}
			})
		})

		$(document).on('click','.addRoleSubmit',function(e){
			e.preventDefault();
			var url = window.location.origin+"/PN101/settings/addRole";
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
					window.location.reload();
				}
			})
		})


	$(document).on('click','.editAreaSubmit',function(e){
			e.preventDefault();
			var url = window.location.origin+"/PN101/settings/UpdateArea";
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
					window.location.reload();
				}
			}).fail(function(){
				alert('fail')
			})
		})


		$(document).on('click','.editRoleSubmit',function(e){
			e.preventDefault();
			var url = window.location.origin+"/PN101/settings/UpdateRole";
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
					window.location.reload();
					alert(roleid + " " + roleName )
				}
			})
		})

		function deleteAreaForm(){
			$('#form-space').empty();
	}

	$(document).on('change','.sellect',function(){
		var url = window.location.origin+"/PN101/settings/orgChart";
		var centerid = parseInt($(this).prop('value'));
		$.ajax({
			url : url,
			type : 'POST',
			data : {centerid:centerid} ,
			success:function(response){
				$('.thisOne').html($(response).find('.thisOne').html())
			} 
		}).fail(function(){
			alert('Failed')
		})
	})

	$(document).on('click','.delete-role',function(){
		var url = window.location.origin+"/PN101/settings/deleteRole"
		var id = $(this).attr('d-val');
		$.ajax({
			url : url ,
			type: 'POST',
			data : {
				id : id
			},
			success : function(response){
				window.location.reload();
			}
		})
	})

	$(document).on('click','.delete-area',function(){
		var url = window.location.origin+"/PN101/settings/deleteArea"
		var id = $(this).attr('d-val');
		$.ajax({
			url : url ,
			type: 'POST',
			data : {
				id : id
			},
			success : function(response){
				window.location.reload();
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>
