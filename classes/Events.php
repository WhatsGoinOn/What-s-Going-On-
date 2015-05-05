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
			return count($this->items);
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
		public function search($page, $perPage = 10) {
	   		//Actual search function, just add additional stuff to where clause as stuff is included
	   		//http://stackoverflow.com/questions/16865747/pdo-prepared-statement-with-optional-parameters
	   		$where = array();
			
			if (isset($_GET['keyword']) && !empty($_GET['keyword'])) { $where[] = 'Title LIKE :keyword'; }
			if (isset($_GET['zip']) && !empty($_GET['zip'])) { $where[] = 'ZIP = :zip'; }
			if (isset($_GET['date']) && !empty($_GET['date'])) { $where[] = 'DATE(StartDateTime) <= :date AND DATE(EndDateTime) >= :date'; }
				
			if (count($where) > 0) {
				//parameters that don't allow a search on their own
				if (!isset($_GET['allowcancelled'])) { $where[] = '(IsCancelled IS NULL OR IsCancelled <> 1)'; }
				if (!isset($_GET['allowover'])) { $where[] = 'EndDateTime > NOW()'; }
				
				try {
					$query = 'SELECT ID, OwnerID, Title, Image, ImageID, Description, StartDateTime, EndDateTime, Address, City, State, ZIP, IsFree, IsCancelled
	                        FROM event
	                        WHERE ' . implode(' AND ', $where) .
	                        ' ORDER BY StartDateTime ASC
	                        LIMIT :offset, :amount';
					$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					$sql = $pdo->prepare($query);
					$offset = ($page - 1) * $perPage;
					
					$sql->bindParam(':offset', $offset, PDO::PARAM_INT);
					$sql->bindParam(':amount', $perPage, PDO::PARAM_INT);
					if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
						$keyword = '%' . $_GET['keyword'] . '%';
						$sql->bindParam(':keyword', $keyword, PDO::PARAM_STR);
					}
					if (isset($_GET['zip']) && !empty($_GET['zip'])) { $sql->bindParam(':zip', $_GET['zip'], PDO::PARAM_STR, 5); }
					if (isset($_GET['date']) && !empty($_GET['date'])) { $sql->bindParam(':date', $_GET['date']); }
					$sql->execute();
					
					while ($result_row = $sql->fetch()) {
						//Create event and set variables
						$event = new Event();
						$event->ID = $result_row["ID"];
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
			} else {
				$this->errors[] = 'No parameters listed for search.';
			}
	    }

		public function searchOwned($ownerID) {
			if (isset($ownerID) && is_numeric($ownerID)) {
				try {
					$query = 'SELECT ID, OwnerID, Title, Image, ImageID, Description, StartDateTime, EndDateTime, Address, City, State, ZIP, IsFree, IsCancelled
	                        FROM event 
	                        WHERE (IsCancelled IS NULL OR IsCancelled <> 1) 
	                        AND EndDateTime > NOW() 
	                        AND OwnerID = :ownerid
							ORDER BY StartDateTime ASC';
					$pdo = new PDO(DB_PDOHOST,DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					$sql = $pdo->prepare($query);
					
					$sql->bindParam(':ownerid', $ownerID, PDO::PARAM_INT);
					$sql->execute();
					
					while ($result_row = $sql->fetch()) {
						//Create event and set variables
						$event = new Event();
						$event->ID = $result_row["ID"];
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
			} else {
				$this->errors[] = 'Owner ID invalid.';
			}
	    }
	}