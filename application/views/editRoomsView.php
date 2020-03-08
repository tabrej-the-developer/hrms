<!DOCTYPE html>
<html>
<head>
	<title>Edit Rooms</title>
		<?php $this->load->view('header'); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
      #wrappers{
        padding:0;
      }
    </style>
  </head>

  <body id="page-top">    
    <div id="wrappers">

      <div id="content-wrappers" style="margin-top: 90px;
    background: white;" class="container">
        <div class="row">
           <h4 class="col-12"><a href="<?php echo base_url();?>center/settings"><button class="btn back-button"> <img src="<?php echo base_url();?>/images/back.png" > </button></a> &nbsp; Edit Rooms</h4>
          <div class="col-12">
        Showing rooms for :
      </div>
      <div class="col-12" style="padding: 10px;"></div>
      <div class="col-lg-3">
          <select id="centerList" class="form-control" onchange="changeCenter()">
            <?php
            $centers = json_decode($centers);
            $count = count($centers->centers);
              for($i=0;$i<$count;$i++) {
                ?><option value="<?php echo $centers->centers[$i]->centerid;?>"><?php echo $centers->centers[$i]->name;?></option>
                <?php
              }
              ?>
          </select> 
          </div>
          <div class="col-lg-9 text-right"> 
          <button onclick="addRoom()" class="btn btn-success" style="background-color: transparent;background-image: url(<?php echo base_url();?>images/button.png);
    border: 0px solid;color: white;background-size: cover;">Add Room</button>
        </div>
        <div class="col-12">
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
                    <td ><span id="<?php echo 'studentRatio'.$room->rooms[$i]->studentRatio;?>" class="ratio">
                      <?php echo $room->rooms[$i]->studentRatio;?>
                         </span>
                    </td>
                    <td>
                       <span style="cursor: pointer;">
                         <div><i class="fas fa-pencil-alt" style="color: #0077ff;"></i> Edit</div>
                          </span>
                        </td>
                        <td>
                          <span style="cursor: pointer;"><i class="fas fa-trash-alt" style="color: #ff3b30;"></i> Delete</span>
                        </td>
                      </tr>
                    <?php }?> 
                  <tr id="addRoomValue"></tr>
            </tbody>
          </table>
        </div>
</div>
        <!-- Sticky Footer -->
     
      </div>


    </div>

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
      var name = $(this).parent().parent().parent().children('.name').val();
       var careAgeFrom  = $(this).parent().parent().parent().children('.capacity').val();
      var careAgeTo  = $(this).parent().parent().parent().children('.max').val();
      var capacity  = $(this).parent().parent().parent().children('.min').val();
      var studentRatio  = $(this).parent().parent().parent().children('.ratio').val();
      var roomId  = $(this).parent().parent().parent().children('.id').val();
      var code = "<td><label>Room Name</label><input type='text' class=\"name\"></td><td><label>Room Capacity</label><input type=\"number\" class=\"capacity\"></td><td><label>Min age in months</label><input type=\"number\" class=\"min\"></td><td><label>Max-age in months</label><input type=\"number\" class=\"max\"></td><td><label>Ratio</label><input type=\"number\" class=\"ratio\"></td><label style=\"display:none\">Room Id</label><input type=\"text\" class=\"id\" style=\"display:none\"><td><button class=\"subm\">submit</button></td><td><button class=\"cancel\">cancel</button></td>"
      parent.html(code);      
      $('.cancel').on('click',function(){
        $(this).parent().parent().html(parentHtml);
      })
    })  
  </script>
  <script type="text/javascript">
    $(document).on('click','.subm',function(){
    var response = 'edit';
    var centerid = <?php echo $centerid;?>;
    var name = $(this).parent().parent().children().children('.name').val();
    var careAgeFrom = $(this).parent().parent().children().next().next().next().children('.min').val();
    var careAgeTo = $(this).parent().parent().children().next().next().children('.max').val();
    var capacity = $(this).parent().parent().children().next().children('.capacity').val();
     var studentRatio = $(this).parent().parent().children().next().next().next().next().children('.ratio').val();
     var roomId = $(this).parent().prev().val();
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
  </script>


   
</body>
</html>