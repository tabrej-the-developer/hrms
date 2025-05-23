<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://kit.fontawesome.com/ca2871ad31.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
        /* .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
           
        /* }  */
        
         .card-body {
            padding: 0rem 1.25rem;
            background: white;
        }
        
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }

.card{
  position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    /* min-width: 0; */
    word-wrap: break-word;
     background-color: transparent;
     background-clip: border-box;
    border: none;
    padding: 0 2rem;
    box-shadow: none;
    border-radius: .25rem;
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
			background-color: #8D91AA;
			color: #E7E7E7;
           
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
.body{
    /* background-color:#8798ab26;  */
}
.container{
    /* background-color:#8798ab26; */
}
table#main-table tr:nth-child(even){
   background-color:#eee;
   
   color:black;
   font-size:18px; 
}
table#main-table{
    box-shadow: 0px 2px 4px;
}
table#main-table tr:nth-child(odd){
    background-color:white;
    padding:25px;
    color:black;
    font-weight:bold;
}
 .row {
  /* background-color: #607d8b; */
  display:block;
  margin-top:15px;
}
.row h3{
    color:black;
}
.left{
    float:left;
    margin-left:35px;
    margin-top:15px;
    margin-bottom:15px;
   
}
.right{
    float:right;
    margin-top:15px;
    margin-bottom:15px;

}
#mom_search{
    border-radius:25px;
}
#mom_button{
    border-radius:25px;
    background-color:#2196f3;
    color:white;
}
/* .container{
    background-color:#607d8bc9 !important;
} */
	
/*corousol end*/		
	#participant img{
        border:1px solid black;
        border-radius:50px;
        height:25px;
        background-color:skyblue;
        display:inline-block;
    }

    #participant1{
        border:1px solid black;
        border-radius:50px;
        background-color:skyblue;
        height:25px;
        width:25px;
        margin-left:-17px;
        z-index:-1;
        display:inline-block;
    }

    #participant1:nth-last-child(1){
        border:1px solid black;
        border-radius:50px;
        background-color:lightblue;
        height:25px;
        width:25px;
        margin-left:-17px;
        z-index:-1;
        display:inline-block;
    }

    #participant2{
        border:1px solid black;
        border-radius:50px;
        height:25px;
        width:25px;
        background-color:lightblue;
        color:white;
        margin-right:-12px;
        display:inline-block;
    }
    .modal-header{
        text-align:left;
    }
    .modal{
 padding: 0 !important;
}
.modal-dialog {
  max-width: 60% !important;
  /* height: 100%; */
  padding: 0;
  margin:auto;
}

.modal-content {
  border-radius: 0 !important;
  /* height: 100%; */
}
input#add_meeting{
    background-color:#eee;
    color:black;
}

.footer div{
   
    display:inline-block;
    margin:5px;
    float:right;

}
.footer button{
    background-color:white;
    border:1px solid black;
    color:black;
}

.dropbtn {
  /* background-color: #4CAF50;
  color: white; */
  padding: 16px;
  font-size: 16px;
  border: none;
  
}

/* .dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
} */

.dropdown {
  float: right;
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  right: 0;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* .dropdown a:hover {background-color: #ddd;} */

.show {display: block;}
.card-header{
    color:white;
    font-size:28px;
}
.user{
    display:block;
    margin:auto;
    margin-bottom:45px;
}
.card-header{
  background: #8D91AA;
  color: #E7E7E7;
  font-size: 1.3rem;
  display: flex;
  justify-content: center;
}
input[type="text"],input[type=time],select,#casualEmp_date{
  background: #ebebeb;
  border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
}
.buttonn,
.button{
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
}
.user div{
    float:left;
    display:block;
    
    margin-left:45px;
}
input[type=checkbox] {
         position: relative;
	       cursor: pointer;
    }
    input[type=checkbox]:before {
         content: "";
         display: block;
         position: absolute;
         width: 20px;
         height: 20px;
         top: 0;
         left: 0;
         background-color:#e9e9e9;
}
input[type=checkbox]:checked:before {
         content: "";
         display: block;
         position: absolute;
         width: 20px;
         height: 20px;
         top: 0;
         left: 0;
         background-color:#1E80EF;
}
    input[type=checkbox]:checked:after {
         content: "";
         display: block;
         width: 5px;
         height: 10px;
         border: solid white;
         border-width: 0 2px 2px 0;
         -webkit-transform: rotate(45deg);
         -ms-transform: rotate(45deg);
         transform: rotate(45deg);
         position: absolute;
         top: 2px;
         left: 6px;
}
.user div img{
    height:25px;
    width:25px;
    border-radius:50px;
}
table{
  width: 100%;
}
.card-body{
  height: calc(100vh - 10rem);
}
</style>
</head>
<body style="background-color:#eee;">
 <div class="containers">
  <div class="d-flex heading-bar">
    <span class="m-3" style="font-size: 1.75rem;font-weight: bold;color: rgb(23, 29, 75) !important;padding-left:1rem">Minutes of Meeting Agenda</span>
    <span class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
  </div>
 <div class="card">
  <div class="card-header ">
    
    <table>
       <td class="text-center h5">Agenda</td>
       <td class="text-center h5">Agenda Summary</td>
    </table>
  </div>
  <?php 
//   echo "<pre>";
//   var_dump(json_decode($summary));
//    exit;
  $summary = json_decode($summary);
?>
  <form action="<?php echo base_url() ?>mom/addSummary/<?php echo $mId; ?>" method="post">
  
  <div class="card-body">
     <table class="table table-borderless">
     <thead>
     <tr>

     </tr>
     </thead>
     <tbody>
     <?php
      
      // echo "<pre>";
      // var_dump($summary);
      // exit;
      // print_r($summary);

      $len = count($summary);
      
      for($i = 0; $i < $len; $i++){
     
     ?>
       <tr>
         <td class="text-center font-weight-bold"><?php echo $summary[$i]->text ?></td>
         <td>
          <div class="form-group">
          <input type="hidden" value="<?php  echo $summary[$i]->id;?>" name="id[]">
          <input type="text" name="summary[]" class="form-control" required>
          </div>
         </td>
       </tr>
      <?php } ?>
     </tbody>
     </table>
  <div class=" d-flex justify-content-center">
       <button type="submit" class="button">
            <i>
              <img src="<?php echo base_url('assets/images/icons/end.png'); ?>" style="max-height:0.8rem;margin-right:10px">
            </i>End</button>
  </div>
  </div>
</form>
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
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
</html>