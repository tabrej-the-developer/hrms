<!DOCTYPE html>
<html>
<head>
	<title>Edit Rooms</title>
		<?php $this->load->view('header'); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  th,td,thead,table{
    border: 0px !important;
    border-bottom:0 !important;
    border-top:0 !important;
  }

  *{
font-family: 'Open Sans', sans-serif;
  }
      #wrappers{
        padding:0;
        height: 100vh;
      }
      .submit,.cancel{
            background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px
      }
    body{
      background: #f2f2f2;
     }
    select{
      background: #ebebeb !important;
      border-radius: 5px;
        padding: 5px;
        border: 2px solid #e9e9e9 !important;
    }
    label{
      font-weight: 600;
      color:rgba(0,0,0,0.8);
      font-size: 0.9rem;
    }
    .row{
      margin-left: 0 !important;
      margin-right: 0 !important;
      padding-left: 0 !important;
      padding-right: 0 !important;
    }
    .edit-rooms-heading{
      width: 100%;
      justify-content: center;
    }
    #content-wrappers{
      padding: 4rem 2rem 0 2rem;
      height:calc(100vh - 4rem);
    }
    .content-wrappers-child{
      background: white;
      height: 100%
    }
    .table-overflow{
      max-width: 100%;
      overflow-x: auto;
    }
    .row{
      display: block !important;
    }
    </style>
  </head>

  <body id="page-top"> 
    <?php $permissions = json_decode($permissions); ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewRoomSettingsYN : "N") == "Y"){ ?>   
    <div id="wrappers">
    <span style="position: absolute;top:20px;padding-left: 2rem">
      <a href="<?php echo base_url();?>/settings">
        <button class="btn back-button">
          <img src="<?php echo base_url('assets/images/back.svg');?>">
          <span style="font-size:0.8rem">Edit Rooms</span>
        </button>
      </a>
    </span>
      <div id="content-wrappers"  class="containers">
        <div class="row content-wrappers-child">
           <h4 style="font-weight: 700;
                      margin: 2rem;
                      color: rgba(11, 36, 107);width: 100%"
                class="text-center"> Edit Rooms</h4>

      <div class="col-lg-12 ml-auto d-flex">
        <?php if((isset($permissions->permissions) ? $permissions->permissions->editRoomSettingsYN : "N") == "Y"){ ?>
            <div class="col-9 ml-auto text-right">
                Showing rooms for :
            </div>
          <select id="centerList" class="form-control " onchange="changeCenter()">
            <?php
            $centers = json_decode($centers);
            $count = count($centers->centers);
              for($i=0;$i<$count;$i++) {
                ?><option value="<?php echo $centers->centers[$i]->centerid;?>"><?php echo $centers->centers[$i]->name;?></option>
                <?php
              }
              ?>
          </select> 
        <?php } ?>
          </div>
 
        <div class="col-12 table-overflow">
          <table class="table table-bordered table-striped thead-dark" style="font-size: 0.9rem;background-color: white;width: 90%;margin: auto;margin-top: 20px;text-align: center;">
            <thead>
              <tr>
                <th>Room name</th>
                <th>Room capacity</th>
                <th>Min age <span class="text-small">(in months)</span></th>
                <th>Max age <span class="text-small">(in months)</span></th>
                <th>Ratio</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody id="filterList" > 
                  <?php
                    $room = json_decode($rooms);
                    if($room != null){
                    $count = count($room->rooms);
              for($i=0;$i<$count;$i++) { 	?>
                <tr >
                  <td ><span id="<?php echo 'roomName'.$room->rooms[$i]->name;?>" class="name">
                    <?php echo $room->rooms[$i]->name;?>
                      </span>
                   </td> 
                    <td ><span id="<?php echo 'roomCapacity'.$room->rooms[$i]->capacity;?>" class="capacity">
                      <?php echo $room->rooms[$i]->capacity;?>   
                         </span>
                    </td>
                    <td ><span id="<?php echo 'roomCareAgeFrom'.$room->rooms[$i]->careAgeFrom;?>" class="min">
                      <?php echo $room->rooms[$i]->careAgeFrom;?>
                         </span>
                    </td>
                    <td ><span id="<?php echo 'roomCareAgeTo'.$room->rooms[$i]->careAgeTo;?>" class="max">
                      <?php echo $room->rooms[$i]->careAgeTo;?>
                         </span>
                    </td>
                    <td >
                      <span id="<?php echo 'studentRatio'.$room->rooms[$i]->studentRatio;?>" class="ratio">
                      <?php echo $room->rooms[$i]->studentRatio;?>
                      </span>
                    </td>
                    <td>
                      <?php if(isset($permissions->permissions) ? $permissions->permissions->editRoomSettingsYN : "N" == "Y"){ ?>
                        <span style="cursor: pointer;">
                         <div><i class="fas fa-pencil-alt" style="color: #0077ff;" i-v="<?php echo $room->rooms[$i]->roomId ?>">Edit</i> </div>
                        </span>
                      <?php }else{ echo "-"; } ?>
                    </td>
                    <td>
                      <?php if(isset($permissions->permissions) ? $permissions->permissions->editRoomSettingsYN : "N" == "Y"){ ?>
                        <span style="cursor: pointer;"><i class="fas fa-trash-alt" style="color: #ff3b30;" d-v="<?php echo $room->rooms[$i]->roomId ; ?>">Delete</i> </span>
                      <?php }else{ echo "-"; } ?>
                    </td>
                    </tr>
                    <?php }}?> 
                  <tr id="addRoomValue"></tr>
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

<script type="text/javascript">
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
</script>

  <script type="text/javascript">
    $(document).on('click','.fa-pencil-alt',function(){
      var parent = $(this).parent().parent().parent().parent();
      var parentHtml = parent.html();
      // alert(parentHtml);
      var name = $(this).parent().parent().parent().parent().children().children('.name').text();
       var careAgeFrom  = $(this).parent().parent().parent().parent().children('td').eq(2).children('.min').text();
      var careAgeTo  = $(this).parent().parent().parent().parent().children('td').eq(3).children('.max').text();
      var capacity  = $(this).parent().parent().parent().parent().children('td').eq(1).children('.capacity').text();
      var studentRatio  = $(this).parent().parent().parent().parent().children('td').eq(4).children('.ratio').text();
      var roomId  = $(this).attr('i-v');
      var code = "<td class=\"r-name\"><label>Room Name</label><input type='text' class=\"name\" value="+name+"></td><td class=\"r-capacity\"><label>Room Capacity</label><input type=\"number\" class=\"capacity\" value="+capacity+"></td><td class=\"min-age\"><label>Min age in months</label><input type=\"number\" class=\"min\" value="+careAgeFrom+"></td><td class=\"max-age\"><label>Max-age in months</label><input type=\"number\" class=\"max\" value="+careAgeTo+"></td><td class=\"s-ratio\"><label>Ratio</label><input type=\"number\" class=\"ratio\" value="+studentRatio+"></td><label style=\"display:none\">Room Id</label><input type=\"text\" class=\"id\" style=\"display:none\"><td class=\"s-button\"><button class=\"submit\" i-v="+roomId+">submit</button></td><td class=\"c-button\"><button class=\"cancel\" >cancel</button></td>"
      parent.html(code);      
      $('.cancel').on('click',function(){
        $(this).parent().parent().html(parentHtml);
      })
    })  
  </script>
  <script type="text/javascript">
    $(document).on('click','.submit',function(){
    var response = 'edit';
    var centerid = <?php echo $centerid;?>;
    var name = $(this).parent().parent().children('.r-name').children('.name').val();
    var careAgeFrom = $(this).parent().parent().children('.min-age').children('.min').val();
    var careAgeTo = $(this).parent().parent().children('.max-age').children('.max').val();
    var capacity = $(this).parent().parent().children('.r-capacity').children('.capacity').val();
     var studentRatio = $(this).parent().parent().children('.s-ratio').children('.ratio').val();
     var roomId = $(this).attr('i-v');
     var url = window.location.origin+"/PN101/settings/updateRoom"
      console.log(centerid+" -"+name+" -"+careAgeFrom+" -"+careAgeTo+" -"+capacity+" -"+studentRatio+" -"+roomId)
      $.ajax({
        url : url,
        type: 'POST',
        data:{
          response : response,
          centerid : centerid,
          roomId : roomId,
          name     : name,
          careAgeFrom : careAgeFrom,
          careAgeTo   : careAgeTo,
          capacity    : capacity,
          studentRatio : studentRatio
        },
        success:function(){
          window.location.reload();
        }
      })

    })
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.fa-trash-alt',function(){
          var id = $(this).attr('d-v');
          var url = "http://localhost/PN101/settings/deleteRoom";
          $.ajax({
            url : url,
            type : 'POST',
            data : {
              id : id
            },
            success : function(response){
              location.reload();
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

   
</body>
</html>
