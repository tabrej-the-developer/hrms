<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Awards Settings</title>
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
.bd-example-modal-lg .modal-dialog{
    display: table;
    position: relative;
    margin: 0 auto;
    top: calc(50% - 24px);
  }
  
  .bd-example-modal-lg .modal-dialog .modal-content{
    background-color: transparent;
    border: none;
  }
</style>
</head>
<body>
	
<div class="wrapperContainer">
    <?php include 'headerNew.php'; ?>
	<?php
	 	$centers = json_decode($centers);
		function dateToDay($date){
			$date = explode("-",$date);
			return date("M d",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
		}
	?>
	<!-- begin::LOADER FOR AJAX REQUESTS -->
	<div class="modal fade bd-example-modal-lg showloader" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="width: 48px">
				<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
				</div>
			</div>
		</div>
	</div>
	<!-- end::LOADER FOR AJAX REQUESTS -->

	<div class="containers scrollY">
		<div class="settingsContainer">

			<span class="d-flex pageHead heading-bar">
				<div class="withBackLink">
					<a href="<?php echo base_url('settings');?>">
						<span class="material-icons-outlined">arrow_back</span>
					</a>				
					<span class="events_title">Awards</span>
				</div>
				<div class="rightHeader">
					<select placehdr="Center" id="centerValue" name="centerValue" >
						<?php 
						foreach($centers->centers as $center){ 
						if(isset($centerid) && $centerid == $center->centerid ){
						?> 
							<option value="<?php echo $center->centerid;?>" selected><?php echo $center->name;?></option>
						<?php }else{ ?>
							<option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
						<?php  }  
						}	?>
					</select>
					<span class="sync_button">
						<button type="button" id="awards" class="<?php 
						if(isset($syncedWithXero->syncedWithXero) && $syncedWithXero->syncedWithXero != null){
						if($syncedWithXero->syncedWithXero == 'N'){
							echo 'disabled';
						}
						}
						?> btn btn-default btn-small btnOrange pull-right" <?php 
						if(isset($syncedWithXero->syncedWithXero) && $syncedWithXero->syncedWithXero != null){
						if($syncedWithXero->syncedWithXero == 'N'){
							echo "disabled";
						}
						}
						?>>
							
							<img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:02rem;margin-right:10px">
							Sync&nbsp;Xero&nbsp;Awards
						</button>						
					</span>
					<button class="addAward btn btn-default btn-small btnBlue pull-right">Add Awards</button>
				</div>
			</span>
			
			<div class="awards-container">
				<div style="height:100%">
				<?php
					$permissions = json_decode($permissions);
					?>
				<?php if((isset($permissions->permissions) ? $permissions->permissions->viewAwardsYN : "N") == "Y"){ ?>

				<?php if((isset($permissions->permissions) ? $permissions->permissions->editAwardsYN : "N") == "Y"){ ?>

				<?php } ?>

				<div class="table-div pageTableDiv">
					<table class="table">
						<thead>
							<th class="alignCenter">S.No</th>
							<th>Name</th>
							<th class="alignCenter">Exempt Tax</th>
							<th class="alignCenter">Exempt Super</th>
							<th class="alignCenter">Reportable</th>
							<th class="alignCenter">Earning Type</th>
							<th class="alignCenter">Rate Type</th>
							<th class="alignCenter">Multiplier Amount</th>
							<th class="alignCenter">Current Record</th>
							<th class="alignCenter w58">Action</th>
						</thead>
						
						<tbody id="tbody">
						<textarea id="awards-data" cols="30" rows="10" class="d-none"><?= $awards ?></textarea>
						<?php
							$awards = json_decode($awards);				
							$x=1;
							foreach($awards->awards as $award){
						?>
							<tr>
									<td class="alignCenter s-no"><?php echo $x; ?></td>
									<td><?php echo $award->name; ?></td>
									<td class="alignCenter"><?php echo $award->isExemptFromTaxYN; ?></td>
									<td class="alignCenter"><?php echo $award->isExemptFromSuperYN; ?></td>
									<td class="alignCenter"><?php echo $award->isReportableAsW1; ?></td>
									<td class="alignCenter"><?php echo $award->earningType; ?></td>
									<td class="alignCenter"><?php echo $award->rateType; ?></td>
									<td class="alignCenter"><?php echo $award->multiplier_amount; ?></td>
									<td class="alignCenter"><?php echo $award->currentRecordYN; ?></td>
									<td class="alignCenter w58">
										<span class="material-icons-outlined edit editAward" style="cursor:pointer;" title="edit"
										data-earningRateId="<?= $award->earningRateId ?>"
										data-name="<?= $award->name ?>"
										data-isExemptFromTaxYN="<?= $award->isExemptFromTaxYN ?>"
										data-isExemptFromSuperYN="<?= $award->isExemptFromSuperYN ?>"
										data-isReportableAsW1="<?= $award->isReportableAsW1 ?>"
										data-earningType="<?= $award->earningType ?>"
										data-rateType="<?= $award->rateType ?>"
										data-multiplier_amount="<?= $award->multiplier_amount ?>"
										data-currentRecordYN="<?= $award->currentRecordYN ?>">edit</span>
										<span class="material-icons-outlined delete" data-earningRateId="<?= $award->earningRateId ?>" style="cursor:pointer;" title="delete">delete</span>
									</td>
								<?php 
								$x++;
								?>
							</tr>
						<?php		} ?>

						
						</tbody>
			
					</table>
					<script>
						$('#tbody').on('click','.delete',function(){
							var userid = $('#userid').val();
							var centerid = $('#centerid').val();
							var erid = $(this).data('earningrateid');
							// alert(erid);
							var awardsdata = JSON.parse($("#awards-data").text());
							// alert(typeof(awardsdata));
							// alert(typeof(awards));
							var removeIndex = awardsdata.awards.map(function(item) { return item.earningRateId; }).indexOf(erid);
							awardsdata.awards.splice(removeIndex, 1);
							var finaldata = awardsdata.awards;
							// alert("userid:"+userid + "centerid:" + centerid + "type:DEL" + "fidaafdel:"+JSON.stringify(finaldata));
							//Here i need to post the new json
							$.ajax({
								url:'<?= base_url('api/xero/addXeroAwards') ?>',
								type:"POST",
								headers:{
									"x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
									"x-token":'<?= $this->session->userdata('AuthToken') ?>'
								},
								data:JSON.stringify({
									"userid":userid,
									"centerid":centerid,
									"type":"DEL",
									"fidaafdel":finaldata
								}),
								//Show modal when it is on processing and hide it when it processed
								beforeSend:function(){
									//alert("Please Wait....");
									$('.showloader').modal('show');
								},
								success:function(result,status,xhr){
									$('.showloader').modal('hide');
									// console.log(result);
									var da = jQuery.parseJSON(result);
									//console.log(da);
									// console.log(result);
									if(da.Status == "OK"){
										// alert("Hello");
										$("#awards").trigger("click");
									}else if(da.ErrorNumber == 10){
										alert(da.Message);
										// alert("Hello Failed");
									}
								}
								
							});
							// alert(erid+"<br>"+JSON.stringify(awardsdata));
							
						});
					</script>
			
				</div>
			<div>
		</div>
	</div>
</div>
<?php } ?>
		</div>
	</div>
</div>

<!-- begin::ADD MODAL -->
<div class="addAwardForm modal modalNew" style="display: none;">
	<div class="modal-dialog mw-40">
		<div class="modal-content NewFormDesign">
			<div class="modal-header">
				<h3 class="modal-title ">Add Awards</h3>
			</div>
			<div class="modal-body">
				<form>
				<script>
					$(document).ready(function(){
						$('#multiplier-div,#typeofunits-div,#rateperunit-div').hide();
					});
					$('body').on('click','#sabtn',function(){
						var userid = $('#userid').val();
						var centerid = $('#centerid').val();
						var award = $('#award-name').val();

						if(award == ""){
							alert("Enter Award");
						}else if(userid == ""){
							alert("Userid is missing");
						}else if(centerid == ""){
							alert("Centerid is missing");
						}else{
							$.ajax({
								url:'<?= base_url('api/xero/addXeroAwards') ?>',
								type:"POST",
								headers:{
									"x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
									"x-token":'<?= $this->session->userdata('AuthToken') ?>'
								},
								data:JSON.stringify({
									"userid":userid,
									"centerid":centerid,
									"type":"ADD",
									"Name":award,
									"RateType":$('#rateType').val(),
									"Amount":$('#amount').val(),
									"Multiplier":$('#multiplier').val(),
									"TypeOfUnits":$('#typeofunits').val(),
									"RatePerUnit":$('#rateperunit').val(),
									"AllowanceType":$('#allowanceType').val(),
									"IsExemptFromTax":$('#eTax').val(),
									"IsExemptFromSuper":$('#eSuper').val(),
									"EarningsType":$('#earningType').val(),
									"IsReportableAsW1":$('#Reportable').val(),
									"CurrentRecord":$('#currentRecord').val()
								}),
								beforeSend:function(){
									$('#sabtn').text('PLEASE WAIT...');
									$('#sabtn').attr('disabled',true);
								},
								success:function(result,status,xhr){
									console.log(result);
									var da = jQuery.parseJSON(result);
									// console.log(da);
									if(da.Status == "OK"){
										// alert("Hello");
										$("#awards").trigger("click");
									}else if(da.ErrorNumber == 10){
										alert(da.Message);
										location.reload();
										// alert("Hello Failed");
									}
								}
							});
						}
					});

					$('body').on('change','#rateType',function(){

						var rtval = $(this).val();

						if(rtval == "RATEPERUNIT"){
							$('#amount-div,#multiplier-div').hide();
							$("#typeofunits-div,#rateperunit-div").show();
						}else if(rtval == "FIXEDAMOUNT"){
							$('#typeofunits-div,#rateperunit-div,#multiplier-div').hide();
							$("#amount-div").show();
						}else if(rtval == "MULTIPLE"){
							$('#typeofunits-div,#rateperunit-div,#amount-div').hide();
							$("#multiplier-div").show();
						}
					});

					$('body').on('change','#earningType',function(){
						var etval = $(this).val();

						if(etval == "ALLOWANCE"){
							$("#allowance-type-div").show();
						}else{
							$("#allowance-type-div").hide();
						}
					});
				</script>

					<!-- <input type="text" name="centerid" id="centerid" value="<= $this->uri->segment('3') ?>"> -->
					<input type="hidden" name="centerid" id="centerid" value="<?= $centerid ?>">
					<input type="hidden" name="userid" id="userid" value="<?= $this->session->userdata('LoginId') ?>">
					<div class="col-md-12">								
						<div class="form-floating">
							<input type="text" placeholder="Award Name" class="form-control" name="award-name" id="award-name">
							<label for="award-name">Award Name</label>
						</div> 
					</div>
					<div class="col-md-12">						
						<div class="form-floating">
							<select id="eTax" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="eTax">Exempt Tax</label>
						</div> 
					</div>
					<div class="col-md-12">					
						<div class="form-floating">
							<select id="eSuper" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="eSuper">Exempt Super</label>
						</div> 
					</div>
					<div class="col-md-12">				
						<div class="form-floating">
							<select id="Reportable" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="Reportable">Reportable</label>
						</div>
					</div>
					<div class="col-md-12">			
						<div class="form-floating">
							<select id="earningType" class="form-control">
								<option value="ORDINARYTIMEEARNINGS">ORDINARYTIMEEARNINGS</option>
								<option value="OVERTIMEEARNINGS">OVERTIMEEARNINGS</option>
								<option value="ALLOWANCE">ALLOWANCE</option>
								<!-- <option value="LUMPSUMA">LUMPSUMA</option>
								<option value="LUMPSUMB">LUMPSUMB</option>
								<option value="LUMPSUMD">LUMPSUMD</option> -->
								<option value="LUMPSUME">LUMPSUME</option>
								<option value="EMPLOYMENTTERMINATIONPAYMENT">EMPLOYMENTTERMINATIONPAYMENT</option>
								<option value="BONUSESANDCOMMISSIONS">BONUSESANDCOMMISSIONS</option>
							</select>
							<label for="earningType">Earning Type</label>
						</div>
					</div>

					<div class="col-md-12" id="allowance-type-div">						
						<div class="form-floating">
							<select id="allowanceType" class="form-control">
									<option value="CAR">CAR</option>
									<option value="TRANSPORT">TRANSPORT</option>
									<option value="TRAVEL">TRAVEL</option>
									<!-- <option value="LUMPSUMA">LUMPSUMA</option>
									<option value="LUMPSUMB">LUMPSUMB</option>
									<option value="LUMPSUMD">LUMPSUMD</option> -->
									<option value="LAUNDRY">LAUNDRY</option>
									<option value="MEALS">MEALS</option>
									<option value="JOBKEEPER">JOBKEEPER</option>
									<option value="OTHER">OTHER</option>
							</select>
							<label for="allowanceType">Allowance Type</label>
						</div> 
					</div>

					<div class="col-md-12">		
						<div class="form-floating">
							<select id="rateType" class="form-control">
								<option value="FIXEDAMOUNT">FIXEDAMOUNT</option>
								<option value="MULTIPLE">MULTIPLE</option>
								<option value="RATEPERUNIT">RATEPERUNIT</option>
							</select>
							<label for="rateType">Rate Type</label>
						</div>
					</div>

					<div class="col-md-12" id="amount-div">						
						<div class="form-floating">
							<input type="text" placeholder="Amount" class="form-control" name="Amount" id="amount" value="0">
							<label for="amount">Amount</label>
						</div> 
					</div>

					<div class="col-md-12" id="multiplier-div">						
						<div class="form-floating">
							<input type="text" placeholder="Multiplier Amount" class="form-control" name="Multiplier" id="multiplier" value="0">
							<label for="multiplier">Multiple (ex: 1.5)</label>
						</div> 
					</div>

					<div class="col-md-12" id="typeofunits-div">						
						<div class="form-floating">
							<input type="text" placeholder="TypeOfUnits" class="form-control" name="TypeOfUnits" id="typeofunits" value="Hours">
							<label for="typeofunits">Type of Units (e.g. Hours)</label>
						</div> 
					</div>
					<div class="col-md-12" id="rateperunit-div">						
						<div class="form-floating">
							<input type="text" placeholder="Multiplier Amount" class="form-control" name="RatePerUnit" id="rateperunit" value="0">
							<label for="rateperunit">Rate per Unit</label>
						</div> 
					</div>

					<div class="col-md-12">			
						<div class="form-floating">
							<select id="currentRecord" class="form-control">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="currentRecord">Current Record</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="close btn btn-default btn-small pull-right"><span class="material-icons-outlined">close</span> Cancel</button>
						<button type="button" id="sabtn" class="btn btn-default btn-small btnOrange pull-right"><span class="material-icons-outlined">save</span> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
					
</div>
<!-- end::ADD MODAL -->
<!-- begin::EDIT MODAL -->
<div class="editAwardForm modal modalNew" style="display: none;">
	<div class="modal-dialog mw-40">
		<div class="modal-content NewFormDesign">
			<div class="modal-header">
				<h3 class="modal-title ">Edit Awards</h3>
			</div>
			<div class="modal-body">
				<form>
				<script>
					$(document).ready(function(){
						$('#multiplier-div,#typeofunits-div,#rateperunit-div,#allowance-type-div').hide();
					});
					$('body').on('click','#eabtn',function(){
						var userid = $('.edit-userid').val();
						var centerid = $('.edit-centerid').val();
						var award = $('.edit-award-name').val();
						var erid = $('.edit-earning-rate-id').val();

						var awardsdata = JSON.parse($("#awards-data").text());
							// alert(typeof(awardsdata));
							// alert(typeof(awards));
						var removeIndex = awardsdata.awards.map(function(item) { return item.earningRateId; }).indexOf(erid);
						awardsdata.awards.splice(removeIndex, 1);
						var exdata = awardsdata.awards;

						// alert(JSON.stringify(olddata));

						if(award == ""){
							alert("Enter Award");
						}else if(userid == ""){
							alert("Userid is missing");
						}else if(centerid == ""){
							alert("Centerid is missing");
						}else{
							$.ajax({
								url:'<?= base_url('api/xero/addXeroAwards') ?>',
								type:"POST",
								headers:{
									"x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
									"x-token":'<?= $this->session->userdata('AuthToken') ?>'
								},
								data:JSON.stringify({
									"userid":userid,
									"centerid":centerid,
									"type":"EDI",
									"existeddata":exdata,
									"EarningsRateID":erid,
									"Name":award,
									"RateType":$('.edit-rate-type').val(),
									"Amount":$('.edit-amount').val(),
									"Multiplier":$('.edit-multiplier').val(),
									"TypeOfUnits":$('.edit-tou').val(),
									"RatePerUnit":$('.edit-rpu').val(),
									"IsExemptFromTax":$('.edit-tax').val(),
									"IsExemptFromSuper":$('.edit-super').val(),
									"EarningsType":$('.edit-earning-type').val(),
									"IsReportableAsW1":$('.edit-reportable').val(),
									"CurrentRecord":$('.edit-current-record').val()
								}),
								beforeSend:function(){
									$('#eabtn').text('PLEASE WAIT...');
									$('#eabtn').attr('disabled',true);
								},
								success:function(result,status,xhr){
									var da = jQuery.parseJSON(result);
// 									// // console.log(da);
									console.log(result);
									if(da.Status == "OK"){
										// alert("Hello");
										$("#awards").trigger("click");
									}else if(da.ErrorNumber == 10){
										alert(da.Message);
										location.reload();
										// alert("Hello Failed");
									}
								}
							});
						}
					});

					$('body').on('change','#rateType',function(){

						var rtval = $(this).val();

						if(rtval == "RATEPERUNIT"){
							$('#edit-amount-div,#edit-multiplier-div').hide();
							$("#edit-typeofunits-div,#edit-rateperunit-div").show();
						}else if(rtval == "FIXEDAMOUNT"){
							$('#edit-typeofunits-div,#edit-rateperunit-div,#edit-multiplier-div').hide();
							$("#edit-amount-div").show();
						}else if(rtval == "MULTIPLE"){
							$('#edit-typeofunits-div,#edit-rateperunit-div,#edit-amount-div').hide();
							$("#edit-multiplier-div").show();
						}
					});

					$('body').on('change','#earningType',function(){
						var etval = $(this).val();

						if(etval == "ALLOWANCE"){
							$("#edit-allowance-type-div").show();
						}else{
							$("#edit-allowance-type-div").hide();
						}
					});
				</script>

					<!-- <input type="text" name="centerid" id="centerid" value="<= $this->uri->segment('3') ?>"> -->
					<input type="hidden" name="centerid" class="edit-centerid" id="edit-centerid" value="<?= $centerid ?>">
					<input type="hidden" name="userid" class="edit-userid" id="edit-userid" value="<?= $this->session->userdata('LoginId') ?>">
					<input type="hidden" name="earningRateId" class="edit-earning-rate-id">
					<div class="col-md-12">								
						<div class="form-floating">
							<input type="text" placeholder="Award Name" class="form-control edit-award-name" name="edit-award-name" id="award-name">
							<label for="award-name">Award Name</label>
						</div> 
					</div>
					<div class="col-md-12">						
						<div class="form-floating">
							<select id="eTax" class="form-control edit-tax">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="eTax">Exempt Tax</label>
						</div> 
					</div>
					<div class="col-md-12">					
						<div class="form-floating">
							<select id="eSuper" class="form-control edit-super">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="eSuper">Exempt Super</label>
						</div> 
					</div>
					<div class="col-md-12">				
						<div class="form-floating">
							<select id="Reportable" class="form-control edit-reportable">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="Reportable">Reportable</label>
						</div>
					</div>
					<div class="col-md-12">			
						<div class="form-floating">
							<select id="earningType" class="form-control edit-earning-type" disabled>
								<option value="ORDINARYTIMEEARNINGS">ORDINARYTIMEEARNINGS</option>
								<option value="OVERTIMEEARNINGS">OVERTIMEEARNINGS</option>
								<option value="ALLOWANCE">ALLOWANCE</option>
								<!-- <option value="LUMPSUMA">LUMPSUMA</option>
								<option value="LUMPSUMB">LUMPSUMB</option> -->
								<option value="LUMPSUMD">LUMPSUMD</option>
								<option value="LUMPSUME">LUMPSUME</option>
								<option value="EMPLOYMENTTERMINATIONPAYMENT">EMPLOYMENTTERMINATIONPAYMENT</option>
								<option value="BONUSESANDCOMMISSIONS">BONUSESANDCOMMISSIONS</option>
							</select>
							<label for="earningType">Earning Type(cannot be changed)</label>
						</div>
					</div>

					<div class="col-md-12" id="edit-allowance-type-div">						
						<div class="form-floating">
							<select id="allowanceType" class="form-control">
									<option value="CAR">CAR</option>
									<option value="TRANSPORT">TRANSPORT</option>
									<option value="TRAVEL">TRAVEL</option>
									<!-- <option value="LUMPSUMA">LUMPSUMA</option>
									<option value="LUMPSUMB">LUMPSUMB</option>
									<option value="LUMPSUMD">LUMPSUMD</option> -->
									<option value="LAUNDRY">LAUNDRY</option>
									<option value="MEALS">MEALS</option>
									<option value="JOBKEEPER">JOBKEEPER</option>
									<option value="OTHER">OTHER</option>
							</select>
							<label for="allowanceType">Allowance Type</label>
						</div> 
					</div>


					<div class="col-md-12">		
						<div class="form-floating">
							<select id="rateType" class="form-control edit-rate-type">
								<option value="FIXEDAMOUNT">FIXEDAMOUNT</option>
								<option value="MULTIPLE">MULTIPLE</option>
								<option value="RATEPERUNIT">RATEPERUNIT</option>
							</select>
							<label for="rateType">Rate Type</label>
						</div>
					</div>

					<div class="col-md-12" id="edit-amount-div">						
						<div class="form-floating">
							<input type="text" placeholder="Amount" class="form-control edit-amount" name="Amount" id="amount" value="0">
							<label for="amount">Amount</label>
				</div> 
					</div>

					<div class="col-md-12" id="edit-multiplier-div">						
						<div class="form-floating">
							<input type="text" placeholder="Multiplier Amount" class="form-control edit-multiplier" name="Multiplier" id="multiplier" value="0">
							<label for="multiplier">Multiple (ex: 1.5)</label>
						</div> 
					</div>

					<div class="col-md-12" id="edit-typeofunits-div">						
						<div class="form-floating">
							<input type="text" placeholder="TypeOfUnits" class="form-control edit-tou" name="TypeOfUnits" id="typeofunits" value="Hours">
							<label for="typeofunits">Type of Units (e.g. Hours)</label>
						</div> 
					</div>
					<div class="col-md-12" id="edit-rateperunit-div">						
						<div class="form-floating">
							<input type="text" placeholder="Multiplier Amount" class="form-control edit-rpu" name="RatePerUnit" id="rateperunit" value="0">
							<label for="rateperunit">Rate per Unit</label>
						</div> 
					</div>

					<div class="col-md-12">			
						<div class="form-floating">
							<select id="currentRecord" class="form-control edit-current-record">
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
							<label for="currentRecord">Current Record</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="close btn btn-default btn-small pull-right"><span class="material-icons-outlined">close</span> Cancel</button>
						<button type="button" id="eabtn" class="btn btn-default btn-small btnOrange pull-right"><span class="material-icons-outlined">save</span> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
					
</div>
<!-- end::EDIT MODAL -->

<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#awards').click(function(){
			var centerid = $('#centerValue').val();
			var url = "<?php echo base_url('settings/syncXeroAwards/'); ?>"+centerid ;
			$.ajax({
					url:url,
					type:'GET',
					success:function(data){
						console.log(data);
						window.location.reload();
					}
				})
			})
		
	  $(document).on('change','#centerValue',function(){
	      var centerid = $('#centerValue').val();
	      window.location.href = '<?php echo base_url("settings/awardSettings/"); ?>'+centerid;
	      // $.ajax({
	      //   url : url,
	      //   type : 'GET',
	      //   success : function(response){
	      //     $('.sync_button button').replaceWith($(response).find('.sync_button button')[0].outerHTML);
	      //     $('tbody').html($(response).find('tbody').html())
	      //     console.log($(response).find('tbody').html())
	      //   }
	      // })
	    })
	})
</script>
<script type="text/javascript">
	$(document).ready(()=>{
		// if($(document).width() > 1024){
		//     $('.containers').css('paddingLeft',$('.side-nav').width());
		// }
	});
	$(document).on('click','.addAward',function(){
		$(".addAwardForm").show();    		
	});
	$(document).on('click','.close',function(){
		$(".addAwardForm,.editAwardForm").hide();    		
	});
	$(document).on('click','.editAward',function(){
		var userid = $('.edit-userid').val();
		var centerid = $('.edit-centerid').val();
		var awardName = $(this).data('name');
		var awardId = $(this).data('earningrateid');
		var awardeTax = $(this).data('isexemptfromtaxyn');
		if(awardeTax == "Y"){
			awardeTax = "true";
		}else if(awardeTax == "N"){
			awardeTax = "false";
		}
		var awardeSuper = $(this).data('isexemptfromsuperyn');
		if(awardeSuper == "Y"){
			awardeSuper = "true";
		}else if(awardeSuper == "N"){
			awardeSuper = "false";
		}
		var awardeReport = $(this).data('isreportableasw1');
		if(awardeReport == "Y"){
			awardeReport = "true";
		}else if(awardeReport == "N"){
			awardeReport = "false";
		}
		var awardeType = $(this).data('earningtype');
		var awarderType = $(this).data('ratetype');
		var awardma = $(this).data('multiplier_amount');
		var awardcr = $(this).data('currentrecordyn');
		if(awardcr == "Y"){
			awardcr = "true";
		}else if(awardcr == "N"){
			awardcr = "false";
		}
		
		$('.edit-award-name').val(awardName);
		$('.edit-earning-rate-id').val(awardId);
		$('.edit-tax').val(awardeTax).change();
		$('.edit-super').val(awardeSuper).change();
		$('.edit-reportable').val(awardeReport).change();
		$('.edit-earning-type').val(awardeType).change();
		$('.edit-rate-type').val(awarderType).change();
		$('.edit-multiplier,.edit-amount').val(awardma);
		$('.edit-current-record').val(awardcr);

		
		$(".editAwardForm").show();
	});
</script>

<?php if( isset($error) ){ ?>
<script type="text/javascript">
  var modal = document.querySelector(".modal-logout");
    function toggleModal() {
        modal.classList.toggle("show-modal");
    }
	$(document).ready(function(){
	  	toggleModal();	
	  })
		</script>
	<?php }
?>

</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/timesheet/timesheet_dashboard/"+id;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('body').html(response);
				
			}
		}).fail(function(){
			alert('whyys')
		})
	})
		})
</script>-->