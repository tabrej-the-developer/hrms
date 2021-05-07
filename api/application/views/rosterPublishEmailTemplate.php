<!DOCTYPE html>
<html>
<head>
	<title>Roster Published</title>
</head>
<body>
					<h4>Please find your attached roster here</h4>
	<div>
		<table style="border-collapse: collapse;border:1px solid black;margin:2rem">
			<thead style="border-collapse: collapse;border:1px solid white;background: #171d4b;color: white">
				<th style="border-collapse: collapse;border:1px solid black;">Date</th>
				<th style="border-collapse: collapse;border:1px solid black;">Area</th>
				<th style="border-collapse: collapse;border:1px solid black;">Role</th>
				<th style="border-collapse: collapse;border:1px solid black;">Shift Time</th>
				<th style="border-collapse: collapse;border:1px solid black;">End Time</th>
			</thead>
			<tbody style="border-collapse: collapse;border:1px solid black;">

				<?php foreach($data as $d){ ?>
			<tr style="border-collapse: collapse;border:1px solid black;">
				 <?php $leave = isset($d['leave']) ? $d['leave']->status : ""; 
					if($leave != 2){
				?>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo isset($d['date']) ? $d['date'] : ""; ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo isset($d['areaName']) ? $d['areaName'] : ""; ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo isset($d['roleName']) ? $d['roleName'] : ""; ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo isset($d['startTime']) ? $d['startTime'] : ""; ?></td>
				<td style="border-collapse: collapse;border:1px solid black;padding:0.25rem 0.5rem"><?php echo isset($d['endTime']) ? $d['endTime'] : ""; ?></td>
			<?php }else{
				echo 'On Leave';
			} ?>
			</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
				<div>
				Click here to go to roster
				<a href="http://todquest.com/PN101/roster/getRosterDetails?rosterId=<?php echo $rosterid; ?>&showBudgetYN=N" style="
			  text-decoration: none;
			  display: inline-block;
			  cursor: pointer">
					<button style="	  border: none;
	  color: rgb(23, 29, 75);
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-weight: 700;
	  margin: 2px;
	  width:6rem;
      border-radius: 20px;
      padding: 8px;
      background: rgb(164, 217, 214);
      display: flex !important;">Click Here</button>
				</a>
			</div>
</body>
</html>

