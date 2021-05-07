<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="outer_box" style="width: 100vw; height: 100vh;background:#E3E4E7;padding:3rem">
		<div class="inner_box" style="width: 100%;height: 100%;background: white;display: flex; justify-content: center; align-items: center;">
			<span>
				<?php
					if($Status == "SUCCESS"){
						echo "Your integration from xero was successful. ";
					}
					else{
						echo "Your integration failed";
					}
				?>
			</span>
		</div>
	</div>
</body>
</html>