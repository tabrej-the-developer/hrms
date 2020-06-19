<html>
<head>
	<title>Dashboard</title>
<style type="text/css">
	body{
		background: #F2F2F2 !important;
	}
	.containers{

	}
  .cardContainer {
  display: flex;
  margin-left: 0 !important;
	}
	.cardItem {
	  height: 8rem;
	  padding-left: 0 !important;
	  padding-right: 0 !important;
	}
	.cardItem > span{
		min-height: 100%;
		display: block;
	  background: white;
	}
	.cardItemChild{

	}
  .module-name{
	width: 100%;
	display: block;
	padding-left: 45%
	}
	.module-balance{
		display: block;
		padding-left: 45%;
		font-size: 2rem;
	}
	.footprints{
		height: calc( 100vh - 11rem);
		overflow-y: scroll
	}
	.dashboard-icons{
    padding: 20px;
    border-radius: 5px;
    position: relative;
    top: 50;
    left: 30;
	}
	.dashboard-icons > img{
		height: 2rem;
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
</style>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="containers">
		<?php $permissions = json_decode($permissions); ?>
		<?php $moduleRowCount = json_decode($moduleEntryCount); ?>
		<div class="row mr-0 mt-3 cardContainer pl-4 pr-4">
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewTimesheetYN : "N") == "Y"){ ?>
			<span class="col-3 cardItem pr-4" >
				<span class="row p-0 m-0">
					<span class="col-6 dashboard-icons" style="background:rgba(0, 84, 254,0.07)">
						<img src="<?php echo base_url('assets/images/dashboard-icons/timesheets.png'); ?>">
					</span>
					<span class="col-6" >
						<span>
							<span class="module-balance" style="color:rgba(0, 84, 254)"><?php echo $moduleRowCount->timesheetsCount; ?></span>
							<span class="module-name">Total Timesheets</span>
						</span>
					</span>
				</span>
			</span>
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewRosterYN : "N") == "Y"){ ?>
			<span class="col-3 cardItem pr-4" >
				<span class="row p-0 m-0">
					<span class="col-6 dashboard-icons" style="background:rgba(254, 237, 242)">
						<img src="<?php echo base_url('assets/images/dashboard-icons/roster.png'); ?>">
					</span>
					<span class="col-6" >
						<span>
							<span class="module-balance" style="color:#FD5181"><?php echo $moduleRowCount->rostersCount; ?></span>
							<span class="module-name">Total Rosters</span>
						</span>
					</span>
				</span>
			</span>
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewPayrollYN : "N") == "Y"){ ?>
			<span class="col-3 cardItem pr-4" >
				<span class="row p-0 m-0">
					<span class="col-6 dashboard-icons" style="background:rgba(233, 255, 208)">
						<img src="<?php echo base_url('assets/images/dashboard-icons/payrolls.png'); ?>">
					</span>
					<span class="col-6" >
						<span class="col-12">
							<span class="module-balance" style="color:rgba(102, 145, 54)"><?php echo $moduleRowCount->payrollsCount; ?></span>
							<span class="module-name">Total Payrolls</span>
						</span>
					</span>
				</span>
			</span>
<?php } ?>
<?php if((isset($permissions->permissions) ? $permissions->permissions->viewLeaveTypeYN : "N") == "Y"){ ?>
			<span class="col-3 cardItem " >
				<span class="row p-0 m-0">
					<span class="col-6 dashboard-icons" style="background:rgba(253, 188, 0,0.18)">
						<img src="<?php echo base_url('assets/images/dashboard-icons/onLeave.png'); ?>">
					</span>
					<span class="col-6" >
						<span>
							<span class="module-balance" style="color:rgba(253, 188, 0)"><?php echo $moduleRowCount->leavesCount; ?></span>
							<span class="module-name">On leave</span>
							</span>
					</span>
				</span>
			</span>		
<?php } ?>	
		</div>
		<div class="row mr-0 ml-3 mr-3 mt-3 ">
			<?php $footprints = json_decode($footprints); 
			// print_r($footprints);
			?>
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
				<?php 
					$count = 1;
				foreach($footprints->footprints as $footprint){?>
					<span class="row activity-row" >
						<span class="col-2"><?php echo  $count++ ;?></span>
						<span class="col-2"><?php  echo $footprint->ip ?></span>
						<span class="col-2"><?php  echo explode(" ",$footprint->start_time)[0] ?></span>
						<span class="col-2"><?php  echo explode(" ",$footprint->start_time)[1] ?></span>
						<span style="background:transparent;" class="col-4 "> <?php  echo $footprint->prev_page_tag != " " ? str_replace("http://localhost/PN101/","",$footprint->prev_page_tag):"Login"; ?></span>
					</span>
			<?php } ?>
			</span>
			
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(()=>{
	    $('.containers').css('paddingLeft',$('.side-nav').width());
	});
</script>
</body>
</html>