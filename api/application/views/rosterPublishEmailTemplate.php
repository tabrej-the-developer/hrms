<!DOCTYPE html>
<html>
<head>
	<title>Roster Published</title>
</head>
<body>
	<div>
		<table>
			<thead>
				<th>Date</th>
				<th>Area</th>
				<th>Role</th>
				<th>Shift Time</th>
				<th>End Time</th>
			</thead>
			<tbody>

				<?php foreach($data as $d){ ?>
			<tr>
				<?php $leave = isset($d['leave']) ? $d['leave']->status : ""; 
					if($leave != 2){
				?>
				<td><?php echo isset($d['date']) ? $d['date'] : ""; ?></td>
				<td><?php echo isset($d['areaName']) ? $d['areaName'] : ""; ?></td>
				<td><?php echo isset($d['roleName']) ? $d['roleName'] : ""; ?></td>
				<td><?php echo isset($d['startTime']) ? $d['startTime'] : ""; ?></td>
				<td><?php echo isset($d['endTime']) ? $d['endTime'] : ""; ?></td>
			<?php }else{
				echo 'On Leave';
			} ?>
			</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>




