<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Superannuation Settings</title>
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
		<div class="containers scrollY">
			<div class="settingsContainer">

			<span class="d-flex pageHead heading-bar">
				<div class="withBackLink">
					<a href="<?php echo base_url();?>/settings">
						<span class="material-icons-outlined">arrow_back</span>
					</a>				
					<span class="events_title">Superannuations</span>
				</div>
				<div class="rightHeader">
					<?php $syncedWithXero = json_decode($syncedWithXero);  ?>
					<select placehdr="Center" id="centerValue" name="centerValue" >
					<?php 
					foreach($centers->centers as $center){ 
						if(isset($centerid) && $centerid == $center->centerid ){
						?> 
						<option value="<?php echo $center->centerid;?>" selected><?php echo $center->name;?></option>
					<?php }else{ ?>
						<option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
					<?php  }
						} ?>
					</select>

					<button id="superfunds" class="<?php 
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
							Sync&nbsp;Xero&nbsp;Superannuations
					</button>
				</div>
			</span>


			<div class="superfunds-container">
				<div class="superfunds-container-child">
					<?php $permissions = json_decode($permissions); ?>
					<?php if(isset($permissions->permissions) ? $permissions->permissions->viewPermissionYN : "N" == "Y"){ ?>

					<?php if(isset($permissions->permissions) ? $permissions->permissions->editPermissionYN : "N" == "Y"){ ?>

					<?php } ?>

					<div class="table-div pageTableDiv">
						<table class="table">
							<thead>
								<th>S.No</th>
								<th>ABN</th>
								<th>USI</th>
								<th>Type</th>
								<th>Name</th>
								<th>BSB</th>
								<th>Account Number</th>
								<th>Account Name</th>
								<th>eService Address</th>
								<th>Employee No</th>
							</thead>
							
							<tbody id="tbody">

								<?php 
								$superfunds = json_decode($superfunds);
								$x=1;
								foreach($superfunds->superfunds as $superfund){
									
								?>
								<tr >
									<td><?php echo $x; ?></td>
									<td><?php echo $superfund->abn;?> </td>
									<td><?php echo $superfund->usi;?> </td>
									<td><?php echo $superfund->type;?> </td>
									<td><?php echo $superfund->name;?> </td>
									<td><?php echo $superfund->bsb;?>  </td>
									<td><?php echo $superfund->accountNumber;?> </td>
									<td><?php echo $superfund->accountName;?> </td>
									<td><?php echo $superfund->eServiceAddress;?> </td>
									<td><?php echo $superfund->employeeNo;?> </td>
								</tr>
								<?php  
								$x++;
							} ?>
							</tbody>
						
						</table>
						
					</div>
				<div>
			<div>
		<div>
</div>

 <?php }
 // else{
// 	redirect('noPermissionPage');
// }

 ?>
	 </div>
	</div>
</div>


<div class="modal-logout">
    <div class="modal-content-logout">
        <h3>You have been logged out!!</h3>
        <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(()=>{
		if($(document).width() > 1024){
		    $('.containers').css('paddingLeft',$('.side-nav').width());
		}
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#superfunds').click(function(){
console.log("clicked");
			var centerid = $('#centerValue').val();
			var url = "<?php echo base_url() ?>settings/syncXeroSuperfunds/"+centerid ;
			$.ajax({
					url:url,
					type:'GET',
					success:function(response){
						 console.log(response)
						window.location.reload();
					}
				})
			})
		$(document).on('change','#centerValue',function(){
		  var centerid = $('#centerValue').val();
		  window.location.href = '<?php echo base_url() ?>settings/superfundsSettings/'+centerid;
		  // $.ajax({
		  //   url : url,
		  //   type : 'GET',
		  //   success : function(response){
		  //     $('#superfunds').replaceWith($(response).find('#superfunds')[0].outerHTML)
		  //     $('tbody').html($(response).find('tbody').html())
		  //     console.log($(response).find('tbody').html())
		  //   }
		  // })
		})
	})
</script>
</body>
</html>
