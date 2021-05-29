<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
        label{
          margin-top: 10px;
        }

   .field-icon {
     float: right;
    margin-top: -25px;
    position: relative;
    z-index: 2;
    right: 10px;
    font-size: 15px;
  }
  body{
    background: #F2F2F2 !important;
    overflow-y: hidden;
  }
  .card_future{
    padding: 25px 25%;
    background: white;
    width: 100%;
  }
  .password-box{
    padding: 0rem 4rem 6rem 3rem;
    /* background: white; */
    height: 100vh;
    width: 100%;
  }
  label{
    font-weight: 600;
    color:rgba(0,0,0,0.8);
    margin-top: 1rem;
    font-size: 0.9rem;
    }
    .btn{
      border-radius: 2px !important;
      margin-top: 1rem;
    }
    .button_submit{
      background: rgb(164, 217, 214) !important;
      color: rgb(23, 29, 75);
      padding: 0.7rem !important;
      width: 100%;
      border-radius: 20px !important;
    }
    .form-control{
      padding: 1.3rem !important;
      border-radius: 2px !important;
      border: 1px solid rgba(218, 222, 227,0.9) !important;
    }
    .fa-eye:before{
      opacity: 0.6 !important;
    }
    input[type="text"]{
		background: #ebebeb !important;
		border-radius: 5px !important;
	    padding: 5px !important;
	    border: 1px solid #D2D0D0 !important;
	    border-radius: 20px !important;
	}
</style>
  </head>


  <body id="page-top">  
    <?php require_once('header.php') ?>

    <div id="wrapper-element">
    <div class="containers">
      <span class="pt-1 pl-4 pb-2 d-inline-flex">
        <a onclick="goBack()">
          <button class="btn mt-0 back-button">
            <img src="<?php echo base_url('assets/images/back.svg');?>">
          </button>
        </a>
        <span class="settings_title">Password Settings</span>
      </span>
        <div class="row mr-0 ml-0 password-box">
          <div class="card_future" >
            <h4 style="font-weight: 700;margin-bottom: 1rem;color: rgba(11, 36, 107)" class="text-center"> Reset Password</h4>
            <label>Current Password</label> 

        <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="Current Password" required>
         <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password1"></span>
        <label> Enter New Password</label>
        <input class="form-control" type="password" name="newPassword1" id="newPassword1" placeholder="Type new Password" required>
         <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password2"></span>
        <label> Confirm New Password</label>
        <input class="form-control" type="password" name="newPassword2" id="newPassword2" placeholder="Confirm new Password" required>
         <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password3"></span>

        <span style="color: red;" id="passwordError"></span><br>
        <div style="text-align: center;" class="mt-0">
          <button class="btn button_submit font-weight-bold" >Reset my password</button>
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
        if(newP === newP2)
          { 
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
              else{
                $('#passwordError').html('Passwords do not match');
                var explode = function(){
                            $('#passwordError').html(' ');
                          };
                   setTimeout(explode, 5000);
              }
          })

      $(document).on('click','.fa-fw',function(){
        if($(this).hasClass('fa-eye-slash')){
          $(this).removeClass('fa-eye-slash');
          $(this).addClass('fa-eye');
        }else{
          $(this).removeClass('fa-eye');
          $(this).addClass('fa-eye-slash');
        }
        if($(this).prev().attr('type') == 'text'){
             $(this).prev().attr('type','password')
        }
        else{
          $(this).prev().attr('type','text')
        }
      })


    $(document).ready(()=>{
      $('.containers').css('paddingLeft',$('.side-nav').width());
  });
  </script>

</body>
</html>

