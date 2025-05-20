<!DOCTYPE html>
<html>
<head>
<title>Xero Settings</title>
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
    <div class="containers scrollY">
		  <div class="settingsContainer ">
        <?php $permissions = json_decode($permissions); 
              $xeroTokens = json_decode($xeroTokens);
              $centers = json_decode($centers);
              // print_r(json_encode($xeroTokens));
        ?>  
          <div id="wrappers">

            <span class="d-flex pageHead heading-bar">
              <div class="withBackLink">
                <a href="<?php echo base_url('settings');?>">
                <span class="material-icons-outlined">arrow_back</span>
                </a>				
                <span class="events_title">Xero Settings</span>
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
                        <!-- <th>Access Token</th> -->
                        <!-- <th>Expires In</th> -->
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="filterList" >
                    <?php  if(isset($xeroTokens->center)){ ?> 
                      <?php foreach($xeroTokens->center as $xeroToken){ ?>
                      <tr >
                        <td >
                          <span id="" class="id">
                            <?php 
                              foreach($centers->centers as $center){
                                if($center->centerid == $xeroToken[1]->centerid){
                                  echo $center->name; 
                                }
                              }
                            ?>
                          </span>
                        </td> 
                        <!-- <td class="name-parent">
                          <span id="" class="names">
                            <a href="javascript:void(0)"><?php echo ""; ?></a>
                          </span>
                        </td>  -->
                          <!-- <td class="hourly-rate-parent">
                            <span id="" class="hourly-rate">
                              <?php echo isset($xeroToken[0]) ? $xeroToken[0]->expires_in : ""; ?>
                            </span>
                          </td> -->
                          <td>
                            <span>
                              <?php 
                              if(isset($xeroToken[0]) && $xeroToken[0] != null){
                                $date = explode(" ",$xeroToken[0]->created_at);
                                $time = explode(":",$date[1]);
                                echo dateToDayAndYear($date[0])." - ".$time[0].":".$time[1]; 
                                // print_r($xeroToken[0]->created_at);
                              }
                              ?>
                            </span>
                          </td>
                   
                          <td class="xero_button" style="text-align:center;">
                            <?php if(isset($xeroToken[0]) != null ? false : true){ ?>
                                <a class="btn btn-default btn-small btnOrange" href="<?php echo base_url().'api/xero/startOauth/'.$this->session->userdata('LoginId').'/'.$xeroToken[1]->centerid; ?>" target="_blank">
                                  Create Xero Token
                                </a>
                          <?php }else{ ?>
                            <span>
                              Token Created
                            </span>
                          <?php } ?>
                          </td>
                          </tr>
                          <?php } 
                        } ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


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
});
</script>


</body>
</html>
