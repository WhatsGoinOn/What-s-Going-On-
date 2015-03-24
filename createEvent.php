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
			a[href="createEvent.htm"]
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
				<input type="text" placeholder="username" onclick="changeColor()"/><br>
				<input type="text" placeholder="password" onclick="changeText()"/><br>
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
	  
	  	<section id="createEventSection">
	  		<form id="createEvent" name="createEvent" method="post" action="#" onsubmit="">		
			
				<fieldset>
					<legend>Create Event:</legend>
					<div>
						<label for="eventName">Event Name:</label>  
		  					<input type="text" id="eventName"/><br>						
						<label for="city">City:</label>  
			  				<input type="text" id="city"/><br>	
			  			<label for="state" id="stateLabel">State:</label>
						<select name="state" id="state">
							<option value="">Select</option>
							<option value="AL">Alabama - AL</option>
							<option value="AK">Alaska - AK</option>
							<option value="AS">American Samoa - AS</option>
							<option value="AK">Arizona - AZ</option>
							<option value="AR">Arkansas - AR</option>
							<option value="CA">California - CA</option>
							<option value="CO">Colorado - CO</option>
							<option value="CT">Connecticut - CT</option>
							<option value="DE">Delaware - DE</option>
							<option value="DC">District of Columbia - DC</option>
							<option value="FM">Federated States of Micronesia - FM</option>
							<option value="FL">Florida - FL</option>
							<option value="GA">Georgia - GA</option>
							<option value="GU">Guam - GU</option>
							<option value="HI">Hawaii - HI</option>
							<option value="ID">Idaho - ID</option>
							<option value="IL">Illinois - IL</option>
							<option value="IN">Indiana - IN</option>
							<option value="IA">Iowa - IA</option>
							<option value="KS">Kansas - KS</option>
							<option value="KY">Kentucky - KY</option>
							<option value="LA">Louisiana - LA</option>
							<option value="ME">Maine - ME</option>
							<option value="MH">Marshall Islands - MH</option>
							<option value="MD">Maryland - MD</option>
							<option value="MA">Massachusetts - MA</option>
							<option value="MI">Michigan - MI</option>
							<option value="MN">Minnesota - MN</option>
							<option value="MS">Mississippi - MS</option>
							<option value="MO">Missouri - MO</option>
							<option value="MT">Montana - MT</option>
							<option value="NE">Nebraska - NE</option>
							<option value="NV">Nevada - NV</option>
							<option value="NH">New Hampshire - NH</option>
							<option value="NJ">New Jersey - NJ</option>
							<option value="NM">New Mexico - NM</option>
							<option value="NY">New York - NY</option>
							<option value="NC">North Carolina - NC</option>
							<option value="ND">North Dakota - ND</option>
							<option value="MP">Northern Mariana Islands - MP</option>
							<option value="OH">Ohio - OH</option>
							<option value="OK">Oklahoma - OK</option>
							<option value="OR">Oregon - OR</option>
							<option value="PW">Palau - PW</option>
							<option value="PA">Pennsylvania - PA</option>
							<option value="PR">Puerto Rico - PR</option>
							<option value="RI">Rhode Island - RI</option>
							<option value="SC">South Carolina - SC</option>
							<option value="SD">South Dakota - SD</option>
							<option value="TN">Tennessee - TN</option>
							<option value="TK">Texas - TX</option>
							<option value="UT">Utah - UT</option>
							<option value="VT">Vermont - VT</option>
							<option value="VI">Virgin Island - VI</option>
							<option value="VA">Virginia - VA</option>
							<option value="WA">Washington - WA</option>
							<option value="WV">West Virginia - WV</option>
							<option value="WI">Wisconsin - WI</option>
							<option value="WY">Wyoming - WY</option>
						</select><br>	
						<label for="zipCode">Zip Code:</label>  
				  			<input type="text" id="zipCode"/><br>
				  		<!--Insert the Calendar here -->
	  					<h1>CALENDAR HERE</h1>	
	  					<textarea rows="8" cols="50" placeholder="Type Description Here!"></textarea>/><br>
						<img src="eventImage.jpg" alt="IMAGE HERE!" width="200" height="200"><br>
						<label for="browseImage">Select Image</label>	
							<input type="button" id="browseImage" value="Browse" onclick=""/><br>
						<p>Select appropriate tags:</p>
						<input type="checkbox" id="music"/>
							<label for="music">Music</label><br>
						<input type="checkbox" id="sports"/>
				  			<label for="sports">Sports</label><br>	
				  		<input type="checkbox" id="annual"/>	  			
				  			<label for="annual">Annual</label><br>
				  		<input type="checkbox" id="party"/>
				  			<label for="party">Party</label><br>
				  		<input type="checkbox" id="kids"/>
				  			<label for="kids">Kids</label><br>
				  		<input type="checkbox" id="school"/>
				  			<label for="school">School</label><br>
				  		<input type="checkbox" id="public"/>
				  			<label for="public">Public</label><br>
				  		<input type="checkbox" id="community"/>
				  			<label for="community">Community</label><br>
				  		<input type="checkbox" id="private"/>
				  			<label for="private">Private</label><br>	
				  		<input type="submit" value="Create Event" onclick=""/>			  			
					</div>
				</fieldset>	
			</form>		  			
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
