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
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
		.containers{
		background:	rgb(243, 244, 247);
		height: calc(100vh - 50px);
	}
		thead{
			background:rgba(0,0,0,0.2);
		}
		tr:nth-child(even){
			background:rgb(255,255,255) !important;
		}
		tr:nth-child(odd){

			background:rgb(243, 244, 247) !important;
		}
		th{
			background: white
		}
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.sort-by{

		}
		
		.table-div{
			height:75vh;
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
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
		    background: rgb(75, 144, 226);
		    color: white;
		}
		#create-new-roster{
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
  width: 50%;
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
#down-arrow::after{
		position:relative;
        content: "";
        background: url("<?php echo base_url('/assets/images/calendar.png') ?>");
        background-repeat: no-repeat;
        background-size: 20px;
        padding:10px;
        top: 5px;
        right: 30px;
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
	  background-color: #9E9E9E;
	  border: none;
	  color: white !important;
	  padding: 10px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  margin: 2px
	}
	.close{
		float: none; 
	    font-size: inherit; 
	    font-weight: inherit; 
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
    	font-size: 2rem;
    	font-weight: bold
    }
    select{
	background: #ebebeb;
	border-radius: 5px;
    padding: 5px;
    border: 2px solid #e9e9e9 !important;
		}
.dataTables_wrapper {
	height:95%;
	overflow-y: hidden;
	background: white;
	box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);
}
table.dataTable tbody th, table.dataTable tbody td{
	padding:1rem;
	border-bottom: none;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1rem;
    border-bottom: none;
}
table.dataTable.no-footer{
	border-bottom: none
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
    @media only screen and (max-width :600px){
    	.modal-content {
		  background-color: #fefefe;
		  margin: auto;
		  padding: 20px;
		  border: 1px solid #888;
		  width: 80%;
		}
		table{
			background: white
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
	<div class="d-flex heading-bar">
		<span class="m-3" id="roster-heading" style="">Rosters</span>
		<span class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
			<?php if($this->session->userdata('UserType') == SUPERADMIN){?> 
<!-- 			<div class="filter-icon d-flex">
				<span class="">Sort&nbsp;by</span>
				<span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div> -->
		
				<select class="center-list " id="center-list">
						<?php $centers = json_decode($centers);
						
						for($i=0;$i<count($centers->centers);$i++){
					?>select
					<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
				<?php } ?>
				</select>	
		</span>
		<?php } ?>
		<?php if($this->session->userdata('UserType') == SUPERADMIN || $this->session->userdata('UserType') == ADMIN ){?>
		<span class="btn ml-auto d-flex align-self-center create"><a href="javascript:void(0)" id="create-new-roster" class="d-flex">
			<span style="margin:0 10px 0 10px">
				<img src="../assets/images/plus.png" >
			</span>Create&nbsp;new&nbsp;roster</a></span>
		<?php } ?>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<th>Roster Name</th>
			<?php } ?>
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
				<?php if($this->session->userdata('UserType')==SUPERADMIN || $this->session->userdata('UserType')== ADMIN) {?>
				<tr id="<?php echo $roster->rosters[$i]->id?>">
					<td><?php echo $i+1 ?></td>
					<?php if($this->session->userdata('UserType') == ADMIN ){?>
						<td><?php print_r(json_decode($centers)->centers[0]->name) ?></td>
					<?php } ?>
					<?php if($this->session->userdata('UserType') ==SUPERADMIN ) { ?>
					<td><?php echo 'Roster | '.dateToDay($roster->rosters[$i]->startDate).'-'.dateToDay($roster->rosters[$i]->endDate) ?></td>
				<?php }?>
					<td><?php echo dateToDayAndYear($roster->rosters[$i]->startDate) ?></td>
					<td><?php echo dateToDayAndYear($roster->rosters[$i]->endDate) ?></td>
					<td><?php echo $roster->rosters[$i]->status ?></td>
					</tr>
				<?php }?>
			<?php if($this->session->userdata('UserType') == STAFF ) { ?>
					<tr id="<?php echo $roster->rosters[$i]->id?>">
					<td><?php echo $i+1 ?></td>
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
   <div class="row" style="background: #307bd3;padding: 0;margin: 0;position: absolute;top:0;width:100%;left:0;padding:10px">
   	<span class="col-12 text-center" style="color:white;font-size:25px">Create New Roster </span>
    
</div>
<div style="position: relative;margin-top:40px ">
 	<form id="create-roster-form"  method="POST" action=<?php echo base_url("roster/createRoster") ?>>
 		<span id="down-arrow" class="row" style="display:flex;justify-content: center;margin:20px">
 			<input class="col-4" name="roster-date" id="roster-date" autocomplete="off" placeholder="Start Date"></span>
 		<input type="text" name="userId" id="userId" style="display:none" value="<?php echo $userId?>">
 		
 		<?php if($this->session->userdata('UserType')==ADMIN) {?>
 			<input type="text" name="centerId" id="center-id" value="<?php echo $cents;?>" style="display:none">
 	<?php } ?>
 		<?php if($this->session->userdata('UserType')==SUPERADMIN){ ?>
 			<input type="text" name="centerId" id="center-id" value="<?php echo $centerId;?>" style="display:none"><?php } ?>
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

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
        
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		<?php if($this->session->userdata('UserType')==SUPERADMIN){?>
		$(document).on('change','.center-list',function(){
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>roster/roster_dashboard?center="+val;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('#tbody').html($(response).find('#tbody').html());
				document.getElementById('center-id').value = parseInt(val);
			}
		});
	});
	<?php } ?>

		$(document).on('click','#tbody tr',function(){
			var rosterId = $(this).prop('id')
			var url = "<?php echo base_url();?>roster/getRosterDetails?rosterId="+rosterId;
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

</script>
<script type="text/javascript">
	 $(function() {
	 	
$("#roster-date").datepicker();
	 });
</script>
<script type="text/javascript">
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
</script>
<script type="text/javascript">
	$(document).ready(()=>{
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
  })

	</script>
<?php }

?>

<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
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
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>
</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/roster/roster_dashboard/"+id;
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
</script>-->


