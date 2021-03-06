<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
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
    
    /**the function "__construct()" automatically starts whenever an object of this class is created,
    * you know, when you do "$registration = new Registration();" */    
    public function __construct()
    {
		if (!isset($_SESSION))
        {
            session_start();            
        }
        
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {                  
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
            $_SESSION['userName'] = $_POST['user_name'];
            $_SESSION['userEmail'] = $_POST['user_email'];
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $user_isBusiness = $this->db_connection->real_escape_string(strip_tags($_POST['is_business'], ENT_QUOTES));
                $user_password = $this->db_connection->real_escape_string(strip_tags($_POST['user_password_new'], ENT_QUOTES));
                       
                // create password hashing object
                $password_hasher = new PasswordHash(8, FALSE);
                
                // crypt the user's password
                $user_password_hash = $password_hasher->HashPassword($user_password);

                // check if username already exists
                $sql = "SELECT * FROM account WHERE Username = '" . $user_name . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username is already taken.";                    
                } else {
                   $_SESSION['userName'] = $_POST['user_name'];
                }
                
                // check if email address already exists
                $sql = "SELECT * FROM account WHERE Email = '" . $user_email . "';";
                $query_check_user_email = $this->db_connection->query($sql);

                if ($query_check_user_email->num_rows == 1) {
                    $this->errors[] = "Sorry, that email address is already taken.";
                } else {                    
                    $_SESSION['userEmail'] = $_POST['user_email'];   
                }
                
                if ($query_check_user_name->num_rows != 1 && $query_check_user_email->num_rows != 1) {
                    // write new user's data into database
                    $sql = "INSERT INTO account (Username, Password, Email, IsBusiness)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "', '" . $user_isBusiness . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        session_destroy();
                        session_start();
                        // database query, getting the ID of the inserted user 
                        $sql = "SELECT ID, Username
                                FROM account
                                WHERE Username = '" . $user_name . "';";
                        $get_inserted_user = $this->db_connection->query($sql);
                        // get result row (as an object)
                        $result_row = $get_inserted_user->fetch_object();
                        // write user data into PHP SESSION (a file on your server)                       
                        $_SESSION['user_name'] = $user_name;
                        $_SESSION['user_login_status'] = 1;  
                        $_SESSION['user_id'] = $result_row->ID;
                        session_write_close();
                                              
                        header('Location: /WhatsGoingOn/views/userProfile.php');
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
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
