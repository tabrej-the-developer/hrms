
<div>
	<?php 
		$timesheetDetails = json_decode($timesheetDetails);
		//print_r($timesheetDetails->timesheet[$y]->employees[$x]->empName);
		function timex( $x)
	{ 
	    $output;
	    if(($x/100) < 12){
	        if(($x%100)==0){
	         $output = $x/100 . ":00 AM";
	        }
	    if(($x%100)!=0){
	        $output = $x/100 .":". $x%100 . "AM";
	        }
	    }
	else if(($x/100)>12){
	    if(($x%100)==0){
	    $output = ($x/100)-12 . ":00 PM";
	    }
	    if(($x%100)!=0){
	    $output = ($x/100)-12 .":". $x%100 . "PM";
	    }
	}
	else{
	if(($x%100)==0){
	     $output = ($x/100) . ": 00 PM";
	    }
	    if(($x%100)!=0){
	    $output = ($x/100) . ":". $x%100 . "PM";
	    }
	}
	return $output;
}
		foreach($timesheetDetails->timesheet[$y]->employees[$x]->visits as $visits){
	?>
	<div start-time="<?php echo $visits->signInTime; ?>" end-time="<?php echo $visits->signOutTime; ?>" class="box-time" style="padding:20px">
		<span><input type="checkbox" name="" checked></span>
		<span svalue="<?php echo $visits->signInTime; ?>" evalue="<?php echo $visits->signOutTime; ?>" class="time-box"><?php echo timex($visits->signInTime) ."-". timex($visits->signOutTime) ?></span>
		<span class="new-time-box"></span>
		<span><?php echo $visits->reason;?></span>
	<div>
		<button class="buttonn">Create Pay Roll</button>
	</div>
	</div>
	<?php
		}
	?>
</div>

	<script type="text/javascript">
	function timer( x)
	{ 
	    var output="";
	    if((x/100) < 12){
	        if((x%100)==0 ){
	        	if((x/100)<10){
	         output = "0"+String(x/100) + ":00" ;
	     }
	     if((x/100)>9){
	     	output = String(x/100) + ":00" ;
	     }
	        }
	    if((x%100)!=0){
	        if((x/100)<10){
	         output = "0"+String(x/100) + ":" + String(x%100) ;
	        }
	    }
	     if((x/100)>10){
	         output = String(x/100) + ":" + String(x%100) ;
	        }
	    }
	
	else if((x/100)>12){
	    if((x%100)==0){
	    output = x/100 + ":00";
	    }
	    if((x%100)!=0){
	    output = x/100 +":" + x%100 ;
	    }
	}
	else{
	if((x%100)==0){
	     output = parseInt(x/100) + ":00";
	    }
	    if((x%100)!=0){
	    output = parseInt(x/100) + ":" + x%100;
	    }
	}
	return output;
}

</script>
<script type="text/javascript">
	$(document).on('click','.time-box',function(){
		var thisValue = $(this).children('.time-box').html();
		var parentHTML = $('timesheet-form').html();
		var stime = $(this).attr('start-time');
		var code = "<input type=\"time\" class=\"sclass\"> - <input type=\"time\" class=\"eclass\">"
		$(this).empty();
		$(this).next().html(code)
		$(this).next().children('.sclass').val(timer($(this).attr('svalue')))
		$(this).next().children('.eclass').val(timer($(this).attr('evalue')))

		//$(this).html(code)
		//$(this).children().val(timer(500))
		//$(this).children('.time-box').html($(this).attr('start-time'))
	})
</script>
<script type="text/javascript">
	$(document).on('click','.buttonn',function(e){
		e.preventDefault();
			$.ajax({
				
			})
		})
</script>
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		$('#stime').val(timer($('.box-time').attr('start-time')))
	</script>

<!--
<input type="time" name="stime" id="stime">
<input type="time" name="etime" id="etime">
-->