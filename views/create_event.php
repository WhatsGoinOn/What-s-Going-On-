<?php
// show potential errors / feedback (from event object)
if (isset($event)) {
    if ($event->errors) {
        foreach ($event->errors as $error) {
            if ($error == "Sorry, your event creation failed. Please go back and try again." 
                || $error == "Sorry, no database connection."
                || $error == "An unknown error occurred."
                || $error == "Sorry, that event has already been created."){
                echo $error . "<br>";
            }            
        }
    }
    if ($event->messages) {
        foreach ($event->messages as $message) {
            echo $message;
        }
    }
}

if (!isset($_SESSION)) {
    session_start();
}

// Unset session variables if the $_POST['createEvent'] variable is not set
if (!isset($_POST['createEvent'])){
    if(isset($_SESSION['title'])) unset($_SESSION['title']);
    if(isset($_SESSION['isFree'])) unset($_SESSION['isFree']);
    if(isset($_SESSION['address'])) unset($_SESSION['address']); 
    if(isset($_SESSION['city'])) unset($_SESSION['city']);
    if(isset($_SESSION['state'])) unset($_SESSION['state']); 
    if(isset($_SESSION['zip'])) unset($_SESSION['zip']);
    if(isset($_SESSION['startDate'])) unset($_SESSION['startDate']); 
    if(isset($_SESSION['startTime'])) unset($_SESSION['startTime']);
    if(isset($_SESSION['start_am_pm'])) unset($_SESSION['start_am_pm']);
    if(isset($_SESSION['endDate'])) unset($_SESSION['endDate']); 
    if(isset($_SESSION['endTime'])) unset($_SESSION['endTime']);
    if(isset($_SESSION['end_am_pm'])) unset($_SESSION['end_am_pm']);
    if(isset($_SESSION['description'])) unset($_SESSION['description']);
    session_write_close();
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
		
		<!-- Stuff for calendar search -->        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#startDate" ).datepicker({ dateFormat: 'mm/dd/yy' }).val();
                $( "#endDate" ).datepicker({ dateFormat: 'mm/dd/yy' }).val();
            });            
        </script>       		

	</head>
    
    <!-- init() is for calendar search -->
    <body onload="init()">
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
	  		<form id="createEvent" name="createEvent" method="post" action="" enctype="multipart/form-data">		
			
				<fieldset>
					<legend>Create Event:</legend>
					<div>
					    <table border="0">
					        <tr>
    						    <td>
    						        <label for="title">Event Name:</label>
						        </td>
						        <td>  
    		  			            <input type="text" id="title" name="title" 		  			          
    		  					    value="<?php if(isset($_SESSION['title'])){echo htmlspecialchars($_SESSION['title']);} ?>" required/>
    		  					        <?php if(isset($event)) {
                                             if ($event->errors) {
                                                 foreach ($event->errors as $error) {
                                                     if($error == "Enter an event name"){
                                                         echo "<span class='error'>" . $error . "</span>";
                                                     }
                                                 }
                                             }
                                         } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Is this event free?</label> 
                                </td>
                                <td>
                                    Yes<input type="radio" class="radioBtn" name="isFree" value="Yes" <?php if(isset($_SESSION['isFree'])){if(($_SESSION['isFree']) == 'Yes') { echo 'checked';} } ?> required> 
                                    No<input type="radio" class="radioBtn" name="isFree" value="No" <?php if(isset($_SESSION['isFree'])){if(($_SESSION['isFree']) ==  'No') { echo 'checked';} } ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address">Address:</label>  
                                </td>
                                <td>
                                    <input type="text" id="address" name="address" 
                                    value="<?php if(isset($_SESSION['address'])){echo htmlspecialchars($_SESSION['address']);} ?>" required/>
                                        <?php if(isset($event)) {
                                            if ($event->errors) {
                                                foreach ($event->errors as $error) {
                                                    if($error == "Enter an address"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }
                                                }
                                            }
                                        } ?>
                                </td>
                            </tr>
    		  				<tr>
    		  				    <td>
    		  				        <label for="city">City:</label> 
    		  				    </td>
    		  				    <td>
    		  				        <input type="text" name="city" 
                                   value="<?php if(isset($_SESSION['city'])){echo htmlspecialchars($_SESSION['city']);} ?>" required/>
                                       <?php if(isset($event)) {
                                            if ($event->errors) {
                                                foreach ($event->errors as $error) {
                                                    if($error == "Enter a city name"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }
                                                }
                                            }
                                        } ?>
    		  				    </td>
    		  				</tr>   
                            <tr>
                                <td>
                                    <label for="state">State:</label>
                                </td>
                                <td>
                                    <select name="state" style="width:66.5%;" required>
                                        <option value="" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == '') { echo 'selected="selected"';} } ?>></option>
                                        <option value="AL" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'AL') { echo 'selected="selected"';} } ?>>Alabama</option>
                                        <option value="AK" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'AK') { echo 'selected="selected"';} } ?>>Alaska</option>
                                        <option value="AS" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'AS') { echo 'selected="selected"';} } ?>>American Samoa</option>
                                        <option value="AZ" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'AZ') { echo 'selected="selected"';} } ?>>Arizona</option>
                                        <option value="AR" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'AR') { echo 'selected="selected"';} } ?>>Arkansas</option>
                                        <option value="CA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'CA') { echo 'selected="selected"';} } ?>>California</option>
                                        <option value="CO" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'CO') { echo 'selected="selected"';} } ?>>Colorado</option>
                                        <option value="CT" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'CT') { echo 'selected="selected"';} } ?>>Connecticut</option>
                                        <option value="DE" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'DE') { echo 'selected="selected"';} } ?>>Delaware</option>
                                        <option value="DC" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'DC') { echo 'selected="selected"';} } ?>>District of Columbia</option>
                                        <option value="FM" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'FM') { echo 'selected="selected"';} } ?>>Federated States of Micronesia</option>
                                        <option value="FL" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'FL') { echo 'selected="selected"';} } ?>>Florida</option>
                                        <option value="GA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'GA') { echo 'selected="selected"';} } ?>>Georgia</option>
                                        <option value="GU" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'GU') { echo 'selected="selected"';} } ?>>Guam</option>
                                        <option value="HI" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'HI') { echo 'selected="selected"';} } ?>>Hawaii</option>
                                        <option value="ID" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'ID') { echo 'selected="selected"';} } ?>>Idaho</option>
                                        <option value="IL" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'IL') { echo 'selected="selected"';} } ?>>Illinois</option>
                                        <option value="IN" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'IN') { echo 'selected="selected"';} } ?>>Indiana</option>
                                        <option value="IA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'IA') { echo 'selected="selected"';} } ?>>Iowa</option>
                                        <option value="KS" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'KS') { echo 'selected="selected"';} } ?>>Kansas</option>
                                        <option value="KY" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'KY') { echo 'selected="selected"';} } ?>>Kentucky</option>
                                        <option value="LA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'LA') { echo 'selected="selected"';} } ?>>Louisiana</option>
                                        <option value="ME" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'ME') { echo 'selected="selected"';} } ?>>Maine</option>
                                        <option value="MH" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MH') { echo 'selected="selected"';} } ?>>Marshall Islands</option>
                                        <option value="MD" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MD') { echo 'selected="selected"';} } ?>>Maryland</option>
                                        <option value="MA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MA') { echo 'selected="selected"';} } ?>>Massachusetts</option>
                                        <option value="MI" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MI') { echo 'selected="selected"';} } ?>>Michigan</option>
                                        <option value="MN" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MN') { echo 'selected="selected"';} } ?>>Minnesota</option>
                                        <option value="MS" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MS') { echo 'selected="selected"';} } ?>>Mississippi</option>
                                        <option value="MO" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MO') { echo 'selected="selected"';} } ?>>Missouri</option>
                                        <option value="MT" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MT') { echo 'selected="selected"';} } ?>>Montana</option>
                                        <option value="NE" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NE') { echo 'selected="selected"';} } ?>>Nebraska</option>
                                        <option value="NV" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NV') { echo 'selected="selected"';} } ?>>Nevada</option>
                                        <option value="NH" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NH') { echo 'selected="selected"';} } ?>>New Hampshire</option>
                                        <option value="NJ" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NJ') { echo 'selected="selected"';} } ?>>New Jersey</option>
                                        <option value="NM" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NM') { echo 'selected="selected"';} } ?>>New Mexico</option>
                                        <option value="NY" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NY') { echo 'selected="selected"';} } ?>>New York</option>
                                        <option value="NC" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'NC') { echo 'selected="selected"';} } ?>>North Carolina</option>
                                        <option value="ND" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'ND') { echo 'selected="selected"';} } ?>>North Dakota</option>
                                        <option value="MP" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'MP') { echo 'selected="selected"';} } ?>>Northern Mariana Islands</option>
                                        <option value="OH" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'OH') { echo 'selected="selected"';} } ?>>Ohio</option>
                                        <option value="OK" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'OK') { echo 'selected="selected"';} } ?>>Oklahoma</option>
                                        <option value="OR" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'OR') { echo 'selected="selected"';} } ?>>Oregon</option>
                                        <option value="PW" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'PW') { echo 'selected="selected"';} } ?>>Palau</option>
                                        <option value="PA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'PA') { echo 'selected="selected"';} } ?>>Pennsylvania</option>
                                        <option value="PR" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'PR') { echo 'selected="selected"';} } ?>>Puerto Rico</option>
                                        <option value="RI" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'RI') { echo 'selected="selected"';} } ?>>Rhode Island</option>
                                        <option value="SC" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'SC') { echo 'selected="selected"';} } ?>>South Carolina</option>
                                        <option value="SD" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'SD') { echo 'selected="selected"';} } ?>>South Dakota</option>
                                        <option value="TN" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'TN') { echo 'selected="selected"';} } ?>>Tennessee</option>
                                        <option value="TK" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'TK') { echo 'selected="selected"';} } ?>>Texas</option>
                                        <option value="UT" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'UT') { echo 'selected="selected"';} } ?>>Utah</option>
                                        <option value="VT" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'VT') { echo 'selected="selected"';} } ?>>Vermont</option>
                                        <option value="VI" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'VI') { echo 'selected="selected"';} } ?>>Virgin Island</option>
                                        <option value="VA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'VA') { echo 'selected="selected"';} } ?>>Virginia</option>
                                        <option value="WA" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'WA') { echo 'selected="selected"';} } ?>>Washington</option>
                                        <option value="WV" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'WV') { echo 'selected="selected"';} } ?>>West Virginia</option>
                                        <option value="WI" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'WI') { echo 'selected="selected"';} } ?>>Wisconsin</option>
                                        <option value="WY" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == 'WY') { echo 'selected="selected"';} } ?>>Wyoming</option>
                                    </select>
                                    <?php if(isset($event)) {
                                            if ($event->errors) {
                                                foreach ($event->errors as $error) {
                                                    if($error == "Select a state name"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }
                                                }
                                            }
                                        } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="zip">Zip Code (5 digits):</label> 
                                </td>
                                <td>
                                    <input type="text" name="zip"
                                    value="<?php if(isset($_SESSION['zip'])){echo htmlspecialchars($_SESSION['zip']);} ?>" required />
                                        <?php if(isset($event)) {
                                            if ($event->errors) {
                                                foreach ($event->errors as $error) {
                                                    if($error == "Enter a five digit zip code"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Zip code must be five numerical digits"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Sorry, please enter a valid zipcode"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }
                                                }
                                            }
                                        } ?>
                                </td>
                            </tr>	
    						<tr>
    						    <td>
    						        <label for="startDate">Start Date:</label>
    						    </td>
    						    <td>
    						        <input type="text" id="startDate" name="startDate"
                                    value="<?php if(isset($_SESSION['startDate'])){echo htmlspecialchars($_SESSION['startDate']);} ?>" required />
                                        <?php if(isset($event)) {
                                            if ($event->errors) {
                                                foreach ($event->errors as $error) {
                                                    if($error == "Enter a start date"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Enter a valid start date"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Enter a start date and time that has not already passed"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }
                                                }
                                            }
                                        } ?>
    						    </td>
    						</tr>
    						<tr>
    						    <td>
    						        <label for="startTime">Start Time:</label>
    						    </td>
    						    <td>
    						        <select name="startTime" id="startTime" required>
                                    <option value=""></option>
                                    <?php  
                                        $min = "00";
                                        $hour = 12;
                                        
                                        for ($i = 0; $i < 48; $i++){                                                                                
                                            $value = $hour . ":" . $min;   
                                            if(isset($_SESSION['startTime'])){
                                                if(($_SESSION['startTime']) == $value){
                                                    echo "<option value= ". $value . " selected='selected'>" . $value . "</option>\n";
                                                }else{
                                                    echo "<option value=" . $value . ">" . $value . "</option>\n";
                                                } 
                                            }else{
                                                echo "<option value=" . $value . ">" . $value . "</option>\n";    
                                            }                                                                                    
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
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Select a start time"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }
                                    } ?>    						   
    						        AM<input type="radio" class="radioBtn" name="start_am_pm" value="AM" <?php if(isset($_SESSION['start_am_pm'])){if(($_SESSION['start_am_pm']) == 'AM') { echo 'checked';} } ?> required> 
                                    PM<input type="radio" class="radioBtn" name="start_am_pm" value="PM" <?php if(isset($_SESSION['start_am_pm'])){if(($_SESSION['start_am_pm']) == 'PM') { echo 'checked';} } ?>>
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Select a meridiem for the start time"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }
                                    } ?>
    						    </td>
    						</tr>
    						<tr>
    						    <td>
    						        <label for="endDate">End Date:</label>
    						    </td>
    						    <td>
    						        <input type="text" id="endDate" name="endDate"
                                    value="<?php if(isset($_SESSION['endDate'])){echo htmlspecialchars($_SESSION['endDate']);} ?>" required />
                                        <?php if(isset($event)) {
                                            if ($event->errors) {
                                                foreach ($event->errors as $error) {
                                                    if($error == "Enter an end date"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Enter a valid end date"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Enter an end date and time that has not already passed"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }elseif($error == "Enter an end date and time that is later than the start time date"){
                                                        echo "<span class='error'>" . $error . "</span>";
                                                    }
                                                }
                                            }
                                        } ?>
    						    </td>
    						</tr>
    						<tr>
    						    <td>
    						        <label for="endTime" id="endTimeLabel">End Time:</label>
    						    </td>
    						    <td>
    						        <select name="endTime" id="endTime" required>
                                    <option value=""></option>
                                    <?php 
                                    $min = "00";
                                    $hour = 12;
                                    
                                    for ($i = 0; $i < 48; $i++){                                                                           
                                        $value = $hour . ":" . $min;
                                        if(isset($_SESSION['endTime'])){
                                            if(($_SESSION['endTime']) == $value){
                                                echo "<option value= ". $value . " selected='selected'>" . $value . "</option>\n";
                                            }else{
                                                echo "<option value=" . $value . ">" . $value . "</option>\n";
                                            }
                                        }else{
                                            echo "<option value=" . $value . ">" . $value . "</option>\n";    
                                        }                                       
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
                                   <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Select a end time"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }
                                    } ?>    						    
    						        AM<input type="radio" class="radioBtn" name="end_am_pm" value="AM" <?php if(isset($_SESSION['end_am_pm'])){if(($_SESSION['end_am_pm']) == 'AM') { echo 'checked';} } ?> required> 
                                    PM<input type="radio" class="radioBtn" name="end_am_pm" value="PM" <?php if(isset($_SESSION['end_am_pm'])){if(($_SESSION['end_am_pm']) == 'PM') { echo 'checked';} } ?>>
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Select a meridiem for the end time"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }
                                    } ?>
    						    </td>
    						</tr>
                            <tr>
                                <td colspan="2">
                                    <textarea rows="10" cols="50" name="description" placeholder="Description Here!"><?php if(isset($_SESSION['description'])){echo htmlspecialchars($_SESSION['description']);} ?></textarea>
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter a description"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }elseif($error == "Only 500 chartacters allowed in the description"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }
                                    } ?> 
                                </td>
                            </tr>
                            <!-- Image Upload section -->
    	  					<tr>
    	  					    <td>
    	  					        <input type="hidden" name="MAX_FILE_SIZE" value="65535">
                                    <label for="userfile">Event Image (max 63KB):</label>
    	  					    </td>
    	  					    <td>
    	  					        <input name="userfile" type="file" id="userfile">
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter a description"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }elseif($error == "There was an issue with the image upload."){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }                                    } ?>
    	  					    </td>
    	  					</tr>
                        </table>
				  		<input type="submit" value="Create Event" name="createEvent"/><br/>                
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

<?php 
if(isset($_SESSION['title'])) unset($_SESSION['title']);
if(isset($_SESSION['isFree'])) unset($_SESSION['isFree']);
if(isset($_SESSION['address'])) unset($_SESSION['address']); 
if(isset($_SESSION['city'])) unset($_SESSION['city']);
if(isset($_SESSION['state'])) unset($_SESSION['state']); 
if(isset($_SESSION['zip'])) unset($_SESSION['zip']);
if(isset($_SESSION['startDate'])) unset($_SESSION['startDate']); 
if(isset($_SESSION['startTime'])) unset($_SESSION['startTime']);
if(isset($_SESSION['start_am_pm'])) unset($_SESSION['start_am_pm']);
if(isset($_SESSION['endDate'])) unset($_SESSION['endDate']); 
if(isset($_SESSION['endTime'])) unset($_SESSION['endTime']);
if(isset($_SESSION['end_am_pm'])) unset($_SESSION['end_am_pm']);
if(isset($_SESSION['description'])) unset($_SESSION['description']);
session_write_close();
?>
