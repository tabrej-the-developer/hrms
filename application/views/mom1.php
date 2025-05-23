<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--   <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
 -->  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}

        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: #ffffff;
            border-bottom: 0px;
        }
        
        .card-body {
            padding: 0rem 1.25rem;
        }
        
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .card {
            border-radius: 0px;
            padding-top: 15px;
            padding-bottom: 15px;
			border:none;
			box-shadow: none;
        }
        
        .flex-wrap {
            margin-bottom: -35px;
        }
        
        div.dataTables_wrapper div.dataTables_paginate {
            margin-top: -25px;
        }
        
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #5D78FF;
            border-color: #5D78FF;
			
        }
		.btn.focus, .btn:focus {
			outline: 0;
			box-shadow: none;
		}
		.btn-group-sm>.btn, .btn-sm {
			padding: .25rem .5rem;
			font-size: .875rem;
			line-height: 1.5;
			border-radius: 1.2rem;
			border: 1px solid #ccc;
		}
		#example_filter input {
		  border-radius: 1.2rem;
		}
		.border-shadow{
			    box-shadow: 0 3px 10px rgba(0,0,0,.1);

		}
		.modal-header {
			border-bottom:none;
			border-top-left-radius:0;
			border-top-right-radius:0;
			background-color: #307bd3;
			color: #fff;
		}
		.modal-content {
			border-radius:0;	
		}
		
		
		/* tabs */
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 10px 15px;
    color:#212528;
    background:none;
    border-radius:0;
    font-size:15px;
    font-weight:500;
}
nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -46px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #ddd ;
}
.tab-content{
    line-height: 25px;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: none;
    color:#212528;
    border-radius:0;
    transition:background 0.20s linear;
}
		/* tabs end */
		
		
/* Toggle */
.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
.switchToggle label {cursor: pointer; text-indent: -9999px; width: 70px; max-width: 70px; height: 30px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
.switchToggle label:after {content: ''; position: absolute; top: 2px; left: 2px; width: 26px; height: 26px; background: #fff; border-radius: 90px; transition: 0.3s; }
.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #4caf50a6; }
.switchToggle input + label:before, .switchToggle input + input + label:before {content: 'No'; position: absolute; top: 1px; left: 35px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Yes'; position: absolute; top: 1px; left: 10px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
.switchToggle label:active:after {width: 60px; } 
.toggle-switchArea { margin: 10px 0 10px 0; }
/* Toggle end */
		/*leaves balance bar*/

		.checkbox{background-color:#fff;display:inline-block;height:18px;margin:0.6em 0 0 0;width:18px;border-radius:0;border:1px solid #ccc;float:right}
  .checkbox span{display:block;height:20px;position:relative;width:20px;padding:0}
  .checkbox span:after{-moz-transform:scaleX(-1) rotate(135deg);-ms-transform:scaleX(-1) rotate(135deg);-webkit-transform:scaleX(-1) rotate(135deg);transform:scaleX(-1) rotate(135deg);-moz-transform-origin:left top;-ms-transform-origin:left top;-webkit-transform-origin:left top;transform-origin:left top;border-right:3px solid #fff;border-top:3px solid #fff;content:'';display:block;height:13px;left:0;position:absolute;top:8px;width:8px}
  
  .checkbox input{display:none}
.checkbox input:checked + .default:after{border-color:#242121ad}
.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}

input::placeholder {
  font-size: 0.9rem;
  color: #999;
}
.chat_img {
  float: left;
  width: 11%;
}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}

.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}
img{ max-width:140%;}

.row.vdivide [class*='col-']:not(:last-child):after {
  background: #e0e0e0;
  width: 1px;
  content: "";
  display:block;
  position: absolute;
  top:0;
  bottom: 0;
  right: 0;
  min-height: 70px;
}
/*leaves balance bar end*/
.dropdown-toggle::after {
            content: none;
            display: none;
        }
		
/*corousol*/	
.carousel-control-next, .carousel-control-prev {
   
    width: 2%;
   
}
.carousel-control-next-icon, .carousel-control-prev-icon {
    height: 40px;
    background-color: #ccc;
}

svg:not(:root).svg-inline--fa {
    overflow: visible;
}
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .feedback{
	position:absolute;
	z-index: 2;
    display: block;
    width: 1.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
    margin: 0 0 0 10px;
}
	
/*corousol end*/		
		
</style>
</head>
<body>
<div class="container">

              <div class="row">
                <div class="col-sm-12 ">
				<div class="row">
                    <div class="col-md-10"><h4>Minutes of Meeting</h4></div>
					<div class="col-md-2">
					<button type="button" name="add_button" id="add_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"   onclick="addLeaveType()"> <i class="fas fa-plus-circle"></i> Add  Meeting</button>
				
					</div>
                </div>
				<table class="table table-striped table-borderless table-hover border-shadow mt-2" id="example1" style="width:100%;">
	                        <thead>
	                            <tr class="text-muted">
	                            <th>Title</th>
	                            <th>Date</th>
	                            <th>Location</th>
	                            <th>Time</th>
	                           
	                            </tr>
	                        </thead>
	                        <tbody>
							<!-- <tr>
							<td>Child Care</td>
							<td>45</td>
							<td>Nashville</td>
							<td>12</td>
							<td><a href="<?php // echo base_url() ?>mom/startMeeting" class="btn btn-success">Start</a></td>
							</tr> -->
							<?php
							
							 $meetings = json_decode($data);
							//  echo "<pre>";
							//  print_r($meetings->data);
							// exit;
							// $len  = count($meetings);
							// echo $len;
							// exit;
							foreach($meetings->data as $m): ?>
                              
						      <tr>
							  <td><?php echo $m->title ?></td>
							  <td><?php echo $m->date?></td>
							  <td><?php echo $m->location?></td>
							  <td><?php echo $m->time?></td>
							  <td> <a href="<?php echo base_url(); ?>mom/meetingInfo/<?php echo $m->mid ?>" class="btn btn-primary">View Info</a> </td>
							  <td><a href="<?php echo  base_url(); ?>mom/startmeeting/<?php echo $m->mid ?>" class="btn btn-success">Start</a></td>
							  </tr>	
						<?php	
					    	
							endforeach;
							
							?>
							</tbody>
							</table>
							</div>
						</div>	

						<div class="modal fade" id="userModal">
                <div class="modal-dialog">
                    
					<form id="leaveTypeForm" action="<?php echo base_url() ?>mom/addMeeting" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Minutes of Meeting</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                <div class="modal-body">
					<div class="col-md-12 col-xl-12">	
					<form  method="POST" action="<?php echo base_url() ?>mom/addMeeting">
						

						<div class="form-group">
						  <label>New Meeting</label>
						  <input type="text" class="form-control" id="meetingTitle" placeholder="Enter Meeting Title" name="meetingTitle" >
						  <span id="meeting_error" class="text-danger"></span>
						</div>

						<span style="color: red" id="leaveNameError"></span>
						 
						<div class="form-group">
							<label>Location</label>
							<input type="text" class="form-control" name="meetingLocation" id="location" placeholder="Location"  >
						  <span id="location_error" class="text-danger"></span>
						</div>

						<div class="form-group">
							<label>Date</label>
							<input type="text" class="form-control" name="meetingDate" id="date" placeholder="Date"  >
						  <span id="date_error" class="text-danger"></span>
						</div>

						<div class="form-group">
							<label>Time</label>
							<input type="text" class="form-control" name="meetingTime" id="time" placeholder="Time"  >
						  <span id="time_error" class="text-danger"></span>
						</div>
 
						<div class="row" id="agenda">
						<div class="col-md-8" id="agendaMore">
						<div class="form-group">
							<label>Agenda</label>
							<input type="text" class="form-control" name="meetingAgenda[]" id="agenda1" placeholder="Agenda"  >
						  <span id="agenda_error" class="text-danger"></span>
						</div>
						</div>
						<div class="col-md-4">
						<div class="btn btn-primary" onclick="addAgenda()">Add Agenda</div>
						</div>
						</div>


						<div class="form-group">
							<label>Meeting Collab Type</label>
							<select type="time" name="meetingcollab" id="colab" class="form-control">
							<option value="">Select Type</option>
							<option value="y">Yearly</option>
							<option value="m">Monthly</option>
							<option value="w">Weekly</option>
							</select>
						  <span id="collab_error" class="text-danger"></span>
						</div>
						
                         
                        <div class="search-table">
							<div class="search-box">
                <div class="row mb-2">
                    <div class="col-sm-12 has-search">
					<i class="fas fa-search feedback"></i>
                        <input type="text" id="myInput" class="form-control rounded-0" placeholder="Search Employee">
                        <script>
                            $(document).ready(function () {
                                $("#myInput").on("keyup", function () {
                                    var value = $(this).val().toLowerCase();
                                    $("#myTable tr").filter(function () {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                        </script>
                    </div> 
                </div>
            </div>
			<div class="search-list">
                <table class="table" id="myTable" style="border:none;">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody class="tbodyscroll">  
					<?php
					 $users = json_decode($users);
                     foreach ($users->users as $chat) {
                      if($chat->imageUrl == null || $chat->imageUrl == ""){
                        $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                      }
                    ?>					
                    <tr>
                        <td> 
						<label class="checkbox">
                            <input type="checkbox" value="<?php echo $chat->userid; ?>" name="invites[]" id="invites" />
                            <span class="default"></span>
                        </label>
						</td>
                        <td>
							<a href="javascript:void(0);" class="list-group-item list-group-item-action list-group-item-light rounded-0 chat_people">
							  <div class="media">
							  <div class="icon-container">
							  <img src="<?php echo $chat->imageUrl;?>" alt="user" width="30" class="rounded-circle">
							  <div class='status-circle-online'></div>
							  </div>
								<div class="media-body ml-4">
								  <div class="d-flex align-items-center justify-content-between ">
									<h6 class="mb-0"><?php echo $chat->username;?></h6>
								  </div>
								  
								</div>
							  </div>
							</a>
						</td>
                    </tr>
					<?php }	?>
                    
                    </tbody>
                </table>

            </div>
						  </div>

                        

                        
						




						<span style="color: red" id="leaveSlugError"></span>
						
						<div class="form-group" id="toggle">
						<label for="leaveIsPaid">IsPaid</label><br>
						<div class="outerDivFull" >
						<div class="switchToggle">
						
							<input type="checkbox" id="switch" name="leaveIsPaid">
							<label for="switch">Toggle</label>
						</div>
						</div>
						</div>
						<div class="form-group text-center" id="updateLeaveType" style="display: none;">
						<button class="btn btn-secondary rounded-0" type="button" onclick="addLeave()">Update</button>
						<button class="btn btn-danger rounded-0" type="button" onclick="deleteLeave()">Delete</button> 
						</div>
						<div class="form-group text-center" id="addLeaveType" style="display: block;">
						<button class="btn btn-secondary rounded-0" type="button" onclick="addMeeting()">Add</button>
						</div>
				  </form>	
					</div>
					</div>
					
                    </div>
					</form>
                </div>
            </div>
          


</body>

<script>
						function addAgenda(){
							var div = 	$('#agenda');
							div.after("<div class='row'> <div class='col-md-12'> <div class='form-group'><label>Agenda</label><input type='text' class='form-control' name='meetingAgenda[]' id='agenda' placeholder='Agenda'  ><span id='time_error' class='text-danger'></span></div></div></div>");
							
						}

						</script>

<script type="text/javascript" language="javascript" >
$('#toggle').remove();
     $('#colab').on('change',function(){
				$('.remove').remove();
              		 
         if(this.value === "m"){  
               $('#colab').after("<input type='date' class='remove' id='month'>");
		 }
         if(this.value === "y"){

			$('#colab').after("<input type='date' class='remove'  id='year'>");
			 
			}
			if(this.value === "w"){
				$('#colab').after("<input type='date' class='remove' id='weekly'>");
			 
			}


	 });
    $('#month').datepicker({
		defaultDate: new Date(),
		format:'MM'
	});
	$('#year').datepicker({
		defaultDate: new Date(),
		format:'DD-MM-YYYY'
	});
	$('#weekly').datepicker({
		defaultDate: new Date(),
		format:'DD-MM-YYYY'
	})
	$('#datetimepicker12').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker121').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
    $('#datetimepicker13').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker131').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#apply_button').click(function(){
        
        $('#applyModal').modal('show');
    });
</script>
<script>
	$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});

	</script>


	<script type="text/javascript">
		
		function addLeaveType(){
			
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

		
	 function addMeeting(){
		 var meetingTitle = $('#meetingTitle').val();
		 if(meetingTitle == ""){
			 $('#meeting_error').text('Please Enter meeting Title')
			 return false;
		 } 
		 else{
			$('#meeting_error').text(' ');
		}
		 var meetingLocation = $('#location').val();
		   if(meetingLocation == ""){
			   $('#location_error').text('please Enter the text');
			   return false;
		   }
		   else{
			$('#location_error').text(' ');
		}


         var meetingDate = $('#date').val();
		 if(meetingDate == ""){
			 $('#date_error').text('Please enter the date');
			 return false;
		 }
		 else{
			$('date_error').text(' ');
		}
		 var meetingTime =  $('#time').val();
		 if(meetingTime == ""){
			 $('#time_error').text('please enter the time');
			 return false;
		 }
		 else{
			$('#time_error').text(' ');
		}
         var meetingAgenda = $('#agenda1').val();
		 if(meetingAgenda == ""){
			 
           $('#agenda_error').text('please enter the agenda');
		   return false;
		 }
		 else{
			$('#agenda_error').text(' ');
		}
		 var meetingCollab = $('#colab').val();
		 if(meetingCollab == ''){
			 $('#collab_error').text('please enter the collab type');
		     return false;
		 }
		 else{
			$('#collab_error').text(' ');
		}
		var meetinginvites = $('#invites').val();
		 if(meetinginvites == ""){
			 alert('please add atleat one employee');
			
			 return false;
		 }
		 else{
			 alert(meetinginvites);
		 }

		$('form').submit();
	 }
		
	</script>
	
</html>