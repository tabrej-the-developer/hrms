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
      #wrappers{
        padding:0;
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
      background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px;
}
    </style>
  </head>

  <body id="page-top"> 
<?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->viewEntitlementsYN : "N" == "Y"){ ?>   
    <div id="wrappers">
      <div id="content-wrappers" style="margin-top: 30px;
    background: white;" class="container">
        <div class="row">
           <h4 class="col-12"><a href="<?php echo base_url();?>center/settings"><button class="btn back-button"> <img src="<?php echo base_url();?>/images/back.png" > </button></a> &nbsp; Entitlements</h4>
<!--           <div class="col-12">
            Entitlements
          </div> -->
      <div class="col-12" style="padding: 10px;"></div>
      <div class=" create-ent" style="cursor: pointer;width: 90%;display: flex;justify-content: flex-end">
       <button class="ent-btn"> Create Entitlement</button>
      </div>
          <div class="col-lg-9 text-right"> 
          <button onclick="addRoom()" class="btn btn-success" style="background-color: transparent;background-image: url(<?php echo base_url();?>images/button.png);
    border: 0px solid;color: white;background-size: cover;">Add Room</button>
        </div>
        <div class="col-12">
          <table class="table table-bordered table-striped thead-dark" style="font-size: 0.9rem;background-color: white;width: 90%;margin: auto;margin-top: 20px;text-align: center;">
            <thead>
              <tr>
                <th>Entitlement Id</th>
                <th>Entitlement name</th>
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
            for($i=0;$i<$count;$i++) {   ?>
              <tr >
                <td ><span id="" class="id">
                        <?php echo $entitlement->entitlements[$i]->id?>
                    </span>
                 </td> 
                <td class="name-parent"><span id="" class="names">
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
                       <div><i class="fas fa-pencil-alt" style="color: #0077ff;" u-v="<?php echo $entitlement->entitlements[$i]->id;?>">Edit</i> </div>
                      </span>
                      <?php }else{ echo "-";} ?>
                  </td>
                  <td>
                  <?php if(isset($permissions->permissions) ? $permissions->permissions->editEntitlementsYN : "N" == "Y"){ ?>
                    <span style="cursor: pointer;"><i class="fas fa-trash-alt" style="color: #ff3b30;" d-v="<?php echo $entitlement->entitlements[$i]->id;?>"></i> Delete</span>
                  <?php }else{ echo "-";} ?>
                  </td>
                  </tr>
                  <?php }}}?> 
            </tbody>
          </table>
        </div>
</div>
        <!-- Sticky Footer -->
     
      </div>


    </div>
<?php } ?>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="row titl">
        <span style="" class="box-name-space col-10">
          <span class="box-name row"></span>
          <span class="box-space row"></span>
        </span>
        <span class="close col-2 d-flex align-items-center" >&times;</span>
      </span>
      
      <div class="modalSpace">
    
      </div>
    </div>
</div>
<!-- <script type="text/javascript">
  function changeCenter(){
      var url = "http://localhost/PN101/settings/editRooms";
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
              var url = window.location.origin + '/PN101/settings/updateEntitlement';
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
       <span style="cursor: pointer;">
          <div>
           <i class="fas fa-check-square" style="color: #0077ff;" u-v=""></i> Create</div>
       </span>
     </td>
     <td>
       <span style="cursor: pointer;">
         <i class="fas fa-trash-alt" style="color: #ff3b30;" d-v=""></i> Cancel</span>
     </td>
   </tr>`;
   
   $('table').append(code)
              }
         });
  </script>
  <script type="text/javascript">
                 $(document).on('click','.fa-check-square',function(){
                 var url = window.location.origin + '/PN101/settings/addEntitlement';
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
     var url = "http://localhost/PN101/updateRoom"
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
          var url = window.location.origin+"/PN101/settings/deleteEntitlement";
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
          var x = parseInt($(this).parent().prev().children().text());
          
          //var y = $(this).attr('cal-p');
          //var eId = $('#employee-id').val($('this').attr('emp-id'))
          //var sDate = $('#start-date').val($(this).attr('curr-date'))
          //var tId = $('#timesheet-id').val($(this).attr('timesheet-id'))
           $.ajax({
            url : "http://localhost/PN101/settings/entitlementsMod/"+x,
            type : 'GET',
            success : function(response){

              $('.modalSpace').html(response)
            }
           })
        })
 
        $(document).on('click','.close',function(){
           modal.style.display = "none";
          // $('timesheet-form').html(htmlVal);
          // $('#timesheet-form').trigger('reset');
        })
</script>


</body>
</html>
