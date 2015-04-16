<?php
	class Upload {
		/**
	     * @var array Collection of error messages
	     */
	    public $errors = array();
		/**
	     * @var array Collection of messages
	     */
	    public $messages = array();
		
		public function uploadImage($_purpose) {
			//$_purpose is int for type of image (profile, event, etc.)
			//1 - Profile
			//2 - Event
			if (isset($_type)) {
				if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0)  {
					if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
						$maxSize = 65535;
						$fileSize = $_FILES['userfile']['size'];
						
						if ($fileSize < $maxSize) {
							$fileType = $_FILES['userfile']['type'];
							
							if (!(false === array_search($fileType, array('image/jpeg', 'image/gif', 'image/png'), true))) {
								$fileName = $_FILES['userfile']['name'];
								$content = fopen($_FILES['userfile']['tmp_name'], 'rb');
								
								try {
									$pdo = new PDO(DB_PDOHOST, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
									$sql = $pdo->prepare("INSERT INTO images (Name, Image, Type, Size) VALUES (" .
													":filename, " .
													":imgdata, " .
													":type, " .
													":size)");					
									$sql->bindParam(':filename', $fileName, PDO::PARAM_STR, 64);
									$sql->bindParam(':imgdata', $content, PDO::PARAM_LOB);
									$sql->bindParam(':type', $fileType, PDO::PARAM_STR, 32);
									$sql->bindParam(':size', $fileSize, PDO::PARAM_STR, 32);
									
									$sql->execute();
									$pdo = null;
									
									$this->errors[] = "File $fileName uploaded";
								} catch(PDOException $e) {
									$this->errors[] = 'Error : ' .$e->getMessage();
								}
							} else {
								$this->errors[] = "File is not allowed type.";
							}
						} else {
							$this->errors[] = "File size too large.";
						}
					} else {
						switch($_FILES['userfile']['error']) {
							case 0: //no error; possible file attack!
							  $this->errors[] = "There was a problem with your upload.";
							  break;
							case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
							  $this->errors[] = "The file you are trying to upload is too big.";
							  break;
							case 2: //uploaded file exceeds the max file size in the html form
							  $this->errors[] = "The file you are trying to upload is too big.";
							  break;
							case 3: //uploaded file was only partially uploaded
							  $this->errors[] = "The file you are trying upload was only partially uploaded.";
							  break;
							case 4: //no file was uploaded
							  $this->errors[] = "You must select an image for upload.";
							  break;
							default: //a default error, just in case!
							  $this->errors[] = "There was a problem with your upload.";
							  break;
						}
					}
				} else {
					$this->errors[] = "No file uploaded.";
				}
			} else {
				$this->errors[] = "Image purpose not specified.";
			}
		}
		
		
	}
