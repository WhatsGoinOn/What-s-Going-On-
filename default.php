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
			a[href="default.php"]
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
 		 	<ul>
	     	    <li><a href="default.php">Home</a></li>
	  	   	    <li><a href="events.php">Search Events</a></li>
	   		    <li><a href="map.php">Map</a></li>
	   		    <li><a href="createEvent.php">Create Event</a></li>
	   		    <li><a href="userProfile.php">User Profile</a></li>
 	   		</ul>
	  	</nav>
	  
	  	<section>
	  		<h1>Featured Upcoming Events!</h1><br/>
	  		
	  			<img src="eventImage.jpg" alt="IMAGE HERE!" >
	  		<div class="eventName">
	  			<h3>Event Name</h3>  
	  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod 
	  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, 
	  				quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
					Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum 
					dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit 
					praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>		  			
	  		</div>
	  		
	  			<img src="eventImage.jpg" alt="IMAGE HERE!">
	  		<div class="eventName">
	  			<h3>Event Name</h3>
	  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod 
	  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, 
	  				quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
					Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum 
					dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit 
					praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
	  		</div>
	  		
	  			<img src="eventImage.jpg" alt="IMAGE HERE!">
	  		<div class="eventName">
	  			<h3>Event Name</h3>
	  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod 
	  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, 
	  				quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
					Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum 
					dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit 
					praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
	  		</div>
	  		
	  			<img src="eventImage.jpg" alt="IMAGE HERE!">
	  		<div class="eventName">
	  			<h3>Event Name</h3>
	  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod 
	  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, 
	  				quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
					Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum 
					dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit 
					praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>	
	  		</div>
	  		
	  			<img src="eventImage.jpg" alt="IMAGE HERE!">
	  		<div class="eventName">
	  			<h3>Event Name</h3>
	  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod 
	  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, 
	  				quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
					Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum 
					dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit 
					praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>	
	  		</div>	  		
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
	  		<address>Copyright &copy; 2015
               Whats Going On? &bull;
               Whats Going On?
      		</address>
	  	</footer>
	 </div><!--end of wrapper-->
	</body>
</html>
