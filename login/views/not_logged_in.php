
<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<!-- login form box -->
<form method="post" name="loginform">

    
    <input id="login_input_name" class="login_input" placeholder="username" type="text" name="user_name" required /><br>

    <input id="login_input_password" class="login_input" placeholder="password" type="password" name="user_password" autocomplete="off" required /><br>

    <input type="submit"  name="login" value="Log in" />&nbsp;&nbsp;
    
    <a href="/WhatsGoingOn/login/registrationHandler.php">Create account</a>

</form>

