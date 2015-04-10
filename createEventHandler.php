<?php
// include the configs / constants for the database connection
require_once("login/config/db.php");
// load the create event class
require_once("classes/Event.php");

// create the createEvent object. when this object is created, it will do all new event stuff automatically
// so this single line handles the entire new event process.
$event = new Event();

// show the create event view (with the new event form, and messages/errors)
include("views/create_event.php");
