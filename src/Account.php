<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;
use Johannes\Classproject\Validator;
use Johannes\Classproject\User;

class Account extends Database {
    public $errors = [];
    public $response = [];
    public function __construct()
    {
        parent::__construct();
    }
    public function create( $email, $password, $username ) 
    {
        // perform query to create an account with email and password
        $create_query = "
        INSERT INTO 
        Account ( email, password,reset,active, last_seen ,created) 
        VALUES (?,?,?,1,?, ?)
        ";
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
        $created = date('Y-m-d H:i:s', time() );
        // create a mysql prepared statement
        $statement = $this -> connection -> prepare( $create_query );
        // binding parameters to the query
        $statement -> bind_param("sssss", $email, $hashed , $reset, $created, $created );
        if( $statement -> execute() ) {
            // account creation success
            $this -> response['success'] = 1;
            // create the user profile
            $account_id = $this -> connection -> insert_id;
            $user = new User();
            $create = $user -> create( $account_id, $username );
            // if( $create['success'] == false ) {
            //     $this -> response['success'] = false;
            //     $this -> errors['username already taken'];
            // }
        }
        else {
            // account creation failed
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