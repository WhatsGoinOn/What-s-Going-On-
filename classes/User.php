<?php	
	class User
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
		public $Username;
		public $Email;
		public $Name;
		public $Image;
		public $ImageID;
		public $IsBusiness;
		
		public function __construct() {
			
		}
		
		public function fetchFromId($_id) {
			if (is_numeric($_id)) {
				try {
					$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					$sql = $pdo->prepare("SELECT ID, Username, Email, Name, Image, ImageID, IsBusiness
	                        FROM account
	                        WHERE ID = :id");
					$sql->bindParam(':id', $_id, PDO::PARAM_INT);
					$sql->execute();
					
					while ($result_row = $sql->fetch()) {
						//Set object variables
						$this->ID = intval($_id);
						$this->Username = $result_row["Username"];
						$this->Email = $result_row["Email"];
						$this->Name = $result_row["Name"];
						$this->Image = $result_row["Image"];
						$this->ImageID = $result_row["ImageID"];
						$this->IsBusiness = $result_row["IsBusiness"];
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

		public function fetchFromUsername($_username) {
			try {
				$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$sql = $pdo->prepare("SELECT ID, Username, Email, Name, Image, ImageID, IsBusiness
                        FROM account
                        WHERE Username = :username");
				$sql->bindParam(':username', $_username, PDO::PARAM_STR, 255);
				$sql->execute();
				
				while ($result_row = $sql->fetch()) {
					//Set object variables
					$this->ID = $result_row["ID"];
					$this->Username = $_username;
					$this->Email = $result_row["Email"];
					$this->Name = $result_row["Name"];
					$this->Image = $result_row["Image"];
					$this->ImageID = $result_row["ImageID"];
					$this->IsBusiness = $result_row["IsBusiness"];
				}
				
				$sql->closeCursor();
				$pdo = null;
			} catch(PDOException $e) {
				$this->errors[] = $e->getMessage();
			}
		}
	}
