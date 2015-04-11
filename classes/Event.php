<?php	
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

        private function createNewEvent()
        {
            $startDate = $_POST['startDate'];
            $startDateArray = explode('/', $startDate);
            $endDate = $_POST['endDate'];
            $endDateArray = explode('/', $endDate);
            
            //Make sure all fields have valid data                
            if (empty($_POST['title'])){
                $this->errors[] = "Enter an event name";
            }elseif(empty($_POST['address'])){
                $this->errors[] = "Enter an address";
            }elseif (empty($_POST['city'])){
                $this->errors[] = "Enter a city name";
            }elseif ($_POST['state'] === ""){
                $this->errors[] = "Select a state name";
            }else if (empty($_POST['zip'])){
                $this->errors[] = "Enter a five digit zip code";
            }elseif (!preg_match("#[0-9]{5}#", $_POST['zip'])){
                $this->errors[] = "Zip code must be five numerical digits";
            }elseif (empty($_POST['startDate'])){
                $this->errors[] = "Enter a start date";
            }elseif (!checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])) {
                $this->errors[] = "Enter a valid start date";
            }elseif ($_POST['startTime'] === ""){
                $this->errors[] = "Select a start time";
            }elseif ($_POST['start_am_pm'] === ""){
                $this->errors[] = "Select a meridiem for the start time";
            }elseif (empty($_POST['endDate'])){
                $this->errors[] = "Enter an end date";
            }elseif (!checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])) {
                $this->errors[] = "Enter a valid end date";
            }elseif ($_POST['endTime'] === ""){
                $this->errors[] = "Select an end time";
            }elseif ($_POST['end_am_pm'] === ""){
                $this->errors[] = "Select a meridiem for the end time";            
            }elseif (strlen($_POST['description']) > 500){
                $this->errors[] = "Only 500 chartacters allowed in the description"; 
            }elseif (!empty($_POST['title'])
                    && !empty($_POST['address'])
                    && !empty($_POST['city'])
                    && $_POST['state'] !== ""
                    && !empty($_POST['zip'])
                    && preg_match("#[0-9]{5}#", $_POST['zip'])
                    && !empty($_POST['startDate'])
                    && checkdate($startDateArray[0], $startDateArray[1], $startDateArray[2])
                    && $_POST['startTime'] !== ""
                    && $_POST['start_am_pm'] !== ""
                    && !empty($_POST['endDate'])
                    && checkdate($endDateArray[0], $endDateArray[1], $endDateArray[2])
                    && $_POST['endTime'] !== ""
                    && $_POST['end_am_pm'] !== ""
                    && strlen($_POST['description']) <= 500)
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
                    $startTime = $this->db_connection->real_escape_string(strip_tags($_POST['startTime'], ENT_QUOTES));
                    $endTime = $this->db_connection->real_escape_string(strip_tags($_POST['endTime'], ENT_QUOTES));
                    $start_am_pm = $this->db_connection->real_escape_string(strip_tags($_POST['start_am_pm'], ENT_QUOTES));
                    $end_am_pm = $this->db_connection->real_escape_string(strip_tags($_POST['end_am_pm'], ENT_QUOTES));
                    $isFree = $this->db_connection->real_escape_string(strip_tags($_POST['isFree'], ENT_QUOTES));
                    $startDateTime;
                    $endDateTime;
                    
                    // Get the time in the correct format
                    if ($start_am_pm === "AM"){
                        $startTimeArray = explode(':', $startTime);
                        if ($startTimeArray[0] === "12"){
                            $startTime = ($startTimeArray[0] - 12) . ":" . $startTimeArray[1];
                            $startDateTime = $startDate . " " . $startTime;
                            $this->errors[] = $startDateTime;
                        } else {
                            $startDateTime = $startDate . " " . $startTime;
                        }                       
                    } else {
                        $startTimeArray = explode(':', $startTime);
                        if ($startTimeArray[0] != "12"){                            
                            $startTime = ($startTimeArray[0] + 12) . ":" . $startTimeArray[1];
                            $startDateTime = $startDate . " " . $startTime;
                        } else {
                            $startDateTime = $startDate . " " . $startTime;
                        }                   
                    }
                    if ($end_am_pm === "AM"){
                        $endTimeArray = explode(':', $endTime);
                        if ($endTimeArray[0] === "12"){
                            $endTime = ($endTimeArray[0] - 12) . ":" . $endTimeArray[1];
                            $endDateTime = $endDate . " " . $endTime;
                        } else {
                            $endDateTime = $endDate . " " . $endTime;
                        }    
                    } else {
                        $endTimeArray = explode(':', $endTime);
                        if ($endTimeArray[0] != "12"){
                            $endTime = ($endTimeArray[0] + 12) . ":" . $endTimeArray[1];
                            $endDateTime = $endDate . " " . $endTime;
                        } else {
                            $endDateTime = $endDate . " " . $endTime;
                        }                       
                    } 
                    
                    // check if the user entered eventName, startDateTime, zip already exist in the same record
                    $sql = "SELECT * FROM event WHERE Title = '" . $title . "' 
                            AND StartDateTime = '" . $startDateTime . "'
                            AND ZIP = '" . $zip . "';";
                    $query_check = $this->db_connection->query($sql);
    
                    if ($query_check->num_rows == 1) {
                        $this->errors[] = "Sorry, that event has already been created.";                    
                        
                        $this->errors[] = $title;
                        $this->errors[] = $zip;
                    } else {
                        // write new event data into database
                        $sql = "INSERT INTO event (OwnerID, Title, Description, StartDateTime, EndDateTime, Address, City, State, Zip, IsFree)
                                VALUES('" . $userID . "', '" . $title . "', '" . $description . "', '" . $startDateTime . "',
                                '" . $endDateTime . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $isFree . "');";
                        $query_new_event_insert = $this->db_connection->query($sql);
    
                        // if event has been added successfully
                        if ($query_new_event_insert) {
                            
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
