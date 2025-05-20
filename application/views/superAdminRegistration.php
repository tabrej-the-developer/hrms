<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- BOOTSTRAP JS  -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/bootstrap.js') ?>">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet"> 
    <!-- ICON FONT -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <!-- SELECT2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <!-- TATA JS -->
    <script src="<?= base_url('assets/js/tata.js') ?>"></script>
    <title>SUPERADMIN-REGISTRATION</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        input{
            box-shadow:none!important;
        }
        .header{
            height:100px;
            background:#6439b1!important;
        }
        .main-form{
            margin-top: -50px !important;
            background: white;
            box-shadow: 0px 1px 21px -5px rgba(0,0,0,0.44);
            -webkit-box-shadow: 0px 1px 21px -5px rgba(0,0,0,0.44);
            -moz-box-shadow: 0px 1px 21px -5px rgba(0,0,0,0.44);
        }
        fieldset.border{
            border-left: 3px solid #e8a257 !important;
        }
    </style>
</head>
<body>
<div class="container-fluid header">
    <div class="row">

    </div>
</div>
<!-- start::FORM START -->
<div class="container-fluid bg-white">
    <div class="row">
        <div class="col-lg-10 p-5 m-auto main-form">
            <center><h2><img src="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>" alt="">&nbsp;HRMS101 SUPERADMIN REGISTRATION FORM</h2></center>
            <form action="" method="post" enctype="multipart/form-data" id="saForm">
            <br>
            <!-- COMPANY INFORMATION BLOCK -->
            <div class="row m-auto">
                <fieldset class="border p-2">
                    <legend  class="w-auto" style="margin-top: -25px;background: white !important;">COMPANY INFORMATION</legend>
                    <div class="row p-2">
                        <div class="col-md-4">
                            <small class="font-weight-bold">Logo</small><sup><span class="text-danger">*</span></sup>
                            <input type="file" name="company_logo" id="company_logo" class="form-control company_logo" required>
                        </div>
                        <div class="col-md-4">
                            <small class="font-weight-bold">Name</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="company_name" id="company_name" class="form-control company_name" placeholder="Company Name" style="position:relative;" required>
                        </div>
                        <div class="col-md-4">
                            <small class="font-weight-bold">Employee ID Prefix</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="emp_id_prefix" id="emp_id_prefix" class="form-control emp_id_prefix text-uppercase" placeholder="Ex:AMV" required onkeypress="return /[a-z]/i.test(event.key)">
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- COMPANY INFORMATION BLOCK -->
            <br>
            <!-- BASIC USER INFORMATION BLOCK -->
            <div class="row m-auto">
                <fieldset class="border p-2">
                    <legend  class="w-auto" style="margin-top: -25px;background: white !important;">BASIC USER INFORMATION</legend>
                    <div class="row p-2">
                        <div class="col-md">
                            <small class="font-weight-bold">First Name</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="user_first_name" id="user_first_name" class="form-control user_first_name" placeholder="First Name" required>
                        </div>
                        <div class="col-md">
                            <small class="font-weight-bold">Last Name</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="user_last_name" id="user_last_name" class="form-control user_last_name" placeholder="Last Name" required>
                        </div>
                        <div class="col-md">
                            <small class="font-weight-bold">Email</small><sup><span class="text-danger">*</span></sup>
                            <input type="email" name="user_email" id="user_email" class="form-control user_email" placeholder="Email" required>
                        </div>
                        <div class="col-md">
                            <small class="font-weight-bold">Password</small><sup><span class="text-danger">*</span></sup>
                            <input type="password" name="user_password" id="user_password" class="form-control user_password" placeholder="Password" required>
                        </div>
                        <div class="col-md">
                            <small class="font-weight-bold">Alias</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="user_alias" id="user_alias" class="form-control user_alias" placeholder="Alias" required>
                        </div>
                    </div>
                </fieldset>
            </div>
            <input type="hidden" name="role" id="role" value="1">
            <input type="hidden" name="created_by" id="created_by" value="">
            <!-- BASIC USER INFORMATION BLOCK -->
            <br>
            <!-- CENTER INFORMATION BLOCK -->
            <div class="row m-auto">
                <fieldset class="border p-2">
                    <legend  class="w-auto" style="margin-top: -25px;background: white !important;">CENTER INFORMATION</legend>
                    <div class="row p-2">
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">Name</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="center_name" id="center_name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">Street</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="center_street" id="center_street" class="form-control" placeholder="Street" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">City</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="center_city" id="center_city" class="form-control" placeholder="City" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">State</small><sup><span class="text-danger">*</span></sup>
                            <input type="text" name="center_state" id="center_state" class="form-control" placeholder="State" required>
                        </div>
                        
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">Zip</small>
                            <input type="text" name="center_zip" id="center_zip" class="form-control" placeholder="Zip" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">Telephone</small>
                            <input type="text" name="center_phone" id="center_phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">Mobile</small>
                            <input type="text" name="center_mobile" id="center_mobile" class="form-control" placeholder="Mobile" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <small class="font-weight-bold">Email</small>
                            <input type="text" name="center_email" id="center_email" class="form-control" placeholder="Email" required>
                        </div>

                    </div>
                </fieldset>
            </div>
            <!-- CENTER INFORMATION BLOCK -->
            <br>
            <!-- PERMISSION INFORMATION BLOCK -->
            <div class="row m-auto">
                <fieldset class="border p-2">
                    <legend  class="w-auto" style="margin-top: -25px;background: white !important;">PERMISSION INFORMATION</legend>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <select name="permission_control" id="permission_control" class="form-control">
                            <option value="sa">Select All</option>
                                <option value="cm">Center Manager</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="row appending-element">
                            <script>
                                $(document).ready(function(){
                                    $('.entitlements-multiple').select2({
                                        width: '100%'
                                    });

                                    var psp = "sa";
                                    function permissionSelect(psp){
                                        if(psp == "sa"){
                                                var sa_array = ['QR READER','VIEW ROSTER','EDIT ROSTER','VIEW TIMESHEET','EDIT TIMESHEET','VIEW PAYROLL',
                                            'EDIT PAYROLL','EDIT LEAVE TYPES','VIEW LEAVE TYPES','CREATE NOTICE','VIEW ORG CHART','EDIT ORG CHART','VIEW CENTER PROFILE',
                                            'VIEW ENTITLEMENTS','EDIT ENTITLEMENTS','EDIT EMPLOYEES','XERO SETTINGS','VIEW AWARDS','EDIT AWARDS','VIEW SUPERFUNDS','EDIT SUPERFUNDS',
                                            'CREATE MOM','EDIT PERMISSIONS','VIEW PERMISSIONS','KIDSOFT PERMISSIONS'];
                                        }else{
                                            var sa_array = ['VIEW ROSTER','EDIT ROSTER','VIEW TIMESHEET','EDIT TIMESHEET','VIEW PAYROLL',
                                            'EDIT LEAVE TYPES','VIEW LEAVE TYPES','VIEW ORG CHART','EDIT ORG CHART','VIEW CENTER PROFILE',
                                            'EDIT EMPLOYEES','CREATE MOM','EDIT PERMISSIONS','VIEW PERMISSIONS'];
                                        }

                                        var set_count = 0;
                                        var show_count = 5;
                                        var get_count = sa_array.length;
                                        var split_count = Math.round(get_count / show_count);

                                        $('.appending-element').empty();

                                        for(var i=0; i<split_count; i++){
                                            for(var j=set_count; j<get_count; j++){
                                                // console.log(sa_array[j]);
                                                set_count++;
                                                var string = `<div class="col-md-3">
                                                <div class="form-check form-check-inline row_line_${j}">
                                                    <input class="form-check-input" name="permissions[]" type="checkbox" id="permissions" value="${sa_array[j]}" checked>
                                                    <label class="form-check-label" for="inlineCheckbox2">${sa_array[j]}</label>
                                                </div>    
                                                </div>`;
                                                $('.appending-element').append(string);
                                            }
                                        }

                                    }

                                    $('#permission_control').change(function(){
                                        var permissionval = $(this).val();
                                        permissionSelect(permissionval);
                                    });

                                    // Run time load
                                    permissionSelect(psp);

                                });
                            </script>

                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- PERMISSION INFORMATION BLOCK -->
            <br>
            <!-- ENTITLEMENT INFORMATION BLOCK -->
            <div class="row m-auto">
                <fieldset class="border p-2">
                    <legend  class="w-auto" style="margin-top: -25px;background: white !important;">ENTITLEMENTS INFORMATION</legend>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <select class="entitlements-multiple form-control" name="entitlements-multiple[]" id="entitlements-multiple" multiple="multiple">
                                <?php
                                    // $fileHandle = fopen("https://thattimelessbookshop.com/wp-content/uploads/2019/03/cats.csv", "r");
                                    // $furl = base_url('assets/files/sheet1.csv');
                                    // echo $furl;
                                    $fileHandle = fopen(FCPATH."assets/files/sheet1.csv", "r");
                                    while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
                                    $classification = $row[0];
                                    $hourlyrate = $row[3];
                                ?>
                                    <option value="<?php echo $classification;?>||<?php echo $hourlyrate;?>"><?php echo $classification;?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- ENTITLEMENT INFORMATION BLOCK -->
            <br>
            <div class="row m-auto">
                <div class="col-md-1">
                    <button type="button" class="form-control btn-outline-primary form-save">Save</button>
                </div>
                <div class="col-md-1">
                    <button type="reset" class="form-control btn-outline-secondary">Reset</button>
                </div>
                <div class="col-md-10 d-flex justify-content-end">
                    <small>Powered by <img src="<?= base_url('assets/images/icons/Todquest_logo.png') ?>" alt="" width="60" height="50"></small>
                </div>
            </div>
            <br>
            </form>
        </div>
    </div>
</div>    
<!-- end::FORM END -->
<br>
<br>

<!-- begin::SCRIPTS -->
<script>
    $(document).ready(function(){

        // check unique while click
        var finalurl = '<?= base_url('api/settings/uniqueChecks') ?>';

        function companynameUnique(cnu){
            $.ajax({
                url:finalurl,
                type:'POST',
                data:{
                    "companyName":cnu
                },
                success:function(result,status,xhr){
                    // console.log(result);
                    // {"status":"SUCCESS","message":"NO COMPANY NAME EXISTS","data":true}
                    var da = jQuery.parseJSON(result);
                    if(da.status == "SUCCESS"){
                        $('#company_name').css("border", "1px solid green");
                        // alert(da.message);
                    }else{
                        $('#company_name').css("border", "1px solid red");
                        tata.error(da.message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                        // alert(da.message);
                    }
                }
            });
        }

        function empidprefixUnique(eip){
            $.ajax({
                url:finalurl,
                type:'POST',
                data:{
                    "empidprefix":eip
                },
                success:function(result,status,xhr){
                    // $('#emp_id_prefix').removeAttr('disabled');
                    // console.log(result);
                    // {"status":"SUCCESS","message":"NO COMPANY NAME EXISTS","data":true}
                    var da = jQuery.parseJSON(result);
                    if(da.status == "SUCCESS"){
                        $('#emp_id_prefix').css("border", "1px solid green");
                        // alert(da.message);
                    }else{
                        $('#emp_id_prefix').css("border", "1px solid red");
                        tata.error(da.message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                        // alert(da.message);
                    }
                }
            });
        }

        function usernameUnique(eip){
            $.ajax({
                url:finalurl,
                type:'POST',
                data:{
                    "name":eip
                },
                success:function(result,status,xhr){
                    // $('#emp_id_prefix').removeAttr('disabled');
                    // console.log(result);
                    // {"status":"SUCCESS","message":"NO COMPANY NAME EXISTS","data":true}
                    var da = jQuery.parseJSON(result);
                    if(da.status == "SUCCESS"){
                        $('#user_first_name').css("border", "1px solid green");
                        // alert(da.message);
                    }else{
                        $('#user_first_name').css("border", "1px solid red");
                        tata.error(da.message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                        // alert(da.message);
                    }
                }
            });
        }

        function useremailUnique(eip){
            $.ajax({
                url:finalurl,
                type:'POST',
                data:{
                    "email":eip
                },
                success:function(result,status,xhr){
                    // $('#emp_id_prefix').removeAttr('disabled');
                    // console.log(result);
                    // {"status":"SUCCESS","message":"NO COMPANY NAME EXISTS","data":true}
                    var da = jQuery.parseJSON(result);
                    if(da.status == "SUCCESS"){
                        $('#user_email').css("border", "1px solid green");
                        // alert(da.message);
                    }else{
                        $('#user_email').css("border", "1px solid red");
                        tata.error(da.message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                        // alert(da.message);
                    }
                }
            });
        }

        function useraliasUnique(eip){
            $.ajax({
                url:finalurl,
                type:'POST',
                data:{
                    "alias":eip
                },
                success:function(result,status,xhr){
                    // $('#emp_id_prefix').removeAttr('disabled');
                    // console.log(result);
                    // {"status":"SUCCESS","message":"NO COMPANY NAME EXISTS","data":true}
                    var da = jQuery.parseJSON(result);
                    if(da.status == "SUCCESS"){
                        $('#user_alias').css("border", "1px solid green");
                        // alert(da.message);
                    }else{
                        $('#user_alias').css("border", "1px solid red");
                        tata.error(da.message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                        // alert(da.message);
                    }
                }
            });
        }

        // COMPANY NAME CHECK UNIQUE
        $('#company_name').on('input',function(){
            var value = $(this).val();
            companynameUnique(value);
        });
        // COMPANY NAME CHECK UNIQUE

        // EMP ID PREFIX CHECK UNIQUE
        $('#emp_id_prefix').on('input',function(){
            var value = $(this).val();
            empidprefixUnique(value);
        });
        // EMP ID PREFIX CHECK UNIQUE

        // USER NAME CHECK UNIQUE
        $('#user_first_name').on('input',function(){
            var value = $(this).val();
            usernameUnique(value);
        });
        // USER NAME CHECK UNIQUE

        // USER EMAIL CHECK UNIQUE
        $('#user_email').on('input',function(){
            var value = $(this).val();
            useremailUnique(value);
        });
        // USER EMAIL CHECK UNIQUE

        // USER ALIAS CHECK UNIQUE
        $('#user_alias').on('input',function(){
            var value = $(this).val();
            useraliasUnique(value);
        });
        // USER ALIAS CHECK UNIQUE



        $('.form-save').click(function(){

            var file_data = $('#company_logo').prop('files')[0];

            var companyLogo = document.getElementById("company_logo").files.length;
            var companyName = document.getElementById('company_name').value;
            var empidprefix = document.getElementById('emp_id_prefix').value;

            var userfirstName = document.getElementById('user_first_name').value;
            var userlastName = document.getElementById('user_last_name').value;
            var userEmail = document.getElementById('user_email').value;
            var userPassword = document.getElementById('user_password').value;
            var userAlias = document.getElementById('user_alias').value;

            var centerName = document.getElementById('center_name').value;
            var centerStreet = document.getElementById('center_street').value;
            var centerCity = document.getElementById('center_city').value;
            var centerState = document.getElementById('center_state').value;
            var centerZip = document.getElementById('center_zip').value;
            var centerTel = document.getElementById('center_phone').value;
            var centerMob = document.getElementById('center_mobile').value;
            var centerEmail = document.getElementById('center_email').value;

            var permissions = new Array();
            $.each($("input[name='permissions[]']:checked"), function () {
                permissions.push($(this).val());
            });

            var entitlements = $('.entitlements-multiple').val();

            if(companyLogo == 0){
                tata.error('UPLOAD COMPANY LOGO','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(companyName == ""){
                tata.error('ENTER COMPANY NAME','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(empidprefix == ""){
                tata.error('ENTER EMP ID PREFIX','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(userfirstName == ""){
                tata.error('ENTER USER FIRST NAME','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(userlastName == ""){
                tata.error('ENTER USER LAST NAME','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(userEmail == ""){
                tata.error('ENTER USER EMAIL','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(userPassword == ""){
                tata.error('ENTER USER PASSWORD','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(userAlias == ""){
                tata.error('ENTER USER ALIAS','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(centerName == ""){
                tata.error('ENTER CENTER NAME','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(centerStreet == ""){
                tata.error('ENTER CENTER STREET','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(centerCity == ""){
                tata.error('ENTER CENTER CITY','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else if(centerState == ""){
                tata.error('ENTER CENTER STATE','<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
            }else{

                var formdata = new FormData();

                var finalurl = '<?= base_url('api/Settings/postSuperadmin') ?>';

                formdata.append('companyImage', file_data);
                formdata.append('companyName', companyName);
                formdata.append('empIdPrefix', empidprefix);

                formdata.append('userfirstName', userfirstName);
                formdata.append('userlastName', userlastName);
                formdata.append('userEmail', userEmail);
                formdata.append('userPassword', userPassword);
                formdata.append('userAlias', userAlias);

                formdata.append('centerName', centerName);
                formdata.append('centerStreet', centerStreet);
                formdata.append('centerCity', centerCity);
                formdata.append('centerState', userAlias);
                formdata.append('centerZip', centerZip);
                formdata.append('centerTelephone', centerTel);
                formdata.append('centerMobile', centerMob);
                formdata.append('centerEmail', centerEmail);

                formdata.append('permissions[]',permissions);

                formdata.append('entitlements[]',entitlements);

                $.ajax({
                    url:finalurl,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,                         
                    type:"POST",
                    beforeSend:function(){
                        $('.form-save').text('Saving...');
                    },
                    success:function(result,status,xhr){
                        $('.form-save').text('Save');
                        console.log(result);
                        var da = jQuery.parseJSON(result);
                        if(da.Status == "SUCCESS"){
                            tata.success(da.Message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                            $('#saForm').trigger('reset');
                            // $("#entitlements-multiple").val('').trigger('change')
                            setTimeout(function(){
                                window.location.reload();
                            },1500);
                        }else if(da.Status == "ERROR"){
                            tata.error(da.Message,'<?= date('d/m/Y H:i:s a') ?>',{position: 'tm'});
                        }
                    }
                });


            }
        });

    });
</script>
<!-- end::SCRIPTS -->

</body>
</html>