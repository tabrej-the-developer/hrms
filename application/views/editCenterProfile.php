<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header.php');?>
	<title>Center Profile</title>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
      *{
    font-family: 'Open Sans', sans-serif;
      } 
      .add-center,.add-employee{
        background-color: #9E9E9E;
        border: none;
        color: white;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 2px
       } 
     body{
      background: #f2f2f2;
     }
     .wrapper-element-child{
      padding: 4rem 2rem 0 2rem;
      height: 95vh;
     }
     .row{
      margin-left: 0 !important;
      margin-right:0 !important;
     }
     #content-wrapper-element{
      background:white !important;
      padding:0 12rem 2rem 12rem !important;
      height: 100%;
     }
     .btn-success{
      background: rgba(64, 152, 20) !important;
      padding: 0.7rem !important;
      width: 30%;
    }
    .col-lg-6{
      padding-bottom: 1rem;
    }
    select{
      background: #ebebeb !important;
      border-radius: 5px;
        padding: 5px;
        border: 2px solid #e9e9e9 !important;
    }
    .center-select{
      display: flex;
      justify-content: center !important;
    }
    .heading-class::after{
      content: ' ';
      border-bottom: 1px solid  gray;
    }
    label{
      font-weight: 600;
      color:rgba(0,0,0,0.8);
      font-size: 0.9rem;
    }
    @media only screen and (max-width:600px){
    .wrapper-element-child{
      padding: 4rem 1rem 0 1rem;
      height: 100%;
     }
     #content-wrapper-element{
      background:white !important;
      padding:0 0rem 2rem 0rem !important;
      height: 100%;
     }
    }
    </style>
</head>
<body id="page-top">  
  <?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->viewCenterProfileYN : "N" == "Y"){ ?>
	<div id="wrapper-element">
      <span style="position: absolute;top:20px;padding-left: 2rem">
        <a href="<?php echo base_url();?>/settings">
          <button class="btn back-button">
              <img src="<?php echo base_url('assets/images/back.svg');?>">
               <span style="font-size:0.8rem">Edit Center Profile</span>
          </button>
        </a>
      </span>
    <div class="wrapper-element-child">
      <div id="content-wrapper-element" class=" container card_future" style="padding-top: 0px;padding: 20px;font-size: 0.9rem;">
        <div class="d-flex heading-class">
          <h4 style="font-weight: 700;padding:2rem 0;margin-bottom: 0rem;color: rgba(11, 36, 107)" class="text-center"> Edit Center Profile</h4>
          <div class=" center-select ml-auto align-items-center">
            <div class="d-flex pr-2">
              <span class="select_css">
                <select id="centerList" class="form-control" onchange="filterCenter()">
                  <?php
                  $centers = json_decode($centers);
                    foreach ($centers->centers as $center) {
                      ?>
                      <option value="<?php echo $center->centerid?>" <?php if($center->centerid == $centerid) echo "Selected";?>><?php echo $center->name;?></option>
                      <?php
                    }
                    ?>
              </select>
            </span>
          </div>
          <span><button class="add-center">Add Center</button></span><!-- 
          <div><button class="add-employee">Add Employee</button></div> -->
        </div>
        </div>


  <form class="row form-group " name ="mainForm" id="mainForm" method="post" enctype="multipart/form-data" >
    <div class="row">
      <div class="row d-block" style="margin:0">
        <label>Logo : </label>
        <div class="row d-flex">
          <span id="centerProfileLogo" class="col-3">
            <img src="<?php echo $center_profile->logo;?>" class="img-fluid" >
          </span>
          <span class="col-3">  
           <input type="file" class="form-control" name="logoFile" id="logoFile" >
          </span>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <input type="hidden" name="centerid" id="centerid" value="<?php echo $centerid;?>">
        <label>Name :</label><br>
        <input class="form-control" type="text" name="centerName" id="centerName" value="<?php echo $center_profile->name;?>" required>
    </div>
<!--  <div class="col-lg-6">
          <label>Contact Number: </label><br>
          <input class="form-control" type="text" name="centerContactNumber" id="centerContactNumber" value="<?php //echo $center_profile['contactNumber'];?>">
          
          </div>
-->
          <div class="col-lg-6">
          <label>Address Street: </label><br>
          <input class="form-control" type="text" name="centerAddStreet" id="centerAddStreet" value="<?php echo $center_profile->addStreet ;?>">
          
          </div>
          <div class="col-lg-6">
          <label>Address City:</label><br>
          <input class="form-control" type="text" name="centerAddCity" id="centerAddCity" value="<?php echo $center_profile->addCity ;?>" required>
          
          </div>
        <div class="col-lg-6">
          <label>Address State:</label><br>
          <input name="addressState" id="addressState" class="form-control" value="<?php echo $center_profile->addState ;?>">
        </div>
                    <div class="col-lg-6">
         <label> Postcode:</label><br>
          <input class="form-control" type="number" name="centerZip" id="centerZip" value="<?php echo $center_profile->addZip;?>" required>
          </div>

             <div class="col-12" style="padding: 10px;"></div>
     <!--   <div class="col-12">
       		<label> About: </label><br>
          	<textarea name="centerAbout" id="centerAbout" class="form-control">
            <?php //echo $center_profile['about'];?>
          	</textarea>
    </div> -->
  <?php if(isset($permissions->permissions) ? $permissions->permissions->editCenterProfileYN : "N" == "Y"){ ?>
        <div class="col-12 text-center" style="margin-top: 20px;">
          <button  class="btn btn-success">Save</button>
        </div>
  <?php } ?>
      </form>
       

       </div>
      <!-- /.content-wrapper-element -->
      </div>
    </div>
  <?php } ?>
    <!-- /#wrapper-element -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
<?php if(isset($permissions->permissions) ? $permissions->permissions->editCenterProfileYN : "N" == "Y"){ ?>
    <script type="text/javascript">
      $(document).on('click','.btn-success',function(e){
          e.preventDefault();
            var url = window.location.origin+"/PN101/settings/updateCenter";
            var centerid = document.getElementById("centerid").value;
            var logo = document.getElementById("logoFile").value;
            var name = document.getElementById("centerName").value;
            var addStreet = document.getElementById("centerAddStreet").value;
            var addCity = document.getElementById("centerAddCity").value;
            var addState = document.getElementById("addressState").value;
            var addZip = document.getElementById("centerZip").value;
            $.ajax({
              url : url,
              type : 'POST',
              //processData: false,
              data : {
                centerid : centerid,
                logo : logo,
                name : name,
                addStreet : addStreet,
                addCity : addCity,
                addState : addState,
                addZip : addZip,
                
              },
               //cache : false,
              success:function(response){
                console.log(response)
                }
            }).fail(function(res){
              console.log('fail')
            })
          })
    </script>
  <?php } ?>
    <!-- Demo scripts for this page-->

<script type="text/javascript">
  function filterCenter(){
    var val = $('select').val();
    var url = window.location.origin+"/PN101/settings/centerProfile?centerid="+val;
    $.ajax({
      url : url,
      type: 'GET',
      success:function(response){
        $('.form-group').html($(response).find('.form-group').html())
        // $('body').html(response)
      }
    })
}
</script>
<script type="text/javascript">
  
</script>
<script type="text/javascript">
  $('.add-center').on('click',function(){
    window.location.href = window.location.origin+"/PN101/settings/createCenter"
  })
</script>
<!-- <script type="text/javascript">
  $('.add-employee').on('click',function(){
    window.location.href=window.location.origin+"/PN101/settings/addEmployee"
  })
</script> -->
<script type="text/javascript">
  $(document).ready(()=>{
    $('#wrapper-element').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>
