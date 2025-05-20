<!DOCTYPE html>
<html>
<head>
	<title>Entitlements</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
 
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
  <?php $permissions = json_decode($permissions); ?>
  <?php if(isset($permissions->permissions) ? $permissions->permissions->viewEntitlementsYN : "N" == "Y"){ ?>   
  <div class="wrapperContainer">
    <?php include 'headerNew.php'; ?>
  
    <div class="containers scrollY">      
      <div class="settingsContainer wrappers">
        
      <span class="d-flex pageHead heading-bar">
          <div class="withBackLink">
            <a href="<?php echo base_url('settings');?>">
              <span class="material-icons-outlined">arrow_back</span>
            </a>				
            <span class="events_title">Entitlement View</span>
          </div>
				  <div class="rightHeader">
            <button class="button ent-btn btn btn-default btn-small btnBlue pull-right">
              <span class="material-icons-outlined">add</span> Create Entitlement
            </button>
          </div>
        </span>

        <div id="content-wrappers">
          <div class="row content-wrappers-child">
            <div class="table-div pageTableDiv">
              <table class="table ">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th class="text-center">Hourly rate</th>
                    <?php if((isset($permissions->permissions) ? $permissions->permissions->editEntitlementsYN : "N") == "Y"){ ?>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody id="filterList"> 
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
                      <td class="hourly-rate-parent text-center" style="text-align:center;"><span id="" class="hourly-rate">
                            <?php echo $entitlement->entitlements[$i]->hourlyRate?>
                          </span>
                      </td>

                      <?php if((isset($permissions->permissions) ? $permissions->permissions->editEntitlementsYN : "N") == "Y"){ ?>
                      <td class="text-center">
                          <span style="cursor: pointer;">
                          <div><i class="fas fa-pencil-alt" style="color: #0077ff;" u-v="<?php echo $entitlement->entitlements[$i]->id;?>">
                            <span class="material-icons-outlined">edit</span>
                          </i> </div>
                          </span>
                      </td>
                      <?php } ?>
                      <?php if((isset($permissions->permissions) ? $permissions->permissions->editEntitlementsYN : "N") == "Y"){ ?>
                      <td style="text-align:center;display: block ruby;">
                        <span style="cursor: pointer;"><i class="fas fa-trash-alt" style="color: #ff3b30;" d-v="<?php echo $entitlement->entitlements[$i]->id;?>">
                          <span class="material-icons-outlined">delete</span>
                        </i></span>
                      </td>
                      <?php } ?>
                      </tr>
                      <?php }}}?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

<div id="myModal" class="modal modalNew">
    <!-- Modal content -->
  <div class="modal-dialog mw-75">
    <div class="modal-content NewFormDesign">
      <div class="modal-header">Assigned List</div>
<!--       <span class="row titl">
        <span style="" class="box-name-space col-10">
          <span class="box-name row"></span>
          <span class="box-space row"></span>
        </span>
      </span> -->
      
      <div class="modal-body modalSpace">
    
      </div>
        <span class="modal-footer withoutModalBody" >
          <button class="close button btn btn-default btn-small pull-right">Close</button>
        </span>
    </div>
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
     <td class="hourly-rate-parent text-center">
       <span id="" class="rate" name="rate">
        <input type="text" name="rate" id="a2">
       </span>
     </td>
     <td class="d-flex justify-content-center">
       <span id="create_new_entitlements">
          <button name="submit" u-v="" class="addEnt">
            <span class="material-icons-outlined">add</span> Create
          </button>
       </span>
     </td>
     <td class="">
      <button class="fa-trash-alt m-auto" id="cancel_new_entitlements">
        <span class="material-icons-outlined">close</span> Cancel
      </button>
     </td>
   </tr>`;
   
   $('table').append(code)
              }
         });
  </script>
  <script type="text/javascript">
                 $(document).on('click','.addEnt',function(){
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
                     success : function(res){
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
          if(confirm("Are you sure to delete?")){
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
          }else{
            location.reload();
          }

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
