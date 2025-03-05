<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;
USE Johannes\Classproject\HashGenerator;

class Account extends Database {
    private $dbconnection;
    // array to store errors
    public $error = [];
    public function __construct()
    {
        try 
        {
            // $db = new Database();
            // if( !$db ) {
            //     throw new Exception("no database available");
            // }
            // else {
            //     $this -> connection = $db -> connection;
            // }
            parent::__construct();
            $this -> dbconnection = $this -> connection;
        }
        catch( Exception $exc )
        {
            exit( $exc -> getMessage() );
        }
    }
    public function create( $email, $password ) 
    {
        // perform query to create an account with email and password
        $query = "INSERT INTO Account ( email, password, reset, active, created)
                VALUES(?,?,?,true,NOW(), NOW() ) ";
        // check email formatting
        // check password
        // hash password
        // create reset string


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