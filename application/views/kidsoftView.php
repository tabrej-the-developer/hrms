<!DOCTYPE html>
<html>
<head>
	<title>Kidsoft Settings</title>
		<?php $this->load->view('header'); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
    *{
  font-family: 'Open Sans', sans-serif;
    }
    body{
      background: #f2f2f2;
    }
      .heading{
      position: relative;
      padding-left: 2rem;
      width: 100%;
      height: 4rem;
    }
    .heading > span{
      display: flex;
      align-items: center;
    }
    #wrappers{
      padding:0;
      height:100vh;
    }
    .modal {
      display: none; 
      position: fixed;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0); 
      background-color: rgba(0,0,0,0.4); 
    }
    input[type="text"],input[type=time],select,#casualEmp_date{
      background: #ebebeb;
      border-radius: 5px;
      padding: 5px;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px;
    }
    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      border: 1px solid #888;
      width: 80%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    .ent-btn{
      background: #ebebeb;
      border-radius: 5px;
      padding: 5px;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px;
      text-align: center;
    }   
    #wrappers{
      height:100vh;
      overflow-y: hidden;
    }
    #content-wrappers{
        padding: 0  2rem 2rem 3rem;
        height:calc(100vh - 4rem);
    }
    .content-wrappers-child{
        background: white;
        height: 100%;
        overflow-y: auto;
    }
    .row{
      display: block !important;
    }
    .table td, .table th {
        padding: 1rem !important;
        vertical-align: top;
         border-top: 0px !important; 
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 0 !important;
    }
    .submit-edit,.cancel-edit{

    }
    .submit-edit,
    .cancel-edit,
    .button,
    #create_new_entitlements,
    #cancel_new_entitlements{
      border: none;
      color: rgb(23, 29, 75);
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-weight: 700;
      margin: 2px;
      width:auto;
      border-radius: 20px;
      padding: 8px;
      background: rgb(164, 217, 214);
    }
    .fa-pencil-alt,.fa-trash-alt{
      color: #171D4B !important;
      font-weight: 700;
      font-style: normal;
    }
  .create-ent{
    display: flex;
    margin-right:2rem;
    justify-content: center;
    align-items: center;
  }
  .row{
    margin: 0 !important;
  }
  .table{
    font-size: 1rem;
    background-color: white;
    width: 100%;
    margin: auto;
    text-align: center;
   }
    thead tr{
      background-color: #8D91AA;
      color: #F3F4F7;
    }
    tr{
      border-top:  1px solid #d2d0d0;
      border-bottom: 1px solid #d2d0d0;
    }
    tbody tr{
      background: white !important;
    }
.button{
  /*position: absolute;*/
/*  right: 0;*/
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
    border-radius: 20px !important;
    padding: 4px 8px !important;
    background: rgb(164, 217, 214) !important;
    font-size: 1rem !important;
    margin-right:5px !important;
    justify-content: center !important;
    display: flex;
    align-items: center;
    }
    .button a{
      font-size: 1rem;
      color: #171d4b;
    }
    .xero_button{
      display: flex;
      justify-content: center;
    }
    </style>
  </head>

  <body id="page-top"> 
<?php $permissions = json_decode($permissions); 
?>  
    <div id="wrappers">
      <span class="d-flex heading">
        <span>
          <a href="<?php echo base_url('settings');?>">
            <button class="btn back-button">
              <img src="<?php echo base_url('assets/images/back.svg');?>">
            </button>
          </a>
        <span class="settings_title">Kidsoft Settings</span>
        </span>
        <span class=" create-ent ml-auto">
 <!--          <button class="button ent-btn">
            <i>
              <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>Create Entitlement
        </button> -->
        </span>
      </span>
      <div id="content-wrappers" class="containers">
        <div class="row content-wrappers-child">
          <div class="">
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
                  <td class="action">
                    <?php if(!isset($details->createdate)){ ?>
                    <div class="addKey">
                      <span>
                        <img src="<?php echo base_url('assets/images/plus.png') ?>">
                      </span>
                    </div>
                    <?php }else{ ?>
                    <div class="">
                      <span class="editKey" >
                        <img height="15" weight="15" src="<?php echo base_url('assets/images/icons/pencil.png') ?>">
                      </span>
                      <span updateVal="del" class="deleteKey">
                        <img height="15" weight="15" src="<?php echo base_url('assets/images/icons/del.png') ?>">
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
    $('#wrappers').css('paddingLeft',$('.side-nav').width());

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
