<?php
	require_once("login/config/db.php");
	require_once("classes/Event.php");
	require_once("classes/Events.php");
	
	$events = new Events();
	if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] > 0) {
		$events->search($_GET["page"]);
	} else {
		$events->search(1);
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
			a[href="/WhatsGoingOn/search.php"]
			{
				display:block;
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
		    	$( "#date" ).datepicker({ dateFormat: 'mm-dd-yy' }).val();
		  	});
		</script>
	</head>

	<!-- init() is for calendar search -->
	<body onload="init()">
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
	  
	  	<section id="searchForm">
	  		<form action="" method="get">
	  			<input name="keyword" type="text" placeholder="Keyword"
	  				<?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])) { echo("value=\"" . $_GET['keyword']) . '"'; } ?>/> 
	  			<br />
	  			<input name="zip" type="text" placeholder="ZIP"
	  				<?php if (isset($_GET['zip']) && !empty($_GET['zip'])) { echo("value=\"" . $_GET['zip']) . '"'; } ?>/>
	  			<br />
	  			<input name="date" id="date" type="text" placeholder="Date"
	  				<?php if (isset($_GET['date']) && !empty($_GET['date'])) { echo("value=\"" . $_GET['date']) . '"'; } ?>/>
	  			<br />
	  			<input name="allowcancelled" type="checkbox"
	  				<?php if (isset($_GET['allowcancelled'])) { echo("checked"); } ?>/>
	  			<label for="allowcancelled">Allow cancelled events.</label>
	  			<br />
	  			<input name="allowover" type="checkbox"
	  				<?php if (isset($_GET['allowover'])) { echo("checked"); } ?>/>
	  			<label for="allowover">Allow events that are over.</label>
	  			<br />
	  			<input type="submit" value="Search"/>
	  		</form>
	  	</section>
	  	<section id="searchList">
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
	  	</div>
	  	<footer>
	  		<?php require_once("footer.php"); ?>
	  	</footer>
	  	
	</body>
</html>
