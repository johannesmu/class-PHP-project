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
        if( Validator::validateUsername($username) == false ) {
            $this -> errors['username'] = "Username does not meet requirements";
        }
        // check if username already exists
        $user = new User();
        if( $user -> checkIfExists($username) ) {
            $this -> errors['username'] = "Username already exists";
        }
        // if there are errors, return the response
        if( count($this -> errors) > 0 ) {
            $this -> response['success'] = false;
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
            // create the user profile
            $account_id = $this -> connection -> insert_id;
           
            $create = $user -> create( $account_id, $username );
            $userdata = array(
                'username' => $username,
                'email' => $email,
                'lastseen' => $created,
                'created' => $created,
                'id' => $account_id
            );
            // account and user creation success
            $this -> response['success'] = 1;
            $this -> response['data'] = $userdata;
            return $this -> response;
        }
        else {
            // account creation failed
            $this -> response['success'] = 0;
            $this -> errors['failed to execute'];
            $this -> response['errors'] = $this -> errors;
        }
        return $this -> response;
    }
    public function login( $email, $password ) {
        $login_query = "
        SELECT 
        Account.id as id,
        email,
        password,
        last_seen,
        Account.created as created,
        User.name as name
        FROM Account 
        INNER JOIN User
  		ON Account.id = User.account_id
        WHERE email=?
        AND active=1
        ";
        $statement = $this -> connection -> prepare( $login_query );
        $statement -> bind_param("s", $email );
        try {
            if( ! $statement -> execute() ) {
                throw new Exception("database error");
            }
            else {
                $result = $statement -> get_result();
                // count how many rows returned
                if( $result -> num_rows == 0 ) {
                    throw new Exception("the account does not exist");
                }
                else {
                    // account exists now check the password
                    $acc = $result -> fetch_assoc();
                    if( !password_verify($password, $acc['password'])) {
                        throw new Exception("wrong password");
                    }
                    else {
                        // password matches
                        $this -> response['success'] = true; 
                        $userdata = array(
                            'username' => $acc['name'],
                            'email' => $acc['email'],
                            'lastseen' => $acc['last_seen'],
                            'created' => $acc['created'],
                            'id' => $acc['id']
                        );
                        $this -> response['data'] = $userdata;
                    }
                }
            }
        }
        catch( Exception $exc ) {
            $this -> errors['authentication'] = $exc -> getMessage();
        }
        if( count( $this -> errors) > 0 ) {
            $this -> response['success'] = false;
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