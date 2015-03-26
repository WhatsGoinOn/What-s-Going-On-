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
		
		public $ID;
		public $OwnerID;
		public $Title;
		public $Image;
		public $Description;
		public $DateTime;
		public $Address;
		public $City;
		public $State;
		public $ZIP;
		public $Cost;
		public $IsCancelled;
		
		public function __construct() { }
		
		public function fetchFromId($_id) {
			if (is_numeric($_id)) {
				// create a database connection, using the constants from config/db.php
	            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	            // change character set to utf8 and check it
	            if (!$this->db_connection->set_charset("utf8")) {
	                $this->errors[] = $this->db_connection->error;
	            }
	            // if no connection errors (= working database connection)
	            if (!$this->db_connection->connect_errno) {
	                // database query, getting all the info of the selected event
	                $sql = "SELECT OwnerID, Title, Image, Description, DateTime, Address, City, State, ZIP, Cost, IsCancelled
	                        FROM event
	                        WHERE ID = '" . $_id . "';";
	                $result = $this->db_connection->query($sql);
	                // if this user exists
	                if ($result->num_rows == 1) {
	                    // get result row (as an object)
	                    $result_row = $result->fetch_object();
	                    //Set object variables
						$this->$ID = intval($_id);
						$this->$OwnerID = $result_row->OwnerID;
						$this->$Title = $result_row->Title;
						$this->$Image = $result_row->Image;
						$this->$Description = $result_row->Description;
						$this->$DateTime = $result_row->DateTime;
						$this->$Address = $result_row->Address;
						$this->$City = $result_row->City;
						$this->$State = $result_row->State;
						$this->$ZIP = $result_row->ZIP;
						$this->$Cost = $result_row->Cost;
						$this->$IsCancelled = $result_row->IsCancelled;
	                } else {
	                    $this->errors[] = "This event does not exist.";
	                }
	            } else {
	                $this->errors[] = "Database connection problem.";
	            }
            } else {
            	//Inputted id was not valid
            	$this->errors[] = "Given id is not valid number.";
            }
		}
	}