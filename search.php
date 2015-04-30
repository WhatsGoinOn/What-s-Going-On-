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
			a[href="search.php"]
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
	  
	  	<section id="searchList">
			<?php
				if (isset($events) && $events->getCount() > 0) {
					//Display events
					for ($i = 0; $i < $events->getCount(); $i++) {
						$event = $events->getItem($i);
						$event->displayEventItem();
						echo("<hr class=\"eventItemSeparator\" />");
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
