<!DOCTYPE html>
<html>
<head>
	<title>Edit Rooms</title>
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
    .back-button span{
      font-size:1.75rem;
      color: #171D4B;
      font-weight: 700;
    }
      .heading{
      position: relative;
      top:20px;
      padding-left: 2rem;
      width: 100%;
    }
      #wrappers{
        padding:0;
        height:100vh;
      }
.modal {
  display: none; 
  position: fixed;
  padding-top: 10vh;
  padding-bottom: 10vh;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
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
  width: 60%;
  height: calc(80vh);
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  height: 10vh;
  opacity: 1 !important;
}
  .close button{
    height: 6vh;
    margin: auto;
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
}    }
    #wrappers{
      height:100vh;
      overflow-y: hidden;
    }
#content-wrappers{
    padding: 2rem 2rem 2rem 3rem;
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
   .modalSpace{
     height: calc(80vh - 20vh);
   }
   .modalSpace > div > div{
    height: calc(80vh - 20vh);
    overflow: auto;
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
    .header__{
      height: 10vh;
      width: 100%;
      background: #8D91AA;
      color: #F3F4F7;
      font-size: 1.5rem;
      display: flex;
      justify-content: center;
      align-items: center;
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
    </style>
  </head>

  <body id="page-top"> 
<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->viewEntitlementsYN : "N" == "Y"){ ?>   
    <div id="wrappers">
      <span class="d-flex heading align-items-center">
        <span class="d-flex align-items-center">
          <a href="<?php echo base_url('settings');?>">
            <button class="btn back-button">
              <img src="<?php echo base_url('assets/images/back.svg');?>">
            </button>
          </a>
          <span class="settings_title">Entitlement View</span>
        </span>
        <span class=" create-ent ml-auto">
          <button class="button ent-btn">
            <i>
              <img src="<?php echo base_url('assets/images/icons/plus.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>Create Entitlement
        </button>
        </span>
      </span>
      <div id="content-wrappers" class="containers">
        <div class="row content-wrappers-child">
          <div class="">
            <table class="table ">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Hourly rate</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody id="filterList" > 
                    <?php
                      $entitlement = json_decode($entitlements);
                      if($entitlement != null){
                if(isset($entitlement->entitlements)){
       $count = count($entitlement->entitlements);
       $x=1;
              for($i=0;$i<$count;$i++) {   ?>
                <tr >
                  <td ><span id="" class="id">
                          <?php echo $x;$x++;?>
                      </span>
                   </td> 
                  <td class="name-parent"><span id="" class="names" entid="<?php echo $entitlement->entitlements[$i]->id?>">
                          <a href="javascript:void(0)"><?php echo $entitlement->entitlements[$i]->name?></a>
                      </span>
                   </td> 
                    <td class="hourly-rate-parent"><span id="" class="hourly-rate">
                          <?php echo $entitlement->entitlements[$i]->hourlyRate?>
                         </span>
                    </td>


                    <td>
                    <?php if(isset($permissions->permissions) ? $permissions->permissions->editEntitlementsYN : "N" == "Y"){ ?>
                        <span style="cursor: pointer;">
                         <div><i class="fas fa-pencil-alt" style="color: #0077ff;" u-v="<?php echo $entitlement->entitlements[$i]->id;?>">
                            <i>
                              <img src="<?php echo base_url('assets/images/icons/pencil.png'); ?>" style="max-height:01rem;margin-right:10px">
                            </i>
                         </i> </div>
                        </span>
                        <?php }else{ echo "-";} ?>
                    </td>
                    <td>
                    <?php if(isset($permissions->permissions) ? $permissions->permissions->editEntitlementsYN : "N" == "Y"){ ?>
                      <span style="cursor: pointer;"><i class="fas fa-trash-alt" style="color: #ff3b30;" d-v="<?php echo $entitlement->entitlements[$i]->id;?>">
                        <i>
                          <img src="<?php echo base_url('assets/images/icons/del.png'); ?>" style="max-height:01rem;margin-right:10px">
                        </i>
                      </i></span>
                    <?php }else{ echo "-";} ?>
                    </td>
                    </tr>
                    <?php }}}?> 
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
<?php } ?>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

<div id="myModal" class="modal">
    <!-- Modal content -->

    <div class="modal-content">
      <div class="header__">Assigned List</div>
<!--       <span class="row titl">
        <span style="" class="box-name-space col-10">
          <span class="box-name row"></span>
          <span class="box-space row"></span>
        </span>
      </span> -->
      
      <div class="modalSpace">
    
      </div>
      <span class="close d-flex justify-content-center align-items-center" >
        <button class="button">Close</button>
      </span>
    </div>
</div>
<!-- <script type="text/javascript">
  function changeCenter(){
      var url = window.location.origin+"/PN101/settings/editRooms";
      var centerid  = $('select').val();
      $.ajax({
        url:url,
        type:'POST',
        data : {centerid : centerid},
        success:function(response){
          $('table').html($(response).find('table').html());
        }
      })
  }
</script> -->

  <script type="text/javascript">

    $(document).on('click','.fa-pencil-alt',function(){
        var parent1 = $(this).parent().parent().parent().prev().prev();
        var parent2 = $(this).parent().parent().parent().prev();
        var parent3 = $(this).parent().parent().parent();
        var parent4 = $(this).parent().parent().parent().next();
        var code1 = "<input name='name' value="+parent1.text()+" class='c2'>";
        var code2 = "<input name='hourly-rate' value="+parent2.text()+" class='c1'>";
        var code3 = "<button name='submit' class='submit-edit'>Submit</button>";
        var code4 = "<button name='cancel' class='cancel-edit'>Cancel</button>";
        var id = $(this).attr('u-v');
        var oldParent1 = parent1.html();
        var oldParent2 = parent2.html();
        var oldParent3 = parent3.html();
        var oldParent4 = parent4.html();
            parent1.html(code1);
            parent2.html(code2);
            parent3.html(code3);
            parent4.html(code4);
          $('.cancel-edit').on('click',function(){
              parent1.html(oldParent1)
              parent2.html(oldParent2)
              parent3.html(oldParent3)
              parent4.html(oldParent4)
          })

          $('.submit-edit').on('click',function(){
              var url = '<?php echo base_url();?>settings/updateEntitlement';
              var rate = $('.c1').val();
              var name = $('.c2').val();
              $.ajax({
                url : url,
                type : 'POST',
                data : {
                  id : id,
                  name :name ,
                  rate : rate
                },
                success : function(response){
                    window.location.reload();
                }
              })
          })
      });
  </script>
    <script type="text/javascript">
 $(document).on('click','.ent-btn',function(){
        if($('#a1').length){}
   else{
             var code = `<tr >
     <td ><span id="" class="id">
           New Entitlement
           </span>
     </td> 
     <td class="name-parent">
       <span id="" class="name">
         <input type="text" name="name" id="a1">
       </span>
     </td> 
     <td class="hourly-rate-parent">
       <span id="" class="rate" name="rate">
        <input type="text" name="rate" id="a2">
       </span>
     </td>
     <td>
       <span style="cursor: pointer;" id="create_new_entitlements">
          <div>
           <i class="fas fa-check-square" style="color: #0077ff;" u-v=""></i> Create</div>
       </span>
     </td>
     <td>
       <span style="cursor: pointer;" class="fa-trash-alt" id="cancel_new_entitlements">
         <i class="fas " style="color: #ff3b30;" d-v=""></i> Cancel</span>
     </td>
   </tr>`;
   
   $('table').append(code)
              }
         });
  </script>
  <script type="text/javascript">
                 $(document).on('click','.fa-check-square',function(){
                 var url = '<?php echo base_url();?>settings/addEntitlement';
                 var rate = $('#a2').val();
                 var name = $('#a1').val();
                   $.ajax({
                     url : url,
                     type : 'POST',
                     data : {
                       name : name ,
                       rate : rate
                     },
                     success : function(response){
                         window.location.reload();
                     }
                   });
             })
  </script>
<!--   <script type="text/javascript">
    $(document).on('click','.submit',function(){
    var response = 'edit';
    var centerid = <?php// echo $centerid;?>;
    var name = $(this).parent().parent().children('.r-name').children('.name').val();
    var careAgeFrom = $(this).parent().parent().children('.min-age').children('.min').val();
    var careAgeTo = $(this).parent().parent().children('.max-age').children('.max').val();
    var capacity = $(this).parent().parent().children('.r-capacity').children('.capacity').val();
     var studentRatio = $(this).parent().parent().children('.s-ratio').children('.ratio').val();
     var roomId = $(this).attr('i-v');
     var url = window.location.origin+"/PN101/updateRoom"
     $.ajax({
          url : url,
          type : 'POST',
          data :{
                roomId :roomId,
                centerid  : centerid,
                name : name ,
                careAgeTo :careAgeTo,
                careAgeFrom : careAgeFrom,
                capacity :capacity,
                studentRatio :studentRatio,
                response : response
              },
          success:function(response){
            alert('success')
          }
     })

    })
  </script> -->
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.fa-trash-alt',function(){
          var id = $(this).attr('d-v');
          var url = "<?php echo base_url();?>settings/deleteEntitlement";
          $.ajax({
            url : url,
            type : 'POST',
            data : {
              id : id
            },
            success : function(response){
              window.location.reload();
            }
          })
        })
    })
  </script>
<script type="text/javascript">
  $(document).ready(()=>{
    $('#wrappers').css('paddingLeft',$('.side-nav').width());
});
</script>


<script type="text/javascript">
        var modal = document.getElementById("myModal");
        var htmlVal = $('timesheet-form').html();

      $(document).on('click','.names',function(){
           modal.style.display = "block";
          //var arrayType = $(this).attr('array-type');
          //var v = $(this).attr('name');
          //var w = $('.day').eq($(this).index()).html();
          var x = parseInt($(this).attr('entid'));
          //var y = $(this).attr('cal-p');
          //var eId = $('#employee-id').val($('this').attr('emp-id'))
          //var sDate = $('#start-date').val($(this).attr('curr-date'))
          //var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
           $.ajax({
            url : "<?php echo base_url();?>settings/entitlementsMod/"+x,
            type : 'GET',
            success : function(response){
              console.log(response)
              $('.modalSpace').html(response)
            }
           })
        })
 
        $(document).on('click','.close',function(){
           modal.style.display = "none";
          // $('timesheet-form').html(htmlVal);
          // $('#timesheet-form').trigger('reset');
        })

    $(document).on('change','.level_select',function(){
      url = '<?php echo base_url();?>settings/editEmployeeEntitlements';
        var empid = $(this).attr('userid');
        var level = $(this).val()
        $.ajax({
          url : url,
          type : 'POST',
          data : {
            empid : empid,
            level : level
          },
          success : function(response){
            console.log(response)
          }
        })
    })
</script>


</body>
</html>
