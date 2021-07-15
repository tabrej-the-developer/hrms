<!-- begin::Hero Screen -->
<?php $url=base_url() ?>
<input type="hidden" id="base_url" value="<?= $url=base_url() ?>">
<section>
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 col-sm-9 p-0 main-frame">
              <img src="<?= $url ?>assets/media/images/home/main-frame.png" alt="main-frame" class="img-fluid p-0 m-0" style="width: 100%!important;height: 100%!important;">
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12 m-auto text-center p-3 form-screen">
            <div class="buttons-holder d-flex justify-content-center mb-4 animate__animated animate__wobble">
              <div class="show-case-buttons d-flex justify-content-center p-2 shadow">
                <a href="<?= base_url('register') ?>"><button type="button" class="btn mr-3 shadow" style="border-radius: 40px;background: white;color: tomato;"><span>REGISTER</span></button></a>
                <a href="<?= base_url('login') ?>"><button type="button" class="btn ml-3 text-white" style="border-radius: 40px;"><span>LOGIN</span></button></a>
              </div>
            </div>
                <form action="" method="post" id="registerForm">
                    <div class="form-row">
                      <div class="col">
                        <label for="firstName">FIRST NAME</label>
                        <input type="text" name="firstName" class="form-control" placeholder="FIRST NAME" id="firstName" style="text-transform:capitalize;">
                      </div>
                      <div class="col">
                        <label for="lastName">LAST NAME</label>
                        <input type="text" name="lastName" class="form-control" placeholder="LAST NAME" id="lastName" style="text-transform:capitalize;">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="companyName">COMPANY NAME</label>
                      <input type="text" name="companyName" class="form-control" placeholder="COMPANY NAME" id="companyName" style="text-transform:capitalize;">
                    </div>
                    <!-- <div class="form-group">
                      <label for="mobile">MOBILE</label>
                      <input type="tel" name="mobile" class="form-control" data-inputmask="'mask': '999-999-9999'" id="mobile">
                    </div> -->
                    <div class="form-group">
                      <label for="email">EMAIL</label>
                      <input type="text" name="email" class="form-control" id="email" data-inputmask="'alias': 'email'">
                    </div>

                    <div class="form-group">
                      <label for="password">PASSWORD</label>
                      <input type="password" name="password" class="form-control" placeholder="PASSWORD" id="password">
                    </div>
                    <!-- <div class="form-group">
                      <select name="companyId" id="companyId" class="form-control">
                        <option value=""></option>
                      </select>
                    </div> -->
                      <div class="form-group">
                      <select name="appId[]" id="appId" class="form-control"  multiple="multiple">
                        <option value=""></option>
                      </select>
                    </div>
                    <input type="hidden" name="canAddYN" value="Y" id="canAddYN">
                    <input type="hidden" name="userType" value="superadmin" id="userType">
                    <input type="hidden" name="createdBy" value="0" id="createdBy">
                    <div class="form-group">
                      <button type="button" class="btn w-100 shadow ca-btn" style="background: #3e957b;color: white;"><span class="spinner-border spinner-border-sm btn-loader" role="status" aria-hidden="true"></span>&nbsp;<span class="btn-text">GET STARTED NOW</span></button>
                    </div>
                </form>
                <div class="response-div">
                  <span class="response-message"></span>
                  <a href="javascript:void(0);" class="d-block response-close" style="font-size:12px;">x(close)</a>
                </div>
          </div>
        </div>
    </div>
</section>
<!-- end::Hero Screen -->
