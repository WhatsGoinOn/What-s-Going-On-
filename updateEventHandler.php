<?php
$eventId = $_GET['id'];
$eventOwnerName;

// include the configs / constants for the database connection
require_once("login/config/db.php");
// load the create event class
require_once("classes/Event.php");
// load the image upload class
require_once("classes/Upload.php");

// create the createEvent object. when this object is created, it will do all new event stuff automatically
// so this single line handles the entire update event process.
$event = new Event();

// create a database connection
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// change character set to utf8 and check it
if (!$db_connection->set_charset("utf8")) {
    $event->errors[] = $db_connection->error;
}

// if no connection errors (= working database connection)
if (!$db_connection->connect_errno) {
    if (!isset($_SESSION))
    {
        session_start();            
    }
    // database query, getting the ID of the user 
    $sql = "Select Username
            FROM event e
            JOIN account a ON e.OwnerID = a.ID
            WHERE e.ID = '" . $eventId . "';";
    $get_user = $db_connection->query($sql);
    // get result row (as an object)
    $result_row = $get_user->fetch_object();
    $eventOwnerName = $result_row->Username; 
}else{
    $event->errors[] = "Sorry, no database connection.";
}

// show the update event view (with the update event form, and messages/errors)
// if the owner of the event is the person who is logged in
if (!isset($_SESSION['user_name'])){
    header('Location: /WhatsGoingOn/default.php');
    die();
}elseif($eventOwnerName != $_SESSION['user_name']){
    header('Location: /WhatsGoingOn/default.php');
    die();
}else{
    include("views/update_event.php");
}
