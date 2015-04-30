<ul>
    <li><a href="/WhatsGoingOn/default.php">Home</a></li>
    <li><a href="/WhatsGoingOn/search.php">Search</a></li>
    <?php 
    if (isset($_SESSION['user_name'])) 
        {
            echo "<li><a href='/WhatsGoingOn/createEventHandler.php'>Create</a></li>";
            echo "<li><a href='/WhatsGoingOn/views/userProfile.php?user=" . $_SESSION['user_name'] . "'>Profile</a></li>";
        }   
    ?>
</ul>