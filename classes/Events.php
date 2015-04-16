<?php 
	class Events {
		/**
	     * @var array Collection of error messages
	     */
	    public $errors = array();    
		/**
	     * @var array Collection of messages
	     */
	    public $messages = array();
		
		private $items = array();
	 	
		// ========== Generic collection functions ==========
		public function getCount() {
			return count($items);
		}
		
	    public function addItem($obj, $key = null) {
	    	if ($key == null) {
		        $this->items[] = $obj;
		    }
		    else {
		        if (isset($this->items[$key])) {
		            throw new KeyHasUseException("Key $key already in use.");
		        }
		        else {
		            $this->items[$key] = $obj;
		        }
		    }
	    }
	 
	    public function getItem($key) {
		    if (isset($this->items[$key])) {
		        return $this->items[$key];
		    }
		    else {
		        throw new KeyInvalidException("Invalid key $key.");
		    }
	    }
		
		//========== Search functions ==========
		public function searchTest($page, $perPage = 10) {
			try {
				$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$sql = $pdo->prepare("SELECT OwnerID, Title, Image, ImageID, Description, StartDateTime, EndDateTime, Address, City, State, ZIP, IsFree, IsCancelled
                        FROM event
                        LIMIT :offset, :amount");
				$offset = $page * $perPage;
				$sql->bindParam(':offset', $offset, PDO::PARAM_INT);
				$sql->bindParam(':amount', $$perPage, PDO::PARAM_INT);
				$sql->execute();
				
				while ($result_row = $sql->fetch()) {
					//Create event and set variables
					$event = new Event();
					$event->ID = intval($_id);
					$event->OwnerID = $result_row["OwnerID"];
					$event->Title = $result_row["Title"];
					$event->Image = $result_row["Image"];
					$event->ImageID = $result_row["ImageID"];
					$event->Description = $result_row["Description"];
					$event->StartDateTime = $result_row["StartDateTime"];
					$event->EndDateTime = $result_row["EndDateTime"];
					$event->Address = $result_row["Address"];
					$event->City = $result_row["City"];
					$event->State = $result_row["State"];
					$event->ZIP = $result_row["ZIP"];
					$event->IsFree = $result_row["IsFree"];
					$event->IsCancelled = $result_row["IsCancelled"];
					
					//Add event to collection
					$this->addItem($event);
					$event = null;
				}
				
				$pdo = null;
			} catch(PDOException $e) {
				$this->errors[] = $e->getMessage();
			}
		}
		
		public function search($page,
							   $keyword,
							   $zip,
							   $radius,
							   $tags,
							   $perPage = 10) {
	   		//Actual search function, just add additional stuff to where clause as stuff is included
	   		//http://stackoverflow.com/questions/16865747/pdo-prepared-statement-with-optional-parameters
	    }
	}