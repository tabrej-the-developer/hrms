<!DOCTYPE html>
<html>
<head>
  <title>PN101</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
  #wrappers{
    background-color: #F3F4F7;
  }
  #content-wrappers-element{
    height: calc(100vh - 5rem);
    padding: 0 2rem 0 2rem;
  }
  .card_future{
    background: rgba(255,255,255);
    overflow-y: scroll;
    height: 100%;
  }
  .back-button{
    display: flex;
    align-items: center;
    border: none;
    padding-left: 2rem;
  }
  #addCenter_heading{
    width: 100%;
    display: flex;
    justify-content: center;
  }
  .input_box{
    width: 33%
  }
    input[type="text"],input[type=time],input[type=date],input[type=email],input[type=number],select,textarea{
      background: #ebebeb !important;
      border-radius: 5px !important;
      padding: 5px !important;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px !important;
      padding-left: 1rem;
      font-size: 0.85rem !important;
      width: 70%
    }
    select{
      background: #E7E7E7 !important;
      border: none !important;
      height: 2.5rem !important;
      border-radius: 20px !important;
      border: 1px solid #D2D0D0 !important;
      padding-left: 1rem !important;
      font-size: 0.75rem !important;
    }
    label{
      display: block;
      width: 100%;
      font-weight: 700;
      margin-bottom: -0.25rem;
      margin-top: 0.25rem
    }
    .street_address{
      width: 67% !important;
      min-height: 5rem;
    }
    .street_address textarea{
      width: 66% !important;
    }
  </style>
</head>
<body id="page-top">
  <?php $permissions = json_decode($permissions); ?>
     <?php require_once('header.php') ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewCenterProfileYN : "N")== "Y"){ ?>
  <div id="wrappers"> 
  <div>
    <span >
      <a href="<?php echo base_url();?>/settings">
        <button class="back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:1.75rem;font-weight: bold;color: rgb(23, 29, 75); ">Edit Center</span>
        </button>
      </a>
    </span>
  </div> 
    <div  id="content-wrappers-element" >
    <div class="card_future" style="padding: 20px;">
  
      <form name="userinput" action="editCenterProfile" method="post" enctype="multipart/form-data" >
          <span id="centerDetailsYo">
            <div class="row">
            <span id="addCenter_heading">Center Details</span>
              
            <div class="" style="padding: 5px;"></div>
            <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> Center Name</label>
              <input type="text" class="" name="center_name" id="ceter name" placeholder="Center name" value="" required>
            </div>
              <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> City</label>
            <input type="text" class="" name="center_city" id="center city" placeholder = "City" value="">
            </div>
            <div class="street_address">
              <label><i style="color: #aa63ff;" class=""></i> Street Address</label>
              <textarea class="street_address" name="center_street" id="center street" placeholder="Street Address"></textarea>
            </div>
               <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> State</label>
              <span class="select_css">
                <select class="" name="center_state" id="center state">
                  <option value=""></option>
                </select>
              </span>
            </div>
              <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> Postcode</label>
              <input class="" type="number" name="center_zip" id="center zip" value="" placeholder = "Postcode" required>
            </div>  
            <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> Centre Phone Number</label>
              <input class="" type="number" name="center_phone" id="centre_phone_number" value="" placeholder = "Centre phone number">
            </div>
              <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> Centre Mobile Number</label>
              <input class="" type="number" name="center_mobile" id="centre_mobile_number" value="" placeholder = "Centre mobile number">
            </div>
              <div class="input_box">
              <label><i style="color: #aa63ff;" class=""></i> Centre Email  </label>
              <input class="" type="email" name="center_email" id="Centre_email " value="" placeholder = "Centre email  ">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Centre ABN</label>
              <input class="" type="text" name="center_abn" id="centre_abn" placeholder="Centre ABN" value="" >
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Centre ACN</label>
              <input class="" type="text" name="center_acn" id="centre_acn" placeholder="Centre ACN" value="">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Centre SE Number</label>
              <input class="" type="text" name="center_se_no" id="centre_se_no" placeholder="Centre SE no" value="">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Center Date Opened</label>
              <input class="" type="date" name="center_date_opened" id="centre_date_opened" placeholder="Center date-opened" value="">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Centre Capacity</label>
              <input class="" type="text" name="center_capacity" id="centre_capacity" placeholder="Centre capacity" value="">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Centre Approval Doc</label>
              <input class="" type="file" name="center_approval_doc" id="centre_approval_doc" placeholder="Centre approval doc" value="" onchange="validate('centre_approval_doc')">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Center CCS Doc</label>
              <input class="" type="file" name="center_ccs_doc" id="centre_ccs_doc" placeholder="Center CCS-doc" value="" onchange="validate('centre_ccs_doc')">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Manager Name</label>
              <input class="" type="text" name="manager_name" id="manager_name" placeholder="Manager-name" value="">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class=""></i> Center Admin Name</label>
              <input class="" type="text" name="center_admin_name" id="centre_admin_name" placeholder="Center admin-name" value="">
            </div>
            <div class="input_box">
              <label>
                <i style="color: #aa63ff;" class="fas "></i> Center Nominated Supervisor</label>
              <input class="" type="text" name="centre_nominated_supervisor" id="centre_nominated_supervisor" placeholder="Center nominated-supervisor" value="">
            </div>
          </div>
        <hr>
          <div class="row">
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
            <input type="number" class="capacity_" name="capacity_[]" value="" placeholder="Capacity" > 
          </div>
          <div class="input_box">
            <label><i style="color: #aa63ff;" class=""></i> Minimum Age</label>
            <input type="number" class="minimum_age" name="minimum_age[]" id="" value="" placeholder="Min age in months">
          </div>
          <div class="input_box">
            <label>
              <i style="color: #aa63ff;" class=""></i> Maximum Age</label>
            <input type="number" class="maximum_age" name="maximum_age[]" id="" value="" placeholder="Max age in months" > 
          </div>
            </div>
          </span> 
        <hr>

          <div class="row text-center justify-content-center align-self-center">
            <div class=""></div>
            <center><button type="submit" class="btn btn-success" style="padding: 6px 30px;"><i style="color: #fff;" class=""></i>&nbsp;  Save</button></center>
          </div>
        </span>
        </form>

    </div>
  </div>  
<div style="padding: 20px;"></div>
</div>
<?php } ?>


<script type="text/javascript">
  $(document).ready(function(){
    var newRoom = $('.room-class').html();
    $(document).on('click','#AddRoom',function(){
      var length = $('.room-class').length;
      $('.room-class').eq(length-1).after(newRoom);
    })
  })
  $(document).ready(()=>{
    $('#wrappers').css('paddingLeft',$('.side-nav').width());
});
</script>
<script type="text/javascript">
  function validate(variable){
    if(($('#'+variable)[0].files[0].size)/(1024*1024) < 4){
      
    }else{
      $('#'+variable).val('');
      alert('File size must be less than 4MB')
    }
  }
</script>
</body>
</html>
