<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Awards Settings</title>
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
		font-family: 'Open Sans', sans-serif;
	}
	.containers{
		padding-left: 200px;
		height: 100vh;
    overflow-y: hidden;
	}
	.table thead th {
    vertical-align: top !important;
    border-bottom: 2px solid #dee2e6;
		}
		thead tr{
			background-color: #8D91AA !important;
	    color: #F3F4F7;
		}
		tr:nth-child(even){
			background: #FFF;
		}
		tr:nth-child(odd){

			background: #FFF;
		}
		tbody tr{
			font-size: 0.85rem;
		}
		body{
			background: #f2f2f2;
			height: 100%;
			overflow-y: auto;
		}
		.table-div{
			max-height:80%;
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
		.containers{
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
  width: 80%;
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
    .awards-container{
    	padding: 4rem 3rem 2rem 2rem;
    	height: 100%;
	    overflow: hidden;
	    padding: 1rem 0 1rem 2rem;
	    margin: 0 !important;
	    color: rgba(11, 36, 107);width: 100%
    }
		.awards-container-child{
    	/*padding: 4rem 3rem 2rem 2rem;*/
    	height: 100%;
	    overflow: hidden;
	    font-weight: 700;
	    /*padding: 1rem 0 1rem 2rem;*/
	    margin: 0 !important;
	    color: rgba(11, 36, 107);
	    width: 100%;
	    font-size: 1.75rem;
		}
		thead{
			height: 100%;
						overflow-y: auto;
		}
		.awards_header_container{
			padding: 1rem 1rem 0rem 2rem;
			display: flex;
		}
		tr{
	    border-top: 1px solid #d2d0d0;
	    border-bottom: 1px solid #d2d0d0;
		}
input[type="text"],input[type=time],select,#casualEmp_date{
  background: #ebebeb;
  border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
}
		#awards{
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
		/*
						scroll bar 
		*/
					/* width */
			::-webkit-scrollbar {
			  width: 10px;
			}

			/* Track */
			::-webkit-scrollbar-track {
			  background: #f1f1f1; 
			}
			 
			/* Handle */
			::-webkit-scrollbar-thumb {
			  background: #888; 
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
			  background: #555; 
			}
		/*
						scroll bar end
		*/
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
	 	$centers = json_decode($centers);
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
<div class="containers">
	<span class="awards_header_container">
		      <a href="<?php echo base_url();?>/settings">
		        <button class="btn back-button">
			          <img src="<?php echo base_url('assets/images/back.svg');?>">
		        </button>
		      </a>
          <span  class="awards-container-child">Awards</span>
          <span class="select_css">
            <select placehdr="Center" id="centerValue" name="centerValue" >
              <?php 
              foreach($centers->centers as $center){ ?> 
                <option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
              <?php } ?>
            </select>
          </span>
          <span>
          	<button id="awards">
	            <i>
	              <img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:02rem;margin-right:10px">
	            </i>Sync&nbsp;Xero&nbsp;Awards
	       	  </button>
          </span>
    </span>
	<div class="awards-container">
		<div >
	<?php
		$permissions = json_decode($permissions);
	 ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewAwardsYN : "N") == "Y"){ ?>

<?php if((isset($permissions->permissions) ? $permissions->permissions->editAwardsYN : "N") == "Y"){ ?>

<?php } ?>

	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<th>Name</th>
				<th>Exempt Tax</th>
				<th>Exempt Super</th>
				<th>Reportable</th>
				<th>Earning Type</th>
				<th>Rate Type</th>
				<th>Multiplier Amount</th>
				<th>Current Record</th>
			</thead>
			
			<tbody id="tbody">
<?php
	$awards = json_decode($awards);
	
	$x=1;
	foreach($awards->awards as $award){
?>
		<tr>
				<td class="s-no"><?php echo $x; ?></td>
				<td><?php echo $award->name; ?></td>
				<td><?php echo $award->isExemptFromTaxYN; ?></td>
				<td><?php echo $award->isExemptFromSuperYN; ?></td>
				<td><?php echo $award->isReportableAsW1; ?></td>
				<td><?php echo $award->earningType; ?></td>
				<td><?php echo $award->rateType; ?></td>
				<td><?php echo $award->multiplier_amount; ?></td>
				<td><?php echo $award->currentRecordYN; ?></td>
			<?php 
			$x++;
			?>
			</tr>
			<?php		} ?>
			</tbody>
		
		</table>
		
	</div>
	<div>
	
</div>
<?php } ?>
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
	$(document).ready(function(){
		$('#awards').click(function(){
			var centerid = $('#centerValue').val();
			var url = window.location.origin + "/PN101/settings/syncXeroAwards/"+centerid ;
			$.ajax({
					url:url,
					type:'GET',
					success:function(){
						window.location.reload();
					}
				})
			})
	  $(document).on('change','#centerValue',function(){
	      var centerid = $('#centerValue').val();
	      var url = window.location.origin+'/PN101/settings/awardSettings/'+centerid;
	      $.ajax({
	        url : url,
	        type : 'GET',
	        success : function(response){
	          
	          $('tbody').html($(response).find('tbody').html())
	          console.log($(response).find('tbody').html())
	        }
	      })
	    })
	})
</script>
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

</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/timesheet/timesheet_dashboard/"+id;
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