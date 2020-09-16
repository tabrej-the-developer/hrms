<!DOCTYPE html>
<html>
<head>
	<title>Roster Published</title>
</head>
<body>
	<?php 
		$rav = json_decode($rav);
	 ?>
	<div>
		<table>
			<thead>
				<th>Date</th>
				<th>Title</th>
				<th>Shift Time</th>
			</thead>
			<tbody>
				<?php foreach($rav as $r){ ?>
				<tr>
					<td><?php echo ; ?></td>
					<td><?php echo $r->empTitle; ?></td>
					<td><?php echo ; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>