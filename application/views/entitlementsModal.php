	<style type="text/css">
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
	</style>

	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<div>

<div>

	<div class="d-flex row m-0">
		<span class="head head-th col-3">Name</span>
		<span class="head head-th col-2">Bonus Rate</span>
		<span class="head head-th col-3">Center</span>
		<span class="head head-th col-2">Title</span>
	</div>
	<?php 
		$users = json_decode($users);
		$count = count($users->users)
	 ?>
	<?php for($x=0;$x<$count;$x++){ ?>
	<div class="d-flex row m-0">
		<span class="head col-3"><?php echo $users->users[$x]->name?></span>
		<span class="head col-2"><?php echo $users->users[$x]->bonusRate; ?></span>
		<span class="head col-3"><?php echo $users->users[$x]->center; ?></span>
		<span class="head col-2"><?php echo $users->users[$x]->title; ?></span>
	</div>
	<?php } ?>
</div>


<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->