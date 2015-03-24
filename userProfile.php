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
			a[href="userProfile.htm"]
			{
				display:block;
				background-color: #E65C00;
				color: #FFFFFF;
				font-weight:bold;
			}
		</style>
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
	  
	  	<section>
	  		<div id="userInfo">
	  			<h1>Name of the User</h1>
		  		<img src="eventImage.jpg" alt="Profile Picture">
		  		<textarea rows="11" cols="50" placeholder="User Bio"></textarea><br>
		  		<label for="browseImage">Select Image</label>	
				<input type="button" id="browseImage" value="Browse" onclick=""/><br>
	  		</div>
	  		
	  		<div id="savedEvents">
	  			<h1>Saved Events</h1>
	  			<div>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!">
	  			<h3>Event Name</h3>
	  			</div>
	  			<div>
	  			<img src="eventImage.jpg" alt="IMAGE HERE!">
	  			<h3>Event Name</h3>
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
