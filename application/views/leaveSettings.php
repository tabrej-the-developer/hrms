 <!DOCTYPE html>
 <html>
 <head>
 	<?php $this->load->view('header'); ?>
 	<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
  body{
  	background: #f2f2f2;
  }
  .tab-pane-child{
  	background: white;
  	height: 100%;
  }
  .tab-pane{
  	padding: 2rem 3rem 2rem 2rem;
  	height: calc(100vh - 4rem);
  }
   .heading{
      position: relative;
      top:20px;
      padding-left: 2rem;
      width: 100%;
    }
    .back-button span{
      font-size:1.75rem;
      color: #171D4B;
      font-weight: 700;
      margin-top: 20px;
    }
  .close{
    float: none; 
      font-size: inherit; 
      font-weight: inherit; 
      line-height: inherit; 
      color: inherit; 
      text-shadow: inherit; 
      opacity: inherit; 
      background: #6c757d !important;
      color:white !important;
      width: 5rem;margin-right: 20px
  }
  .btn-secondary{
    float: none; 
      font-size: inherit; 
      font-weight: inherit; 
      line-height: inherit; 
      color: inherit; 
      text-shadow: inherit; 
      opacity: inherit; 
      background: #6c757d !important;
      color:white !important;
      width: 5rem;
  }
  .button{
      border: none;
      color: rgb(23, 29, 75);
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-weight: 700;
      margin: 2px;
      width:auto;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
  }
  .close:hover{
    background:#6c757d;
  }
        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: #ffffff;
            border-bottom: 0px;
        }
        
        .card-body {
            padding: 0;
            height: 100%;
            overflow-y: auto;
            width: 100%;
            overflow-x: auto !important;
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
		.btn-group-sm>.btn,{
			padding: .25rem .5rem;
			font-size: .875rem;
			line-height: 1.5;
			border-radius: 1.2rem;
			border: 1px solid #ccc;
		}
		.btn-sm{
			padding: .5rem;
			font-size: .9rem;
			line-height: 1.5;
			border-radius: 5px;
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
			color: #F3F4F7;
      font-size: 1rem;
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
    .sync_button{
      display: flex;
      margin-right:2rem;
      justify-content: center;
      align-items: center;
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
  .table{
    font-size: 1rem;
    background-color: white;
    width: 100%;
    margin: auto;
    text-align: center;
    max-height: 100%;
    overflow-y: auto;
   }
    thead tr{
      background-color: #8D91AA;
      color: #F3F4F7 !important;
    }
    tr{
      border-top:  1px solid #d2d0d0;
      border-bottom: 1px solid #d2d0d0;
    }
    tbody tr{
      background: white !important;
    }
.buttons-parent{
	padding:1rem;
}
.buttonn,
.button,
button[type=button]{
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
input[type="text"],input[type=time],select,#casualEmp_date{
  background: #ebebeb;
  border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
}
.disabled{
  background: rgb(235, 235, 228) !important;
}
</style>
 	<title></title>
 </head>
 <body>
 	<?php 
    $permissions = json_decode($permissions);
    $centers = json_decode($centers); 
  ?>
<div class="containers">
  <span class="d-flex heading">
	  <span>
      <a href="<?php echo base_url('settings');?>">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span >Manage Leave Types</span>
        </button>
      </a>
    </span>
    <span class="ml-auto sync_button">
        <?php if(isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N" === "Y"){ ?>
          <span class="select_css">
            <select placehdr="Center" id="centerValue" name="centerValue" >
              <?php 
              foreach($centers->centers as $center){ 
        if(isset($centerid) && $centerid == $center->centerid ){
                ?> 
                <option value="<?php echo $center->centerid;?>" selected><?php echo $center->name;?></option>
              <?php }else{ ?>
        <option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
          <?php  }  
          } ?>
            </select>
          </span>
          <?php $syncedWithXero = json_decode($syncedWithXero);  ?>
          <button class="button <?php 
            if(isset($syncedWithXero->syncedWithXero) && $syncedWithXero->syncedWithXero != null){
              if($syncedWithXero->syncedWithXero == 'N'){
                echo 'disabled';
              }
            }
           ?>" id="XeroLeaves" <?php 
            if(isset($syncedWithXero->syncedWithXero) && $syncedWithXero->syncedWithXero != null){
              if($syncedWithXero->syncedWithXero == 'N'){
                echo "disabled";
              }
            }
           ?>>
            <i>
              <img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:2rem;margin-right:10px">
            </i>Sync Xero Leaves</button>
        <?php } ?>

    </span>
  </span>
  <div class="tab-pane " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<div class="tab-pane-child">
 	  <?php  if((isset($permissions->permissions) ? $permissions->permissions->viewLeaveTypeYN : "N") === "Y"){ ?>


  	<div class="card-body">
        <table class="table " id="example2" style="width:100%;">
            <thead>
                <tr>
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
<?php if(isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N" == "Y"){ ?>
					<span onclick="editLeaveType('<?php echo $leaveType->id;?>')">
					<a href="#" title="Edit">
            <i>
              <img src="<?php echo base_url('assets/images/icons/pencil.png'); ?>" style="max-height:0.8rem;margin-right:10px">
            </i>
          </a>
	<?php }else{ echo "-"; } ?>
					</td>
				</tr>
				<?php }?>
				
            </tbody>
        </table>
	</div>
<?php } ?>
		</div>
	</div>
</div>
<!-- modal start here -->
  <div class="modal fade" id="userModal">
    <div class="modal-dialog">
  		<form id="leaveTypeForm" action="<?php  echo base_url().'settings/addLeaveType';?>" method="POST">
				<div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Leave Type</h5>
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
							<input type="checkbox" name="show_in_payslips" class="checkbox_label" id="show_in_payslips"><label class=""for="show_in_payslips">Show in payslips</label>
						</div>
						<div class="form-group text-center " id="updateLeaveType" >
  						<button class="" type="button" onclick="addLeave()">
                <i>
                  <img src="<?php echo base_url('assets/images/icons/pencil.png'); ?>" style="max-height:1rem;margin-right:10px">
                </i>Update</button>
             <button type="button" class=" btn-close" data-dismiss="modal" aria-label="Close">
                <i>
                  <img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:1rem;margin-right:10px">
                </i>Cancel</button>
  						<button class=" btn-danger rounded-0" type="button" onclick="deleteLeave()">
                <i>
                  <img src="<?php echo base_url('assets/images/icons/del.png'); ?>" style="max-height:1rem;margin-right:10px">
                </i>Delete</button> 
						</div>
						<div class="form-group text-center  form-group-add" id="addLeaveType" >
              <button type="button" class=" " data-dismiss="modal" aria-label="Close">
                <i>
                  <img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:1rem;margin-right:10px">
                </i>Cancel</button>
  						<button class="" type="button" onclick="addLeave()">
                <i>
                  <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem;margin-right:10px">
                </i>Add</button>
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
              // console.log(xhr.responseText)
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

    // function syncedWithXero(centerid){
    //   var url = ;
    //   $.ajax({
    //     url : url,
    //     type : 'GET',
    //     success : function(response){

    //     }
    //   })
    // }

	$('#XeroLeaves').click(function(){
    var centerid = $('#centerValue').val();
		var url =  window.location.origin + "/PN101/settings/syncXeroLeaves/"+centerid ;
    console.log(url)
    $.ajax({
				url:url,
				type:'GET',
				success:function(response){
          console.log(response)
					 window.location.reload();
				}
			})
		})
  $(document).on('change','#centerValue',function(){
      var centerid = $('#centerValue').val();
      window.location.href = window.location.origin+'/PN101/settings/leaveSettings/'+centerid;
      // $.ajax({
      //   url : url,
      //   type : 'GET',
      //   success : function(response){
      //     $('tbody').html($(response).find('tbody').html())
      //     $('.sync_button button').replaceWith($(response).find('.sync_button button')[0].outerHTML);
          // sycedWithXero(centerid);
          // console.log($(response).find('tbody').html())
      //   }
      // })
    })
	})
</script>
 </body>
 </html>

