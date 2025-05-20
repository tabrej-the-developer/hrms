<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
	*{
font-family: 'Open Sans', sans-serif;
	}
		.group-span{
			display:flex;
			justify-content: space-around;
			min-width:100%;
		}
		.box-time{
			
		}
		.shift-type-select{
			width:100px;
		}
		.buttonn{
		background-color: #9E9E9E;
		border: none;
		color: white;
		padding: 10px 10px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		margin: 2px
		}
		.time-box{
			cursor:pointer;
		}
		.head-th{
			font-size:1.1rem;
			font-weight:bolder;
		}
		.d-flex{
			padding-bottom:5px;
		}
		.head{
			padding-left: 1rem;
		}
	</style>

	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<div>

<div class="template_table">

	<div class="d-flex w-100">
		<span class="head head-th col-4">Name</span>
		<span class="head head-th col-4">Level</span>
		<!-- <span class="head head-th col-3">Center</span> -->
		<span class="head head-th col-4">Role Name</span>
	</div>
	<?php 
		$users = json_decode($users);
		if(isset($users->users)){
			$count = count($users->users);
			$entitlements = json_decode($entitlements);
		 ?>
		<?php for($x=0;$x<$count;$x++){ ?>
		<div class="d-flex  m-0">
			<span class="head col-4"><?php echo $users->users[$x]->name?></span>
			<span class="head col-4">
				<div class="form-floating">
					<select class="level_select form-control" id="<?php echo $users->users[$x]->id; ?>" userid="<?php echo $users->users[$x]->id; ?>">
					<?php foreach($entitlements->entitlements as $e ){ 
						if($e->id == $users->users[$x]->level){ ?>
							<option value="<?php echo $e->id ?>"  selected><?php echo $e->name; ?></option>
					<?php	}else{ ?>
							<option value="<?php echo $e->id ?>" ><?php echo $e->name; ?></option>
					<?php } 
							} ?>
					</select>
					<label for="<?php echo $users->users[$x]->id; ?>">Level Name</label>
				</div> 
			</span>
			<!-- <span class="head col-3"><?php echo $users->users[$x]->center; ?></span> -->
			<span class="head col-4"><?php echo $users->users[$x]->roleName; ?></span>
		</div>
			<?php } }?>
</div>


<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->