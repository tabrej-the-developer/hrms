<!-- begin::Hero Screen -->
<?php $url=base_url() ?>
<input type="hidden" id="base_url" value="<?= $url=base_url() ?>">
<input type="hidden" id="vizytor_base_url" value="<?= BASE_VIZYTOR_URL ?>">
<section>
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 col-sm-9 p-0 main-frame">
              <img src="<?= $url ?>assets/media/images/home/main-frame.png" alt="main-frame" class="img-fluid p-0 m-0">
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12 m-auto text-center p-3 form-screen">
            <div class="buttons-holder d-flex justify-content-center mb-4 animate__animated animate__wobble">
              <div class="show-case-buttons d-flex justify-content-center p-2 shadow">
                <a href="<?= base_url('register') ?>"><button type="button" class="btn mr-3 text-white" style="border-radius: 40px;"><span>REGISTER</span></button></a>
                <a href="<?= base_url('login') ?>"><button type="button" class="btn ml-3 shadow" style="border-radius: 40px;background: white;color: tomato;"><span>LOGIN</span></button></a>
              </div>
            </div>
                <form action="" method="post" id="loginForm">
                    <div class="form-row">
                        <div class="col-lg-12">

                          <label for="email">EMAIL</label>
                          <input type="text" name="email" class="form-control" placeholder="EMAIL" id="email" data-inputmask="'alias': 'email'">
                        </div>
                        <div class="col-lg-12">

                          <label for="password">PASSWORD</label>
                          <input type="password" name="password" class="form-control" placeholder="PASSWORD" id="password">
                        </div>
                    </div>

                    <div class="form-group">
                      <button type="button" class="btn w-100 shadow la-btn" style="background: #3e957b;color: white;"><span class="spinner-border spinner-border-sm la-btn-loader" role="status" aria-hidden="true"></span>&nbsp;<span class="la-btn-text">LOGIN</span></button>
                    </div>
                </form>
                <div class="la-response-div">
                  <span class="la-response-message"></span>
                  <a href="javascript:void(0);" class="d-block la-response-close" style="font-size:12px;">x(close)</a>
                </div>
          </div>
        </div>
    </div>
</section>
<!-- end::Hero Screen -->
