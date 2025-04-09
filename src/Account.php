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
            // get the id of the new account
            $account_id = $this -> connection -> insert_id;
            // create the user profile
            $user = new User();
            $create_user = $user -> create( $account_id, $username );
            if( $create_user['success'] == true ) {
                // user created successfully
            }
            else{
                // there was a problem creating user
                $this -> response['success'] = false;
                $this -> errors['username'] = implode(',', $create_user['errors']);
                $this -> response['errors'] = $this -> errors;
                //print_r( $this -> response['errors']);
                // delete the account if user is not created
                $this -> deleteAccount($account_id);
            }
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
    private function deleteAccount( $id) {
        $delete_query = "DELETE FROM Account WHERE id=?";
        $statement = $this -> connection -> prepare( $delete_query );
        $statement -> bind_param("i",$id );
        if( $statement -> execute() ) {
            return true;
        }
        else {
            return false;
        }
    }
} 
?>