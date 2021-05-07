<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<table style="border-collapse: collapse;border:1px solid black;margin:2rem">
		<thead style="border-collapse: collapse;border:1px solid white;background: #171d4b;color: white">
			<th style="border-collapse: collapse;border:1px solid black;">Date</th>
			<th style="border-collapse: collapse;border:1px solid black;">Start Time</th>
			<th style="border-collapse: collapse;border:1px solid black;">End Time</th>
			<th style="border-collapse: collapse;border:1px solid black;">Message</th>
		</thead>
		<tbody style="border-collapse: collapse;border:1px solid black;">
			<?php foreach($arr as $a){?>
			<tr style="border-collapse: collapse;border:1px solid black;">
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo date('d M, Y',strtotime($a['date'])); ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo $a['startTime']; ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo $a['endTime']; ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo $a['message']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>