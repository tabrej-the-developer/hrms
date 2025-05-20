<!DOCTYPE html>
<html>
<head>
<title>Leaves</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

  
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(1) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(1)::after {
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
      <div class="dashboradContainer ">

        <div class="button_class pageHead">
          <span class="events_title">Meeting Onboard <span class="sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>"></span></span>
          <div class="rightHeader">       
          </div>
        </div>

        <div class="card">
          <?php 
          $present = json_decode($present);
          // print_r($present);
          $len = count($present);
          ?>
          <form action="<?php echo base_url() ?>mom/meetingRecord/<?php echo $mId; ?>" method="post">
            <div class="card-body">
              <div class="row NewFormDesign">

                <div class="col-md-12">
                  
                  <div class="d-flex">  
                    <div class="form-floating">
                      <select name="invites[]" id="meetingName" class="form-control">
                            <?php for($i = 0; $i < $len; $i++) { ?>
                            <option value="<?php echo $present[$i]->uid ?>"><?php echo $present[$i]->name; ?></option>
                            <?php } ?>
                        </select>
                      <label for="meetingName">Meeting Name</label>
                    </div> 
                    <button type="button" onclick="addMore()" class="btn-blank">
                      <span class="material-icons-outlined">add_circle_outline</span>
                    </button>
                  </div>

                  <div class="form-floating">
                    <textarea id="meetingDetails" name="sentence[]" id="" cols="30" rows="1" class="form-control"></textarea>
                    <label for="meetingDetails">Meeting Details</label>
                  </div> 
                </div>



              </div>

            </div>
          </form>
        </div>
        
        <div class="formSubmit">
            <button type="submit" class="btn btn-default btn-small btnOrange pull-right">
              <span class="material-icons-outlined">hourglass_top</span>
              End
            </button>
          </div>
      </div>
    </div>
</div>
<body>
 
<script>
 
 function addMore(){
     var div = document.getElementsByClassName('card-body');
     var row = document.createElement('div');
     row.classList.add('row','NewFormDesign');
 row.innerHTML = '<div class="col-md-12"><div class="d-flex"><div class="form-floating"><select name="invites[]" id="" class="form-control"><?php for($j = 0 ; $j < $len;$j++){ ?><option value="<?php echo $present[$j]->uid; ?>"><?php echo $present[$j]->name; ?></option><?php } ?></select><label for="meetingName">Meeting Name</label></div><button type="button" onclick="addMore()" class="btn-blank"><span class="material-icons-outlined">add_circle_outline</span></button></div><div class="form-floating"><textarea name="sentence[]" id="" cols="30" rows="1" class="form-control"></textarea></div></div>';
    div[0].appendChild(row);
 }

</script>
<script type="text/javascript">
  $(document).ready(()=>{
    // $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
	
</html>