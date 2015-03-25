<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Whats Going On?</title>   
    
    <link href="../Styles/FormLayout.css" rel="stylesheet" type="text/css" />       
    
    <script type="text/javascript">
        function Validate()
        {           
            var Username = document.getElementById("login_input_username");             
            var Email = document.getElementById("login_input_email");
            var Password = document.getElementById("login_input_password_new");
            var PasswordVerify = document.getElementById("login_input_password_repeat");
            EmailEdit = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
            
            if (Username.length >= 2 && Username.length <= 64)    
            {
                alert("Username must be from 2-64 characters in length.");
                Username.focus();
                return false;
            } 
            else if (!EmailEdit.test(Email.value))
            {
                alert("Please enter a valid email.");
                Email.focus();
                return false;
            }  
            else if (Password.value == "" || Password.length < 6)
            {
                alert("Your password must be at least 6 characters.");
                Password.value = "";
                PasswordVerify.value = "";
                Password.focus();
                return false;
            }
            else if (Password.value !== PasswordVerify.value)
            {
                alert("The passwords do not match.  Please retype your passwords.");
                Password.value = "";
                PasswordVerify.value = "";
                Password.focus();
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
    <header>
        <h1><img src="" alt="What's Going On?"></h1>                   
    </header>
    
    <nav>
        <ul>
            <li><a href="/WhatsGoingOn/default.php">Home</a></li>
            <li><a href="/WhatsGoingOn/events.php">Search Events</a></li>
            <li><a href="/WhatsGoingOn/map.php">Map</a></li>
            <li><a href="/WhatsGoingOn/createEvent.php">Create Event</a></li>
            <li><a href="/WhatsGoingOn/userProfile.php">User Profile</a></li>
        </ul>
    </nav>
    
    <form method="post" action="/WhatsGoingOn/login/registrationHandler.php" name="registerform">
    
        <!-- the user name input field uses a HTML5 pattern check -->
        <label for="login_input_username">Username:</label>
        <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /><br>
    
        <!-- the email input field uses a HTML5 email type check -->
        <label for="login_input_email">Email:</label>
        <input id="login_input_email" class="login_input" type="email" name="user_email" required /><br>
    
        <label for="login_input_password_new">Password:</label>
        <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /><br>
    
        <label for="login_input_password_repeat">Repeat Password:</label>
        <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /><br>
        
        Is this a business account?
        <input type="radio" name="is_business" value="0" checked>No 
        <input type="radio" name="is_business" value="1">Yes<br><br>
        
        <input type="submit" onclick="return Validate()" name="register" value="Register" />
    
    </form>
</body>
