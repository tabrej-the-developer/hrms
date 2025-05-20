<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <title>Company Settings</title> 
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
      <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">
 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

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

    <div class="containers scrollY">
        <div class="permission-container settingsContainer">

            <span class="d-flex pageHead heading-bar">
                <div class="withBackLink">
                    <a href="<?php echo base_url();?>/settings">
                        <span class="material-icons-outlined">arrow_back</span>
                    </a>				
                    <span class="events_title">Company Settings</span>
                </div>
            </span>
            <?php $codata = json_decode($companydata); ?>
            <form action="" method="post" id="companyForm">
            <div class="companyBoxCont company-box" style="display:grid;place-items:center;">
                <div class="col-md-3">
                    <span class="logoChange">
                    <?php 
if (isset($codata->companydata) && is_object($codata->companydata)) {
    $cI = $codata->companydata->companyLogo;
    $cid = $codata->companydata->companyid;
    ?>
    
    <?php if($cI == ""){ ?>
        <img src="<?= base_url('assets/images/no_image_available.png') ?>" class="todquest-logo dummy-image">
    <?php } else { ?>
        <img src="<?php echo base_url("assets/images/icons/$cI"); ?>" class="todquest-logo dummy-image">
    <?php } ?>

<?php } else { ?>
    <img src="<?= base_url('assets/images/no_image_available.png') ?>" class="todquest-logo dummy-image">
<?php } ?>
                        <input type="file" class="d-none dummy-image-file" id="companyImage" name="companyImage" data-cimage="<?= $cI?>" required>
                        <input type="hidden" name="companyId" id="companyId" value="<?= isset($cid) ?>">
                    </span>
                    <span class="d-block col-md-12 inputfile-box mb30 p-btn">
                        <!-- <input id="profileImage" class="profileImage inputfile" type="FILE" name="profileImage" onchange="uploadFile(this)"> -->
                        <!-- <input id="profileImage" class="profileImage inputfile" type="FILE" name="profileImage"> -->
                        <label for="profileImage">
                            <span id="file-name" class="file-box"></span>
                            <span class="file-button">
                                <span class="material-icons-outlined">publish</span>
                            Select File
                            </span>
                        </label>
                    </span>
                </div>
                <!-- <div class="d-flex justify-content-between d-i-actions mt-2" style="visibility:hidden;">
                    <button type="button" class="btn btn-danger btn-small btnOrange" onclick="location.reload()"><i class="fa fa-fw fa-close"></i></button>
                    <button type="button" class="btn btn-success final-upload-image-update btn-small btnBlue"><i class="fa fa-fw fa-check"></i></button>
                </div> -->
                <div class="clearfix"></div>
                <div class="col-md-3 d-block">
                    <div class="form-floating">
                        <?php
                         if (isset($codata->companydata) && is_object($codata->companydata) && $codata->companydata->emp_id_prefix == "") { 
                                ?>
                                <input class="form-control" type="text" name="emp_id_prefix" id="empcodeprefix" placeholder="Employee Code Prefix" required="">
                            <?php }else{ ?>
                                <input class="form-control" type="text" name="emp_id_prefix" id="empcodeprefix" placeholder="Employee Code Prefix" value="<?= isset($codata->companydata->emp_id_prefix) ?>">
                            <?php }
                        ?>
                        <label for="Employee Code Prefix">Employee Code Prefix</label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <small>Note:This prefix is linked to employee id. Think while you are updating. Once it is updated, employee count will increment from the last employee id with the updated prefix.</small>
                </div>

                <div class="formSubmit d-flex justify-content-center">
                    <button class="btn button_submit btn btn-default btn-small btnOrange" type="reset">Reset</button>
                    <button class="btn button_submit btn btn-default btn-small btnBlue csubmit" type="button">Submit</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>

    function uploadFile(target) {
        document.getElementById("file-name").innerHTML = target.files[0].name;
    }

    //Profile Scripts
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $(".dummy-image").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

    $('.p-btn').click(function(){
        $('.dummy-image-file').trigger('click');
    });

    $('.dummy-image-file').change(function(){
        previewFile(this);
        uploadFile(this);
        $('.p-btn').hide();
        // $('.d-i-actions').css('visibility','visible');
    });


    $('.csubmit').click(function(){
        var baseurl = '<?= base_url('api/settings/postCompanySettings') ?>';
        var cimage = $('#companyImage').data("cimage");
        var file_data = $('#companyImage').prop('files')[0];
   
        var empidprefix = $('#empcodeprefix').val();
        var companyid = $('#companyId').val();
        var userid = '<?= $this->session->userdata('LoginId') ?>';

        var form_data = new FormData();
        form_data.append('emp_id_prefix', empidprefix);
        form_data.append('companyImage', file_data);
        form_data.append('companyId', companyid);
        form_data.append('userid', userid);
        // console.log(form_data.get("companyImage"));
        // File { name: "some-any.jpg", lastModified: 1628482263845, webkitRelativePath: "", size: 62533, type: "image/jpeg" }
        // console.log(form_data.get("emp_id_prefix"));  
        // AMV
        if(empidprefix == ""){
            alert("Please fill employee id prefix");
        }else{
            $.ajax({
                url: baseurl, // <-- point to server-side PHP script 
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type:"POST",
                headers:{
                    "x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
                    "x-token":'<?= $this->session->userdata('AuthToken') ?>'
                },
                beforeSend:function(){
                    $('.csubmit').text('Please wait...');
                    $('.csubmit').attr('disabled',true);
                },
                success: function(result){
                console.log(result);
                $('.csubmit').text('Submit');
                $('.csubmit').attr('disabled',false);
                var da = jQuery.parseJSON(result);
                if(da.Status == "SUCCESS"){
                    alert(da.Message);
                    location.reload();
                }else if(da.Status == "ERROR"){
                    alert(da.Message);
                    location.reload();
                }else{
                    alert(da.Message);
                    location.reload();
                }
                }
            });  
        }                        
    });

</script>


</body>
</html>