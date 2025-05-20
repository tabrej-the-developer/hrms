<!DOCTYPE html>
<html>
<head>
<title>Kidsoft Settings</title>
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
    <?php $permissions = json_decode($permissions); ?>  
      <div id="wrappers" class="containers scrollY">
        <div class="settingsContainer ">

        <span class="d-flex pageHead heading-bar">
          <div class="withBackLink">
            <a href="<?php echo base_url('settings');?>">
            <span class="material-icons-outlined">arrow_back</span>
            </a>				
            <span class="events_title">Kidsoft Settings</span>
          </div>
          <div class="rightHeader">
            
          </div>
        </span>

      <div id="content-wrappers" >
        <div class="row content-wrappers-child">
          <div class="table-div pageTableDiv">
            <table class="table ">
              <thead>
                <tr>
                  <th>Center Name</th>
                  <th>Service Key</th>
                  <th>Created At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="filterList" > 
                <?php
                $kidsoft = json_decode($kidsoft);
                  foreach($kidsoft as $details){ ?>
                <tr>
                  <td><?php echo $details->centerName ?></td>
                  <td class="kidsoftKey" cent-val="<?php echo isset($details->center) ? $details->center : "" ?>"><?php echo isset($details->kidsoftkey) ? $details->kidsoftkey : "- -" ?></td>
                  <td><?php echo $details->createdate ?></td>
                  <td class="action" style="text-align:center;">
                    <?php if(!isset($details->createdate)){ ?>
                    <div class="addKey">
                      <span class="material-icons-outlined">add_circle_outline</span>
                    </div>
                    <?php }else{ ?>
                    <div class="">
                      <span class="editKey" >
                        <span class="material-icons-outlined">edit</span>
                      </span>
                      <span updateVal="del" class="deleteKey">
                        <span class="material-icons-outlined">delete</span>
                      </span>
                    </div>
                    <?php } ?>
                  </td>
                </tr>
                <?php  } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
<?php 
    function dateToDayAndYear($date){
      $date = explode("-",$date);
      return date("M d, Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
    } 
?>
<script type="text/javascript">
  $(document).ready(()=>{
    // $('#wrappers').css('paddingLeft',$('.side-nav').width());

    $(document).on('click','.addKey',function(){
      let code = `<input class="kidsoftKeyValue">`;
      let buttonscode = `<div>
                    <span updateVal="add" class="yesClass">
                      <img updateVal="add" height="22" width="22" src="<?php echo base_url('assets/images/icons/tick.png') ?>">
                    </span>
                    <span class="noClass">
                      <img height="20" width="20" src="<?php echo base_url('assets/images/icons/x.png') ?>">
                    </span>
                  </div>`;
      $(this).parent().parent('tr').children('.kidsoftKey').html(code);
      $(this).parent().html(buttonscode);
    })

    $(document).on('click','.noClass',function(){
      $(this).parent().parent().parent().find('.kidsoftKey').html("- -")
      $(this).parent().parent().parent().find('.action').html(`<div class="addKey">
                      <span>
                        <img src="<?php echo base_url('assets/images/plus.png') ?>">
                      </span>
                    </div>`)
    })

    $(document).on('click','.editKey',function(){
      let buttonscode = `<div>
                    <span updateVal="upd" class="yesClass">
                      <img height="22" width="22" src="<?php echo base_url('assets/images/icons/tick.png') ?>">
                    </span>
                    <span class="noClassFilled">
                      <img height="20" width="20" src="<?php echo base_url('assets/images/icons/x.png') ?>">
                    </span>
                  </div>`;
      let key = $(this).parent().parent().parent().children('.kidsoftKey').text();
      let code = `<input class="kidsoftKeyValue" value="${key}">`;
                $(this).parent().parent().parent().children('.kidsoftKey').html(code);
      $(this).parent().parent().html(buttonscode);
    })

    $(document).on('click','.noClassFilled',function(){
      window.location.reload();
    })

    $(document).on('click','.deleteKey , .yesClass ',function(){
      let url = "<?php echo base_url('settings/updateKidsoftKey'); ?>"
      var key;
      if($(this).attr('updateVal') == 'del'){
        key = null;
      }
      else{
        key = $('.kidsoftKeyValue').val();
      }
      let centerid = $(this).parent().parent().parent().children('.kidsoftKey').attr('cent-val');
      let updateVal = $(this).attr('updateVal');
      console.log(key + " " +centerid + " " +updateVal)
      $.ajax({
        url : url,
        method : 'POST',
        data : {
          key : key,
          centerid : centerid,
          updateVal : updateVal
        },
        success : function(response){
          window.location.reload();
        }
      })
    })

});
</script>


</body>
</html>
