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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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
            position: fixed;
            bottom: 0.2rem;
            right: 1rem
        }
        .dataTables_info{
          display: none;
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
			background-color:#8D91AA;
			color: #E7E7E7;
          display: flex;
          justify-content: center; 
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
  width: 14%;
}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}

.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 14%;
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

/* ----------------------
    Schedule meeting modal : key (321x)
   ---------------------- */
   input{
    padding-left: 2rem;
    padding-right:1rem;
   }
   .button_form{
        border: none;
    color: rgb(23, 29, 75);
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-weight: 700;
    margin: 2px;
    width:8rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
   }
   .clos{
    background: #BCBFCF !important;
   }
   .click-add{
    position: absolute;
    right:100px;

   }
   .click-remove{
    position: absolute;
    right:70px;

   }
   .modal_table{
    margin-bottom: 0;
   }
   .agenda-class{
    padding-bottom: 1rem;
   }
   .agenda_block{
      min-height: 14rem;
      border: 1px solid #707070;
      border-radius: 33px;
      margin: 2rem 1rem 0 0;
   }
   .label_text{
    font-weight: 700;
    color: #171D4B;
    display: inline-block;
   }
.fc_input{
  border-radius: 20px;
  background: rgba(231, 231, 231, 1);
  border: 1px solid rgba(231, 231, 231, 1);
  box-shadow: none;
  width: 8rem;
}
.add_member_label{
  width:14%;
  padding:0 0 1rem 0;
  font-weight: 700;
  color: #171D4B;
}
.fc_input_label span{
  background: none;

}
.blocks_modal{
  width:100%;
  display: flex;
}
.modal_title_div{
  width: 100%;
  display: flex;
}
  .title_span_label{
    width: 14%;
    padding: 1rem 0;
    display: inline-block;
  }
  #add_meeting{
    width: 100%;
  }
  .title_span_input{
    width: 80%;
    padding: 1rem 0;
    display: inline-block;
    padding-left: 0 !important;
  }
  .tokens-container{
    width: 100%;
    background: rgba(231, 231, 231, 1);
  }
  .add_member_span{
    width: 80%;
  }
  .tokenize{
    width:100%;
          height: 2.5rem;
  }
  .blocks_modal > span{
    padding-left : 0 !important;
  }
  .tokenize ul{
        border-radius: 20px;
        background: rgba(231, 231, 231, 1);
        border: 1px solid rgba(231, 231, 231, 1);
        box-shadow: none;
        height: 2.5rem !important;
  }
  .title_span_input input{
    width: 79%
  }
.input-group>.form-control{
  flex:0 !important;
  width: 8rem !important;
}
.form-control{
  padding: 0 !important;
}
  .date_span_label{
    width:30%;
    display: inline-block;
  }
  .date_span_input{
    width:65%;
      display: inline-block;
  }
  .date_span_input .input_box__{
    width: 100%;
  }
.input-group{
  display: flex;
}
.input_box__{
      background: #E7E7E7;
      border: none !important;
      height: 2.5rem;
      border-radius: 20px;
  }
  form{
        padding: 0 1rem 0 3rem;
  }
.table td{
  padding: 0 1rem 1rem 0;
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
    margin-left:0.5rem 0 0.5rem 2.5rem;
   
}
.right{
    float:right;
    margin: 1rem 1rem 0.5rem 0;
}
.left h3{
  margin-left:2rem;
  font-weight: 700;
  color: #171D4B !important;
  margin-top: 0.5rem;
}
#mom_search{
    border-radius:25px;
}

#agenda{
  width:70%;
  margin-left: 4rem;
  border-radius: 20px;
  min-height: 3rem;
  color: #171D4B;
  margin-top:0.5rem;
  padding-left:1rem !important;
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
   min-height: 85vh; 
  padding: 0;
  margin: 1.75rem auto;
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
height:32px;
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
    margin-top: 32px;
    position: absolute;
    /* width: 100px; */
    border-right: 10px solid transparent;
    border-top: 15px solid rgba(137, 144, 151, 0.3);
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
    padding: 4rem 2rem 2rem 0rem;
    height: calc(100vh - 2rem);
  }
  .mom-container-child{
    background: white;
    height: 100%;
  }
  .button{
      border: none;
      color: rgb(23, 29, 75);
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-weight: 700;
      margin: 2px;
      display:inline-block;

      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
    }

  #hide input[type=file] {
display:none;
margin:10px;
}
#hide input[type=file] + label {
display:inline-block;
margin:20px;
padding: 4px 32px;
background-color: #FFFFFF;
border:solid 1px #666F77;
border-radius: 6px;
color:#666F77;
}
#hide input[type=file]:active + label {
background-image: none;
background-color:#2D6C7A;
color:#FFFFFF;
}
  #agendaFile{
    background:#eee;
    width: 70%;
    border-radius: 20px;
    height: 3rem;
    margin-left: 4rem;
    margin-top:1rem;
    margin-bottom:3rem;
  }
  .input-class{
    padding-right:4rem !important;
  }
  .input-group-parent{
    width:50% !important;
  }
.form-group{
  margin-bottom: 0 !important;
}
  .label-class{
    padding-left:8rem !important;
    text-align:left;
  }
  .form-control{
    padding: 0.25rem 0 !important;
  }
  .click-add{
    cursor: pointer;
  }
  .click-remove{
    cursor: pointer;
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
        <span style="position: absolute;top:20px">
        <a href="<?php echo base_url();?>/settings">
          <button class="btn back-button p-0">
              <img src="<?php echo base_url('assets/images/back.svg');?>">
               <span style="font-size:0.8rem">Minutes of Meeting</span>
          </button>
        </a>
      </span>
  <div class="mom-container-child">


<div class="modal fade" id="myModal" role="dialog" style="z-index:1400px">
    <div class="modal-dialog mw-75">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header ">
    
          <h3 class="modal-title ">Schedule New Meeting</h3>
        </div>
        <div class="modal-body container">
             <form method="post" action="<?php echo base_url() ?>mom/addMeeting">
              <div class="form-group modal_title_div">
                   <span class="title_span_label">
                      <label class="label_text">Title</label>
                    </span>
                    <span class="title_span_input">
                      <input type="text" name="meetingTitle" id="add_meeting" class="input_box__" placeholder="Enter Title">
                    </span>  
              </div>
               <table class="table table-borderless modal_table">
               <tr>
                  <td class="col-md-4 input-group-parent">
                    <div class="d-flex blocks_modal">
                        <span class="col-md-6 ">
                          <span class="input-group-prepend date_span_label">
                            <label class="label_text">Start&nbsp;Date</label>
                          </span>
                          <span class=" date_span_input">
                            <input type="date" id="date" name="meetingDate" class="input_box__" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                          </span>
                        </span>
                        <span class="col-md-6 ">
                          <span class="input-group-prepend date_span_label">
                            <label class="label_text">End&nbsp;Date</label>
                          </span>
                          <span class=" date_span_input">
                            <input type="date" id="date" name="meetingDate" class="input_box__" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                          </span>
                        </span>
                      </div>
                  </td>
               </tr>
              <tr>
                <td class="col-md-12 input-group-parent">
                  <div class="d-flex blocks_modal">
                    <span class="col-md-6 ">
                      <span class="input-group-prepend date_span_label">
                         <span class=" label_text" id="basic-addon1">Start&nbsp;Time</span>
                      </span>
                      <span class="date_span_input">
                        <input type="time" name="meetingTime" id="time" class="input_box__" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </span>
                    </span>
                    <span class="col-md-6 ">
                      <span class="input-group-prepend date_span_label">
                        <span class=" label_text" id="basic-addon1">End&nbsp;Time</span>
                      </span>
                      <span class="date_span_input">
                        <input type="time" name="meetingEndTime" id="time" class="input_box__" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </span>
                    </span>
                  </div>
                
                </td>
               <tr>
                <td>
                  <div class="d-flex blocks_modal">
                    <span class="col-md-6">
                      <span class="date_span_label label_text">Where</span>
                      <span class="date_span_input">
                        <input id="location" type="text" class="input_box__" id="autocomplete" placeholder="Type Address..." name="meetingLocation">
                      </span>
                      <div class="form-group">
                       <input type="hidden">
                       <input type="hidden">
                      </div>
                    </span>
                    <span class="col-md-6">
                    <span class="date_span_label label_text">Repeat&nbsp;Event</span>
                    <span class="date_span_input">
                       <select name="meetingcollab" id="collab" class="input_box__">
                          <option value="O">Once</option>
                          <option value="A">Annual</option>
                          <option value="M">Monthly</option>
                          <option value="W">Weekly</option>
                       </select>
                    </span>
                   </span>
                  </div>
                </td>
               </tr>
               </table>

              <table class="table table-borderless">


               <tr>
                  <div class="blocks_modal d-flex">
                    <span class="add_member_label">Add&nbsp;Member</span>
                    <span class="add_member_span">
                      <select name="invites[]" class="demo" multiple  id="demo">
                      <?php 
                          foreach($users->users as $m):
                      ?>  
                         <option value="<?php echo $m->userid ?>"><?php echo $m->username;?></option>
                      <?php endforeach; ?>
                     </select>
                    </span>
                  </div>  
               </tr>
<!--                <tr>
                   <td class="text-center">Calender</td>
                   <td>
                    <div class="form-group">
                    <input type="text" id="add_meeting" class="">
                    </div>  
                   </td>
               </tr> -->

          <div class="agenda_block">
             <span style="position: absolute;margin-top: -15px;margin-left: 70px;background: white;padding:0 0.25rem">Agenda</span> 
             <div id="agendaFile">
               <input type="FILE" name="agendaFile" id="hide" class="agendaFile" onchange=" return validate()">
             </div>
            <span class="click-add">
              <i>
                <img src="<?php echo base_url('assets/images/circle_plus.png');?>" height="25px">
              </i>
            </span>
            <span class="click-remove">
              <i>
                <img src="<?php echo base_url('assets/images/minus.png');?>" height="25px">
              </i>
            </span>
              <span>
                <div class="form-group agenda-class">
                    <textarea name="meetingAgenda[]" id="agenda" class="form-control agenda" style="background-color:#eee" placeholder="Add Agenda"></textarea>
                </div>  
              </span>
          </div>
 </table>
              
           
       
        <div class="modal-footer">
        <div class="m_footer" style="margin:auto">
          <button type="button" class="btn button_form clos" data-dismiss="modal">Close</button>
          <button class="btn button_form">Submit</button>
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
 
       <div class="left ">
        <h3>Mins. of Meeting</h3>
     
        
        </div>
       <div class="right">
       <button id="mom_button" type="button"  class="btn button" data-toggle="modal" data-target="#myModal">+ Schedule New Meeting</button>
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
           if(isset($meetings->data)){
         foreach($meetings->data as $u): 
          if($u->date <= date('Y-m-d')){
           $i = $i + 1;
         ?>
        <tr>
        <td class="title-td <?php echo $u->status; ?>" m-id="<?php echo $u->mid; ?>"><?php echo $u->title; ?></td>
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
          <?php if(strtolower($u->status) != 'summary'){ ?>
            <a href="<?php if(strtolower($u->status) == 'created' || strtolower($u->status) == ''){echo base_url('mom/attendence/').$u->mid; }if(strtolower($u->status) == 'attendance'){echo base_url('mom/onBoard/').$u->mid; }if(strtolower($u->status) == 'mom'){echo base_url('mom/summary/').$u->mid;}if(strtolower($u->status) == 'summary'){echo base_url('mom/meetingInfo/').$u->mid;} ?>" class="btn btn-primary btn-p ">start</a>
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
                         <?php } endforeach; } } ?>
      
       

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
        <td class="<?php if($u->status == 'Summary'){echo 'title-td';} ?>" m-id="<?php echo $u->mid; ?>"><?php echo $u->title; ?></td>
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
          <?php // if($u->status == 'Summary'){?>

          <?php // } ?>
          </td>
        <td>
<!--            <div class="dropdown">
            <a href="#" onclick="myFunction(this)" id="<?php echo $i; ?>" class="dropbtn">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div id="myDropdown<?php echo $i; ?>" class="dropdown-content"> -->
              <a   class="btn btn-default" id="update"  data-toggle="modal" data-target="#myModal">Edit</a>
              <!-- <a href="#">Delete</a> -->
<!--           </div>
        </div> -->
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
  // console.log(value);
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

  $(document).on('click','a#update',function() {
    $('.tokens-container').empty()
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
      //pre worked
      $('.tokens-container').append(`<li class="token" data-value="${email}"><a class="dismiss" onclick="remove()"></a><span> ${email} </span></li>`); 
      // pre worked



         // $('#demo').append(`<option value="${email}" selected> ${email} </option>`);   
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
   // $('.agenda').val(value5);
   $('#collab').val(value6);
   // console.log(JSON.stringify(value5))
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
    remove_loader_icon();
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
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
          if($(this).hasClass('Summary')){
              var url = window.location.origin+"/PN101/MOM/meetingInfo/"+mId;
              window.location.href=url;
          }
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
    var newElement = $('.agenda-class ').html();
    $('.click-add').click(function(){
        $('.agenda-class').append(newElement)
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
  <script type="text/javascript">
    function validate(){
      var fileInput =  $('.agendaFile').val();
      var allowedExtensions =  /(\.pdf)$/i; 
        
      if (!allowedExtensions.exec(fileInput)) { 
          alert('Invalid file type'); 
          $('.agendaFile').val(''); 
          return false; 
    }
  }
  </script>
</html>
