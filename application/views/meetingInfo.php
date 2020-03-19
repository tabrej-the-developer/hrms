<html>
<head></head>
<body>
 <p>
<?php
 echo "<pre>";
 $info = json_decode($info);
 foreach($info->agenda as $a){
     echo '<br>';
     echo $a->text;
 }
?> 
 </p>
</body>
</html>
