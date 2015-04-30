<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

class Event
{
	/**
     * @var array Collection of error messages
     */
    public $errors = array();    
	/**
     * @var array Collection of messages
     */
    public $messages = array();
	
	//Set to default values
	public $ID;
	public $OwnerID;
	public $Title;
	public $Image;
	public $ImageID;
	public $Description;
	public $StartDateTime;
	public $EndDateTime;
	public $Address;
	public $City;
	public $State;
	public $ZIP;
	public $IsFree;
	public $IsCancelled;
	
	public function __construct() {            
		if (isset($_POST["createEvent"])) {
            $this->createNewEvent();
        }
        
        if (isset($_POST["updateEvent"])) {
            $this->updateEvent();
        }
	}
	
	public function setValues($id,
						  $ownerID,
						  $title,
						  $image,
						  $imageID,
						  $description,
						  $startDateTime,
						  $endDateTime,
						  $address,
						  $city,
						  $state,
						  $zip,
						  $isFree,
						  $isCancelled) {
		$this->ID = $id;
		$this->OwnerID = $ownerID;
		$this->Title = $title;
		$this->Image = $image;
		$this->ImageID = $imageID;
		$this->Description = $description;
		$this->StartDateTime = $startDateTime;
		$this->EndDateTime = $endDateTime;
		$this->Address = $address;
		$this->City = $city;
		$this->State = $state;
		$this->ZIP = $zip;
		$this->IsFree = $isFree;
		$this->IsCancelled = $isCancelled;
	}
	
	public function getFullAddress() {
		return $this->Address . ', ' . $this->City . ', ' . $this->State;
	}
	
	public function fetchFromId($_id) {
		if (is_numeric($_id)) {
			try {
				$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$sql = $pdo->prepare("SELECT OwnerID, Title, Image, ImageID, Description, StartDateTime, EndDateTime, Address, City, State, ZIP, IsFree, IsCancelled
                        FROM event
                        WHERE ID = :id");
				$sql->bindParam(':id', $_id, PDO::PARAM_INT);
				$sql->execute();
				
				while ($result_row = $sql->fetch()) {
					//Set object variables
					$this->ID = intval($_id);
					$this->OwnerID = $result_row["OwnerID"];
					$this->Title = $result_row["Title"];
					$this->Image = $result_row["Image"];
					$this->ImageID = $result_row["ImageID"];
					$this->Description = $result_row["Description"];
					$this->StartDateTime = $result_row["StartDateTime"];
					$this->EndDateTime = $result_row["EndDateTime"];
					$this->Address = $result_row["Address"];
					$this->City = $result_row["City"];
					$this->State = $result_row["State"];
					$this->ZIP = $result_row["ZIP"];
					$this->IsFree = $result_row["IsFree"];
					$this->IsCancelled = $result_row["IsCancelled"];
				}
				
				$sql->closeCursor();
				$pdo = null;
			} catch(PDOException $e) {
				$this->errors[] = $e->getMessage();
			}
        } else {
        	//Inputted id was not valid
        	$this->errors[] = "Given id is not valid number.";
        }
	}

    private function createNewEvent(){
        $todaysDateTime = new DateTime();            
        $startDateTime;
        $endDateTime;
        
        $startDate = test_input($_POST['startDate']);
        $startDateArray = explode('/', $startDate); 
        if (count($startDateArray) != 3){                
            $startDateArray[0] = 9999;
            $startDateArray[1] = 9999;
            $startDateArray[2] = 9999;
        }elseif(!is_numeric($startDateArray[0]) || !is_numeric($startDateArray[1]) || !is_numeric($startDateArray[2])){
            $startDateArray[0] = 9999;
            $startDateArray[1] = 9999;
            $startDateArray[2] = 9999;
        }
                  
        $endDate = test_input($_POST['endDate']);
        $endDateArray = explode('/', $endDate);
        if (count($endDateArray) != 3){                   
            $endDateArray[0] = 9999;
            $endDateArray[1] = 9999;
            $endDateArray[2] = 9999;
        }elseif(!is_numeric($endDateArray[0]) || !is_numeric($endDateArray[1]) || !is_numeric($endDateArray[2])){
            $startDateArray[0] = 9999;
            $startDateArray[1] = 9999;
            $startDateArray[2] = 9999;
        }          
        
        // Get the time in the correct format
        $start_am_pm = test_input($_POST['start_am_pm']);
        $startTime = test_input($_POST['startTime']);
        $end_am_pm = test_input($_POST['end_am_pm']);
        $endTime = test_input($_POST['endTime']);
        if ($start_am_pm === "AM"){
            $startTimeArray = explode(':', $startTime);
            if ($startTimeArray[0] === "12"){
                $startTime = ($startTimeArray[0] - 12) . ":" . $startTimeArray[1];
                $startDateTime = new DateTime($startDate . " " . $startTime);
            } else {
                $startDateTime = new DateTime($startDate . " " . $startTime);
            }                       
        } else {
            $startTimeArray = explode(':', $startTime);
            if ($startTimeArray[0] != "12"){                            
                $startTime = ($startTimeArray[0] + 12) . ":" . $startTimeArray[1];
                $startDateTime = new DateTime($startDate . " " . $startTime);
            } else {
                $startDateTime = new DateTime($startDate . " " . $startTime);
            }                   
        }
        if ($end_am_pm === "AM"){
            $endTimeArray = explode(':', $endTime);
            if ($endTimeArray[0] === "12"){
                $endTime = ($endTimeArray[0] - 12) . ":" . $endTimeArray[1];
                $endDateTime = new DateTime($endDate . " " . $endTime);
            } else {
                $endDateTime = new DateTime($endDate . " " . $endTime);
            }    
        } else {
            $endTimeArray = explode(':', $endTime);
            if ($endTimeArray[0] != "12"){
                $endTime = ($endTimeArray[0] + 12) . ":" . $endTimeArray[1];
                $endDateTime = new DateTime($endDate . " " . $endTime);
            } else {
                $endDateTime = new DateTime($endDate . " " . $endTime);
            }                       
        }        
        
        //set the session variables        
        if (!isset($_SESSION)){
            session_start();            
        }
        if (!empty($_POST['title'])){
            $_SESSION['title'] = $_POST['title'];
        }
        if (!empty($_POST['isFree'])){
            $_SESSION['isFree'] = $_POST['isFree'];
        }
        if (!empty($_POST['address'])){
            $_SESSION['address'] = $_POST['address'];
        }
        if (!empty($_POST['city'])){
            $_SESSION['city'] = $_POST['city'];
        }
        if ($_POST['state'] != ""){
            $_SESSION['state'] = $_POST['state'];
        }
        if (!empty($_POST['zip']) && preg_match("#[0-9]{5}#", $_POST['zip'])){
            $_SESSION['zip'] = $_POST['zip'];
        }
        if (!empty($_POST['startDate']) && $todaysDateTime < $startDateTime
            && checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])){
                $_SESSION['startDate'] = $_POST['startDate'];
        }
        if ($_POST['startTime'] != "" && $todaysDateTime < $startDateTime){
            $_SESSION['startTime'] = $_POST['startTime'];
        }
        if (!empty($_POST['start_am_pm']) && $todaysDateTime < $startDateTime){
            $_SESSION['start_am_pm'] = $_POST['start_am_pm'];
        }
        if (!empty($_POST['endDate']) && $todaysDateTime < $endDateTime && $startDateTime < $endDateTime
            && checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])){
                $_SESSION['endDate'] = $_POST['endDate'];
        }
        if ($_POST['endTime'] != "" && $todaysDateTime < $endDateTime && $startDateTime < $endDateTime){
            $_SESSION['endTime'] = $_POST['endTime'];
        }
        if (!empty($_POST['end_am_pm']) && $todaysDateTime < $endDateTime && $startDateTime < $endDateTime){
            $_SESSION['end_am_pm'] = $_POST['end_am_pm'];
        }
        if (!empty($_POST['isFree'])){
            $_SESSION['isFree'] = $_POST['isFree'];
        }
        if (strlen($_POST['description']) <= 500 && $_POST['description'] != ""){
            $_SESSION['description'] = $_POST['description'];                
        }            
        session_write_close();
        
        //Set up error messages
        if (empty($_POST['title'])){
            $this->errors[] = "Enter an event name";
        }
        if (empty($_POST['address'])){
            $this->errors[] = "Enter an address";
        }
        if (empty($_POST['city'])){
            $this->errors[] = "Enter a city name";
        }
        if ($_POST['state'] === ""){
            $this->errors[] = "Select a state name";
        }
        if (empty($_POST['zip'])){
            $this->errors[] = "Enter a five digit zip code";
        }else if (!preg_match("#[0-9]{5}#", $_POST['zip'])){
            $this->errors[] = "Zip code must be five numerical digits";
        }
        if (empty($_POST['startDate'])){
            $this->errors[] = "Enter a start date";
        }elseif (!checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])){
            $this->errors[] = "Enter a valid start date";
        }elseif ($todaysDateTime > $startDateTime){
            $this->errors[] = "Enter a start date and time that has not already passed";
        }
        if ($_POST['startTime'] === ""){
            $this->errors[] = "Select a start time";
        }
        if (empty($_POST['start_am_pm'])){
            $this->errors[] = "Select a meridiem for the start time";
        }
        if (empty($_POST['endDate'])){
            $this->errors[] = "Enter an end date";
        }elseif (!checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])) {
            $this->errors[] = "Enter a valid end date";
        }elseif ($todaysDateTime > $endDateTime){
            $this->errors[] = "Enter an end date and time that has not already passed";
        }elseif ($startDateTime > $endDateTime){
            $this->errors[] = "Enter an end date and time that is later than the start time date";
        }
        if ($_POST['endTime'] === ""){
            $this->errors[] = "Select an end time";
        }
        if (empty($_POST['end_am_pm'])){
            $this->errors[] = "Select a meridiem for the end time";            
        }
        if (empty($_POST['description'])){
            $this->errors[] = "Enter a description";
        }elseif (strlen($_POST['description']) > 500){
            $this->errors[] = "Only 500 chartacters allowed in the description"; 
        }
            
        //Make sure all fields have valid data                
        if (empty($_POST['title'])){
        }elseif (empty($_POST['address'])){
        }elseif (empty($_POST['city'])){
        }elseif ($_POST['state'] === ""){
        }elseif (empty($_POST['zip'])){
        }else if (!preg_match("#[0-9]{5}#", $_POST['zip'])){
        }elseif (empty($_POST['startDate'])){
        }elseif (!checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])){
        }elseif ($todaysDateTime > $startDateTime){
        }elseif ($_POST['startTime'] === ""){
        }elseif ($_POST['start_am_pm'] === ""){
        }elseif (empty($_POST['endDate'])){
        }elseif (!checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])) {
        }elseif ($todaysDateTime > $endDateTime){
        }elseif ($startDateTime > $endDateTime){
        }elseif ($_POST['endTime'] === ""){
        }elseif ($_POST['end_am_pm'] === ""){         
        }elseif (empty($_POST['description'])){
        }elseif (strlen($_POST['description']) > 500){
        }elseif (!empty($_POST['title'])
            && !empty($_POST['address'])
            && !empty($_POST['city'])
            && $_POST['state'] !== ""
            && !empty($_POST['zip'])
            && preg_match("#[0-9]{5}#", $_POST['zip'])
            && !empty($_POST['startDate'])
            && checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])
            && $todaysDateTime < $startDateTime
            && $_POST['startTime'] !== ""
            && $_POST['start_am_pm'] !== ""
            && !empty($_POST['endDate'])
            && checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])
            && $todaysDateTime < $endDateTime
            && $_POST['endTime'] !== ""
            && $_POST['end_am_pm'] !== ""
            && strlen($_POST['description']) <= 500
            && !empty($_POST['description']))               
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            
            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                if (!isset($_SESSION['id']))
                {
                    session_start();            
                }
                $user_name = $_SESSION['user_name'];
                session_write_close();
                // database query, getting the ID of the user 
                $sql = "SELECT ID, Username
                        FROM account
                        WHERE Username = '" . $user_name . "';";
                $get_user = $this->db_connection->query($sql);
                // get result row (as an object)
                $result_row = $get_user->fetch_object();
                $userID = $result_row->ID; 
                
                // escaping, additionally removing everything that could be (html/javascript-) code                    
                $title = $this->db_connection->real_escape_string(strip_tags($_POST['title'], ENT_QUOTES));
                $description = $this->db_connection->real_escape_string(strip_tags($_POST['description'], ENT_QUOTES));
                $address = $this->db_connection->real_escape_string(strip_tags($_POST['address'], ENT_QUOTES));
                $city = $this->db_connection->real_escape_string(strip_tags($_POST['city'], ENT_QUOTES));
                $state = $this->db_connection->real_escape_string(strip_tags($_POST['state'], ENT_QUOTES));
                $zip = $this->db_connection->real_escape_string(strip_tags($_POST['zip'], ENT_QUOTES));                    
                $isFree = $this->db_connection->real_escape_string(strip_tags($_POST['isFree'], ENT_QUOTES)); 
                if ($isFree == "Yes"){
                    $isFree = 0;
                }elseif($isFree == "No"){
                    $isFree = 1;
                }               
                
                $convertedStartDateTime = $startDateTime->format('Y-m-d H:i:s');
                $convertedEndDateTime = $endDateTime->format('Y-m-d H:i:s');
                // check if zip code is valid
                $sql = "SELECT * FROM zipcode WHERE zip = '" . $zip . "';";
                $query_zip_check = $this->db_connection->query($sql);
                // check if the user entered eventName, startDateTime, zip already exist in the same record
                $sql = "SELECT * FROM event WHERE Title = '" . $title . "' 
                        AND StartDateTime = '" . $convertedStartDateTime . "'
                        AND ZIP = '" . $zip . "';";
                $query_event_check = $this->db_connection->query($sql);

                if ($query_zip_check->num_rows != 1){
                    $this->errors[] = "Sorry, please enter a valid zipcode";
                }elseif ($query_event_check->num_rows == 1) {
                    $this->errors[] = "Sorry, that event has already been created.";
                } else {
                    // write new event data into database
                    $sql = "INSERT INTO event (OwnerID, Title, Description, StartDateTime, EndDateTime, Address, City, State, Zip, IsFree)
                            VALUES('" . $userID . "', '" . $title . "', '" . $description . "', '" . $convertedStartDateTime . "',
                            '" . $convertedEndDateTime . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $isFree . "');";
                    $query_new_event_insert = $this->db_connection->query($sql);

                    // if event has been added successfully
                    if ($query_new_event_insert) {
                        if (!isset($_SESSION['id']))
                        {
                            session_start();            
                        }
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
                    } else {
                        $this->errors[] = "Sorry, your event creation failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }  

    private function updateEvent(){
        $todaysDateTime = new DateTime();            
        $startDateTime;
        $endDateTime;
        
        $startDate = test_input($_POST['startDate']);
        $startDateArray = explode('/', $startDate); 
        if (count($startDateArray) != 3){                
            $startDateArray[0] = 9999;
            $startDateArray[1] = 9999;
            $startDateArray[2] = 9999;
        }elseif(!is_numeric($startDateArray[0]) || !is_numeric($startDateArray[1]) || !is_numeric($startDateArray[2])){
            $startDateArray[0] = 9999;
            $startDateArray[1] = 9999;
            $startDateArray[2] = 9999;
        }
                  
        $endDate = test_input($_POST['endDate']);
        $endDateArray = explode('/', $endDate);
        if (count($endDateArray) != 3){                   
            $endDateArray[0] = 9999;
            $endDateArray[1] = 9999;
            $endDateArray[2] = 9999;
        }elseif(!is_numeric($endDateArray[0]) || !is_numeric($endDateArray[1]) || !is_numeric($endDateArray[2])){
            $startDateArray[0] = 9999;
            $startDateArray[1] = 9999;
            $startDateArray[2] = 9999;
        }          
        
        // Get the time in the correct format
        $start_am_pm = test_input($_POST['start_am_pm']);
        $startTime = test_input($_POST['startTime']);
        $end_am_pm = test_input($_POST['end_am_pm']);
        $endTime = test_input($_POST['endTime']);
        if ($start_am_pm === "AM"){
            $startTimeArray = explode(':', $startTime);
            if ($startTimeArray[0] === "12"){
                $startTime = ($startTimeArray[0] - 12) . ":" . $startTimeArray[1];
                $startDateTime = new DateTime($startDate . " " . $startTime);
            } else {
                $startDateTime = new DateTime($startDate . " " . $startTime);
            }                       
        } else {
            $startTimeArray = explode(':', $startTime);
            if ($startTimeArray[0] != "12"){                            
                $startTime = ($startTimeArray[0] + 12) . ":" . $startTimeArray[1];
                $startDateTime = new DateTime($startDate . " " . $startTime);
            } else {
                $startDateTime = new DateTime($startDate . " " . $startTime);
            }                   
        }
        if ($end_am_pm === "AM"){
            $endTimeArray = explode(':', $endTime);
            if ($endTimeArray[0] === "12"){
                $endTime = ($endTimeArray[0] - 12) . ":" . $endTimeArray[1];
                $endDateTime = new DateTime($endDate . " " . $endTime);
            } else {
                $endDateTime = new DateTime($endDate . " " . $endTime);
            }    
        } else {
            $endTimeArray = explode(':', $endTime);
            if ($endTimeArray[0] != "12"){
                $endTime = ($endTimeArray[0] + 12) . ":" . $endTimeArray[1];
                $endDateTime = new DateTime($endDate . " " . $endTime);
            } else {
                $endDateTime = new DateTime($endDate . " " . $endTime);
            }                       
        }        
        
        //set the session variables        
        if (!isset($_SESSION)){
            session_start();            
        }
        if (!empty($_POST['title'])){
            $_SESSION['title'] = $_POST['title'];
        }
        if (!empty($_POST['isFree'])){
            $_SESSION['isFree'] = $_POST['isFree'];
        }
        if (!empty($_POST['address'])){
            $_SESSION['address'] = $_POST['address'];
        }
        if (!empty($_POST['city'])){
            $_SESSION['city'] = $_POST['city'];
        }
        if ($_POST['state'] != ""){
            $_SESSION['state'] = $_POST['state'];
        }
        if (!empty($_POST['zip']) && preg_match("#[0-9]{5}#", $_POST['zip'])){
            $_SESSION['zip'] = $_POST['zip'];
        }
        if (!empty($_POST['startDate']) && $todaysDateTime < $startDateTime
            && checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])){
                $_SESSION['startDate'] = $_POST['startDate'];
        }
        if ($_POST['startTime'] != "" && $todaysDateTime < $startDateTime){
            $_SESSION['startTime'] = $_POST['startTime'];
        }
        if (!empty($_POST['start_am_pm']) && $todaysDateTime < $startDateTime){
            $_SESSION['start_am_pm'] = $_POST['start_am_pm'];
        }
        if (!empty($_POST['endDate']) && $todaysDateTime < $endDateTime && $startDateTime < $endDateTime
            && checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])){
                $_SESSION['endDate'] = $_POST['endDate'];
        }
        if ($_POST['endTime'] != "" && $todaysDateTime < $endDateTime && $startDateTime < $endDateTime){
            $_SESSION['endTime'] = $_POST['endTime'];
        }
        if (!empty($_POST['end_am_pm']) && $todaysDateTime < $endDateTime && $startDateTime < $endDateTime){
            $_SESSION['end_am_pm'] = $_POST['end_am_pm'];
        }
        if (!empty($_POST['isFree'])){
            $_SESSION['isFree'] = $_POST['isFree'];
        }
        if (strlen($_POST['description']) <= 500 && $_POST['description'] != ""){
            $_SESSION['description'] = $_POST['description'];                
        }            
        session_write_close();
        
        //Set up error messages
        if (empty($_POST['title'])){
            $this->errors[] = "Enter an event name";
        }
        if (empty($_POST['address'])){
            $this->errors[] = "Enter an address";
        }
        if (empty($_POST['city'])){
            $this->errors[] = "Enter a city name";
        }
        if ($_POST['state'] === ""){
            $this->errors[] = "Select a state name";
        }
        if (empty($_POST['zip'])){
            $this->errors[] = "Enter a five digit zip code";
        }else if (!preg_match("#[0-9]{5}#", $_POST['zip'])){
            $this->errors[] = "Zip code must be five numerical digits";
        }
        if (empty($_POST['startDate'])){
            $this->errors[] = "Enter a start date";
        }elseif (!checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])){
            $this->errors[] = "Enter a valid start date";
        }elseif ($todaysDateTime > $startDateTime){
            $this->errors[] = "Enter a start date and time that has not already passed";
        }
        if ($_POST['startTime'] === ""){
            $this->errors[] = "Select a start time";
        }
        if (empty($_POST['start_am_pm'])){
            $this->errors[] = "Select a meridiem for the start time";
        }
        if (empty($_POST['endDate'])){
            $this->errors[] = "Enter an end date";
        }elseif (!checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])) {
            $this->errors[] = "Enter a valid end date";
        }elseif ($todaysDateTime > $endDateTime){
            $this->errors[] = "Enter an end date and time that has not already passed";
        }elseif ($startDateTime > $endDateTime){
            $this->errors[] = "Enter an end date and time that is later than the start time date";
        }
        if ($_POST['endTime'] === ""){
            $this->errors[] = "Select an end time";
        }
        if (empty($_POST['end_am_pm'])){
            $this->errors[] = "Select a meridiem for the end time";            
        }
        if (empty($_POST['description'])){
            $this->errors[] = "Enter a description";
        }elseif (strlen($_POST['description']) > 500){
            $this->errors[] = "Only 500 chartacters allowed in the description"; 
        }
            
        //Make sure all fields have valid data                
        if (empty($_POST['title'])){
        }elseif (empty($_POST['address'])){
        }elseif (empty($_POST['city'])){
        }elseif ($_POST['state'] === ""){
        }elseif (empty($_POST['zip'])){
        }else if (!preg_match("#[0-9]{5}#", $_POST['zip'])){
        }elseif (empty($_POST['startDate'])){
        }elseif (!checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])){
        }elseif ($todaysDateTime > $startDateTime){
        }elseif ($_POST['startTime'] === ""){
        }elseif ($_POST['start_am_pm'] === ""){
        }elseif (empty($_POST['endDate'])){
        }elseif (!checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])) {
        }elseif ($todaysDateTime > $endDateTime){
        }elseif ($startDateTime > $endDateTime){
        }elseif ($_POST['endTime'] === ""){
        }elseif ($_POST['end_am_pm'] === ""){         
        }elseif (empty($_POST['description'])){
        }elseif (strlen($_POST['description']) > 500){
        }elseif (!empty($_POST['title'])
            && !empty($_POST['address'])
            && !empty($_POST['city'])
            && $_POST['state'] !== ""
            && !empty($_POST['zip'])
            && preg_match("#[0-9]{5}#", $_POST['zip'])
            && !empty($_POST['startDate'])
            && checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])
            && $todaysDateTime < $startDateTime
            && $_POST['startTime'] !== ""
            && $_POST['start_am_pm'] !== ""
            && !empty($_POST['endDate'])
            && checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])
            && $todaysDateTime < $endDateTime
            && $_POST['endTime'] !== ""
            && $_POST['end_am_pm'] !== ""
            && strlen($_POST['description']) <= 500
            && !empty($_POST['description']))               
        {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            
            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                if (!isset($_SESSION)){
                    session_start();            
                }
                $user_name = $_SESSION['user_name'];
                session_write_close();
               
                // escaping, additionally removing everything that could be (html/javascript-) code                    
                $title = $this->db_connection->real_escape_string(strip_tags($_POST['title'], ENT_QUOTES));
                $description = $this->db_connection->real_escape_string(strip_tags($_POST['description'], ENT_QUOTES));
                $address = $this->db_connection->real_escape_string(strip_tags($_POST['address'], ENT_QUOTES));
                $city = $this->db_connection->real_escape_string(strip_tags($_POST['city'], ENT_QUOTES));
                $state = $this->db_connection->real_escape_string(strip_tags($_POST['state'], ENT_QUOTES));
                $zip = $this->db_connection->real_escape_string(strip_tags($_POST['zip'], ENT_QUOTES));                    
                $isFree = $this->db_connection->real_escape_string(strip_tags($_POST['isFree'], ENT_QUOTES)); 
                $eventID = 14;
                if ($isFree == "Yes"){
                    $isFree = 0;
                }elseif($isFree == "No"){
                    $isFree = 1;
                }               
                
                $convertedStartDateTime = $startDateTime->format('Y-m-d H:i:s');
                $convertedEndDateTime = $endDateTime->format('Y-m-d H:i:s');
                // check if zip code is valid
                $sql = "SELECT * FROM zipcode WHERE zip = '" . $zip . "';";
                $query_zip_check = $this->db_connection->query($sql);
                // check if the user entered eventName, startDateTime, zip already exist in the same record
                $sql = "SELECT * FROM event WHERE Title = '" . $title . "' 
                        AND StartDateTime = '" . $convertedStartDateTime . "'
                        AND ZIP = '" . $zip . "';";
                $query_event_check = $this->db_connection->query($sql);

                if ($query_zip_check->num_rows != 1){
                    $this->errors[] = "Sorry, please enter a valid zipcode";
                }elseif ($query_event_check->num_rows == 1) {
                    $this->errors[] = "Sorry, that event has already been created.";
                } else {
                    // write updated event data into database
                    
                    $sql = "UPDATE event SET Title = '" . $title . "', Description = '" . $description . "', 
                            StartDateTime = '" . $convertedStartDateTime . "', EndDateTime = '" . $convertedEndDateTime . "', 
                            Address = '" . $address . "', City = '" . $city . "', State = '" . $state . "', Zip = '" . $zip . "', 
                            IsFree = '" . $isFree . "' WHERE ID = '" . $eventID . "'";
                            
                            $query_update_event_insert = $this->db_connection->query($sql);

                    // if event has been updated successfully
                    if ($query_update_event_insert) {
                        if (!isset($_SESSION['id']))
                        {
                            session_start();            
                        }
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
                    } else {
                        $this->errors[] = "Sorry, your event creation failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    } 
}
