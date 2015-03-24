<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On?</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="cssMain.css" rel="stylesheet" type="text/css" />		

		<style type="text/css">
			a[href="map.php"]
			{
				display:block;
				background-color: #E65C00;
				color: #FFFFFF;
				font-weight:bold;
			}
			
			#map-canvas {
		        width: 500px;
		        height: 400px;
		      }
		</style>
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script>
			function initialize() {
			    var mapCanvas = document.getElementById('map-canvas');
			    var mapOptions = {
					center: new google.maps.LatLng(44.5403, -78.5463),
					zoom: 8,
					mapTypeId: google.maps.MapTypeId.ROADMAP
			    }
				var map = new google.maps.Map(mapCanvas, mapOptions);
			}
			//Load map on page load
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>

	<body>
		<div id="wrapper">
		<header>
			<h1><img src="" alt="What's Going On?" /></h1>
			<div id="login">
				<input type="text" placeholder="username"/><br>
				<input type="text" placeholder="password"/><br>
				<input type="button" value="login" onclick=""/><br/>
				<a href="createAccount.htm">or Create Account</a> 
			</div>			
		</header>
		<div id="text">
			<nav>
	 		 	<ul>
		     	    <li><a href="default.php">Home</a></li>
                    <li><a href="events.php">Search Events</a></li>
                    <li><a href="map.php">Map</a></li>
                    <li><a href="createEvent.php">Create Event</a></li>
                    <li><a href="userProfile.php">User Profile</a></li>
	 	    	</ul>
		  	</nav>
	  
		  	<section id="mapSection">
		  		<div id="map">
		  			<div id="map-canvas"></div>
		  			<div id="mapSearch">
			  			<input type="text" placeholder="Choose starting point"/><br>
						<input type="text" placeholder="Choose destination"/><br>
						<input type="button" id="getDirections" value="Get Directions" onclick=""/><br>
					</div>	
		  		</div>
		  		
		  		<div id="nearbyEvents">
		  			<h1>Nearby Events</h1>
		  			<div>
		  			<img src="eventImage.jpg" alt="IMAGE HERE!">
		  			<h3>Event Name</h3><br/>
		  			</div>
		  			<div>
		  			<img src="eventImage.jpg" alt="IMAGE HERE!">
		  			<h3>Event Name</h3><br/>
		  			</div>
		  			<div>
		  			<img src="eventImage.jpg" alt="IMAGE HERE!">
		  			<h3>Event Name</h3>
		  			</div>
		  		</div>	
		  	</section>	  	
	  	</div><!--end of text-->
	  	<footer>
	  		<address>Copyright &copy; 2015
               Whats Going On? &bull;
               Whats Going On?
      		</address>
	  	</footer>
	  	</div><!--end of wrapper-->
	</body>
</html>
