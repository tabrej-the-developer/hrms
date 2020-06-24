<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Superfund Settings</title>
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
		font-family: 'Open Sans', sans-serif;
	}
	body{
		background: #f2f2f2;
	}
		.containers{
		padding-left: 200px;
				height: 100vh;
    overflow-y: hidden;
	}
		thead tr{
			background:rgba(255,255,255,1) !important;
		}
		tbody{
			overflow-y: auto
		}
		tr:nth-child(even){
			background:rgb(255,255,255);
		}
		tr:nth-child(odd){

			background:rgb(243, 244, 247);
		}
		tr{
			line-height: 1rem
		}
		td{
			font-size: 0.8rem;
			line-height: 1rem;

		}

		.table-div{
			height:80%;
			overflow-y: auto;
			padding: 0 20px;
		}	
		.table  td,.table th{
			padding: 1rem;
			border: none;
		}
		.sort-by{

		}
		table{
			box-shadow: 0 0 20px 2px #eeeff2;
		}
		.center-list{
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
		}
		.sort-by:hover::after{
			position:absolute;
						
		}

		.filter-icon{
			border:1px solid rgba(0,0,0,0.7);
			padding:8px;
			border-radius: 20px
		}
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
		}
		.data-buttons{
			padding:10px;
		}
		button{
			line-height: 1rem;
			display: flex;
			background: #142059;
    	color: white;
    	border-radius: 5px;
    	border:none;
    	padding: 0.5rem;
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
  max-width: 100%;
}

/* The Close Button */
.close {
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
}

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
}
.ui-datepicker-next{
	margin: 20px;
	padding:10px;
	background:#e0e0e0;
border-top-right-radius: 20px;
border-bottom-right-radius: 20px;
}
.ui-datepicker-title{
	text-align: center;
	margin:30px 30px 10px 30px;
}
#down-arrow::after{
		position:relative;
        content: " \2193";
        top: 0px;
        right: 20px;
        height: 10px;
        width: 20px;
}
.ui-datepicker-current-day{
	background:green;
}
.ui-datepicker-today{
	background:skyblue;
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
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
}
.dataTables_info{
	font-size:0.8rem;
}
.dataTables_paginate{
	font-size:0.8rem;
}
.paginate_button{
	background:transparent;
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
        z-index:150;
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
    .superfunds-container{
    	padding: 4rem 3rem 2rem 2rem;
    	height: 100%;
    overflow: hidden;
    }
    .superfunds-container-child{
    	background: white;
    	height: 100%;
    }
@media only screen and (max-width:1024px) {
.modal-content{
	min-width:100vw;
}
.containers {
     width: 100%;
    margin: 0px;
    padding:0;
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
	?>
<div class="containers">
		<span style="position: absolute;top:20px;padding-left: 2rem">
      <a href="<?php echo base_url();?>/settings">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:0.8rem">Superfunds</span>
        </button>
      </a>
    </span>
	<div class="superfunds-container">
		<div class="superfunds-container-child">
	<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->viewPermissionYN : "N" == "Y"){ ?>
	<div class="d-flex">
			<h4 style="font-weight: 700;
                      padding: 1rem 0 0 2rem;
                      margin: 0 !important;
                      color: rgba(11, 36, 107);width: 100%"
                class="text-left">Superfunds</h4>
<?php if(isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N" == "Y"){ ?>
		<span class="d-flex align-items-center pr-4"><button id="superfunds">Sync&nbsp;Xero&nbsp;Superfunds</button></span>
<?php } ?>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<th>ABN</th>
				<th>USI</th>
				<th>Type</th>
				<th>Name</th>
				<th>BSB</th>
				<th>Account Number</th>
				<th>Account Name</th>
				<th>eService Address</th>
				<th>Employee No</th>
			</thead>
			
			<tbody id="tbody">

				<?php 
				$superfunds = json_decode($superfunds);
				$x=1;
				foreach($superfunds->superfunds as $superfund){
					
				?>
				<tr >
					<td><?php echo $x; ?></td>
					<td><?php echo $superfund->abn;?> </td>
					<td><?php echo $superfund->usi;?> </td>
					<td><?php echo $superfund->type;?> </td>
					<td><?php echo $superfund->name;?> </td>
					<td><?php echo $superfund->bsb;?>  </td>
					<td><?php echo $superfund->accountNumber;?> </td>
					<td><?php echo $superfund->accountName;?> </td>
					<td><?php echo $superfund->eServiceAddress;?> </td>
					<td><?php echo $superfund->employeeNo;?> </td>
				</tr>
				<?php  
				$x++;
			} ?>
			</tbody>
		
		</table>
		
	</div>
	<div>
	
</div>

 <?php }
 // else{
// 	redirect('noPermissionPage');
// }

 ?>
	 </div>
	</div>
</div>


<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(()=>{
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
});
</script>

<?php if( isset($error) ){ ?>
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
	$(document).ready(function(){
	$('#superfunds').click(function(){
		var url = window.location.origin + "/PN101/settings/syncXeroSuperfunds" ;
		$.ajax({
				url:url,
				type:'GET',
				success:function(){
					window.location.reload();
				}
			})
		})
	})
</script>
</body>
</html>
