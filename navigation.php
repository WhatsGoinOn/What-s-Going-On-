<ul>
    <li><a href="/WhatsGoingOn/default.php">Home</a></li>
    <li><a href="/WhatsGoingOn/search.php">Search Events</a></li>
    <li><a href="/WhatsGoingOn/map.php">Map</a></li>
    <?php 
        if (isset($_SESSION['user_name'])) 
        {
            echo "<li><a href='/WhatsGoingOn/createEventHandler.php'>Create Event</a></li>";
            echo "<li><a href='/WhatsGoingOn/userProfile.php'>User Profile</a></li>";
        }   
    ?>
</ul>