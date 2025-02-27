<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\App;

class Database extends App {
    protected $connection;
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
                try 
                {
                    $this -> connection = mysqli_connect(
                        $_ENV['DBHOST'],
                        $_ENV['DBUSER'],
                        $_ENV['DBPASSWORD'],
                        $_ENV['DBNAME']
                    );
                    if( !$this->connection ) {
                        throw new Exception("database connection cannot be created");
                    }
                }
                catch( Exception $exc ) 
                {
                    exit( $exc -> getMessage() );
                }
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