<!DOCTYPE html>
<html>
<head>
<title>Leaves</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(1) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(1)::after {
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
    <div class="dashboradContainer ">

      <div class="button_class pageHead">
        <span class="events_title">Minutes of Meeting Attendence <span class="sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>"></span></span>
        <div class="rightHeader">       
        </div>
      </div>

      <div class="cardCont">
        <form class="attendance_form" action="<?php echo base_url() ; ?>mom/meetingAttendence/<?php echo $mId; ?>" method="post">
          <?php
              $partcipants = json_decode($partcipants);
              $len = count($partcipants);
              for($i = 0 ; $i < $len;$i++){ ?>
              <div class="card-body">
              <div class="user">
                    <div>
                    <input type="checkbox" name="absent[]" value="<?php echo $partcipants[$i]->uid; ?>">
                    
                    </div>
                    <div>
                    <span class="col-12 icon-parent">
                      <span class=" icon" style="<?php echo "background:#A4D9D6; color:#707070";?>">
                        <?php 
                          if(file_exists("api/application/assets/profileImages/".$partcipants[$i]->uid.".png")){
                            echo "<img src='../../api/application/assets/profileImages/".$partcipants[$i]->uid.".png'>";
                          }else{
                            echo icon($partcipants[$i]->name);
                          }
                        ?>
                      </span>
                    </span>
                    </div>
                    <div>
                      <h6>
                        <div class="d-inline-block">
                          <span class="d-flex"><?php echo $partcipants[$i]->name ; ?></span>
                          <span class="d-flex"><?php echo " (".$partcipants[$i]->email.")"; ?></span>
                        </div>
                      </h6>
                    </div>
              </div>
              </div>
                  <?php } ?>
              <div class="d-flex bg-default attendance_background">
                      <button type="submit" class="btn btn-default btn-small btnOrange">
                        <span class="material-icons-outlined">person_add</span> Mark Attendance
                      </button>
                      <div><i>Check to mark absent</i></div>
              </div>
        </form>
      </div>
    </div>
  </div>
</div>

<body>
<script>

function myFunction(value) {
    
  document.getElementById("myDropdown"+value.id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

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
	<script type="text/javascript">
  $(document).ready(()=>{
    // $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>

</html>