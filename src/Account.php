<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;

class Account extends Database {
    private $connection;
    public function __construct()
    {
        try 
        {
            $db = new Database();
            if( !$db ) {
                throw new Exception("no database available");
            }
            else {
                $this -> connection = $db -> connection;
            }
        }
        catch( Exception $exc )
        {
            exit( $exc -> getMessage() );
        }
    }
    public function create( $email, $password ) 
    {
        // perform query to create an account with email and password
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