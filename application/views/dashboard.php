<html>
<head>
	<title>Dashboard</title>
<style type="text/css">
	.containers{

	}
  .cardContainer {
  display: flex;
  justify-content: center;
	}
	.cardItem {
	  text-align: center;
	  transition: all 500ms ease-in-out;
	  height: 8rem;
	}
	.cardItemChild{

	}
	.cardItem:hover {
		  cursor: pointer;
		  box-shadow: 0px 12px 30px 0px rgba(0, 0, 0, 0.2);
		  transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
	}
  .module-name{
	width: 100%;
	display: inline-block;
	text-align: left;
	}
	.module-balance{
		position: absolute;
		bottom: 0;
		left: 0;
		text-align: right;
		width: 100%;
		padding-right: 20px;
	}
	.footprints{
		height: calc( 100vh - 10rem);
		overflow-y: scroll
	}
</style>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="containers">
		<?php $moduleRowCount = json_decode($moduleEntryCount); ?>
		<div class="row mr-0 ml-0 cardContainer">
			<span class="col-4 cardItem" style="background:rgba(0,139,139)">
				<span class="module-name">Timesheets</span>
				<span class="module-balance"><?php echo $moduleRowCount->timesheetsCount; ?></span>
			</span>
			<span class="col-4 cardItem" style="background:rgba(220,20,60,0.8)">
				<span class="module-name">Rosters</span>
				<span class="module-balance"><?php echo $moduleRowCount->rostersCount; ?></span>
			</span>
			<span class="col-4 cardItem" style="background:	rgb(46,139,87)">
				<span class="module-name">Payrolls</span>
				<span class="module-balance"><?php echo $moduleRowCount->payrollsCount; ?></span>
			</span>			
		</div>
		<div class="row mr-0 ml-0 ">
			<?php $footprints = json_decode($footprints); 
			// print_r($footprints);
			?>
			<span class="col-8 footprints">

				<?php 
					$count = count($footprints->footprints);
				foreach($footprints->footprints as $footprint){?>
					<span class="row">
						<span class="col-1"><?php echo  $count-- ;?></span>
				<span style="background:rgba(135,206,235,0.5);font-size:0.75rem" class="col-5 m-0 pl-2"> <?php  echo $footprint->prev_page_tag != " " ? str_replace("http://localhost/PN101/","",$footprint->prev_page_tag):"Login"; ?></span>
				<span class="bg-info col-1 m-0 pl-2" > &nbsp; To &nbsp;</span>
				<span style="background:rgba(135,206,235,0.5);font-size:0.75rem" class="col-5 m-0 pl-2"> <?php  echo str_replace("http://localhost/PN101/","",$footprint->page_tag); ?></span>
					</span>
			<?php } ?>
			</span>
			<span class="col-4">Last login details</span>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(()=>{
	    $('.containers').css('paddingLeft',$('.side-nav').width());
	});
</script>
</body>
</html>