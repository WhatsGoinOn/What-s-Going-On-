<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On?</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="../styles/cssMain.css" rel="stylesheet" type="text/css" />		

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
	  
		  	<section id="mapSection">
		  		<div id="map">
		  			<iframe
					  	width="600"
					  	height="450"
					  	frameborder="0" style="border:0"
					  	src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDDhZL749Ov1AhGMlAj4bAVTnAVCGvCTQM&q=-33.8569,151.2152&zoom=7">
					</iframe>
				</div>		  		
		  		
		  		<div id="nearbyEvents">
		  			<h1>Nearby Events</h1>
		  			<div>
		  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
		  			<h3>Event Name</h3><br/>
		  			</div>
		  			<div>
		  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!">
		  			<h3>Event Name</h3><br/>
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