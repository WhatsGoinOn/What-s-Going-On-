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
		public $Description;
		public $DateTime;
		public $Address;
		public $City;
		public $State;
		public $ZIP;
		public $Cost;
		public $IsCancelled;
		
		public function __construct() {
			
		}
		
		public function getFullAddress() {
			return $this->Address . ', ' . $this->City . ', ' . $this->State;
		}
		
		public function fetchFromId($_id) {
			if (is_numeric($_id)) {
				try {
					$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					$sql = $pdo->prepare("SELECT OwnerID, Title, Image, Description, DateTime, Address, City, State, ZIP, Cost, IsCancelled
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
						$this->Description = $result_row["Description"];
						$this->DateTime = $result_row["DateTime"];
						$this->Address = $result_row["Address"];
						$this->City = $result_row["City"];
						$this->State = $result_row["State"];
						$this->ZIP = $result_row["ZIP"];
						$this->Cost = $result_row["Cost"];
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
	}