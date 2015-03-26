<?php
	require_once("login/config/db.php");
	require_once("classes/Event.php");
	
	$eventExists = true; //Variable to determine rendering of event or not
	
	$event = new Event();
	if (!isempty($_GET["id"])) {
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
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="" rel="stylesheet" type="text/css" />		

	</head>

	<body>
		<header>
			<h1><img src="" alt="What's Going On?" /></h1>
			<div id="login">
				<input type="text" placeholder="username" onclick="changeColor()"/><br>
				<input type="text" placeholder="password" onclick="changeText()"/><br>
				<input type="button" value="login" onclick=""/>
				<a href="createAccount.htm">or Create Account</a> 
			</div>			
		</header>
		
		<nav>
 		 	<ul>
	     	    <li><a href="default.htm">Home</a></li>
	  	   	    <li><a href="events.htm">Events</a></li>
	   		    <li><a href="map.htm">Map</a></li>
	   		    <li><a href="createEvent.htm">Create</a></li>
	   		    <li><a href="userProfile.htm">Profile</a></li>
 	    	</ul>
	  	</nav>
	  
	  	<section>		  			
	  		<div id="eventName">
	  			<h1>Name of the Event</h1>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="300" height="200">
	  			<p>Event description</p>	  			
	  		</div>	
	  		
	  		<div id="">
	  			<!--Not sure what Andrew was planning on the wireframe for the event 
	  				article on the right hand side of the page, but it will go here-->
	  		</div>
	  		
	  		<div id="similarEvents">
	  			<h1>Similar Events</h1>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
	  			<h3>Event Name</h3>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
	  			<h3>Event Name</h3>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
	  			<h3>Event Name</h3>
	  		</div>  		
	  	</section>
	  	
	  	<footer>
	  		<address>Whats Going On? &bull;
               Whats Going On? &bull;
               Whats Going On? &bull;
               Whats Going On?
      		</address>
	  	</footer>
	  	
	</body>
</html>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On?</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="" rel="stylesheet" type="text/css" />		

	</head>

	<body>
		<header>
			<h1><img src="" alt="What's Going On?" /></h1>
			<div id="login">
				<input type="text" placeholder="username" onclick="changeColor()"/><br>
				<input type="text" placeholder="password" onclick="changeText()"/><br>
				<input type="button" value="login" onclick=""/>
				<a href="createAccount.htm">or Create Account</a> 
			</div>			
		</header>
		
		<nav>
 		 	<ul>
	     	    <li><a href="default.htm">Home</a></li>
	  	   	    <li><a href="events.htm">Events</a></li>
	   		    <li><a href="map.htm">Map</a></li>
	   		    <li><a href="createEvent.htm">Create</a></li>
	   		    <li><a href="userProfile.htm">Profile</a></li>
 	    	</ul>
	  	</nav>
	  
	  	<section>		  			
	  		<div id="eventName">
	  			<h1>Name of the Event</h1>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="300" height="200">
	  			<p>Event description</p>	  			
	  		</div>	
	  		
	  		<div id="">
	  			<!--Not sure what Andrew was planning on the wireframe for the event 
	  				article on the right hand side of the page, but it will go here-->
	  		</div>
	  		
	  		<div id="similarEvents">
	  			<h1>Similar Events</h1>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
	  			<h3>Event Name</h3>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
	  			<h3>Event Name</h3>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" width="100" height="100">
	  			<h3>Event Name</h3>
	  		</div>  		
	  	</section>
	  	
	  	<footer>
	  		<address>Whats Going On? &bull;
               Whats Going On? &bull;
               Whats Going On? &bull;
               Whats Going On?
      		</address>
	  	</footer>
	  	
	</body>
</html>
