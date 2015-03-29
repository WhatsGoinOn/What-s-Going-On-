<?php

/**
 * Class createEvent
 * handles the creation of new events
 */
class CreateEvent
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$createEvent = new CreateEvent();"
     */
    public function __construct()
    {
        if (isset($_POST["createEvent"])) {
            $this->createNewEvent();
        }
    }

    /**
     * handles the entire event creation process. checks all error possibilities
     * and creates a new event in the database if everything is fine
     */
    private function createNewEvent()
    {                
        if (empty($_POST['eventName']))
        {
            $this->errors[] = "Empty event name";
        }
        elseif (empty($_POST['city']))
        {
            $this->errors[] = "Empty city name";
        }
        elseif ($_POST['state'] === "Select")
        {
            $this->errors[] = "Select a state name";
        }
        else if (empty($_POST['zip']))
        {
            $this->errors[] = "Empty zip code";
        }
        elseif (strlen($_POST['zip']) !== 5 || !filter_var($int, $_POST['zip']) === false)        
        {
            $this->errors[] = "Enter a valid zip code";
        }
        elseif ($_POST['month'] === "select" || $_POST['day'] === "select" || $_POST['year'] === "select")        
        {
            $this->errors[] = "Select a date";
        }
    }
}
