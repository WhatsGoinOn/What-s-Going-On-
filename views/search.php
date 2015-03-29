<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On? - Search</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="../styles/cssMain.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			a[href="search.php"]
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
	  
	  	<section id="eventsSection">	  		
	  		<form id="searchForm" name="searchForm" method="post" action="#" onsubmit="">		
			
				<fieldset>
					<legend>Search Event:</legend>
					<div> 
			  				<input id="eventName" type="text" id="eventName" placeholder="Event Name"/> 
				  			<input id="zip" type="text" id="zipCode" placeholder="Zip"/>
				  			<input id="city" type="text" id="city" placeholder="City"/>
				  			<input id="state" type="text" id="state" placeholder="State"/>
				  		
					  		<div id="chkbx1">
					  		<label for="music">Music:</label>
					  			<input type="checkbox" id="music"/>
					  		<label for="sports">Sports:</label>
					  			<input type="checkbox" id="sports"/>
					  		<label for="annual">Annual:</label>
					  			<input type="checkbox" id="annual"/>
					  		<label for="party">Party:</label>
					  			<input type="checkbox" id="party"/>
					  		<label for="kids">Kids:</label>
					  			<input type="checkbox" id="kids"/>
					  		</div>
					  		
					  		<div id="chkbx2">
					  		<label for="school">School:</label>
					  			<input type="checkbox" id="school"/>
					  		<label for="public">Public:</label>
					  			<input type="checkbox" id="public"/>
					  		<label for="community">Community:</label>
					  			<input type="checkbox" id="community"/>
					  		<label for="private">Private:</label>
					  			<input type="checkbox" id="private"/><br/>			  			
							<!--Insert the Calendar here -->
							</div>
							
				  			<input type="submit" value="Search" onclick=""/><br>
				  				
					</div>
				</fieldset>	
			</form>
	  			
	  		<div id="results">	  			
		  			
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!" >
			  			<h3>Event Name</h3>  
			  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
			  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam 
			  			</p><br/>	  			
			  		
			  		
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!" >
			  			<h3>Event Name</h3>
			  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
			  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam 
			  			</p><br/>	
			  		
			  		
			  			<img src="../images/eventImage.jpg" alt="IMAGE HERE!" >
			  			<h3>Event Name</h3>
			  			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
			  				tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam 
			  			</p><br/>	
		  			
	  		</div>	  		
	  	</section>
	  	</div><!--end of text-->
	  	<footer>
	  		<?php require_once("../footer.php"); ?>
	  	</footer>
	  	 </div><!--end of wrapper-->
	</body>
</html>
