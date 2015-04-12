<?php
// show potential errors / feedback (from createEvent object)
if (isset($event)) {
    if ($event->errors) {
        foreach ($event->errors as $error) {
            echo $error;
        }
    }
    if ($event->messages) {
        foreach ($event->messages as $message) {
            echo $message;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Whats Going On? - Create Event</title>
		<meta name="description" content="">
		<meta name="author" content="wetzel">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<link href="styles/cssMain.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			a[href="/WhatsGoingOn/createEventHandler.php"]
			{
				display:block;
				background-color: #E65C00;
				color: #FFFFFF;
				font-weight:bold;
			}
		</style>
		
		<script type="text/javascript">
            function Validate()
            {           
                
            }
        </script>       		

	</head>

	<body>
		<div id="wrapper">
			
		<header>
			<h1><img src="" alt="What's Going On?" /></h1>
			<div id="login">
				<?php 
				    require_once("login/loginHandler.php");                    
                    if (!isset($_SESSION['user_name']))
                    {
                        header('Location: /WhatsGoingOn/default.php');
                        die();
                    }
				?> 
			</div>			
		</header>
		<div id="text">
		<nav>
 		 	<?php require_once("navigation.php"); ?>
	  	</nav>
	  
	  	<section id="createEventSection">
	  		<form id="createEvent" name="createEvent" method="post" action="/WhatsGoingOn/createEventHandler.php">		
			
				<fieldset>
					<legend>Create Event:</legend>
					<div>
						<label for="title">Event Name:</label>  
		  					<input type="text" id="title" name="title" placeholder="Name" required/><br>
		  				Is this event free?
                        <input type="radio" name="isFree" value="0">Yes 
                        <input type="radio" name="isFree" value="1">No<br>
		  				<label for="address">Address:</label>  
                            <input type="text" id="address" name="address" placeholder="Address" required/><br>  					
						<label for="city">City:</label>  
			  				<input type="text" id="city" name="city" placeholder="City" required/><br>			  		    
			  			<label for="state">State:</label>
    						<select name="state" id="state" required>
    							<option value="">State:</option>
    							<option value="AL">Alabama</option>
    							<option value="AK">Alaska</option>
    							<option value="AS">American Samoa</option>
    							<option value="AZ">Arizona</option>
    							<option value="AR">Arkansas</option>
    							<option value="CA">California</option>
    							<option value="CO">Colorado</option>
    							<option value="CT">Connecticut</option>
    							<option value="DE">Delaware</option>
    							<option value="DC">District of Columbia</option>
    							<option value="FM">Federated States of Micronesia</option>
    							<option value="FL">Florida</option>
    							<option value="GA">Georgia</option>
    							<option value="GU">Guam</option>
    							<option value="HI">Hawaii</option>
    							<option value="ID">Idaho</option>
    							<option value="IL">Illinois</option>
    							<option value="IN">Indiana</option>
    							<option value="IA">Iowa</option>
    							<option value="KS">Kansas</option>
    							<option value="KY">Kentucky</option>
    							<option value="LA">Louisiana</option>
    							<option value="ME">Maine</option>
    							<option value="MH">Marshall Islands</option>
    							<option value="MD">Maryland</option>
    							<option value="MA">Massachusetts</option>
    							<option value="MI">Michigan</option>
    							<option value="MN">Minnesota</option>
    							<option value="MS">Mississippi</option>
    							<option value="MO">Missouri</option>
    							<option value="MT">Montana</option>
    							<option value="NE">Nebraska</option>
    							<option value="NV">Nevada</option>
    							<option value="NH">New Hampshire</option>
    							<option value="NJ">New Jersey</option>
    							<option value="NM">New Mexico</option>
    							<option value="NY">New York</option>
    							<option value="NC">North Carolina</option>
    							<option value="ND">North Dakota</option>
    							<option value="MP">Northern Mariana Islands</option>
    							<option value="OH">Ohio</option>
    							<option value="OK">Oklahoma</option>
    							<option value="OR">Oregon</option>
    							<option value="PW">Palau</option>
    							<option value="PA">Pennsylvania</option>
    							<option value="PR">Puerto Rico</option>
    							<option value="RI">Rhode Island</option>
    							<option value="SC">South Carolina</option>
    							<option value="SD">South Dakota</option>
    							<option value="TN">Tennessee</option>
    							<option value="TK">Texas</option>
    							<option value="UT">Utah</option>
    							<option value="VT">Vermont</option>
    							<option value="VI">Virgin Island</option>
    							<option value="VA">Virginia</option>
    							<option value="WA">Washington</option>
    							<option value="WV">West Virginia</option>
    							<option value="WI">Wisconsin</option>
    							<option value="WY">Wyoming</option>
    						</select><br>	
						<label for="zip">Zip Code:</label>  
				  			<input type="text" id="zip" name="zip" placeholder="five digit zip" required /><br>
				  		<label for="startDate">Start Date:</label>  
                            <input type="text" id="startDate" name="startDate" placeholder="Start Date (MM/DD/YYYY)" required /><br>
                        <label for="startTime">Start Time:</label>
                            <select name="startTime" id="startTime" required>
                                <option value="">Start Time:</option>
                                <?php  
                                    $min = "00";
                                    $hour = 12;
                                    
                                    for ($i = 0; $i < 48; $i++){                                                                                
                                        $value = $hour . ":" . $min;                                        
                                        echo "<option value=" . $value . ">" . $value . "</option>";                                            
                                        $min += 15;                                        
                                        if ($min == 60){
                                            $hour += 1;
                                            $min = "00";
                                        }
                                        if ($hour == 13){
                                            $hour = 1;
                                        }
                                    }
                                ?>
                            </select>
                            <select name="start_am_pm" id="start_am_pm" required>
                                <option value="">AM/PM</option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select><br>
                        <label for="endDate">End Date:</label>  
                            <input type="text" id="endDate" name="endDate" placeholder="End Date (MM/DD/YYYY)" required /><br>
                        <label for="endTime" id="endTimeLabel">End Time:</label>
                            <select name="endTime" id="endTime" required>
                                <option value="">End Time:</option>
                                <?php 
                                $min = "00";
                                $hour = 12;
                                
                                for ($i = 0; $i < 48; $i++){                                                                           
                                    $value = $hour . ":" . $min;                                    
                                    echo "<option value=" . $value . ">" . $value . "</option>";                                        
                                    $min += 15;                                    
                                    if ($min == 60){
                                        $hour += 1;
                                        $min = "00";
                                    }
                                    if ($hour == 13){
                                        $hour = 1;
                                    }
                                }?>
				  			</select>
                            <select name="end_am_pm" id="end_am_pm" required>
                                <option value="">AM/PM</option>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select><br>
	  					<textarea rows="8" cols="50" id="description" name="description" placeholder="Description Here!"></textarea><br>
						<img src="eventImage.jpg" alt="IMAGE HERE!" width="200" height="200"><br>
						<input type="button" id="browseImage" value="Select Image" onclick=""/><br>
						<p>Select appropriate tags (min 1):</p><br>
						<input type="checkbox" id="music" name="chk_tags[]" value="Music" />Music<br>							
						<input type="checkbox" id="sports" name="chk_tags[]" value="Sports" />Sports<br>				  			
				  		<input type="checkbox" id="annual" name="chk_tags[]" value="Annual" />Annual<br>				  			
				  		<input type="checkbox" id="party" name="chk_tags[]" value="Party" />Party<br>				  			
				  		<input type="checkbox" id="kids" name="chk_tags[]" value="Kids" />Kids<br>				  			
				  		<input type="checkbox" id="school" name="chk_tags[]" value="School" />School<br>				  			
				  		<input type="checkbox" id="public" name="chk_tags[]" value="Public" />Public<br>				  			
				  		<input type="checkbox" id="community" name="chk_tags[]" value="Community" />Community<br>				  			
				  		<input type="checkbox" id="private" name="chk_tags[]" value="Private" />Private<br>
				  				
				  		<input type="submit" value="Create Event" onclick="return Validate()" name="createEvent"/>			  			
					</div>
				</fieldset>	
			</form>		  			
	  	</section>
	  	</div><!--end of text-->
		  	<footer>
		  		<?php require_once("footer.php"); ?>
		  	</footer>
	  	</div><!--end of wrapper-->
	</body>
</html>
