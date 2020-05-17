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
	.area-id::before{
		content: url(../assets/images/arrow-f.svg);
		position: absolute;
		margin:0 0 -80px -30px;
	}
	.li-c{
				list-style:none;
	}
	.li-c span[class="roleNameClass"]{

		background:#307bd3;
		max-width:200px;
		padding:10px;
		border-radius:5px;
		color:white;
	}
	.center-name{
		display: inline-flex;
		font-size:30px;
	}
	.none{
		display:none;
	}
	#areas-roles{
		display: inline-flex;
		width:100%;
	}
	.area-name{
		font-weight:bolder;
		margin:10px;
	}
	.newRole{
		margin-left:auto;
	}
	.editArea{
		margin:0 20px;
	}
/*	.newRole:after{
		content:' | ';
	}
	.editArea:after{
		content:" |";
	}*/
	.editRole{
		cursor: pointer;
	}
	#addAreaSubmit{
		margin-left:auto;
	}
	#new-area-form{
		width:100%;
	}
	.delete-role{
		cursor:pointer;
	}
	input[type="submit"],input[type="button"]{
      background-color: #9E9E9E;
	  border: none;
	  color: white;
	  padding: 10px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  margin: 2px;
	}
	input[type="text"]{
		border-radius:3px;
		border-style:solid;
		border:none ;
		border-width:1px; 
		border:1px solid #cccccc;
		padding:10px;
	}
	.sellect{
		border-radius:5px;
	}
	.select-class{
		display: flex;
		justify-content: flex-end
	}
</style>
</head>
<body>
<div class="container">

	<div class="select-class">
		<?php $centersList = json_decode($centers); ?>
		<select class="sellect">
			<option>--Select Center--</option>
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
		 <span onclick="newArea()" style="font-size:25px">
			<a href="javascript:void(0)" style="padding:0 0 0 20px"><i class="fas fa-plus" ></i></a>
		 </span>
		</div>
		<div id="areas-roles-list">
			<div id="form-space"></div>
		<?php $orgChart = json_decode($orgChart);
	if(isset($orgChart->orgchart)){
		foreach($orgChart->orgchart as $orgChart){ ?>
			<div id="<?php echo $orgChart->areaId .'-'.$orgChart->areaName?>" class="area-id">
				<div id="areas-roles" areaId="<?php echo $orgChart->areaId; ?>" YN="<?php echo $orgChart->isRoomYN; ?>">
					<span class="area-name"><?php echo $orgChart->areaName."<br>"; ?></span>
					<span  class="newRole"><a href="javascript:void(0)"><i class="fas fa-plus" ></i></a></span>
					<span class="editArea "><a href="javascript:void(0)"><i class="fas fa-pencil-alt"></i></a></span>
					<span><a class="delete-area" href="javascript:void(0)" d-val="<?php echo $orgChart->areaId ?>"><i class="fas fa-trash-alt" style="color: #ff3b30;"></i></a></span>
				</div>
				<div areaId="<?php echo $orgChart->areaId;?>"></div>
				<div>
					<?php foreach($orgChart->roles as $roles){
					echo "<li class='li-c'><span class=\"roleNameClass\">".$roles->roleName."</span> <span class=\"editRole\" ><i class=\"fas fa-pencil-alt\"></i>&nbsp; &nbsp;</span><span class=\"delete-role\" d-val=\"$roles->roleid\"><i class=\"fas fa-trash-alt\"></i></span></li>"."<br>";
					}
					?>
				</div>
			</div>
		<?php 
	
		}}
		?>
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
		var code = "<div><span><label>Area Name</label><input type=\"text\" name=\"areaName\" id=\"areaName\"></span><span><label>Is room Y/N</label><select name=\"isRoomYN\" id=\"isRoomYN\"><option>select</option><option value=\"Y\">Y</option><option value=\"N\">N</option></select><input type=\"text\" name=\"\" class=\"none\"><input type=\"text\" name=\"centerid\" class=\"none\" value=\"<?php echo $centerid;?>\"></span><span><input type=\"submit\" value=\"Save\" id=\"addAreaSubmit\"></span><span><input type=\"button\" value=\"Cancel\" class=\"reset\" onclick=\"deleteAreaForm()\"></span></div>"
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
			var url = "http://localhost/PN101/settings/addArea";
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
					window.location.reload;
				}
			})
		})

		$(document).on('click','.addRoleSubmit',function(e){
			e.preventDefault();
			var url = "http://localhost/PN101/settings/addRole";
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
					alert('wow')
				}
			})
		})


	$(document).on('click','.editAreaSubmit',function(e){
			e.preventDefault();
			var url = "http://localhost/PN101/settings/UpdateArea";
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
					alert(areaid + " " +areaName )
				}
			}).fail(function(){
				alert('fail')
			})
		})


		$(document).on('click','.editRoleSubmit',function(e){
			e.preventDefault();
			var url = "http://localhost/PN101/settings/UpdateRole";
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
					alert(roleid + " " + roleName )
				}
			})
		})

		function deleteAreaForm(){
			$('#form-space').empty();
	}

	$(document).on('change','.sellect',function(){
		var url = "http://localhost/PN101/settings/orgChart";
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
		var url = "http://localhost/PN101/settings/deleteRole"
		var id = $(this).attr('d-val');
		$.ajax({
			url : url ,
			type: 'POST',
			data : {
				id : id
			},
			success : function(response){
				location.reload();
			}
		})
	})

	$(document).on('click','.delete-area',function(){
		var url = "http://localhost/PN101/settings/deleteArea"
		var id = $(this).attr('d-val');
		$.ajax({
			url : url ,
			type: 'POST',
			data : {
				id : id
			},
			success : function(response){
				location.reload();
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.container').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>