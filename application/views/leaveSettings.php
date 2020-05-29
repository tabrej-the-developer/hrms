 <!DOCTYPE html>
 <html>
 <head>
 	<?php $this->load->view('header'); ?>
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
    background:#307bd3;
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
.nav-item{
	color:white !important;
}
nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: #307bd3 !important;
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

input[class=checkbox_label] + label {
  display: block;
  margin: 0.2em;
  cursor: pointer;
  padding: 0.2em;
}

input[class=checkbox_label] {
  display: none;
}

input[class=checkbox_label] + label:before {
  content: "\2714";
  border: 0.1em solid #000;
  border-radius: 0.2em;
  display: inline-block;
  width: 1em;
  height: 1.3em;
  vertical-align: bottom;
  color: transparent;
  transition: .2s;
}

input[class=checkbox_label] + label:active:before {
  transform: scale(0);
}

input[class=checkbox_label]:checked + label:before {
  background-color: #307bd3 ;
  border-color: #307bd3 ;
  color: #fff;
}

</style>
 	<title></title>
 </head>
 <body>
 <div class="tab-pane containers" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
 	<h2 class="m-2">Manage Leave Types</h2>
	<div class="card-header">
		<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-2 ml-auto "><button class="btn btn-primary">Sync Xero Leaves</button></div>
	<div class="col-md-2 text-right ml-auto">
	<button type="button" name="add_button" id="add_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"   onclick="addLeaveType()"> <i class="fas fa-plus-circle"></i> Add Leave Type</button>
	</div>
    </div>
    </div>
  	<div class="card-body">
        <table class="table table-striped table-borderless table-hover border-shadow" id="example2" style="width:100%;">
            <thead>
                <tr class="text-muted">
                <th>S.No</th>
                <th>Leave Name</th>
                <th>Leave Slug</th>
                <th>Is Paid</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            	<?php
            	$leaveType = json_decode($leaveType);
            	$var = 0;
            	foreach ($leaveType->leaveTypes as $leaveType) { 
            		$var++;
        		?>
				<tr>
					<td><?php echo $var;?></td>
					<td id="<?php echo $leaveType->id.'name';?>"><?php echo $leaveType->name;?></td>
					<td id="<?php echo $leaveType->id.'slug';?>"><?php echo $leaveType->slug;?></td>
					<td id="<?php echo $leaveType->id.'isPaidYN';?>"><?php echo $leaveType->isPaidYN;?></td>
					<td>
					<span onclick="editLeaveType('<?php echo $leaveType->id;?>')">
					<a href="#" title="Edit"><i class="far fa-edit" style="color:green;font-size:18px;"></i></a>
					</td>
				</tr>
				<?php }?>
				
            </tbody>
        </table>
	</div>
</div>
<!-- modal start here -->
            <div class="modal fade" id="userModal">
                <div class="modal-dialog">
                    
					<form id="leaveTypeForm" action="<?php echo base_url().'settings/addLeaveType';?>" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Leave Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                <div class="modal-body">
					<div class="col-md-12 col-xl-12">	
					<form id="leaveType" method="POST" action="<?php echo base_url().'settings/addLeave';?>">
						<input type="hidden" name="leaveId" id="leaveId" value="">

						<div class="form-group">
						  <label>New Leave Type</label>
						  <input type="text" class="form-control" id="leaveName" placeholder="Enter leave name" name="leaveName" >
						  <span id="new_leave_type_error" class="text-danger"></span>
						</div>

						<span style="color: red" id="leaveNameError"></span>
						 
						<div class="form-group">
							<label>Slug</label>
							<input type="text" class="form-control" name="leaveSlug" id="leaveSlug" placeholder="slug"  >
						  <span id="slug_error" class="text-danger"></span>
						</div>
						<span style="color: red" id="leaveSlugError"></span>
						
						<div class="form-group">
						<label for="leaveIsPaid">IsPaid</label><br>
						<div class="outerDivFull" >
						<div class="switchToggle">
						<!--dont rename id="switch"-->
							<input type="checkbox" id="switch" name="leaveIsPaid">
							<label for="switch">Toggle</label>
						</div>
						</div>
						</div>
						<div class="">
							<input type="checkbox" name="" class="checkbox_label" id="show_in_payslips"><label class=""for="show_in_payslips">Show in payslips</label>
						</div>
						<div class="form-group text-center" id="updateLeaveType" style="display: none;">
						<button class="btn btn-secondary rounded-0" type="button" onclick="addLeave()">Update</button>
						<button class="btn btn-danger rounded-0" type="button" onclick="deleteLeave()">Delete</button> 
						</div>
						<div class="form-group text-center" id="addLeaveType" style="display: block;">
						<button class="btn btn-secondary rounded-0" type="button" onclick="addLeave()">Add</button>
						</div>
				  </form>	
					</div>
					</div>
					
                    </div>
					</form>
                </div>
            </div>
            <!-- modal end here -->
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";

		function editLeaveType(leaveId){
			document.getElementById("leaveId").value = leaveId;
			document.getElementById("leaveName").value = document.getElementById(leaveId+"name").innerHTML;
			document.getElementById("leaveSlug").value = document.getElementById(leaveId+"slug").innerHTML;
			document.getElementById("switch").checked = document.getElementById(leaveId+"isPaidYN").innerHTML == "Y";
			document.getElementById("updateLeaveType").style.display = "block";
			document.getElementById("addLeaveType").style.display = "none";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

		function addLeaveType(){
			document.getElementById("leaveName").value =  "";
			document.getElementById("leaveSlug").value = "";
			document.getElementById("switch").checked = true;
			document.getElementById("updateLeaveType").style.display = "none";
			document.getElementById("addLeaveType").style.display = "block";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

			function addLeave(){
			var leaveName = document.getElementById("leaveName").value.trim();
			if(leaveName == ""){
				document.getElementById("leaveNameError").innerHTML = "Required field";
			}
			var leaveSlug = document.getElementById("leaveSlug").value.trim();
			if(leaveSlug == ""){
				document.getElementById("leaveSlugError").innerHTML = "Required field";
			}

			if(leaveName != "" && leaveSlug != ""){
				document.getElementById("leaveTypeForm").submit();
			}

		}


		function updateLeaveApp(leaveId,status){
			console.log(leaveId);
			var data = 'leaveId='+leaveId+'&status='+status;
		    var params = typeof data == 'string' ? data : Object.keys(data).map(
		        function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
		    ).join('&');
			var xhr = new XMLHttpRequest();
			xhr.open('POST', base_url+"settings/updateLeaveApp");
		    xhr.onreadystatechange = function() {
		        if (xhr.readyState>3 && xhr.status==200) { 
		        	location.reload();
		        }
		    };
		    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		    xhr.send(params);
		}
</script>
<script type="text/javascript">
	$(document).ready(function(){
	$('#superfunds').click(function(){
		var url = window.location.origin + "/PN101/settings/syncXeroLeaves" ;
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

