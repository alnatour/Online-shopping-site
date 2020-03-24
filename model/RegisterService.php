<?php

class RegisterService {

    private $db;
    private $registerDb;
    public $errors;

    public function __construct()
    {
        $this->db = ContactDb::getInstance();
        $this->registerDb = RegisterRepository::getInstance();
    }

    public function login($user)
    {
        $errors = array();
        $user_check = $this->registerDb->findUserByEmail($user);
       
        if ($user_check !==  false){
            if ($user_check->getPassword() !== $user->getPassword() ) {
                    array_push($errors, "The Password is incorrect ");
                }
            if (count($errors) == 0) {
                    if($this->registerDb->checkIfLoggedUserIsAdmin($user) == 'admin') {
                        $_SESSION['role'] = 'admin';
                        
                    }else {
                        $_SESSION['loggedUser'] = true;
                    }

                    $_SESSION['user'] = $user_check;
                    header('Location: '.BASE_URL.'index.php');
                }
            } else {
                array_push($errors, 'E-Mail '.$user->getEmail().' is incorrect');
            }

            $_SESSION['message'] = $errors;

    }

    public function register($user){

        $errors = array();

        //Check if user exists
        $checkUser = $this->registerDb->findUserByEmail($user);

            //Check errors
        if ($checkUser) {
            array_push($errors, "Email already exists");
        }
        if (empty($_POST['email']) ) {
            array_push($errors, "Email is required");
        }
        if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
            array_push($errors, "Password is required and must be at least 6 characters long");
        }
        if ( !preg_match("#[0-9]+#", $_POST['password']) ) {
            array_push($errors, "Password must contain at least one Nummer");
        }
        if ( !preg_match("#[a-z]+#", $_POST['password']) ) {
            array_push($errors, "Password must contain at least one character");
        }

        if (empty($_POST['firstname'])) {
            array_push($errors, "First Name is required");
        }
        if (empty($_POST['lastname'])) {
            array_push($errors, "Last Name is required");
        }
        
        //create new user 
        if (count($errors) == 0) {

            $create_user = $this->registerDb->registerNewUser($user);

            if(!$create_user){
                $feedback = 'wurde nicht registriert';
            }else{
                $_SESSION['user'] = 1;
            }
            $user->setId($create_user);
            $_SESSION['user'] = $user;
            header('Location: '.BASE_URL.'index.php');
        }
        return $errors;

    }

} 
