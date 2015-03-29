<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On? - Profile</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="../styles/cssMain.css" rel="stylesheet" type="text/css" />		

		<style type="text/css">
			a[href="userProfile.php"]
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
				<?php require_once("../login/loginHandler.php"); ?> 
			</div>			
		</header>
		<div id="text">
		<nav>
 		 	<?php require_once("../navigation.php"); ?>
	  	</nav>
	  
	  	<section>
	  		<div id="userInfo">
	  			<h1>Name of the User</h1>
		  		<img src="../images/eventImage.jpg" alt="Profile Picture">
		  		<textarea rows="11" cols="50" placeholder="User Bio"></textarea><br>
		  		<label for="browseImage">Select Image</label>	
				<input type="button" id="browseImage" value="Browse" onclick=""/><br>
	  		</div>
	  		
	  		<div id="savedEvents">
	  			<h1>Saved Events</h1>
	  			<div>
	  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
	  			<h3>Event Name</h3>
	  			</div>
	  			<div>
	  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
	  			<h3>Event Name</h3>
	  			</div>
	  			<div>
	  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
	  			<h3>Event Name</h3>
	  			</div>
	  		</div>	  		
	  	</section>	  	
	  	</div><!--end of text-->
	  	<footer>
	  		<?php require_once("../footer.php"); ?>
	  	</footer>
	   </div><!--end of wrapper-->	
	</body>
</html>
