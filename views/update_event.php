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

    if (!isset($_POST["updateEvent"])) {
        $event = new Event();
        $eventID = 14;
        $event->fetchFromId($eventID);
        
        if (!isset($_SESSION)){
            session_start();            
        }
        
        if ($event->IsFree == 0){
            $isFree = "Yes";
        }elseif($event->IsFree == 1){
            $isFree = "No";
        }
        
        $startDate = date("d/m/Y", strtotime($event->StartDateTime));
        $endDate = date("d/m/Y", strtotime($event->EndDateTime));
        $startTime = date("H:i", strtotime($event->StartDateTime));        
        $endTime = date("H:i", strtotime($event->EndDateTime));
        $start_am_pm;
        $end_am_pm;
        
        $startTimeArray = explode(':', $startTime);
        if ($startTimeArray[0] == 0){
            $startTime = 12 . ":" . $startTimeArray[1];
            $start_am_pm = "AM";
        }elseif($startTimeArray[0] > 12){
            $startTime = ($startTimeArray[0] - 12) . ":" . $startTimeArray[1];
            $start_am_pm = "PM"; 
        }elseif($startTimeArray[0] == 12){
            $start_am_pm = "PM";
        }else{
            $start_am_pm = "AM";
        } 
        
        $endTimeArray = explode(':', $endTime);
        if ($endTimeArray[0] == 0){
            $endTime = 12 . ":" . $endTimeArray[1];
            $end_am_pm = "AM";
        }elseif($endTimeArray[0] > 12){
            $endTime = ($endTimeArray[0] - 12) . ":" . $endTimeArray[1];
            $end_am_pm = "PM"; 
        }elseif($endTimeArray[0] == 12){
            $end_am_pm = "PM";
        }else{
            $end_am_pm = "AM";
        }     
        
        $_SESSION['title'] = $event->Title;
        $_SESSION['isFree'] = $isFree;
        $_SESSION['address'] = $event->Address;
        $_SESSION['city'] = $event->City;
        $_SESSION['state'] = $event->State;
        $_SESSION['zip'] = $event->ZIP;
        $_SESSION['startDate'] = $startDate;
        $_SESSION['startTime'] = $startTime;
        $_SESSION['start_am_pm'] = $start_am_pm;
        $_SESSION['endDate'] = $endDate;
        $_SESSION['endTime'] = $endTime;
        $_SESSION['end_am_pm'] = $end_am_pm;
        $_SESSION['description'] = $event->Description;
        session_write_close();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Whats Going On? - Update Event</title>
        <meta name="description" content="">
        <meta name="author" content="wetzel">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        
        <link href="styles/cssMain.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            a[href="/WhatsGoingOn/updateEventHandler.php"]
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
                var Title = document.getElementById("title");             
                var Address = document.getElementById("address");
                var City = document.getElementById("city");
                var State = document.getElementById("state");
                var Zip = document.getElementById("zip");
                var StartDate = document.getElementById("startDate");
                var StartTime = document.getElementById("startTime");
                var StartAmPm = document.getElementById("start_am_pm");
                var EndDate = document.getElementById("endDate");
                var EndTime = document.getElementById("endTime");
                var EndAmPm = document.getElementById("end_am_pm");                
                
                if ()
                {
                   
                    return false;
                } 
                else if ()
                {
                    
                    return false;
                }
                else 
                {
                    return true;    
                }            
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
            <form id="updateEvent" name="updateEvent" method="post" action="/WhatsGoingOn/updateEventHandler.php">      
            
                <fieldset>
                    <legend>Update Event:</legend>
                    <div>
                        <label for="title">Event Name:</label>  
                            <input type="text" id="title" name="title" placeholder="Name"
                               value="<?php if(isset($_SESSION['title'])){echo htmlspecialchars($_SESSION['title']);} ?>" />
                                   <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter an event name"){
                                                    echo "<span class='error'>" . $error . "</span>";
                                                }
                                            }
                                        }
                                    } ?><br>
                        Is this event free?  
                        Yes<input type="radio" name="isFree" value="Yes" <?php if(isset($_SESSION['isFree'])){if(($_SESSION['isFree']) == 'Yes') { echo 'checked';} } ?> required> 
                        No<input type="radio" name="isFree" value="No" <?php if(isset($_SESSION['isFree'])){if(($_SESSION['isFree']) ==  'No') { echo 'checked';} } ?>><br>
                        <label for="address">Address:</label>  
                            <input type="text" id="address" name="address" placeholder="Address"
                                value="<?php if(isset($_SESSION['address'])){echo htmlspecialchars($_SESSION['address']);} ?>" required/>
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter an address"){
                                                    echo $error;
                                                }
                                            }
                                        }
                                    } ?><br>                    
                        <label for="city">City:</label>  
                            <input type="text" id="city" name="city" placeholder="City"
                               value="<?php if(isset($_SESSION['city'])){echo htmlspecialchars($_SESSION['city']);} ?>" required/>
                                   <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter a city name"){
                                                    echo $error;
                                                }
                                            }
                                        }
                                    } ?><br>                        
                        <label for="state">State:</label>
                            <select name="state" id="state" required>
                                <option value="" <?php if(isset($_SESSION['state'])){if(($_SESSION['state']) == '') { echo 'selected="selected"';} } ?>>State:</option>
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
                                                    echo $error;
                                                }
                                            }
                                        }
                                    } ?><br>    
                        <label for="zip">Zip Code:</label>  
                            <input type="text" id="zip" name="zip" placeholder="five digit zip"
                               value="<?php if(isset($_SESSION['zip'])){echo htmlspecialchars($_SESSION['zip']);} ?>" required />
                                   <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter a five digit zip code"){
                                                    echo $error;
                                                }elseif($error == "Zip code must be five numerical digits"){
                                                    echo $error;
                                                }elseif($error == "Sorry, please enter a valid zipcode"){
                                                    echo $error;
                                                }
                                            }
                                        }
                                    } ?><br>
                        <label for="startDate">Start Date:</label>  
                            <input type="text" id="startDate" name="startDate" placeholder="(month/day/year)"
                                value="<?php if(isset($_SESSION['startDate'])){echo htmlspecialchars($_SESSION['startDate']);} ?>" required />
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter a start date"){
                                                    echo $error;
                                                }elseif($error == "Enter a valid start date"){
                                                    echo $error;
                                                }elseif($error == "Enter a start date and time that has not already passed"){
                                                    echo $error;
                                                }
                                            }
                                        }
                                    } ?><br>
                        <label for="startTime">Start Time:</label>
                            <select name="startTime" id="startTime" required>
                                <option value="">Start Time:</option>
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
                                                echo $error;
                                            }
                                        }
                                    }
                                } ?>
                        AM<input type="radio" name="start_am_pm" value="AM" <?php if(isset($_SESSION['start_am_pm'])){if(($_SESSION['start_am_pm']) == 'AM') { echo 'checked';} } ?> required> 
                        PM<input type="radio" name="start_am_pm" value="PM" <?php if(isset($_SESSION['start_am_pm'])){if(($_SESSION['start_am_pm']) == 'PM') { echo 'checked';} } ?>>
                            <?php if(isset($event)) {
                                if ($event->errors) {
                                    foreach ($event->errors as $error) {
                                        if($error == "Select a meridiem for the start time"){
                                            echo $error;
                                        }
                                    }
                                }
                            } ?><br>
                        <label for="endDate">End Date:</label>  
                            <input type="text" id="endDate" name="endDate" placeholder="(month/day/year)"
                                value="<?php if(isset($_SESSION['endDate'])){echo htmlspecialchars($_SESSION['endDate']);} ?>" required />
                                    <?php if(isset($event)) {
                                        if ($event->errors) {
                                            foreach ($event->errors as $error) {
                                                if($error == "Enter an end date"){
                                                    echo $error;
                                                }elseif($error == "Enter a valid end date"){
                                                    echo $error;
                                                }elseif($error == "Enter an end date and time that has not already passed"){
                                                    echo $error;
                                                }elseif($error == "Enter an end date and time that is later than the start time date"){
                                                    echo $error;
                                                }
                                            }
                                        }
                                    } ?><br>
                        <label for="endTime" id="endTimeLabel">End Time:</label>
                            <select name="endTime" id="endTime" required>
                                <option value="">End Time:</option>
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
                                                echo $error;
                                            }
                                        }
                                    }
                                } ?>
                        AM<input type="radio" name="end_am_pm" value="AM" <?php if(isset($_SESSION['end_am_pm'])){if(($_SESSION['end_am_pm']) == 'AM') { echo 'checked';} } ?> required> 
                        PM<input type="radio" name="end_am_pm" value="PM" <?php if(isset($_SESSION['end_am_pm'])){if(($_SESSION['end_am_pm']) == 'PM') { echo 'checked';} } ?>>
                            <?php if(isset($event)) {
                                if ($event->errors) {
                                    foreach ($event->errors as $error) {
                                        if($error == "Select a meridiem for the end time"){
                                            echo $error;
                                        }
                                    }
                                }
                            } ?><br>
                        <textarea rows="10" cols="50" name="description" placeholder="Description Here!"><?php if(isset($_SESSION['description'])){echo htmlspecialchars($_SESSION['description']);} ?></textarea>
                            <?php if(isset($event)) {
                                if ($event->errors) {
                                    foreach ($event->errors as $error) {
                                        if($error == "Enter a description"){
                                            echo $error;
                                        }elseif($error == "Only 500 chartacters allowed in the description"){
                                            echo $error;
                                        }
                                    }
                                }
                            } ?><br>
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
                                
                        <input type="submit" value="Update Event" onclick="return Validate()" name="updateEvent"/>                      
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
?>
