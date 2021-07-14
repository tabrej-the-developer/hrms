<!-- begin::Our Apps -->
<?php $url=base_url() ?>
<section class="" style="display: grid;place-items:center;height:100%;width:100%;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-sm-12 col-md-12 m-auto">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="d-flex justify-content-between">
        <p class="mb-0 lead">App settings</p>
        <a href="<?= base_url('logout') ?>" class="text-danger" style=""><img src="<?= $url ?>assets/images/logout.png" class="img-fluid" width="20" height="20" alt=""></a>
        </div>
        <hr>
    <div class="media text-muted pt-3 spotlist d-none">
      <div class="image border d-flex justify-content-center align-items-center" style="width:60px;height:60px;">
        <img src="<?= $url ?>assets/media/images/logos/spotlist.png" class="img-fluid" alt="">
      </div>
      <div class="media-body mt-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-dark">&nbsp;Spotlist</strong>
          <a href="#" class="btn btn-primary btn-sm mb-2" style="width:20%;">Authorize</a>
        </div>
      </div>
    </div>
    <div class="media text-muted pt-3 vizytor d-none">
      <div class="image border d-flex justify-content-center align-items-center" style="width:60px;height:60px;">
        <img src="<?= $url ?>assets/media/images/logos/vizytor.png" class="img-fluid">  
      </div>  
      <div class="media-body mt-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-dark">&nbsp;Vizytor</strong>
          <a href="#" class="btn btn-success btn-sm mb-2" style="width:20%;">Use</a>
        </div>
      </div>
    </div>
    <div class="media text-muted pt-3 hrms d-none">
      <div class="image border d-flex justify-content-center align-items-center" style="width:60px;height:60px;">
        <img src="<?= $url ?>assets/media/images/logos/hrms.png" class="img-fluid">  
      </div> 
      <div class="media-body mt-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-dark">&nbsp;HRMS</strong>
          <a href="#" class="btn btn-primary btn-sm mb-2" style="width:20%;">Authorize</a>
        </div>
      </div>
    </div>
    <div class="media text-muted pt-3 kronicle d-none">
      <div class="image border d-flex justify-content-center align-items-center" style="width:60px;height:60px;">
        <img src="<?= $url ?>assets/media/images/logos/kronicle.png" class="img-fluid">  
      </div>  
      <div class="media-body mt-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-dark">&nbsp;Kronicle</strong>
          <a href="#" class="btn btn-primary btn-sm mb-2" style="width:20%;">Authorize</a>
        </div>
      </div>
    </div>
    <?php foreach($userapps as $ua) : ?>
        <div class="media text-muted pt-3">
          <div class="image border d-flex justify-content-center align-items-center" style="width:80px;height:80px;">
            <img src="<?= $ua->appLogo ?>" class="img-fluid">  
          </div>  
          <div class="media-body mt-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-end align-items-center">
              <form action="<?= base_url('app-dashboard') ?>" method="post">
                <input type="hidden" name="appName" value="<?= $ua->appName ?>">
                <?php
                  if($ua->loginAccess == "Y"){ ?>
                    <button type="submit" class="btn btn-success btn-sm m-0">7days Trial&nbsp;</button>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-danger btn-sm m-0">Trial Ended</button>
                  <?php }
                ?>
              </form>
            </div>
          </div>
        </div>
    <?php endforeach ?>
    <div class="d-flex justify-content-between">
      <small class="d-block text-left mt-3 text-capitalize">
        <?= $this->session->userdata('firstName') ?>&nbsp;<?= $this->session->userdata('lastName') ?>
      </small>
      <small class="d-block text-right mt-3 text-capitalize">
        <?= $this->session->userdata('companyName') ?>
      </small>
    </div>

  </div>
      </div>
    </div>
  </div>
</section>
<!-- end::Our Apps -->