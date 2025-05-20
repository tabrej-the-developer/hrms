<?php 
	$colorcodes = ['#0041C2','#254117','#FBB117','#C35817','#E42217','#9F000F','#7D0552'];
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Leaves</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<!-- Draggable plugin -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

  <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(5) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(5)::after {
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
	<?php $permissions = json_decode($permissions); ?>
  <div class="containers scrollY">
    <div class="rosterContainer ">
      <div class="d-flex pageHead heading-bar">
        <span class="events_title">Leave Management</span>
        <span class=" sort-by rightHeader <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
          <?php if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "Y"){ ?>
            <!--      <div class="filter-icon d-flex">
              <span class="">Sort&nbsp;by</span>
              <span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
            </div> -->
                <select class="center-list " id="center-list">
                  <?php $centers = json_decode($centers);
                  
                  for($i=0;$i<count($centers->centers);$i++){
                    if($_SESSION['centerr'] == $centers->centers[$i]->centerid){
                ?>
                <option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>" selected><?php echo $centers->centers[$i]->name?></option>
              <?php }else{ ?>
                <option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
              <?php }}  ?>
              </select>
          <?php } ?>

          <?php  if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "N"){ ?>
              <button type="button" name="apply_button" id="apply_button" class="button btn btn-default btn-small btnOrange pull-right" data-toggle="modal" data-target="#exampleModal">
                <span class="material-icons-outlined">task_alt</span>
                Apply Leave
              </button>
          <?php  } ?>
        </span>
      </div>

      <?php  if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "N"){ ?>
          <div class="row mt-3">
            <div class="col-md-12">
              <h6>Leave Balance</h6>
            </div>
          </div>
          <div class="row shadow-sm mb-4  rounded vdivide">
            <div class="col-sm-12">	
              <div id="recipeCarousel" class="carousel slide w-100" data-ride="">
                <div class="carousel-inner w-100" role="listbox">
                  <?php
                    // print_r($balance);
                  if(isset($balance)){
                    $balance = json_decode($balance);
                    // print_r($balance);
                    if(count($balance->balance) > 0){
                      $count = count($balance->balance) > 0 ? count($balance->balance) : 1;
                      $count = ceil($count/3);
                      for($i=0; $i < $count; $i+=3){ ?>
                  <div class="carousel-item row no-gutters  <?php if($i == 0) echo 'active';?>">
                  <?php 
                    $var = 0;
                    while($var < 3){ 
                      if($var+$i < count($balance->balance)){
                    ?>
                    <div class="col-md-3 balance-tile cardContainer" style="background: <?php echo $colorcodes[rand(0,6)];?>;">
                      <div class="balance-tile-div cardItem">
                        <div class="leave-balance">
                            <?php echo sprintf('%.2f',$balance->balance[$i + $var]->leavesRemaining);?>
                        </div>
                        <div class="leave-name" >
                          <?php echo $balance->balance[$i + $var]->leaveName;?>
                        </div>
                      </div>
                    </div> 
                  <?php 
                    }	
                  $var++;
                }  ?>
                </div>
            <?php } } } ?>
              </div>
          <!-- <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a> -->
          <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
          </div>

            
            
      <?php } ?>

      
      
<?php if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "Y"){ ?>
      
      <div class="table-div pageTableDiv">
          <table class="table" id="example3" >
            <!-- Employee Leave View -->
            <thead>
              <tr class="text-muted">
                <th>Name</th>
                <th>Role</th>
                <th>Leave Type</th>
                <th>Applied Date</th>
                <th>Start Date</th>
                <th>End Date </th>
                <th>Reason</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $leaves = json_decode($leaves);
              if(isset($leaves) && count($leaves->leaves)>0){
              
              foreach ($leaves->leaves as $l) { ?>
              <tr>                              
                <td><?php  echo $l->name;?></td>
                <td><?php  echo $l->title;?></td> 
                <td><?php echo isset($l->leaveTypeSlug) ? $l->leaveTypeSlug : "" ;?></td>
                <td >
                  <?php
                    $date = date_create($l->appliedDate);
                    echo date_format($date,"d/m/Y");
                  ?>
                </td>
                <td>
                  <?php
                    $date = date_create($l->startDate);
                    echo date_format($date,"d/m/Y");
                  ?>
                </td>
                <td>
                  <?php
                    $date = date_create($l->endDate);
                    echo date_format($date,"d/m/Y");
                    ?>
                </td>
                <td>
                  <?php echo $l->notes;?>
                </td>
                  <?php
                    $color = '#F44336';
                    if($l->status == "Applied") $color = '#9E9E9E';
                    if($l->status == "Approved") $color = '#4CAF50';

                    if($l->userid == $this->session->userdata('LoginId')){
                      echo "<td style=\"text-align: center; vertical-align: center\" class=\" span__\">".$l->status."</td>";
                    }else{
                      if($l->status == "Applied"){ 
                  ?>
                  <td class="spanAction "> 
                    <div class="accept" onclick="updateLeaveApp('<?php echo $l->id;?>','2')" class="pr-3">
                      <span class="material-icons-outlined">check_circle_outline</span>
                    </div>
                    <div class="reject" onclick="updateLeaveApp('<?php echo $l->id;?>','3')" class="pl-3">
                      <span class="material-icons-outlined">highlight_off</span>
                    </div>
                  </td>
              <?php }
                else{
                  $color = $l->status == "Approved" ? '#4CAF50' : '#F44336'; 
                  $sta = $l->status == "Approved" ? 'appr' : 'reje'; 
                  $img = $l->status == "Approved" ? 'check_circle_outline' : 'highlight_off'; ?>
                  <td class=" spanReject <?php echo $sta; ?> ">
                  <span style="color: <?php echo $color;?>; " class="status-<?php echo $sta; ?>">
                    <span class="material-icons-outlined"><?php echo $img ?></span>
                    <?php echo $l->status;?>
                  </span>
                </td>
                  <?php
                }}
              ?>
              </tr>
              <?php } }?>
            </tbody>
          </table>
        </div>
      <?php } ?>
            

    </div>
  </div>
</div>


<div id="modal_confirm__container">
  <div class="modal_confirm__background NewFormDesign">
    <div class="modal_confirm_">
      <h2 class="confirm__"></h2>
      <span class="d-flex justify-content-center p-3 confirm_span">Are you sure you want to&nbsp;<p class="confirm_p"></p>&nbsp;the leave?</span>
      <span class="confirm__span pb-3 d-block"></span>
      <span class="confirm_buttons d-flex justify-content-center p-2">
      	<input class="confirm_button btn btn-default btn-small confirm_cancel" type="button" value="Cancel" status="no">
      	<input class="confirm_button btn btn-default btn-small btnOrange confirm_save" type="button" value="Confirm" status="yes">
      </span>
    </div>
  </div>
</div>  





<?php if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "N"){ ?>
 <!-- apply leave modal start here -->
              <div class="modal modalNew fade" id="applyModal">
                <div class="modal-dialog mw-40">
                    
                  <form id="applyLeaveForm" action="<?php echo base_url().'leave/applyLeave';?>" method="POST">
                    <div class="modal-content NewFormDesign">
                      <div class="modal-header">
                        <h3 class="modal-title ">Apply Leave</h3>
                      </div>
                      <div class="modal-body">	

                        <div class="col-md-12">
                          <div class="form-floating">
                            <select class="form-control" id="applyLeaveId" name="applyLeaveId" required >
                              <option value="" selected disabled>Select Leave Type </option>
                              <?php 
                                foreach ($balance->balance as $bal) { ?>
                              <option value="<?php echo $bal->leaveTypeId;?>"
                                      balance="<?php echo $bal->leavesRemaining ?>">
                                      <?php echo $bal->leaveName;?>
                              </option>
                              <?php }?>
                            </select>
                            <label for="applyLeaveId">Leave Type</label>
                            <span style="color: red" id="applyLeaveIdError"></span>
                          </div> 
                        </div>

                        <div class="d-flex">
                          <div class="col-md-12">
                            <div class="form-floating date">
                              <input type="date" name="applyLeaveFromDate" id="applyLeaveFromDate" class="form-control"  placeholder="dd-mm-yyyy"/>
                              <label for="applyLeaveFromDate">Start Date</label>
                            </div> 
                          </div>
                          <div class="col-md-12">
                            <div class="form-floating date" id="datetimepicker13">
                              <input type="date" name="applyLeaveToDate" class="form-control" id="applyLeaveToDate" placeholder="dd-mm-yyyy"/>
                              <label for="applyLeaveFromDate">End Date</label>
                            </div> 
                          </div>
                        </div>
                        <span style="color: red" id="applyLeaveDateError"></span>

                        <div class="col-md-12">
                          <div class="form-floating date">
                            <textarea id="applyLeaveNotes" name="applyLeaveNotes" class="form-control" placeholder="Reason" ></textarea>
                            <label for="message">Leave Reason</label>
                          </div> 
                        </div>	
                        
                        <div class="col-md-12">
                          <div class="form-floating">
                            <input type="number" clas="form-control" name="total_leave_hours" id="total-leave-hours" step="0.5">
                            <label for="roster-date">Total leave hours</label>
                          </div>    
                        </div>     
                        <div class="col-md-12">                
                        <span class="total-leave-hours infoMessage"></span>
                        </div>

                          <span class="leave_balance"></span>

                        <div class="modal-footer">
                          <button class=" btn btn-default btn-small btnOrange pull-right button apply_leave" type="button" onclick="applyLeave()" >
                            Apply
                          </button>
                          <button type="button" class="btn btn-default btn-small pull-right close button" data-dismiss="modal" aria-label="Close" onclick="$('#applyModal').modal('hide');">
                            Close
                          </button>
                        </div>
                      </div>	
                    </div>
                  </form>
                </div>
              </div>
            <!-- modal end here -->  
<?php } ?>     

 <div class="modal-logout">
      <div class="modal-content-logout">
          <h3>You have been logged out!!</h3>
          <h4><a class="btn btn-default btn-small btnOrange" href="<?php echo base_url(); ?>">Click here</a> to login</h4>
          
      </div>
  </div>

</body>
<script type="text/javascript" language="javascript" >

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

		function deleteLeave(){
			document.getElementById("leaveTypeForm").action = "<?php echo base_url();?>" + 'leave/deleteLeaveType';
			document.getElementById("leaveTypeForm").submit();
		}

		function updateLeaveApp(leaveId,status){
			console.log(leaveId+" "+status);
      //confirm box is a modal
      if(status == 3){
			confirmBox(`<span class="material-icons-outlined" style="color: #F44336;">highlight_off</span>`,status);
        }
        else{
      confirmBox(`<span class="material-icons-outlined" style="color: #29a300;">check_circle</span>`,status);
        }
      //confirm status adds the attr
			confirmStatus('update_leave_no','update_leave_yes',status);
      //disables the button
      if(($('.reject_leave_text').length > 0) && status == 3) {
        $('.confirm_save').attr('disabled',true);
        $(document).on('keyup','.reject_leave_text',function(){
          if($('.reject_leave_text').val() !=""){
          $('.confirm_save').attr('disabled',false);
            }
            else{
              $('.confirm_save').attr('disabled',true);
            }
        })
      }

					$(document).on('click','.confirm_button',function(){
						console.log($(this).attr('button-attr'))
      if(status != null){
          if(($(this).attr('button-attr')) == 'update_leave_no' ){
            $('.confirm_p').empty();
            $('.confirm__').empty();
            $('.confirm__span').empty();
             $('.confirm_save').attr('disabled',false);
              console.log(leaveId+" "+status);
              removeAttribute()
              status = null;
            }

            if(($(this).attr('button-attr')) == 'update_leave_yes'  ){
            removeAttribute()
            console.log(leaveId+" "+status)
            
            if($('.reject_leave_text').length >0){
              let rejectLeaveText = $('.reject_leave_text').val();
              console.log(leaveId+""+status+""+rejectLeaveText)
            var data = 'leaveId='+leaveId+'&status='+status+'&message='+rejectLeaveText;
            }else{
              var data = 'leaveId='+leaveId+'&status='+status;
            }
        
              var params = typeof data == 'string' ? data : Object.keys(data).map(
                  function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
              ).join('&');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', base_url+"leave/updateLeaveApp");
              xhr.onreadystatechange = function() {
                  if (xhr.readyState>3 && xhr.status==200) { 
                    location.reload();
                  }
              };
              xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
              xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              xhr.send(params);
              status = null;
              }
      }
		});
        }

	function confirmStatus(attr1,attr2){
		  $(this).addClass('out');
		  let yesOrNo;
		  $('.confirm_button').eq(0).attr('button-attr',`${attr1}`);
		  $('.confirm_button').eq(1).attr('button-attr',`${attr2}`);
		  $('.confirm_button').on('click',function(){	
		  	if(($('.reject_leave_text').val() != null || $('.reject_leave_text').val() != "") && ($('.reject_leave_text').length > 0)){
          // console.log($('.reject_leave_text').val() +""+$('.reject_leave_text').val() != null)
	  	  $('#modal_confirm__container').addClass('out');
			  $('body').removeClass('modal_confirm__active');
			  	}
        if($('.reject_leave_text').length == 0){
        $('#modal_confirm__container').addClass('out');
        $('body').removeClass('modal_confirm__active');
			  	}
		  })
		};
		function confirmBox(heading,status){
		  $('#modal_confirm__container').removeAttr('class').addClass('five');
		  let modalHeading = `${heading}`;
		  if(status == 3){
		  	$('.confirm_p').empty();
		  	$('.confirm__').empty();
		  	$('.confirm__span').empty();
		  let code = `<div class="form-floating"><textarea type="text" id="date" class="form-control" placeholder="Please mention the reason" required></textarea><label for="date" class="label_text">Start&nbsp;Date</label></div>`;
			  $('.confirm__span').append(code);
		  	$('.confirm_p').html('<span style="color: #F44336">Reject</span>');
		  }
	  	if(status == 2){
		  	$('.confirm_p').empty();
		  	$('.confirm__').empty();
        $('.confirm__span').empty();
	  		$('.confirm_p').html('<span style="color: #29a300">Approve</span>');
	  	}
		  $('.confirm__').append(modalHeading);
		  $('body').addClass('modal_confirm__active');
		};	

		function removeAttribute(){
			  $('.confirm_button').eq(0).removeAttr('button-attr');
			  $('.confirm_button').eq(1).removeAttr('button-attr');
		}


		function applyLeave(){
			var leaveId = document.getElementById("applyLeaveId").value;
			var startDate = document.getElementById("applyLeaveFromDate").value;
			var endDate = document.getElementById("applyLeaveToDate").value;
			var hours = document.getElementById("total-leave-hours").value;
			var notes = document.getElementById("applyLeaveNotes").value;
			//  (leaveId);
			// console.log(startDate);
			// console.log(endDate);
			// console.log(notes);
			// if(leaveId == ""){
			// 	document.getElementById("applyLeaveIdError").innerHTML = "Select a leave type";
			// }
			// else{
			// 	document.getElementById("applyLeaveIdError").innerHTML = "";
			// }
			// if(endDate < startDate){
			// 	document.getElementById("applyLeaveDateError").innerHTML = "End date cannot be less than start date";
			// }
			// else{
			// 	document.getElementById("applyLeaveDateError").innerHTML = "";
			// }
			// if(leaveId != "" && endDate>startDate){
			// 	document.getElementById("applyLeaveForm").submit();
			// }
      if(leaveId == ""){
        alert("Leave Id is Empty");
      }else if(endDate < startDate){
        alert("End Date should be greater than Start Date");
      }else{
        var url = "<?php echo base_url();?>leave/applyLeave";
        $.ajax({
          url : url,
          type:"POST",
          data : {
            applyLeaveId : leaveId,
            applyLeaveFromDate : startDate,
            applyLeaveToDate : endDate,
            applyLeaveNotes : notes,
            total_leave_hours : hours 
          },
          success:function(result){
            // console.log(result);
            var re = jQuery.parseJSON(result);
            if(re.Status == "ERROR"){
              alert(re.Message);
              location.reload();
            }else if(re.Status == "SUCCESS"){
              alert(re.Message);
              location.reload();
            }
            // window.location.reload();
          }
        })
      }
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('change','.center-list',function(){
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>leave?center="+val;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('tbody').html($(response).find('tbody').html());
					}
				});
			});
		})
	</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<?php if( isset($error) != null){ ?>
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
else{

};
?>
<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.close',function(){
      removeAttribute();
    })
  })
</script>
<script type="text/javascript">
  $( ".modal_confirm_" ).draggable();
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#apply_button',function(){
      if($('#applyLeaveId').val() == null){
        $('.total-leave-hours').text('select Leave Type')
        $('#total-leave-hours').prop('disabled',true)
      }
      $(document).on('change','#applyLeaveId',function(){
        if($('#applyLeaveId').val() != null){
          $('.leave_balance').text(parseFloat($('#applyLeaveId :selected').attr('balance')).toFixed(2))
          $('.total-leave-hours').empty();
          $('#total-leave-hours').prop('disabled',false);
        }
        $(document).on('keyup','#total-leave-hours',function(){
          if($('#applyLeaveId').val() != null){
              $('.leave_balance').text(`${
                parseFloat((parseFloat($('#applyLeaveId :selected').attr('balance')).toFixed(2)) - ($('#total-leave-hours').val())).toFixed(2)
              }`)
              console.log()
            if($('#total-leave-hours').val() > (parseFloat($('#applyLeaveId :selected').attr('balance')).toFixed(2)) ){
              $('.total-leave-hours').text('Exceeded Leaves Limit')
              $('.apply_leave').prop('disabled',true)
            }
            else{
              $('.total-leave-hours').empty()
              $('.apply_leave').prop('disabled',false)
            }
          }
        })
        $(document).on('change','#total-leave-hours',function(){
          if($('#applyLeaveId').val() != null){
              $('.leave_balance').text(`${
                parseFloat((parseFloat($('#applyLeaveId :selected').attr('balance')).toFixed(2)) - ($('#total-leave-hours').val())).toFixed(2)
              }`)
            if($('#total-leave-hours').val() > (parseFloat($('#applyLeaveId :selected').attr('balance')).toFixed(2))){
              $('.total-leave-hours').text('Exceeded Leaves Limit')
              $('.apply_leave').prop('disabled',true)
            }
            else if($('#total-leave-hours').val() == null){
              $('.total-leave-hours').text('Value Cannot Be Null')
              $('.apply_leave').prop('disabled',true)
            }
            else if($('#total-leave-hours').val() <= 0){
              $('.total-leave-hours').text('Value Must Be Greater Than 0')
              $('.apply_leave').prop('disabled',true)
            }
            else{
              $('.total-leave-hours').empty()
              $('.apply_leave').prop('disabled',false)
            }
          }
        })
      })
    })
  })
</script>
</html>
