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
    </style>
</head>
<body id="page-top">  
	<div id="wrapper">
      <div id="content-wrapper container-styled" class=" container card_future" style="padding-top: 0px;padding: 20px;font-size: 0.9rem;">
        <div class="row">
          <div class="col-12"><a href="<?php echo base_url();?>settings">
            <button class="btn back-button">
              <img src="<?php echo base_url();?>/images/back.png" >
            </button>
          </a>
        </div>
        <div class="col-lg-6 offset-md-3 text-center">
          <label style="text-align: center;">
    Change center profile for </label><br>
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
          </div>
          <div><button class="add-center">Add Center</button></div><!-- 
          <div><button class="add-employee">Add Employee</button></div> -->
        </div>

  <form class="row form-group " name ="mainForm" id="mainForm" method="post" enctype="multipart/form-data" >
    <div class="col-lg-6">
      <input type="hidden" name="centerid" id="centerid" value="<?php echo $centerid;?>">
        <label>Name :</label><br>
        <input class="form-control" type="text" name="centerName" id="centerName" value="<?php echo $center_profile->name;?>" required>
    </div>
    <div class="col-lg-3 offset-md-3" style="margin:0">
      <label>Logo : </label>
       <span id="centerProfileLogo">
        <img src="<?php echo $center_profile->logo;?>" class="img-fluid">
       </span>
    
       <input type="file" class="form-control" name="logoFile" id="logoFile">
     </div>

           <div class="col-12" style="padding: 10px;"></div>
<!--  <div class="col-lg-6">
          <label>Contact Number: </label><br>
          <input class="form-control" type="text" name="centerContactNumber" id="centerContactNumber" value="<?php //echo $center_profile['contactNumber'];?>">
          
          </div>
-->
          <div class="col-12" style="padding: 10px;"></div>
          <div class="col-lg-6">
          <label>Address Street: </label><br>
          <input class="form-control" type="text" name="centerAddStreet" id="centerAddStreet" value="<?php echo $center_profile->addStreet ;?>">
          
          </div>
          <div class="col-lg-6">
          <label>Address City:</label><br>
          <input class="form-control" type="text" name="centerAddCity" id="centerAddCity" value="<?php echo $center_profile->addCity ;?>" required>
          
          </div>
           <div class="col-12" style="padding: 10px;"></div>
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
        <div class="col-12 text-center" style="margin-top: 20px;">
          <button  class="btn btn-success">Save</button>
        </div>
      </form>
       

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
      $(document).on('click','.btn-success',function(e){
          e.preventDefault();
            var url = "http://localhost/PN101/settings/updateCenter";
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
    <!-- Demo scripts for this page-->

<script type="text/javascript">
  function filterCenter(){
    var val = $('select').val();
    var url = "http://localhost/PN101/settings/centerProfile?centerid="+val;
    $.ajax({
      url : url,
      type: 'GET',
      success:function(response){
        $('.form-group').html($(response).find('.form-group').html())
      }
    })
}
</script>
<script type="text/javascript">
  
</script>
<script type="text/javascript">
  $('.add-center').on('click',function(){
    window.location.href="http://localhost/PN101/settings/createCenter"
  })
</script>
<!-- <script type="text/javascript">
  $('.add-employee').on('click',function(){
    window.location.href="http://localhost/PN101/settings/addEmployee"
  })
</script> -->
<script type="text/javascript">
  $(document).ready(()=>{
    $('.container').css('paddingLeft',$('.side-nav').width());
});
</script>
</body>
</html>
