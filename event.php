<?php	
	require_once("login/config/db.php");
	require_once("classes/Event.php");
	require_once("classes/User.php");
	
	$eventExists = true; //Variable to determine rendering of event or not
	
	$event = new Event();
	$user = new User();
	if (!empty($_GET["id"])) {
		$event->fetchFromId($_GET["id"]);
		$user->fetchFromId($event->OwnerID);
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
		<script>
			function confirmCancel(eventName) {
				return confirm("Are you sure you want to cancel '" + eventName + "'?");
			}
		</script>
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
		  			<?php
		  				if (isset($_SESSION['user_name'])) {
			  				if ($user->Username == $_SESSION['user_name']) {
			  					echo <<<EOL
			  						<a href="/WhatsGoingOn/updateEventHandler.php?id=$event->ID">Edit</a>
									<span>&nbsp;&nbsp;</span>
									<form class="cancelEvent" method="post" action="/WhatsGoingOn/cancelEvent.php" onsubmit="return confirmCancel('$event->Title');">
										<input type="hidden" name="eventId" value="$event->ID">
										<button class="linkButton" type="submit" value="Cancel Event">Cancel Event</button>
									</form>
EOL;
							}
						}
		  			?>
		  			<div class="eventImage">
		  				<?php
			  				if ($event->ImageID == null) {
			  					echo '<img class="imgSub" src="images/event.gif" alt="Event image">';
			  				} else {
			  					echo "<img class=\"imgSub\" src=\"image.php?id=$event->ImageID\" alt=\"Event image\">";
							}
		  				?>
		  			</div>
		  			<?php 		  			
    		  			//Format Dates
                        $startDate = date("m/d/Y", strtotime($event->StartDateTime));
                        $endDate = date("m/d/Y", strtotime($event->EndDateTime));
                        if ($startDate == $endDate){
                           $endDate = date("g:i A", strtotime($event->EndDateTime)); 
                        }else{
                           $endDate = date("m/d/Y g:i A", strtotime($event->EndDateTime));
                        }
                        $startDate = date("m/d/Y g:i A", strtotime($event->StartDateTime));
                    ?>	  			
		  			
		  			<p><?php echo($startDate)?> - <?php echo($endDate)?></p>
		  			<p><?php echo($event->Address);?></p>
		  			<p><?php echo($event->City);?>&nbsp;<?php echo($event->State);?>&nbsp;<?php echo($event->ZIP);?></p>
		  			<hr>
		  			<p class="descriptionE"><?php echo($event->Description); ?></p>	  			
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
		  	<?php } else {
				  		if (isset($event)) {
						    if ($event->errors) {
						        foreach ($event->errors as $error) {
						            echo $error;
						        }
						    }
						}
					} ?>
			<br />
			<br />
	  	</section>
	  	</div>
	  	<footer>
	  		<?php require_once("footer.php"); ?>
	  	</footer>
	  	
	</body>
</html>
