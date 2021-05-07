

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Roster</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stylesheet.css') ?>" /> -->
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
	.template_name{
		text-decoration: none !important;
		color: rgba(0,0,0,1) !important
	}
	input[type="submit"]:disabled{
		cursor:not-allowed 
	}

		.containers{
		background:	rgb(243, 244, 247);
		height: calc(100vh);
	}
		thead{
			background:#8D91AA;
		}
		tr:nth-child(even){
			background:#D2D0D0 !important;
		}
		tr:nth-child(odd){

			background: #F1EEEE !important;
		}
		th{
			background: #8D91AA;
			color: #F3F4F7;
		}
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.sort-by{

		}
		.center-list {
			width: 12rem ;
			max-width: 12rem ;
		}
		.table-div{
			height:80vh;
			padding: 0 20px 0 20px;
		}
/*		.center-list{
			display:none;
			box-shadow:0 0 1px 1px rgb(242, 242, 242) ;
		}
		.center-list a{
			display:block;
			position: relative;
			text-decoration: none;
			color:black;			
		}
		.sort-by:hover .center-list{
			display:block;
			background:white;
			position:absolute;
			margin-top:5px;
			margin-left:-15px;
			padding:10px;
		}*/
		.sort-by:hover::after{
			position:absolute;	
		}
		.heading-bar{
			padding: 0 20px 0 20px;
		}

		.filter-icon{
			border:1px solid rgba(0,0,0,0.7);
			padding:8px;
			border-radius: 20px
		}
		.filter-icon span{
			padding: 0 5px;
		}
		#createTemplate{
			display: flex;
			justify-content: center;
			align-items: center;
			width : 100%;
		}
		.create,.createTemplate{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
			background: rgb(164, 217, 214);
		}
		.create a,.createTemplate a{
		    color: rgb(23, 29, 75) !important;
		    font-weight: 700;
		}
		#create-new-roster,#create-Template{
			color:white;
		}
		.data-buttons{
			padding:10px;
		}
		/* The Modal (background) */
.modal {
  display: none; 
  position: fixed;
  z-index: 1; 
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
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

/* The Close Button */

#ui-datepicker-div{
	background:white;
	color:black;
	background: white;
    padding: 50px;
    border-radius: 30px;
}
.ui-state-default{
	color:black;
	font-size:20px;
}
.ui-datepicker-prev{
	margin:20px;
	padding:10px;
	background:#e0e0e0;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	cursor:pointer;
}
.ui-datepicker-next{
	margin: 20px;
	padding:10px;
	background:#e0e0e0;
	border-top-right-radius: 20px;
	border-bottom-right-radius: 20px;
	cursor:pointer;
}
.ui-datepicker-title{
	text-align: center;
	margin:30px 30px 10px 30px;
}
/*#down-arrow::after{
		position:relative;
        content: "";
        background: url("<?php // echo base_url('/assets/images/calendar.png') ?>");
        background-repeat: no-repeat;
        background-size: 20px;
        padding:10px;
        top: 5px;
        right: 30px;
}*/
#roster-name{
	background: #ebebeb;
	border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
    padding-left: 50px !important;
}
#down-arrow{
	    display: flex;
	    width: 100%;
	    justify-content: center;
	    margin: 20px 20px 20px 0px;
}
#create-template{
	    display: flex;
	    width: 40%;
	    justify-content: center;
	    margin: 20px 20px 20px 0px;
}
#down-arrow input{
	width: 100%;
}
.ui-datepicker-current-day{
	background:skyblue;
	color:white;
}

.ui-datepicker-today{
	background:#307bd3;
}
.ui-datepicker-today a{
	color:white !important;
}
.ui-datepicker-calendar thead tr{
	background: #80B9FF
}
.ui-datepicker-calendar thead th{
	margin:5px;
}
.ui-datepicker-calendar tbody tr:nth-child(even){
	background: white
}
	.button{
	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  width:5rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
	}
	.close{
		float: none; 
	    font-size: inherit;  
	    line-height: inherit; 
	    color: inherit; 
	    text-shadow: inherit; 
	    opacity: inherit; 
	}
	.close:hover{
		background:#9E9E9E;
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
    td[data-handler="selectDay"]{
    	text-align:center;
    }
    td:hover{
    	cursor: pointer
    }
    #roster-heading{
    	font-size: 1.75rem;
    	font-weight: bold;
    	color: rgb(23, 29, 75) !important;
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
		select:hover{
			cursor: pointer;
		}
.dataTables_wrapper {
	height:95%;
	overflow-y: hidden;
	background: white;
	box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);
}
.templateSelect{
	width: 100%;
    justify-content: center;
    display: flex;
    margin: 2rem 0;
}
table.dataTable tbody th, table.dataTable tbody td{
	padding:1rem;
	border: none !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1rem;
    border: none !important;
}
table.dataTable.no-footer{
	border: none !important;
}
table.dataTable{
	margin-top: 0 !important;
	margin-bottom: 0 !important;
}
	.dataTables_paginate span .paginate_button{
		background:none !important;
		border:none !important;
		border-color: transparent;
	}
	.dataTables_paginate{
		position: fixed;
		bottom: 0;
		right: 0
	}
	.loader {
	  border: 16px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 16px solid #307bd3;
	  width: 120px;
	  height: 120px;
	  animation: spin 2s linear infinite;
	}
	.loading{
		position: fixed;
		height: 100vh;
		width: 100vw;
		top: 0;
		display: flex;
		justify-content: center;
		align-items: center;
	}

/* Templates dropdown*/
	.templates_block{
		display: block;
		text-align: center;
		justify-content: center;
		margin-bottom: 1rem;
		background: #e2e4e7;
		border-radius: 20px;
		width: 12rem;
		align-items: center;
		    margin-left: auto;
    margin-right: auto;
    padding: 0.5rem 0;
	}
	.templates_list{
		display: none;
				min-width:10rem;
				text-align: left
	}
	.templates_list a{
		color: black;
	}
	.templates_list a:hover{
		color: black;
	}
	.templates_list>span{
		padding: 0.25rem;
				min-width:10rem;
				position: relative;
	}
	.templates_list span:hover{
		background: rgba(0,0,0,0.4);
		cursor: pointer;
	}
	.templates_block:hover .templates_list{
		display: block;
		position:absolute;
		max-height:10rem;
		overflow-y: auto;
		min-width:10rem;
		max-width:auto;
		background: white;
		border-radius: 0.25rem;
	}
/*	.roster_template_style{
		position: absolute;
		right: 0;
		justify-content: center;
	}*/
	.
/* Templates dropdown*/

/*Templates table*/
.rosterTemplateTable{
	height: 40vh;
	max-height: 40vh;
	width: 100%;
}
.template_row{
	width:100%;
}
.template_td{
	width: 80%;
}
.template_table{
	width: 100%;
  margin-top: 1rem;
}
.template_header_first_child{
	width: 80%;
	padding-left: 2rem !important;
}
.template_td_name{
	width: 80%;
	padding-left: 2rem;
}
.template_table > thead > tr > th{
	padding: 0.5rem 0 0.5rem 0;
}
/*Templates table*/

		/* The Modal (background) */
.templateModal {
  display: none; 
  position: fixed;
  z-index: 1; 
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
.template-modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  position: relative;
}

/* The Close Button */

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}

    @media only screen and (max-width :600px){
    	.modal-content {
		  background-color: #fefefe;
		  margin: auto;
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%;
		}
		table{
			background: white;
			display: block;
		}
		.header-top{
			max-width: 100vw !important;
		}
		.table-div{
			padding: 0;
			position: relative;
			max-width: 100vw !important;
   			overflow-x: scroll !important;
		}
		.title{
			display: flex;
   			 justify-content: center;
		}
		.sort-by{
			margin-right:0px !important;
			padding:0 !important;
		}
		#roster-heading{
			font-size: 1.5rem !important;
			margin: 0 !important;
			display: flex;
			align-items: center
		}
		.table  td,.table th{
			padding: 0.75rem;
			border: none;
		}
		.create{
			width: 150px;
			overflow: hidden;
		}
		.center-list{
			width: 100px
		}
		body{
			max-width: 100vw;
			overflow: hidden;
		}
    }
</style>
</head>
<body>
	<?php
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
		function dateToDayAndYear($date){
			$date = explode("-",$date);
			return date("M d, Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
<div class="containers">

	<?php $permissions = json_decode($permissions); ?>
	<div class="d-flex heading-bar">
		<span class="m-3" id="roster-heading" style="">Rosters</span>
		<span class="btn sort-by m-3 ">
<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?> 
<!-- 			<div class="filter-icon d-flex">
				<span class="">Sort&nbsp;by</span>
				<span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div> -->
		<span class="select_css">
				<select class="center-list " id="center-list">
						<?php $centers = json_decode($centers);
						
						for($i=0;$i<count($centers->centers);$i++){
							if($_SESSION['centerr'] == $centers->centers[$i]->centerid){
					?>
					<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>" selected><?php echo $centers->centers[$i]->name?></option>
				<?php }else{ ?>
					<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
				 <?php }}  ?>
				</select>
		</span>	
						<?php } ?>
		</span>

		<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
		<span class="btn ml-auto ml-auto d-flex align-self-center createTemplate " >
			<a href="javascript:void(0)" id="create-Template" class="d-flex">
				<span style="margin:0 10px 0 10px">
					<img src="../assets/images/plus.png" >
				</span>
				Create&nbsp;Roster&nbsp;Template
			</a>
		</span> 

		<span class="btn  d-flex align-self-center create"><a href="javascript:void(0)" id="create-new-roster" class="d-flex">
			<span style="margin:0 10px 0 10px">
				<img src="../assets/images/plus.png" >
			</span>Create&nbsp;New&nbsp;Roster</a></span>
		<?php } ?>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<th>Roster Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
			</thead>
			
			<tbody id="tbody">

				<?php 
				$centerId;
				if(isset($rosters)){
				$roster = json_decode($rosters);
				for($i=0;$i<count($roster->rosters);$i++){
				?>
				<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "Y"){ ?>
				<tr id="<?php echo $roster->rosters[$i]->id?>" clickable="yes">
					<td><?php echo $i+1 ?></td>
					<td><?php echo 'Roster | '.dateToDay($roster->rosters[$i]->startDate).'-'.dateToDay($roster->rosters[$i]->endDate) ?></td>
					<td><?php echo dateToDayAndYear($roster->rosters[$i]->startDate) ?></td>
					<td><?php echo dateToDayAndYear($roster->rosters[$i]->endDate) ?></td>
					<td><?php echo $roster->rosters[$i]->status ?></td>
				</tr>
				<?php }?>
			<?php if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N"){ ?>
					<tr id="<?php echo $roster->rosters[$i]->id?>" clickable="yes">
					<td><?php echo $i+1 ?></td>
					<td><?php echo 'Roster | '.dateToDay($roster->rosters[$i]->startDate).'-'.dateToDay($roster->rosters[$i]->endDate) ?></td>
					<td><?php echo $roster->rosters[$i]->startDate ?></td>
					<td><?php echo $roster->rosters[$i]->endDate ?></td>
					<td><?php echo $roster->rosters[$i]->status ?></td>
					</tr>
				<?php } ?>
<?php } } ?>
			</tbody>
		
		</table>
		
	</div>
	<div>
	
</div>
</div>
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
   <div class="row" style="background: #8D91AA;padding: 0;margin: 0;position: absolute;top:0;width:100%;left:0;padding:1rem">
   	<span class="col-12 text-center" style="color:#F3F4F7;font-size:1rem">Create New Roster </span>
    
</div>
<div style="position: relative;margin-top:40px ">
 	<form id="create-roster-form"  method="POST" action=<?php echo base_url("roster/createRoster") ?>>
 		<span id="down-arrow" class="row" style="display:flex;justify-content: center;margin:20px">
 			<input type = "date" placeholder = "dd-mm-yyyy" class="col-8" name="roster-date" id="roster-date">
 		</span>
					<?php 
						$rosterTemplates = json_decode($rosterTemplates);
					?>
 		<?php if(count($rosterTemplates->templates) > 0){ ?>
 		<span class="templateSelect">
			<span class="select_css">
					<select class="template-list " id="template-list" name="template-list">
						<option value="not_selected">Select Template</option>
						<?php
							for($i=0;$i<count($rosterTemplates->templates);$i++){
						?>
						<option href="javascript:void(0)" class="center-class" id="<?php echo $rosterTemplates->templates[$i]->id ?>" value="<?php echo $rosterTemplates->templates[$i]->id; ?>"><?php echo $rosterTemplates->templates[$i]->name?></option>
					<?php } ?>
					</select>
			</span>
		</span>
	<?php } ?>
 		<input type="text" name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
 			<input type="text" name="centerId" id="center-id" value="<?php echo $center__;?>" style="display:none">
 		<div class="text-center">
 		<input type="submit" name="roster-submit" id="roster-submit" class="button" value="Create">
 		<input type="reset" name="" id="" class="button" value="Reset">
 		<input type="button" name="cancel" value="Cancel" class="close button">
 	</div>
 	</form>
 </div>
 	<p id="alert-data"></p>
  </div>
</div>

<div id="mxModal" class="templateModal">
  <!-- Modal content -->
  <div class="template-modal-content">
   <div class="row" style="background: #8D91AA;padding: 0;margin: 0;position: absolute;top:0;width:100%;left:0;padding:1rem">
   	<span class="col-12 text-center" style="color:#F3F4F7;font-size:1rem">Create Roster Template </span>
    
</div>
<div style="position: relative;margin-top:40px ">
 	<form id="createTemplate"  method="POST" action=<?php echo base_url("roster/createRosterTemplate") ?>>
 		<span id="create-template" class="row" style="display:flex;justify-content: center;margin:20px">
 			<input type = "text" placeholder = "Roster Name" class="" name="roster-name" id="roster-name">
 		</span>

 		<input type="text" name="userId" id="templateUserId" style="display:none" value="<?php echo $userId?>">
 			<input type="text" name="centerId" id="template-center-id" value="<?php echo $center__;?>" style="display:none">
 		<div class="text-center">
	 		<input type="submit" name="roster-submit" id="roster-template-submit" class="button" value="Create">
	 		<input type="reset"  class="button" value="Reset">
	 		<input type="button" name="cancel" value="Cancel" class="close button">
 		</div>
 	</form>
 	<div class="rosterTemplateTable">
 		<table class="template_table">
 			<thead>
 				<tr class="template_header_row">
 					<th class="template_header_first_child">Template Name</th>
 					<!-- <th class="template_header_second_child">Edit</th> -->
 					<th class="template_header_third_child">Delete</th>
 				</tr>
 			</thead>
 			<tbody class="template_tbody">
 				<?php foreach($rosterTemplates->templates as $templates){ ?>
 					<tr class="template_row">
		 				<td class="template_td_name"><a href="<?php echo base_url('roster/getRosterTemplateDetails/').$templates->id.'/'.$this->session->userdata("LoginId") ?>" class="template_name"><?php echo $templates->name ?></a></td>
		 				<!-- <td class="template_td_edit">Edit</td> -->
						<td class="template_td_delete roster_template_style" id='<?php echo $templates->id ?>'>
							<i>
								<img src="<?php echo base_url("assets/images/icons/delete.png") ?>" style="max-height:0.8rem;margin-right:10px"  >
							</i>
						</td>
					</tr>
 				<?php 	}  ?>
 			</tbody>
 		</table>
 	</div>
 </div>
 	<p id="alert-data"></p>
  </div>
</div>

<div class="notify_">
	<div class="note">
		  <div class="notify_body">
    <span class="_notify_message">
      
    </span>
    <span class="_notify_close" onclick="closeNotification()">
      &times;
    </span>
  </div>
	</div>
</div>

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>


<div class="loading">
	<div class="loader"></div>
</div>

<script type="text/javascript">
	/*		---------------
						This code contains the session storage
				---------------   */
	// localStorage.setItem('currentCenter',2)
	// currentCenter();
	// 			document.getElementsByClassName('center-list')[0].value=2;
	// function currentCenter() {
	// 	// if(typeof(Storage) != undefined){
	// 	// 	let val = localStorage.getItem('currentCenter');
	// 	var url = "<?php // echo base_url();?>roster/roster_dashboard?center="+parseInt(val);
	// 	$.ajax({
	// 		url:url,
	// 		type:'GET',
	// 		success:function(response){
	// 			remove_loader_icon();
	// 			$('#tbody').html($(response).find('#tbody').html());
	// 			document.getElementById('center-id').value = parseInt(val);
	// 		}
	// 	});
	// }
// }

// Notification //
    function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
      $('._notify_message').append(`<li>${message}</li>`)
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }

<?php  if(($this->session->flashdata('errorMessage') != null) && ($this->session->flashdata('errorMessage') != "") ){ ?>
      showNotification();
      addMessageToNotification('<?php echo $this->session->flashdata('errorMessage') ?>');
      setTimeout(closeNotification,5000)
    <?php  } ?>
  // Notification //

	$(document).ready(function(){
		<?php if($this->session->userdata('UserType')==SUPERADMIN){?>
		$(document).on('change','.center-list',function(){
			
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>roster/roster_dashboard?center="+val;

				loader_icon();
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				remove_loader_icon();
				$('#tbody').html($(response).find('#tbody').html());
				document.getElementById('center-id').value = parseInt(val);
				document.getElementById('template-center-id').value = parseInt(val);
						var url_template = "<?php echo base_url();?>roster/getTemplates/"+val;
				$.ajax({
					url : url_template,
					type : 'GET',
					success : function(response){
						$('#template-list').empty();
						$('.template_tbody').empty();
						var resp = JSON.parse(response);
						var co = `<option value="not_selected">Select Template</option>`;
						$('#template-list').append(co)
						resp.templates.forEach(function(item){
						var code = `<option href="javascript:void(0)" class="center-class" id="${item.id}" value="${item.id}">${item.name}</option>`;
						var tableCode = `<tr class="template_row"><td class="template_td_name"><a href="<?php echo base_url("roster/getRosterTemplateDetails/"); ?>${item.id}<?php echo '/'.$this->session->userdata("LoginId") ?>">${item.name}</a></td><td class="template_td_edit">Edit</td><td class="template_td_delete roster_template_style" id='${item.id}'><i><img src="<?php echo base_url("assets/images/icons/x.png") ?>" style="max-height:0.8rem;margin-right:10px"> </i></td></tr>`;
						$('.template_tbody').eq(0).append(tableCode);
						$('#template-list').append(code);
						})
					}
				})
			}
		});
	});
	<?php } ?>

		$(document).on('click','#tbody tr[clickable="yes"]',function(){
			var rosterId = $(this).prop('id')
			var url = "<?php echo base_url();?>roster/getRosterDetails?rosterId="+rosterId+'&showBudgetYN=N';
			window.location.href=url;
		})
})
</script>
<script type="text/javascript">
	<?php if($this->session->userdata('UserType')==SUPERADMIN){?>
	$(document).ready(function(){
			equalElements('sort-by','center-list');
		})
		function equalElements(original,toBeModified){
			var originalHeight = document.getElementsByClassName(original)[0].offsetHeight;
			var originalWidth = document.getElementsByClassName(original)[0].offsetWidth;
			var toBeModifiedWidth =document.getElementById(toBeModified);
			toBeModifiedWidth.style.width = originalWidth+"px";
		}
	<?php } ?>
</script>
<script type="text/javascript">
	var modal = document.getElementById("myModal");

	$(document).on('click','#create-new-roster',function(){
		 modal.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 modal.style.display = "none";
	})

	var mod = document.getElementById("mxModal");

	$(document).on('click','#create-Template',function(){
		 mod.style.display = "block";
	})

	$(document).on('click','.close',function(){
		 mod.style.display = "none";
	})



	 $(function() {

	 	// datepicker
$("#roster-date").datepicker();
	 });



	$(document).ready(function(){
		$(document).on('click','#roster-submit',function(e){
			var a = $('#roster-date').val();
			var b = a.split("/");
			var date = new Date(b).getDay();
			if(date != 1){
				var alert = "Please select a monday";
				document.getElementById('alert-data').style.color = "red";
				document.getElementById('alert-data').innerHTML = alert;
				e.preventDefault();
			}

		})
	})


// validate
$('#roster-template-submit').prop('disabled','disabled');
	$(document).on('keyup','#roster-name',function(){
		if($('#roster-name').val() == null || $('#roster-name').val() == ""){
			$('#roster-template-submit').prop('disabled','disabled');
		}
		if($('#roster-name').val() != null && $('#roster-name').val() != ""){
			$('#roster-template-submit').prop('disabled',false);
		}
	})
	$(document).ready(()=>{
		remove_loader_icon();
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<?php if( isset($error) != null){ ?>
	<script type="text/javascript">
		
   var modal = document.querySelector(".modal-logout");
       function toggleModal() {
   	     modal.classList.toggle("show-modal");
    	}
	$(document).ready(function(){
  		toggleModal();	
  		});
	</script>
<?php }	?>

<script type="text/javascript">
	  $(document).ready( function () {
		    $('.table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').remove()
			$('.table-div').css('maxWidth','100vw')
		})
</script>
<script type="text/javascript">
	function remove_loader_icon(){
		$('.loading').hide();
	};
	function loader_icon(){
		$('.loading').show();
	};
	//----------------

$(document).ready(function(){
	$(document).on('click','.roster_template_style',function(){
			var url = window.location.origin+"/HRMS101/roster/updateRosterTemplate";
			var rosterTemplateId = $(this).attr('id');
			var userid = "<?php echo $this->session->userdata('LoginId'); ?>";
				$.ajax({
					url:url,
					type:'POST',
					data:{
						userid: userid,
						rosterid: rosterTemplateId,
						status: 'Discarded'
					},
					success:function(response){
						window.location.href= window.location.origin+"/HRMS101/roster/roster_dashboard";
					}

				})
	})
})
</script>
<script type="text/javascript">
	$('#ui-datepicker-div').remove()
</script>
</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/HRMS101/roster/roster_dashboard/"+id;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('body').html(response);
				
			}
		}).fail(function(){
			alert('whyys')
		})
	})
		})


					$('#create-template').attr('href','<?php echo base_url('createRosterTemplate/') ?>'+$('.center-list').val());
</script>-->

