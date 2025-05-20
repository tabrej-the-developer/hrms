<!DOCTYPE html>
<html>
<head>
	<title>Edit Password</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    <div id="wrapper-element">
    <div class="containers scrollY">
		<div class="settingsContainer ">
      <span class="d-flex pageHead heading-bar">
        <div class="withBackLink">
          <a onclick="goBack()" href="#">
            <span class="material-icons-outlined">arrow_back</span>
          </a>				
					<span class="events_title">Password Settings</span>
				</div>
      </span>
        <div class="passwordBoxCont password-box">
          <div class="card_future" >
            <!-- <h4 style="font-weight: 700;margin-bottom: 1rem;color: rgba(11, 36, 107)" class="text-center"> Reset Password</h4> -->
            <div class="col-md-12">
              <div class="form-floating">
                <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="Current Password" required>
                <label for="currentPassword">Current Password</label>
              </div> 
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input class="form-control" type="password" name="newPassword1" id="newPassword1" placeholder="Type new Password" required>
                <label for="newPassword1">Enter New Password</label>
                <span toggle="#password-field" class="material-icons-outlined toggle-password2">visibility_off</span>
              </div> 
            </div>
            <div class="col-md-12">
              <div class="form-floating">
            <input class="form-control" type="password" name="newPassword2" id="newPassword2" placeholder="Confirm new Password" required>
                <label for="newPassword2">Confirm New Password</label>
                <span toggle="#password-field" class="material-icons-outlined toggle-password3">visibility_off</span>
              </div> 
            </div>

            <span class="infoMessage" id="passwordError"></span>
            <div class="formSubmit">
              <button class="btn button_submit btn btn-default btn-small btnOrange" >Reset my password</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 
 
    <!-- /#wrapper-element -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
      $(document).on('click','.button_submit',function(){
        var current = document.getElementById('currentPassword').value;
        var newP2 = document.getElementById("newPassword1").value;
        var newP = document.getElementById("newPassword2").value;
        if(current == ""){
          alert("Please enter current password");
        }else if(newP2 == ""){
          alert("Please enter new password");
        }else if(newP == ""){
          alert("Please enter confirm password");
        }else if(newP != newP2){
          alert("New Password and Confirm Password Mismatch");
        }else if(newP === newP2){ 
            var url = "<?php echo base_url();?>settings/changePassword";
                $.ajax({
                  url : url,
                  type : 'POST',
                  //processData: false,
                  data : {
                    password : newP,
                    passcode : current,
                    
                  },
                  success:function(response){
                      window.location.href = "<?php echo base_url('settings'); ?>"
                    }
                }).fail(function(res){
                  console.log('fail')
                })
              }
              // else{
              //   $('#passwordError').html('Passwords do not match');
              //   var explode = function(){
              //               $('#passwordError').html(' ');
              //             };
              //      setTimeout(explode, 5000);
              // }
          })

      $(document).on('click','.material-icons-outlined',function(){
        // if($(this).hasClass('toggle-password2')){
        //   $(this).html("visibility");
        //   $(this).siblings("input").attr('type','text')
        // }else{
        //   $(this).html("visibility_off");
        //   $(this).siblings("input").attr('type','text')
        // }

        // if($(this).hasClass('toggle-password3')){
        //   $(this).html("visibility");
        //   $(this).siblings("input").attr('type','text');
        // }
        // else{
        //   $(this).html("visibility_off");
        //   $(this).siblings("input").attr('type','text');
        // }
        if($(this).siblings("input").is('input:password')){
          $(this).siblings("input").attr('type','text');
          $(this).html("visibility");
        } else {          
          $(this).siblings("input").attr('type','text');
          $(this).siblings("input").attr('type','password');
          $(this).html("visibility_off");
        }
      })


    $(document).ready(()=>{
      $('.containers').css('paddingLeft',$('.side-nav').width());
  });
  </script>

</body>
</html>

