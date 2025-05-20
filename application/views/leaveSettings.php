 <!DOCTYPE html>
 <html>
 <head> 	
<title>Leave Settings</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">
  
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(9) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(9)::after {
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
    <?php 
      $permissions = json_decode($permissions);
      $centers = json_decode($centers); 
    ?>
    <div class="containers scrollY">
		  <div class="settingsContainer ">

      <span class="d-flex pageHead heading-bar">
        <div class="withBackLink">
          <a href="<?php echo base_url('settings');?>">
          <span class="material-icons-outlined">arrow_back</span>
          </a>				
          <span class="events_title">Manage Leave Types</span>
        </div>
        <div class="rightHeader">
          <?php if(isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N" === "Y"){ ?>
              <select placehdr="Center" id="centerValue" name="centerValue" >
                <?php // $centers = json_decode($centers);
                  for($i=0;$i<count($centers->centers);$i++){
                    if($_SESSION['centerr'] == $centers->centers[$i]->centerid){
                ?>
                    <option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>" selected><?php echo $centers->centers[$i]->name?></option>
                <?php }else{ ?>
                  <option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
                <?php }
                    }  ?>
              </select>
            <?php $syncedWithXero = json_decode($syncedWithXero);  ?>
            <button class="btn btn-default btn-small btnOrange pull-right <?php 
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
              <img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:2rem;margin-right:10px">
              Sync Xero Leaves</button>
          <?php } ?>
          <button class="addLeaves btn btn-default btn-small btnBlue pull-right">Add Leaves</button>
        </div>
      </span>

 
  <div class="tab-pane " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<div class="tab-pane-child">
 	  <?php  if((isset($permissions->permissions) ? $permissions->permissions->viewLeaveTypeYN : "N") === "Y"){ ?>


  	<div class="table-div pageTableDiv">
        <table class="table " id="example2" style="width:100%;">
            <thead>
                <tr>
                <th>S.No</th>
                <th>Leave Name</th>
                <th>Leave Slug</th>
                <th>Is Paid</th>
                <th>Medical Record</th>
                <th>Hours</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <textarea id="leaves-data" cols="30" rows="10" class="d-none"><?= $leaveType ?></textarea>
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
          <td id="<?php echo $leaveType->id.'medicalFileYN';?>"><?php echo $leaveType->medicalFileYN;?></td>
          <td id="<?php echo $leaveType->id.'hoursYN';?>"><?php echo $leaveType->hoursYN;?></td>
					<td style="display: flex;justify-content: center;">
<?php if(isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N" == "Y"){ ?>
					<span onclick="editLeaveType('<?php echo $leaveType->leaveid;?>','<?php echo $leaveType->id;?>')">
					<a href="#" title="Edit">
            <span class="material-icons-outlined">edit</span>
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


<!-- begin::ADD MODAL -->
<div class="addLeaveForm modal modalNew" style="display: none;">
	<div class="modal-dialog mw-40">
		<div class="modal-content NewFormDesign">
			<div class="modal-header">
				<h3 class="modal-title ">Add Leave</h3>
			</div>
			<div class="modal-body">
				<form>
				<script>

					$('body').on('click','#slbtn',function(){
						var userid = $('#add-userid').val();
						var centerid = $('#add-centerid').val();
						var leave = $('#add-leave-name').val();
            var leaveslug = $('#add-leave-slug').val();
            var isPaid = $('#add-isPaid').val();
            var sop = $('#add-sop').val();
            var currentrecord = $('#add-currentRecord').val();


						if(leave == ""){
							alert("Enter Leave Name");
						}else if(userid == ""){
							alert("Userid is missing");
						}else if(centerid == ""){
							alert("Centerid is missing");
						}else{
							$.ajax({
								url:'<?= base_url('api/Leave/CreateLeaveType') ?>',
								type:"POST",
								headers:{
									"x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
									"x-token":'<?= $this->session->userdata('AuthToken') ?>'
								},
								data:JSON.stringify({
									"userid":userid,
									"centerid":centerid,
									"name":leave,
									"slug":leaveslug,
									"isPaidYN":isPaid,
									"showOnPaySlipYN":sop,
                  "CurrentRecord":currentrecord
								}),
								beforeSend:function(){
									$('#slbtn').text('PLEASE WAIT...');
									$('#slbtn').attr('disabled',true);
								},
								success:function(result,status,xhr){
                  console.log(result);
                  var da = jQuery.parseJSON(result);
        					// console.log(da);
                  // console.log(result);
                  if(da.Status == "OK"){
                    // alert("Hello");
                    $("#XeroLeaves").trigger("click");
                  }else if(da.ErrorNumber == 10){
                    alert(da.Message);
                    // alert("Hello Failed");
                  }
								}
							});
						}
					});
				</script>

					<!-- <input type="text" name="centerid" id="centerid" value="<= $this->uri->segment('3') ?>"> -->
					<input type="hidden" name="centerid" id="add-centerid" value="<?= $centerid ?>">
					<input type="hidden" name="userid" id="add-userid" value="<?= $this->session->userdata('LoginId') ?>">
					<div class="col-md-12">								
						<div class="form-floating">
							<input type="text" placeholder="Leave Name" class="form-control" name="leave-name" id="add-leave-name">
							<label for="leave-name">Leave Name</label>
						</div> 
					</div>
          <div class="col-md-12">								
						<div class="form-floating">
							<input type="text" placeholder="Leave Slug" class="form-control" name="leave-slug" id="add-leave-slug">
							<label for="leave-name">Leave Slug</label>
						</div> 
					</div>
          <div class="row m-1">
					<div class="col-md-4">						
						<div class="form-floating">
							<select id="add-isPaid" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="isPaid">isPaid</label>
						</div> 
					</div>
					<div class="col-md-4">					
						<div class="form-floating">
							<select id="add-sop" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="sop">Show on payslips</label>
						</div> 
					</div>
					<div class="col-md-4">			
						<div class="form-floating">
							<select id="add-currentRecord" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="currentRecord">Current Record</label>
						</div>
					</div>
          </div>

					<div class="modal-footer">
						<button type="button" class="close btn btn-default btn-small pull-right"><span class="material-icons-outlined">close</span> Cancel</button>
						<button type="button" id="slbtn" class="btn btn-default btn-small btnOrange pull-right"><span class="material-icons-outlined">save</span> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
					-
</div>
<!-- end::ADD MODAL -->



<!-- modal start here -->
  <div class="modal modalNew fade" id="userModal">
    <div class="modal-dialog mw-40">
      <div class="modal-content NewFormDesign">
        <form id="leaveTypeForm" action="<?php  echo base_url().'settings/addLeaveType';?>" method="POST">
          <div class="modal-header ">
            <h3 class="modal-title ">Leave Type</h3>
          </div>
          <div class="modal-body container">
            <div class="col-md-12 col-xl-12">	
              <!-- <form id="leaveType" method="POST" action="<php echo base_url().'settings/addLeave';?>"> -->
              <input type="hidden" name="leaveId" id="xeroleaveId" value="">
              <input type="hidden" name="leaveId" id="leaveId" value="">
              
              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control" id="leaveName" placeholder="Enter leave name" name="leaveName">
                  <label for="leaveName">Leave Type</label>
                </div> 
                <span id="new_leave_type_error" class="text-danger"></span>
              </div>
              <span style="color: red" id="leaveNameError"></span>

              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control" name="leaveSlug" id="leaveSlug" placeholder="slug">
                  <label for="leaveSlug">Slug</label>
                </div> 
                <span id="slug_error" class="text-danger"></span>
              </div>
              <span style="color: red" id="leaveSlugError"></span>
              
              <div class="col-md-12 formJustifyCeenter d-flex">
                <label for="leaveIsPaid">IsPaid</label>
                <div class="outerDivFull" >
                  <div class="switchToggle">
                    <!--dont rename id="switch"-->
                    <input type="checkbox" id="switch" name="leaveIsPaid">
                    <!-- <label for="switch">Toggle</label> -->
                  </div>
                </div>
              </div>
              <div class="col-md-12 formJustifyCeenter d-flex">
                <label for="leaveIsPaid">Medical Record</label><br>
                <div class="outerDivFull" >
                  <div class="switcToggle">
                    <!--dont rename id="switch"-->
                    <input type="checkbox" id="switc" name="medicalFile">
                    <!-- <label for="switc">Toggle</label> -->
                  </div>
                </div>
              </div>
              <div class="col-md-12 formJustifyCeenter d-flex">
                <label for="leaveIsPaid">Hours</label><br>
                <div class="outerDivFull" >
                  <div class="switToggle">
                    <!--dont rename id="switch"-->
                    <input type="checkbox" id="swit" name="hours">
                    <!-- <label for="swit">Toggle</label> -->
                  </div>
                </div>
              </div>
              <div class="col-md-12 checkPayslip">
                <input type="checkbox" name="show_in_payslips" class="checkbox_label" id="show_in_payslips"><label class=""for="show_in_payslips">Show in payslips</label>
              </div>
              <div class="formSubmit " id="updateLeaveType" >
                <button type="button" class="btn-close btn btn-default btn-small btnBlue pull-right" aria-label="Close" id="closeModal">
                  <span class="material-icons-outlined">close</span>
                  Cancel</button>
                <!-- <button class="submitEditLeave btn btn-default btn-small btnOrange pull-right" onclick="submitEditLeave()" type="button"> -->
                <button class="submitEditLeave btn btn-default btn-small btnOrange pull-right" type="button" id="editLeave">
                  <span class="material-icons-outlined">edit</span>
                  Update</button>
                <!-- <button class=" btn btn-default btn-small pull-right" type="button" onclick="deleteLeave()"> -->
                <button class=" btn btn-default btn-small pull-right" type="button" id="deleteLeave">
                  <span class="material-icons-outlined">delete</span>
                  Delete</button> 
              </div>
              <!-- <div class="form-group text-center  form-group-add" id="addLeaveType" >
              <button type="button" class=" " data-dismiss="modal" aria-label="Close">
              <i>
              <img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:1rem;margin-right:10px">
              </i>Cancel</button>
              <button class="" type="button" onclick="addLeave()">
              <i>
              <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem;margin-right:10px">
              </i>Add</button>
              </div> -->
              <!-- </form>	 -->
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>

    <!-- Notification -->
    <div class="notify_">
      <div class="note">
        <div class="notify_body">
          <span class="_notify_message"></span>
          <span class="_notify_close" onclick="closeNotification()">&times;</span>
          </div>
      </div>
    </div>
    <!-- Notification -->
            <!-- modal end here -->
<script type="text/javascript">

// Notification //
function showNotification(){
      $('.notify_').css('visibility','visible');
    }
    function addMessageToNotification(message){
    	if($('.notify_').css('visibility') == 'hidden'){
     		$('._notify_message').append(`<li>${message}</li>`)
    	}
    }
    function closeNotification(){
      $('.notify_').css('visibility','hidden');
      $('._notify_message').empty();
    }
  // Notification //

	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});

  	var base_url = "<?php echo base_url(); ?>";
		function editLeaveType(leaveId,id){
			document.getElementById("xeroleaveId").value = leaveId;
      document.getElementById("leaveId").value = id;
			document.getElementById("leaveName").value = document.getElementById(id+"name").innerHTML;
			document.getElementById("leaveSlug").value = document.getElementById(id+"slug").innerHTML;
			document.getElementById("switch").checked = document.getElementById(id+"isPaidYN").innerHTML == "Y";
      document.getElementById("switc").checked = document.getElementById(id+"medicalFileYN").innerHTML == "Y";
      document.getElementById("swit").checked = document.getElementById(id+"hoursYN").innerHTML == "Y";
			document.getElementById("updateLeaveType").style.display = "block";
			// document.getElementById("addLeaveType").style.display = "none";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

    function submitEditLeave(){
      document.getElementById('leaveTypeForm').submit();
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

	$('#XeroLeaves').click(function(){
    var centerid = $('#centerValue').val();
		var url =  "<?php echo base_url();?>settings/syncXeroLeaves/"+centerid;
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
      window.location.href = '<?php echo base_url();?>settings/leaveSettings/'+centerid;
    })

    // DELETE LEAVE
    $('body').on('click','#deleteLeave',function(){
      // alert("Hello");
      var fullurl  = '<?= base_url('api/leave/editLeaveType') ?>';
			var xdeviceid = '<?php echo $this->session->userdata('x-device-id'); ?>';
			var xtoken = '<?php echo $this->session->userdata('AuthToken'); ?>';
      var leaveId = $('#leaveId').val();
      var xeroleaveId = $('#xeroleaveId').val();
      var userid = '<?php echo $this->session->userdata('LoginId'); ?>';
      var centerid = $('#centerValue').val();
      var leavesdata = JSON.parse($("#leaves-data").text());

      // alert(fullurl + "||" + xdeviceid + "||" + xtoken + "||" + leaveId + "||" + xeroleaveId + "||" + userid + "||" + centerid);
      var removeIndex = leavesdata.leaveTypes.map(function(item) { return item.leaveid; }).indexOf(xeroleaveId);
      leavesdata.leaveTypes.splice(removeIndex, 1);
      var exdata = leavesdata.leaveTypes;
      
      $.ajax({
          url:fullurl,
          type:"POST",
          headers:{
            "x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
            "x-token":'<?= $this->session->userdata('AuthToken') ?>'
          },
          data:JSON.stringify({
            "leaveId":leaveId,
            "userid":userid,
            "centerid":centerid,
            "xeroleaveId":xeroleaveId,
            "existeddata":exdata,
            "type":"DEL"
          }),
          beforeSend:function(){
            $('#deleteLeave').text('PLEASE WAIT...');
            $('#deleteLeave').attr('disabled',true);
          },
          success:function(result,status,xhr){
            console.log(result);
            var da = jQuery.parseJSON(result);
            // console.log(da);
            console.log(result);
            if(da.Status == "OK"){
              // alert("Hello");
              $("#XeroLeaves").trigger("click");
            }else if(da.ErrorNumber == 10){
              alert(da.Message);
              // alert("Hello Failed");
            }
          }
				});







//       var xhttp = new XMLHttpRequest();
//       xhttp.open("POST", fullurl, true);
//       xhttp.setRequestHeader('x-device-id', xdeviceid);
//       xhttp.setRequestHeader('x-token', xtoken);
      
//       xhttp.send(JSON.stringify({
//           "leaveId":leaveId,
//           "userid":userid,
//           "centerid":centerid,
//           "xeroleaveId":xeroleaveId,
//           "existeddata":exdata,
//           "type":"DEL"
//         }));

//       xhttp.onreadystatechange = function() {
//         var da = jQuery.parseJSON(this.responseText);
// // 									// // console.log(da);
//           // console.log(result);
//           if(da.Status == "OK"){
//             // alert("Hello");
//             $("#XeroLeaves").trigger("click");
//           }else if(da.ErrorNumber == 10){
//             alert(da.Message);
//             // alert("Hello Failed");
//           }
//         // console.log(this.responseText);
//           // if (this.readyState == 4 && this.status == 200) {
//           //   //console.log(this.responseText);
//             // var da  = jQuery.parseJSON(this.responseText);
//             // // console.log(da);
//             // if(da.Status == "SUCCESS"){
//             //   alert("Leave Deleted Successfully");
//             //   location.reload();
//             // }else if(da.Status == "ERROR"){
//             //   alert(da.Message);
//             //   location.reload();
//             // }
//           // }
//       }
    });
    // DELETE LEAVE

    //UPDATE LEAVE
    $('body').on('click','#editLeave',function(){
      // alert("Hello");
      var fullurl  = '<?= base_url('api/leave/editLeaveType') ?>';
			var xdeviceid = '<?php echo $this->session->userdata('x-device-id'); ?>';
			var xtoken = '<?php echo $this->session->userdata('AuthToken'); ?>';

      var leaveId = $('#leaveId').val();
      var name = $('#leaveName').val();
      var slug = $('#leaveSlug').val();
      var xeroleaveId = $('#xeroleaveId').val();

      if ($('#switch').is(':checked')) {
        var isPaidYN = "Y";
      }else{
        var isPaidYN = "N";
      }
      if ($('#switc').is(':checked')) {
        var medicalFileYN = "Y";
      }else{
        var medicalFileYN = "N";
      }
      if ($('#swit').is(':checked')) {
        var hoursYN = "Y";
      }else{
        var hoursYN = "N";
      }
      if ($('#show_in_payslips').is(':checked')) {
        var showOnPaySlipYN = "Y";
      }else{
        var showOnPaySlipYN = "N";
      }
      
      var userid = '<?php echo $this->session->userdata('LoginId'); ?>';
      var leavesdata = JSON.parse($("#leaves-data").text());
      // alert(typeof(leavesdata));
      // alert(typeof(awards));
      var removeIndex = leavesdata.leaveTypes.map(function(item) { return item.leaveid; }).indexOf(leaveId);
      leavesdata.leaveTypes.splice(removeIndex, 1);
      var exdata = leavesdata.leaveTypes;

      $.ajax({
          url:fullurl,
          type:"POST",
          headers:{
            "x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
            "x-token":'<?= $this->session->userdata('AuthToken') ?>'
          },
          data:JSON.stringify({
            "type":"EDI",
						"existeddata":exdata,
            "leaveId":leaveId,
            "name":name,
            "slug":slug,
            "isPaidYN":isPaidYN,
            "showOnPaySlipYN":showOnPaySlipYN,
            "hours":hoursYN,
            "userid":userid,
            "medicalFile":medicalFileYN,
            "xeroLeaveId":xeroleaveId
          }),
          beforeSend:function(){
            $('#editLeave').text('PLEASE WAIT...');
            $('#editLeave').attr('disabled',true);
          },
          success:function(result,status,xhr){
            console.log(result);
            var da = jQuery.parseJSON(result);
            // console.log(da);
            console.log(result);
            if(da.Status == "OK"){
              // alert("Hello");
              $("#XeroLeaves").trigger("click");
            }else if(da.ErrorNumber == 10){
              alert(da.Message);
              // alert("Hello Failed");
            }
          }
				});

      // var xhttp = new XMLHttpRequest();
      // xhttp.open("POST", fullurl, true);
      // xhttp.setRequestHeader('x-device-id', xdeviceid);
      // xhttp.setRequestHeader('x-token', xtoken);
      
      // xhttp.send(JSON.stringify({
      //     "leaveId":leaveId,
      //     "name":name,
      //     "slug":slug,
      //     "isPaidYN":isPaidYN,
      //     "showOnPaySlipYN":showOnPaySlipYN,
      //     "hours":hoursYN,
      //     "userid":userid,
      //     "medicalFile":medicalFileYN
      //   }));

      // xhttp.onreadystatechange = function() {
      //     if (this.readyState == 4 && this.status == 200) {
      //       console.log(this.responseText);
      //       // var da  = jQuery.parseJSON(this.responseText);
      //       // // console.log(da);
      //       // if(da.Status == "SUCCESS"){
      //       //   alert("Leave Updated Successfully");
      //       //   location.reload();
      //       // }else if(da.Status == "ERROR"){
      //       //   alert(da.Message);
      //       //   location.reload();
      //       // }
      //     }
      // }
    });
    //UPDATE LEAVE

    //CLOSE MODAL
    $('body').on('click','#closeModal',function(){
      $('#userModal').modal('hide');
      location.reload();
    });
    //CLOSE MODAL


    // XERO POSTINGS
    //INTERNAL MODALS ADD LEAVE
    
    //INTERNAL MODALS ADD LEAVE
  $(document).on('click','.addLeaves',function(){
		$(".addLeaveForm").show();    		
	});
	$(document).on('click','.close',function(){
		$(".addLeaveForm,.editLeaveForm").hide();    		
	});
    // XERO POSTINGS
	})
</script>
 </body>
 </html>

