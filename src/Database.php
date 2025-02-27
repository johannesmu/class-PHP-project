<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\App;

class Database extends App {
    protected function __construct()
    {
        try 
        {
            if(
                $_ENV['DBHOST'] &&
                $_ENV['DBUSER'] &&
                $_ENV['DBPASSWORD'] &&
                $_ENV['DBNAME']
            ) 
            {
                // initialise connection
            }
            else {
                throw new Exception("Database credentials not loaded");
            }
        }
        catch( Exception $exc ) 
        {
            exit( $exc -> getMessage() );
        }
    }
}
?>