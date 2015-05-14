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
		<!-- Stuff for calendar search -->		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	    <script>
			$(function() {
		    	$( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
		  	});
		</script>
	</head>

	<!-- init() is for calendar search -->
	<body onload="init()">
		<div id="wrapper">			
    		<header>
    			<h1>What's Going On?<!--img src="" alt="What's Going On?">--></h1>
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
        	  		<form action="search.php" method="get">
			            <input type="text" name="date" id="date" placeholder="Search by date">
			            <input type="submit" value="Search">
			        </form>
        	  	</aside>
    	  	</div><!--end of text-->
    	  	
    	  	<footer>    	  	    
    	  	    <?php require_once("footer.php"); ?>
    	  	</footer>
	    </div><!--end of wrapper-->
	</body>
</html>
