<?php
	require_once("login/config/db.php");
	require_once("classes/Event.php");
	
	$eventExists = true; //Variable to determine rendering of event or not
	
	$event = new Event();
	if (!empty($_GET["id"])) {
		$event->fetchFromId($_GET["id"]);
	} else {
		$eventExists = false;
	}
	// show potential errors / feedback (from event object)
	if (isset($event)) {
	    if ($event->errors) {
	        foreach ($event->errors as $error) {
	            //echo $error;
	            $eventExists = false;
	        }
	    }
	    if ($event->messages) {
	        foreach ($event->messages as $message) {
	            //echo $message;
	        }
	    }
	}	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On?</title>
		<meta name="description" content="">
		<meta name="author" content="What's Going On Team">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="styles/cssMain.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			a[href="event.php"]
			{
				display:block;
				width:3.5em;
				background-color: #E65C00;
				color: #FFFFFF;
				font-weight:bold;
			}
		</style>		

	</head>

	<body>
		<div id="wrapper">
			
		<header>
			<h1><img src="" alt="What's Going On?"></h1>
			<div id="login">			    
				<?php require_once("login/loginHandler.php"); ?>
			</div>			
		</header>
		<div id="text">
		<nav>
 		 	<?php require_once("navigation.php"); ?>
	  	</nav>
	  
	  	<section id="eventArticle">
	  		<?php if ($eventExists) { ?>
		  		<div id="eventName">
		  			<h1><?php echo($event->Title); ?></h1>
		  			<div class="eventImage">
		  				<img class="imgSub" src="image.php?id=<?php echo($event->ImageID); ?>" alt="Event image">
		  			</div>
		  			<p><?php echo($event->StartDateTime);?></p>
		  			<p><?php echo($event->Address);?></p>
		  			<p><?php echo($event->City);?>&nbsp;<?php echo($event->State);?>&nbsp;<?php echo($event->ZIP);?></p>
		  			<hr>
		  			<p><?php echo($event->Description); ?></p>	  			
		  		</div>	
		  		
		  		<div id="">
		  			<div id="map">
			  			<iframe
						  	width="600"
						  	height="450"
						  	frameborder="0" style="border:0"
						  	src="https://www.google.com/maps/embed/v1/place?q=<?php echo(str_replace(' ','+',$event->getFullAddress())) ?>&key=AIzaSyDDhZL749Ov1AhGMlAj4bAVTnAVCGvCTQM">
						</iframe>
					</div>	
		  		</div>
		  		
		  		<!--
		  		<div id="similarEvents">
		  			<h1>Similar Events</h1>
		  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
		  			<h3>Event Name</h3>
		  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
		  			<h3>Event Name</h3>
		  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
		  			<h3>Event Name</h3>
		  		</div>
		  		<!---->
		  	<?php } else {
				  		if (isset($event)) {
						    if ($event->errors) {
						        foreach ($event->errors as $error) {
						            echo $error;
						        }
						    }
						}
					} ?>
	  	</section>
	  	</div>
	  	<footer>
	  		<?php require_once("footer.php"); ?>
	  	</footer>
	  	
	</body>
</html>
