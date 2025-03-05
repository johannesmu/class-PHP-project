<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;

class Account extends Database {
    public function __construct()
    {
        parent::__construct();
    }
    public function create( $email, $password ) 
    {
        // perform query to create an account with email and password
        $create_query = "INSERT INTO Account (
            email,
            password,
            reset,
            active,
            created
            VALUES (?,?,?,TRUE,NOW() )
        )";
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