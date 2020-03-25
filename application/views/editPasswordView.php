<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
       <style>
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
       </style>
  </head>


  <body id="page-top">  
    <?php require_once('header.php') ?>

    <div id="wrapper">
    <div class="container" style="margin-top: 65px;">
        <div class="row">
          <div class="col-lg-6 offset-lg-3 card_future" style="padding: 20px;">
            <h4><a href="<?php echo base_url();?>/settings"><button class="btn back-button"> <img src="<?php echo base_url();?>/images/back.png"  > </button></a> Change Password</h4>
            <label>Current Password</label>

        <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="Current Password" required>
         <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password1"></span>
        <label> Enter New Password</label>
        <input class="form-control" type="password" name="newPassword1" id="newPassword1" placeholder="Type new Password" required>
         <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
        <label> Re-enter New Password</label>
        <input class="form-control" type="password" name="newPassword2" id="newPassword2" placeholder="Retype new Password" required>
         <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password3"></span>

        <span style="color: red;" id="passwordError"></span><br>
        <div style="text-align: center;">
        <button class="btn btn-success" style="margin: auto;">Submit</button>
      </div>
      </div>
   
      </div>
    </div>
  </div>
 
 
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
      $(document).on('click','.btn-success',function(){
        
           var url = "http://localhost/PN101/settings/changePassword";
           var current = document.getElementById('currentPassword').value;
            var newP = document.getElementById("newPassword1").value;

            $.ajax({
              url : url,
              type : 'POST',
              //processData: false,
              data : {
                password : newP,
                passcode : current,
                
              },
              success:function(response){
                console.log(response)
                }
            }).fail(function(res){
              console.log('fail')
            })
          })
    </script>
    <script type="text/javascript">
      $(document).on('click','.fa-fw',function(){
        
        if($(this).prev().attr('type') == 'text'){
          
             $(this).prev().attr('type','password')
         
        }
        else{
          $(this).prev().attr('type','text')
        }
      })

    </script>

</body>
</html>