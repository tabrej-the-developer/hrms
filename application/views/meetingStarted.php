<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <style>
  

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
.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.chat_img {
  float: left;
  width: 11%;
}

.checkbox{background-color:#fff;display:inline-block;height:18px;margin:0.6em 0 0 0;width:18px;border-radius:0;border:1px solid #ccc;float:right}
  .checkbox span{display:block;height:20px;position:relative;width:20px;padding:0}
  .checkbox span:after{-moz-transform:scaleX(-1) rotate(135deg);-ms-transform:scaleX(-1) rotate(135deg);-webkit-transform:scaleX(-1) rotate(135deg);transform:scaleX(-1) rotate(135deg);-moz-transform-origin:left top;-ms-transform-origin:left top;-webkit-transform-origin:left top;transform-origin:left top;border-right:3px solid #fff;border-top:3px solid #fff;content:'';display:block;height:13px;left:0;position:absolute;top:8px;width:8px}
  
  .checkbox input{display:none}
.checkbox input:checked + .default:after{border-color:#242121ad}

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
	
/*corousol end*/		
		
</style>
</head>
<body>
<div class="container">

            
						


<h1>On Board </h1>
<?php 

$present = json_decode($present);
 //var_dump($present[0]->uid);
 //exit;
 $len = count($present);
?>
        <form action="<?php echo base_url() ?>mom/meetingRecord/<?php echo $mId; ?>" method="post">

<div class="row" id="addMore">
 <div class="col-md-2">
 
 </div>
 <div class="col-md-3">
 <div class="form-group">
           <select name="invites[]" id="invites" class="form-control" id="">
          <?php for($i = 0; $i < $len ; $i++){ ?>

           
               <option value="<?php  echo $present[$i]->uid; ?>">name1</option>
          <?php } 
          ?>
                         </select>
        
        

       </div> 
 </div>
 <div class="col-md-3">
   <div class="form-group">
   <textarea name="sentence[]" id="meetingText" cols="30" rows="1" class="form-control">
   
   </textarea>
   </div>

 </div>
 <div class="col-md-2">
 <div class="form-group">
 <input type="text" name="remark[]" class="form-control" placeholder="Add a Remark">
 </div>
 </div>
 

<div class="col-md-2">
<button class="btn btn-primary" type="button" id="addmore"> Add more </button>

</div> 
</div>

                </div>

               <div class="row">
                   <div class="col-md-5"></div>
                   <!-- <div class="col-md-2"><button class="btn btn-success">Done</button></div> -->
                   <div class="col-md-5"><button class="btn btn-warning" type="submit">Add summary</button></div>


               </div> 
          
          
               </form>


</body>

<script>
						function addAgenda(){
							alert('clicked');
							
							var div = document.getElementById('agendaMore');
							div.innerHTML  = "<div class='form-group'><label>Agenda</label><input type='text' class='form-control' name='meetingLocation' id='agenda' placeholder='Agenda'  ><span id='time_error' class='text-danger'></span></div>";
							
						}
						</script>

<script type="text/javascript" language="javascript" >
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

        $('#addmore').on('click',function(event){
        var div = '<div class="row"><div class="col-md-2"></div><div class="col-md-3"><div class="form-group"><select name="invites[]" class="form-control" id=""><?php for($j = 0;$j < $len ;$j++) { ?> <option value="<?php echo $present[$j]->uid; ?>">name1</option> <?php } ?></select></div> </div><div class="col-md-3"><div class="form-group"><textarea name="sentence[]" id="meetingText" cols="30" rows="1" class="form-control"></textarea></div></div> <div class="col-md-2">  <input class="form-control" type="text" placeholder="Add a Remark" name="remark[]">  </div> </div>';
            // if(event.keyCode == '13'){
                $('#addMore').after(div);
            //  }
        });

		
		
		
	</script>
	
</html>