<html>
	<body>
	<?php
	if(sizeof($_GET)==0){
				header("location:calendar2.php");
				exit();
			}
	$date = $_GET['date'];
	if(isset($_GET['date'])){
		print("<h3>$date</h3>");		
		}
		

	 ?>
	
</body>	
</html>
