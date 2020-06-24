<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css"> -->
  <!-- <link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


  <!-- <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://kit.fontawesome.com/ca2871ad31.js" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->

<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
  .placePickerUIButton{
    position:absolute;
    z-index:1000;
    top:269px;
    left:1000px;
  }
  .form-signin {
    width: 100%;
    max-width: 70vw;
    padding: 15px;
    margin: 0 auto;
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
/*			border: 1px solid #ccc;*/
		}
		#example_filter input {
		  border-radius: 1.2rem;
		}
		.border-shadow{
			    /*box-shadow: 0 3px 10px rgba(0,0,0,.1);*/

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
/*  border: 15px solid transparent;*/
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

		.checkbox{background-color:#fff;display:inline-block;height:18px;margin:0.6em 0 0 0;width:18px;border-radius:0;float:right}
  .checkbox span{display:block;height:20px;position:relative;width:20px;padding:0}
  .checkbox span:after{-moz-transform:scaleX(-1) rotate(135deg);-ms-transform:scaleX(-1) rotate(135deg);-webkit-transform:scaleX(-1) rotate(135deg);transform:scaleX(-1) rotate(135deg);-moz-transform-origin:left top;-ms-transform-origin:left top;-webkit-transform-origin:left top;transform-origin:left top;border-right:3px solid #fff;border-top:3px solid #fff;content:'';display:block;height:13px;left:0;position:absolute;top:8px;width:8px}
  
  .checkbox input{display:none}
.checkbox input:checked + .default:after{border-color:#242121ad}
.chat_people{ overflow:hidden; clear:both;}
.chat_list {
 /* border-bottom: 1px solid #c4c4c4;*/
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
table.main-table tr:nth-child(odd){
   background-color:#eee !important;
   color:black; 
}
thead tr td{
  background:white !important;
  font-weight:bolder;
}

table.main-table{
    /*box-shadow: 0px 2px 4px;*/
}
table.main-table tr:nth-child(odd){
    background-color:white;
    padding:25px;
    color:black;
    /* font-weight:bold; */
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
	#participant{
       /* border:1px solid black;*/
        border-radius:50px;
        height:25px;
        background-color:skyblue;
        display:inline-block;
    }

    #participant1{
        /*border:1px solid black;*/
        border-radius:50px;
        background-color:skyblue;
        height:25px;
        width:25px;
        margin-left:-17px;
        z-index:-1;
        display:inline-block;
    }

    #participant1:nth-last-child(1){
        /*border:1px solid black;*/
        border-radius:50px;
        background-color:lightblue;
        height:25px;
        width:25px;
        margin-left:-17px;
        z-index:-1;
        display:inline-block;
    }

    #participant2{
        /*border:1px solid black;*/
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
    /*border:1px solid black;*/
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
  /*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
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
#main-table_filter{
    margin-top: -53px;
    margin-right: 212px;
}
#main-table_filter input{
border-radius:50px;
height:35px;
margin-top:-3px;

}
.dataTables_length{
  display:none;
}

#main-table_paginate{
  margin-top:2px;
}
.modal-body{
  padding:0;
}

.containers{
  max-width:100%;
}
.shift-bar-tab{
  text-align: center;
  color:white;
  max-width: 100%;
}
table{
  width: 100% !important;
}
.prevv{
  background:#307bd3 ;
  padding:10px 0 10px 0;
  cursor:pointer;
}
.prevv:hover{
  background:rgba(48, 123, 211,0.7);
}
.futt{
  background:#307bd3 ;
  padding:10px 0 10px 0;
  cursor:pointer;
}
.futt:after{
  content:'';

}
.futt:hover{
    background:rgba(48, 123, 211,0.7);
}
.table{
  border-radius:10px;
}
.dataTables_paginate{
  margin:0 !important;
}
.table.dataTable.no-footer{
  border-bottom: 0;
}
table.dataTable thead th, table.dataTable thead td{
  border:0 !important;
}
.prevv,.futt{
  margin-bottom: 40px
}
.arrow::after{
  content: " ";
    /* background: red; */
    margin-top: 35px;
    position: absolute;
    /* width: 100px; */
    border-right: 10px solid transparent;
    border-top: 20px solid #899097;
    border-left: 10px solid transparent;
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
  .mom-container{
    padding: 4rem 3rem 2rem 2rem;
    height: calc(100vh - 3rem);
  }
  .mom-container-child{
    background: white;
    height: 100%;
  }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<!-- <script type="text/javascript" src="<?php // echo base_url(); ?>assets/js/PlacePicker.js?v2"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>



<script>
//  var searchInput = 'search_input';
//  $(document).ready(function(){
//     var autocomplete;
//     autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)),{
//       types:['geocode']
//     });
//     google.maps.event.addListener(autocomplete,'place_changed',function(){
//      var near_place = autocomplete.getPlace();
//      document.getElementById('').value = near_place.geometry.location.lat();
//      document.getElementById('').value = near_place.geometry.location.lng();
    
//     document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
//     document.getElementById('logitude_view').innerHTML = near_place.geometry.location.lat();

//     });
//  });
//    $(document).on('change','#'+searchInput ,function(){
//        document.getElementById('latitude_input').value = "";
//        document.getElementById('longitude_input').value = "";
//        document.getElementById('latitude_view').innerHTML = "";
//        document.getElementById('longitude_view').innerHTML = "";


//    })
let autocomplete;

   function initAutocomplete(){
           autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'),{
             type: ['establishment'],
             componentRestrictions : { 'country' : ['AUS'] },
             fields: ['place_id','geometry','name']
           });
   }
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCca4JjWfY4ThOR-4CoLKH_pEeHkUt_4rs&libraries=places&callback=initAutocomplete" async defer ></script>


<!-- 
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
      var map = document.getElementById('map');

   var d = document.getElementById('pickup_country');
   d.addEventListener('focus',function(){
    map.style.display = 'block';
   })
   d.addEventListener('blur',function(){
      map.style.display = 'none'; 
   })

     function loadmap(){
        initMap();
     }
    </script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCca4JjWfY4ThOR-4CoLKH_pEeHkUt_4rs&callback=initMap">
</script> -->


</head>
<body style="background-color:#eee">

<?php 
  if(isset($users)){
$users =   json_decode($users);
}
          //  echo "<pre>";
             // foreach($users->users as $m):
//echo "<br>"; 
             //   echo $m->email;
             // endforeach;
             // exit;
          // print_r($users->users[0]);
         //exit;
   ?>
<div class="containers">
<!-- Button trigger modal -->


<!-- Modal -->

<div class="mom-container">
  <div class="mom-container-child">


<div class="modal fade" id="myModal" role="dialog" style="z-index:1400px">
    <div class="modal-dialog mw-75">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-primary">
    
          <h3 class="modal-title">Schedule New Meeting</h3>
        </div>
        <div class="modal-body container">
             <form method="post" action="<?php echo base_url() ?>mom/addMeeting">
              <div class="form-group">
                    <input type="text" name="meetingTitle" id="add_meeting" class="form-control" placeholder="Add Meeting Title">  
              </div>
               <table class="table table-borderless">
               <tr>
              
                <td>
                <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Date</span>
                        </div>
                        <input type="date" id="date" name="meetingDate" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                </td>
               
                <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Time</span>
                    </div>
                    <input type="time" name="meetingTime" id="time" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                
                </td>
               </tr>
               
               </table>
              <hr>
              <table class="table table-borderless">
               <tr>
                   <td class="text-center">Where</td>
                    <td>
                      <div class="form-group">
                       <input id="location" type="text" class="form-control" id="autocomplete" placeholder="Type Address...">
                      </div>
                      <div class="form-group">
                       <input type="hidden">
                       <input type="hidden">
                      </div>
                    </td>  
                </tr>
              
               
<!--                <tr>
                   <td class="text-center">Calender</td>
                   <td>
                    <div class="form-group">
                    <input type="text" id="add_meeting" class="form-control">
                    </div>  
                   </td>
               </tr> -->
     <tr>
        <td class="text-center">Agenda <span class="click-add">+</span><span class="click-remove">-</span></td>
          <td>
            <div class="form-group agenda-class">
                <textarea name="meetingAgenda[]" id="agenda" class="form-control agenda" style="background-color:#eee"></textarea>
            </div>  
          </td>
      </tr>
              <tr>
                  <td class="text-center">Period</td>
                  <td>
                   <div class="form-group">
                   <select name="" id="collab" class="form-control">
                      <option value="O">Once</option>
                      <option value="A">Annual</option>
                      <option value="M">Monthly</option>
                      <option value="W">Weekly</option>
                   </select>
                   
                   </div>
                  </td>
                </tr>
               <tr>
                   <td class="text-center">Add Member</td>
                   <td>
                    <div class="form-group">
                    <!-- <input type="text" id="add_meeting" class="form-control"> -->
                    
                     <select name="invites[]" class="demo" multiple  id="demo">
                       <?php 
                       
                         foreach($users->users as $m):
                       ?>  
                       <option value="<?php echo $m->username ?>"><?php echo $m->username;?></option>
                         <?php endforeach; ?>
                     </select>
                    </div>  
                   </td>
               </tr>
               <tr>
               
               <td></td>
               <td></td>
               </tr>
              </table>
              
           
       
        <div class="modal-footer">
        <div class="m_footer" style="margin:auto">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button class="btn btn-primary">Submit</button>
          </div>
        </div>
        </form>
      
        </div>
      </div>
      
    </div>
  </div>

    <div class="shift-bar " >
      <span class="shift-bar-tab d-flex" >
        <span class="prevv ">Previous Meetings</span>
        <span class="futt ">Upcoming Meetings</span>
      </span>
    </div>


<div class="row">
 
       <div class="left">
        <h3>Mins. of Meeting</h3>
     
        
        </div>
       <div class="right">
       <button id="mom_button" type="button"  class="btn btn-info" data-toggle="modal" data-target="#myModal">+ Schedule New Meeting</button>
       </div>        
  </div>
  <table class="table table-borderless past main-table" >

        <thead>
        <tr>
         <td>Title</td>
         <td>Start Date</td>
         <td>Time</td>
         <td>Location</td>
         <td>Status</td>
         <td>Attendees</td>
        <td></td>
        <td></td>
        </tr>
        </thead>
        <tbody>
         <?php 
         $i = 0;
         if(isset($meetings)){
           $meetings = json_decode($meetings);
            // print_r($meetings);
         foreach($meetings->data as $u): 
          if($u->date <= date('Y-m-d')){
           $i = $i + 1;
         ?>
        <tr>
        <td class="title-td" m-id="<?php echo $u->mid; ?>"><?php echo $u->title; ?></td>
        <td class="table-date"><?php echo $u->date; ?></td>
        <td><?php echo $u->time; ?></td>
        <td><?php echo $u->location; ?></td>
        <td><?php echo $u->status; ?></td>
        <script>
        var arr = [];
        </script>
        <td>
        
        <?php foreach($u->participants as $p): 
        // var_dump($p);
        // exit;
        
?>
        
        
         <input type="hidden" id="p"  name="p[]" value="<?php echo $p->participateName; ?>" >
        <div id="participant1"></div>
         
        <?php endforeach;
        
        ?>
        <!-- <div id="participant2">+5</div> -->
        </td>
        <td>
          
     <!--      <a href="<?php echo base_url() ?>mom/attendence/<?php echo $u->mid ?>" class="btn btn-primary btn-p ">start</a>
         -->
        </td>
        <td>
        <div class="dropdown">
  <a href="#" onclick="myFunction(this)" id="<?php echo $i; ?>" class="dropbtn"><i   class="fas fa-ellipsis-v"></i></a>
  <div id="myDropdown<?php echo $i; ?>" class="dropdown-content">
    <a   class="btn btn-default" id="update"  data-toggle="modal" data-target="#myModal">Edit</a>
    <!-- <a href="#">Delete</a> -->
    </div>
      </div>
      </td>
          </tr>
                         <?php } endforeach; } ?>
      
       

        </tbody>
  </table>
     
    <table class="table table-borderless future main-table"  style="">
        <thead>
         <td>Title</td>
         <td>Start Date</td>
         <td>Time</td>
         <td>Location</td>
         <td>Status</td>
         <td>Attendees</td>
        <td></td>
        <td></td>
        </tr>
        </thead>
        <tbody>
         <?php 
         $i = 0;
           // $meetings = json_decode($meetings);
            // print_r($meetings);
         if(isset($meetings)){
         foreach($meetings->data as $u): 
          if($u->date > date('Y-m-d')){
           $i = $i + 1;
         ?>
        <tr>
        <td class="title-td" m-id="<?php echo $u->mid; ?>"><?php echo $u->title; ?></td>
        <td class="table-date"><?php echo $u->date; ?></td>
        <td><?php echo $u->time; ?></td>
        <td><?php echo $u->location; ?></td>
        <td><?php echo $u->status; ?></td>
        <script>
        var arr = [];
        </script>
        <td>
        
        <?php foreach($u->participants as $p): 
        // var_dump($p);
        // exit;
        
?>
        
        
         <input type="hidden" id="p"  name="p[]" value="<?php echo $p->participateName; ?>" >
        <div id="participant1"></div>
         
        <?php endforeach; 
        
        ?>
        <!-- <div id="participant2">+5</div> -->
        </td>
        <td>
          <?php if($u->status == 'Summary'){?>
            <a href="<?php echo base_url() ?>mom/attendence/<?php echo $u->mid ?>" class="btn btn-primary btn-p disabled">start</a>
          <?php } ?>
          </td>
        <td>
        <div class="dropdown">
          <a href="#" onclick="myFunction(this)" id="<?php echo $i; ?>" class="dropbtn">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div id="myDropdown<?php echo $i; ?>" class="dropdown-content">
            <a   class="btn btn-default" id="update"  data-toggle="modal" data-target="#myModal">Edit</a>
              <!-- <a href="#">Delete</a> -->
          </div>
        </div>
        </td>
          </tr>
                         <?php } endforeach; } ?>
      
       

        </tbody>
  </table>    
   <!-- <div class="footer">
   <div class="dataTables_paginate paging_simple_numbers">
   <button class="paginate_button previous disabled" aria-controls="main-table" data-dt-idx="0" tabindex="-1" id="main-table_previous"><</button>
   <button class="paginate_button next disabled" aria-controls="main-table" data-dt-idx="2" tabindex="-1" id="main-table_next">></button>
   
   </div> -->
   <!-- <div>
   <p>Viewing page 1-20 of 36</p>
   
   </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-logout">
  <div class="modal-content-logout">
    <h3>You have been logged out!!</h3>
    <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
  </div>
</div>
  
<body>




<script>

 $(document).ready(function(){
  $('.demo').tokenize2();
 });

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
$(document).ready(function(){
          $('#mom_button').click(function(){
          $("form").each(function(){
          $(this).find(':input').val(""); 
          $(this).find(':textarea').val("");
      });    
    });
  });

$(document).ready(function(){

  $('a#update').click(function() {
    $('.tokens-container').remove('li');
    var  value  = $(this).closest('tr').children('td:eq(0)').text();
    var  value1 = $(this).closest('tr').children('td:eq(1)').text();
    var  value2 = $(this).closest('tr').children('td:eq(2)').text();
    var  value3 = $(this).closest('tr').children('td:eq(3)').text();
    var  value4 = $(this).closest('tr').children('td:eq(4)').text();
    var  value5 = $(this).closest('tr').children('td:eq(5)').find('input').each(function(){
      //alert(this.value);
      var email = this.value;
      console.log(email);
      //$('.tokens-container').append(`<li class="token" data-value="${email}"><a class="dismiss" onclick="remove()"></a><span> ${email} </span></li>`); 
         $('#demo').append(`<option value="${email}" selected> ${email} </option>`);   
      });
    // working
    // $('input[type="hidden"').each(function(){
    //   alert(this.value);
    // })
  //  $(this).closest('#p').each(function(){
  //     alert(this.value);
  //   })
    var  value6 = $(this).closest('tr').children('td:eq(6)').text();
    var  value7 = $(this).closest('tr').children('td:eq(7)').text(); 
    //alert(value5);    
   $('#add_meeting').val(value);
   $('#date').val(value1);
   $('#time').val(value2);
   $('#location').val(value3);
   $('.agenda').val(value5);
   $('#collab').val(value6);
});

 function remove(){
   alert('hello');
 }

});
 
</script>

<script>

$('.tokens-container a.dismiss').live('click', function(){
  $(this).parent().remove();
});
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
	<script>
  $(document).ready( function () {
    $('.main-table').dataTable({
     pageLength:10,
     "columnDefs": [
        { "orderable": false, "targets": [0, 1,2,3,4, 5, 6] },
        { "orderable": false, "targets": [] }
    ]
    });
} );

 $(document).ready(function(){
      $('#main-table_paginate span').remove();
 });

 $(document).ready(function(){
   $('#main-table_next').on('click',function(){
    $('#main-table_paginate span').remove();

     $('#main-table_paginate span').css({
       "display":"none",
     })
   })
 })

 $(document).ready(function(){
   $('#main-table_previous').on('click',function(){
     $('#main-table_paginate span').remove();
     $('#main-table_paginate span').css({
       "display":"none",
     })
   })
 });
//  $(document).ready(function(){

//       $('#pickup_country').focus(function(){


//         $("#pickup_country").PlacePicker({
//     btnClass:"btn btn-xs btn-default",
//   key:"AIzaSyCca4JjWfY4ThOR-4CoLKH_pEeHkUt_4rs",

//   });

//       }); 

//  $('#pickup_country').hover(function(){
//    $('.placePickerUIButton').css({
//      "top":"200px",
//      "left":"700px",
//      "z-index":1000
//    })
//  })

   
  
  
//   $("#pickup_country").PlacePicker({

//   success:function(data,address){

//     //data contains address elements and

//     //address conatins you searched text

//     //Your logic here

//     $("#pickup_country").val(data.formatted_address);

//   }

// });
// $("#pickup_country").PlacePicker({
//   btnClass: "btn btn-secondary btn-sm"
// });


//  })
 

  </script>
<script type="text/javascript">
  $(document).ready(()=>{
    $('.containers').css('paddingLeft',($('.side-nav').width() + 30));
});
</script>
<script type="text/javascript">
  $(document).ready(()=>{
    var count = $('.table-date').length;
    for(var i=0;i<count;i++){
    var date = $('.table-date').eq(i).text();
    var today = new Date(); 
    var dd = today.getDate(); 
    var mm = today.getMonth() + 1; 
    var yyyy = today.getFullYear(); 
        if (dd < 10) { 
            dd = '0' + dd; 
        } 
        if (mm < 10) { 
            mm = '0' + mm; 
        } 
        var tod = yyyy + '-' + mm + '-' + dd; 
    if(date < tod){
      $('.table-date').eq(i).closest('.btn-p').remove();
      console.log( $('.table-date').eq(i).text());
      // console.log(today);
    }
  }
  })
</script>
  <script type="text/javascript">
      $(document).ready(()=>{
        var past = $('.past').html()
        var future = $('.future ').hide()
        $('#DataTables_Table_1_wrapper').hide()
        $('#DataTables_Table_1_wrapper label').remove();
        $('#DataTables_Table_0_wrapper label').remove();
        $('#DataTables_Table_0_wrapper').prepend($('.shift-bar').html())
        $('#DataTables_Table_1_wrapper').prepend($('.shift-bar').html())
        $('.shift-bar').eq(2).hide();
        $('.shift-bar').eq(0).remove();
        $('.prevv').addClass('arrow');
        $('.futt').css('background','rgba(48,123,211,1)');
        $('.prevv').css('background','rgba(48,123,211,0.5)');
       // $('.past').html(future)
       $('.futt').on('click',function(){ 
        $('.futt').css('background','rgba(48,123,211,0.5)');
        $('.prevv').css('background','rgba(48,123,211,1)');
        $('.futt').addClass('arrow');
        $('.prevv').removeClass('arrow');
         $('.future ').show()   
         $('.past ').hide()            
          $('#DataTables_Table_1_wrapper').show()
          $('#DataTables_Table_0_wrapper').hide()
          $('.shift-bar').eq(1).hide();
      });
     $('.prevv').on('click',function(){ 
              $('.futt').css('background','rgba(48,123,211,1)');
        $('.prevv').css('background','rgba(48,123,211,0.5)');
         $('.future ').hide()   
         $('.past ').show()   
          $('.prevv').addClass('arrow');
          $('.futt').removeClass('arrow');         
          $('#DataTables_Table_1_wrapper').hide()
          $('#DataTables_Table_0_wrapper').show()
          $('.shift-bar').eq(2).hide();
      });
    });
  </script>
  <script type="text/javascript">
  $(document).on('click','.title-td',function(){
      var mId = $(this).attr('m-id');

  var url = "http://localhost/PN101/MOM/meetingInfo/"+mId;
      window.location.href=url;
    });
  </script>
  <script type="text/javascript">
    $(document).ready(()=>{
      var length = $('.shift-bar-tab').length ;
      for(var i=0;i<length;i++){
      $('.shift-bar-tab').eq(i).width($('table').eq(2).width());
      $('.prevv').eq(i).width(($('table').eq(2).width())/2);
      $('.futt').eq(i).width(($('table').eq(2).width())/2);
      }
    })
  </script>
  <script type="text/javascript">
    $('.arrow::after').css('marginTop',$('.shift-bar-tab').height())
  </script>
  <script type="text/javascript">
    $('.click-add').click(function(){
        $('.agenda-class').append($('.agenda-class ').html())
    })
    $('.click-remove').click(function(){
      if(($('.agenda').length) > 1){
        $('.agenda').last().remove();
        // alert( $('.agenda').length )
      }
    })
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
  
</html>
