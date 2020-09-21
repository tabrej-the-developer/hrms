<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<table>
		<thead>
			<th>Date</th>
			<th>Start Time</th>
			<th>End Time</th>
		</thead>
		<tbody>
			<td><?php echo $startTime; ?></td>
			<td><?php echo $endTime; ?></td>
			<td><?php echo date('d M, Y',strtotime($date)); ?></td>
		</tbody>
	</table>
</body>
</html>