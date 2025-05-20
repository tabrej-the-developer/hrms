<!DOCTYPE html>
<html>
<head>
  <title>Edit Center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
<body id="page-top">
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
  <div class="containers scrollY">
    <?php $permissions = json_decode($permissions);
          $centerData = json_decode($centerData);
          $centers = json_decode($centers);
          $states = json_decode($states);
          $cD = $centerData->centerDetails;
          $cR = $centerData->centerRecord;
    ?>
    <?php if((isset($permissions->permissions) ? $permissions->permissions->viewCenterProfileYN : "N")== "Y"){ ?>
    <div id="wrappers"> 
      <div class="settingsContainer ">
        <span class="d-flex pageHead heading-bar">
          <div class="withBackLink">
            <a onclick="goBack()" href="#">
              <span class="material-icons-outlined">arrow_back</span>
            </a>				
            <span class="events_title">Edit Center</span>
          </div>
				  <div class="rightHeader">
            <select class="center-list " id="center-list">

              <?php    for($i=0;$i<count($centers->centers);$i++){
                  if($centers->centers[$i]->centerid == $centerid){
              ?>
              <option selected href="javascript:void(0)" 
                  class="center-class" 
                  id="<?php echo $centers->centers[$i]->centerid ?>" 
                  value="<?php echo $centers->centers[$i]->centerid; ?>" >
                    <?php echo $centers->centers[$i]->name?></option>
              <?php } else{ ?>
              <option href="javascript:void(0)" 
                      class="center-class" 
                      id="<?php echo $centers->centers[$i]->centerid ?>" 
                      value="<?php echo $centers->centers[$i]->centerid; ?>">
                      <?php echo $centers->centers[$i]->name?>
              </option>
              <?php   }
              } ?>
            </select>
            <a class="btn btn-default btn-small btnBlue pull-right" href="<?php echo base_url('settings/createCenter');?>">
              Add Center
            </a>
          </div>
        </span>

        <div  id="content-wrappers-element" class="passwordBoxCont" >
          <div class="card_future" style="padding: 20px;">
              <form name="userinput" action="updateCenter" method="post" enctype="multipart/form-data" >
                <span id="centerDetailsYo">
                  <div class="row">

                  <div class="col-md-3">
                    <div class="input_box form-floating">
                      <input type="text" class="form-control" name="center_name" id="ceter_name" placeholder="Center Name" value="<?php echo isset($cD->name) ? $cD->name : ''; ?>" required>
                      <label for="ceter_name">Center Name</label>
                      <input type="text" name="centerid" value="<?php echo $cD->centerid; ?>" style="display: none">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="input_box form-floating">
                      <input type="text" class="form-control" name="center_city" id="center_city" placeholder="City" value="<?php echo isset($cD->addCity) ? $cD->addCity : ''; ?>">
                      <label for="center_city">City</label>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="input_box form-floating">
                          <select class="form-control" name="center_state" id="center_state" value="<?php  echo isset($cD->addState) ? $cD->addState : ''; ?>">
                            <?php foreach($states->states as $state){ 
                              if((isset($cD->addState) ? $cD->addState : '') == $state->stateId ){ ?>
                          <option value="<?php echo $state->stateId; ?>" selected><?php echo $state->stateName; ?></option>
                              <?php }else{ ?>
                          <option value="<?php echo $state->stateId; ?>"><?php echo $state->stateName; ?></option>
                            <?php  } ?>
                          <?php } ?>
                          </select>                          
                          <label for="center_state">State</label>
                      </div>
                  </div>

                    <div class="col-md-3">
                      <div class="street_address form-floating">
                        <textarea class="form-control street_address" name="center_street" id="center_street" placeholder="Street Address"><?php echo isset($cD->addStreet) ? $cD->addStreet : ''; ?></textarea>
                        <label for="center_street"> Street Address</label>
                      </div>
                    </div>
             
                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="number" name="center_zip" id="center_zip" value="<?php echo isset($cD->addZip) ? $cD->addZip : ''; ?>" placeholder = "Postcode" required>
                        <label for="center_zip">Postcode</label>
                      </div>  
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="number" name="center_phone" id="centre_phone_number" value="<?php echo isset($cD->centre_phone_number) ? $cD->centre_phone_number : ''; ?>" placeholder = "Centre phone number">
                        <label for="centre_phone_number">Centre Phone Number</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="number" name="center_mobile" id="centre_mobile_number" value="<?php echo isset($cD->centre_mobile_number) ? $cD->centre_mobile_number : ''; ?>" placeholder = "Centre mobile number">
                        <label for="centre_mobile_number">Centre Mobile Number</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="email" name="center_email" id="Centre_email " value="<?php echo isset($cD->centre_email) ? $cD->centre_email : ''; ?>" placeholder = "Centre email  ">
                        <label for="Centre_email">Centre Email  </label>
                      </div>
                    </div>  
                    
                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="center_abn" id="centre_abn" placeholder="Centre ABN" value="<?php echo isset($cR->centreABN) ? $cR->centreABN : '' ?>" >
                        <label for="centre_abn">Centre ABN</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="center_acn" id="centre_acn" placeholder="Centre ACN" value="<?php echo isset($cR->centreACN) ? $cR->centreACN : '' ?>">
                        <label for="centre_acn">Centre ACN</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="center_se_no" id="centre_se_no" placeholder="Centre SE Number" value="<?php echo isset($cR->centreSE_no) ? $cR->centreSE_no : '' ?>">
                        <label for="centre_se_no">Centre SE Number</label>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="date" name="center_date_opened" id="centre_date_opened" placeholder="Center Date Opened" value="<?php echo isset($cR->centreDateOpened) ? $cR->centreDateOpened : '' ?>">
                        <label for="centre_date_opened">Center Date Opened</label>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="center_capacity" id="centre_capacity" placeholder="Centre Capacity" value="<?php echo isset($cR->centreCapacity) ? $cR->centreCapacity : '' ?>">
                        <label for="centre_capacity">Centre Capacity</label>
                      </div>
                    </div>

      <!--             <div class="input_box">
                    <label>
                      <i style="color: #aa63ff;" class=""></i> Centre Approval Doc</label>
                      <?php if(isset($cR->centreApprovalDoc) && $cR->centreApprovalDoc != null && $cR->centreApprovalDoc != ""){ ?>
                        <a href="<?php echo base_url('api/application/assets/files/').$cR->centreApprovalDoc ?>" download><i>
                          <img src="<?php echo base_url('assets/images/icons/download.png')?>">
                        </i>Download</a>
                        <?php } ?>
                    <input class="" type="file" name="center_approval_doc" id="centre_approval_doc" value="<?php echo isset($cR->centreApprovalDoc) ? $cR->centreApprovalDoc : '' ?>" onchange="validate('centre_approval_doc')">
                  </div>
                  <div class="input_box">
                    <label>
                      <i style="color: #aa63ff;" class=""></i> Center CCS Doc</label>
                      <?php if(isset($cR->centreCCSDoc) && $cR->centreCCSDoc != null && $cR->centreCCSDoc != ""){ ?>
                      <a href="<?php echo base_url('api/application/assets/files/').$cR->centreCCSDoc ?>" download><i>
                        <img src="<?php echo base_url('assets/images/icons/download.png')?>">
                      </i>Download</a>
                    <?php } ?>
                    <input class="" type="file" name="center_ccs_doc" id="centre_ccs_doc" value="" onchange="validate('centre_ccs_doc')">
                  </div> -->


                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="center_capacity" id="centre_capacity" placeholder="Centre Capacity" value="<?php echo isset($cR->centreCapacity) ? $cR->centreCapacity : '' ?>">
                        <label for="centre_capacity">Centre Capacity</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="center_admin_name" id="centre_admin_name" placeholder="Center Admin Name" value="<?php echo isset($cR->centreAdminId) ? $cR->centreAdminId : '' ?>">
                        <label for="centre_admin_name">Center Admin Name</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="input_box form-floating">
                        <input class="form-control" type="text" name="centre_nominated_supervisor" id="centre_nominated_supervisor" placeholder="Center Nominated Supervisor" value="<?php echo isset($cR->centreNominatedSupervisorId) ? $cR->centreNominatedSupervisorId : '' ?>">
                        <label for="centre_nominated_supervisor">Center Nominated Supervisor</label>
                      </div>
                    </div>
              </div>
              <!-- <hr> -->
      <!--           <div class="row">
                  <div class="col-lg-6"><h3>Organize Rooms</h3></div>

                  <div class="" style="padding: 5px;"></div>
                </div>
                <span id="" class="room-class">
                <div class="row">
                <div class="input_box">
                  <label><i style="color: #aa63ff;" class=""></i> Room Name</label>
                  <input type="text" class="room_name" name="room_name[]" id="" value="" placeholder="Room name">
                </div>
                <div class="input_box">
                  <label><i style="color: #aa63ff;" class=""></i> Capacity</label>
                  <input type="number" class="capacity_" name="capacity_[]" value="" > 
                </div>
                <div class="input_box">
                  <label><i style="color: #aa63ff;" class=""></i> Minimum Age</label>
                  <input type="number" class="minimum_age" name="minimum_age[]" id="" value="" placeholder="Min age in months">
                </div>
                <div class="input_box">
                  <label>
                    <i style="color: #aa63ff;" class=""></i> Maximum Age</label>
                  <input type="number" class="maximum_age" name="maximum_age[]" id="" value="" > 
                </div>
                  </div>
                </span>  -->
              <!-- <hr> -->
              <div class="formSubmit">
                <button type="submit" class="btn btn-default btn-small btnOrange pull-right save_submit" style="padding: 6px 30px;"><i style="color: #fff;" class=""></i>&nbsp;  Save</button>
              </div>

            </span>
        </form>

    </div>
  </div>  
<div style="padding: 20px;"></div>
</div>
</div>
</div>
</div>
    <div class="notify_">
      <div class="notify_body">
        <span class="_notify_message">
          
        </span>
        <span class="_notify_close" onclick="closeNotification()">
          &times;
        </span>
      </div>
    </div>
<?php } ?>


<script type="text/javascript">
  $('body').on('change','#center-list',function(){
    var centerid = $('#center-list').val();
    // alert(centerid);
    var url = "<?php echo base_url();?>settings/centerProfile/"+centerid
    $.ajax({
      url : url,
      type : 'GET',
      success : function(response){
        console.log(response)
        $('#content-wrappers-element').html($(response).find('#content-wrappers-element').html());
          // document.getElementById('center-list').value = parseInt(centerid);
      }
    })
  })

//   $(document).ready(()=>{
//     if($(document).width() > 1024){
//         $('#wrappers').css('paddingLeft',$('.side-nav').width());
//     }
// });

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


  function validate(variable){
    if(($('#'+variable)[0].files[0].size)/(1024*1024) < 4){
      
    }else{
      $('#'+variable).val('');
      addMessageToNotification('File size must be less than 4MB');
      showNotification();
      setTimeout(closeNotification,5000)
    }
  }


</script>
</body>
</html>
