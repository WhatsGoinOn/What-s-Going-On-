<?php
	require_once("login/config/db.php");
	require_once("classes/Event.php");
	require_once("classes/Events.php");
	
	$events = new Events();
	$events->mainPageSearch();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On? - Home</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="styles/cssMain.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			a[href="/WhatsGoingOn/default.php"]
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
        	  
        	  	<section class="defaultSection">
        	  		<h1>Upcoming Events</h1><br/>
        	  		<?php
	    	  			if (isset($events) && $events->getCount() > 0) {
							//Display events
							for ($i = 0; $i < $events->getCount(); $i++) {
								$event = $events->getItem($i);
								$event->displayEventItem();
								
							}
						} else {
							echo("<p>No events to display.</p>");
						}
					?>
        	  	</section>
        	  	
        	  	<aside>
        	  		<!--Insert the Calendar here -->
        	  		<h1>CALENDAR HERE</h1>
        	  		<h4>Name and date of the event</h4>
        	  		<h4>Name and date of the event</h4>
        	  		<h4>Name and date of the event</h4>
        	  		<h4>Name and date of the event</h4>
        	  		<h4>Name and date of the event</h4>
        	  	</aside>
    	  	</div><!--end of text-->
    	  	
    	  	<footer>    	  	    
    	  	    <?php require_once("footer.php"); ?>
    	  	</footer>
	    </div><!--end of wrapper-->
	</body>
</html>
