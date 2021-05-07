<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php $this->load->view('header'); ?>
  <style type="text/css">
    *{
      text-align:center;
    }
    .cardContainer {
      display: flex;
      justify-content: space-between;
      margin-left: 0 !important;

      }
  .footprints{
    height: calc( 100vh - 2rem);
    overflow-y: hidden;
    box-shadow: 0 0 1rem 0.1rem rgba(0,0,0,0.1)
  }
  .activity{
    line-height: 2rem;
  }
  .activity-row{
    line-height: 2.5rem;
    font-size:0.8rem;
    font-weight: 700;
  }
  .activity-heading{
    font-weight: 700;
    line-height: 2.5rem;
  }
  .activity-row:nth-of-type(odd){
    background:#F5F6FA;
  }
  .scrollClass{
    overflow-y: auto;
    height:100%;
  }
  </style>
</head>
<body>
  <div class="containers ">
      <?php
      if(isset($footprints)){
         $footprints = json_decode($footprints); 
        }
      // print_r($footprints);
      ?>
    <div class="row mr-0 mb-5 mb-md-0 mt-3 cardContainer pl-0 pl-md-4 pr-0 pr-md-4">
      <span class="col-12 footprints" style="background: white">
        <span class="row activity" style="border-bottom:1px solid #979797;opacity:0.28">
          <span class="mr-auto pl-3">Activity</span>
          <span class="pr-3">Refresh</span>
        </span>
        <span class="row m-0 p-0 activity-heading">
          <span class="col-2">S.No</span>
          <span class="col-2">IP Address</span>
          <span class="col-2">Date</span>
          <span class="col-2">Last Activity Time</span>
          <span class="col-3">Activity Description</span>
        </span>
        <div class="scrollClass">
        <?php 
          $count = 1;
        foreach($footprints->footprints as $footprint){?>
            <span class="row activity-row" >
              <span class="col-2"><?php echo  $count++ ;?></span>
              <span class="col-2"><?php   echo $footprint->ip ?></span>
              <span class="col-2"><?php   echo explode(" ",$footprint->start_time)[0] ?></span>
              <span class="col-2"><?php   echo explode(" ",$footprint->start_time)[1] ?></span>
              <span style="background:transparent;" class="col-4 "> <?php   echo $footprint->prev_page_tag != " " ? str_replace(base_url(),"",$footprint->prev_page_tag):"Login"; ?></span>
            </span>
      <?php  } ?>
        </div>
      </span>
    </div>
  </div>
  <script type="text/javascript">
    // $(document).ready(()=>{
      $('.containers').css('paddingLeft',$('.side-nav').width());
  // });
  </script>
</body>
</html>