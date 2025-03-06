<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;
use Johannes\Classproject\Validator;
use Validator as GlobalValidator;

class Account extends Database {
    public $errors = [];
    public $response = [];
    public function __construct()
    {
        parent::__construct();
    }
    public function create( $email, $password ) 
    {
        // perform query to create an account with email and password
        $create_query = "INSERT INTO Account( email, password,reset,active, created) 
        VALUES (?,?,?,1,NOW() )
        )";
        if( Validator::validateEmail($email) == false ) {
            // email is not in valid format
            $this -> errors['email'] = "Email address is not valid";
        }
        if( Validator::validatePassword($password) == false ) {
            // password is not valid
            $this -> errors['password'] = "Password does not meet requirements";
        }
        // if there are errors, return the response
        if( count($this -> errors) > 0 ) {
            $this -> response['success'] = 0;
            $this -> response['errors'] = $this -> errors;
            return $this -> response;
        }
        // if there are no errors
        $reset = md5( time() . random_int(0,5000));
        $hashed = password_hash( $password, PASSWORD_DEFAULT);
        // create a mysql prepared statement
        $statement = $this -> connection -> prepare( $create_query );
        // binding parameters to the query
        $statement -> bind_param("sss", $email, $hashed , $reset );
        if( $statement -> execute() ) {
            $this -> response['success'] = 1;
        }
        else {
            $this -> response['success'] = 0;
            $this -> errors['failed to execute'];
            $this -> response['errors'] = $this -> errors;
        }
        return $this -> response;
    }
    public function update()
    {

    }
    public function getAccount() 
    {

    }
    public function deactivate()
    {

    }
}
?>