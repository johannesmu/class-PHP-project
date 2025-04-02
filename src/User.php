<?php
namespace Johannes\Classproject;

use Johannes\Classproject\Database;
use \Exception;

class User extends Database {
    public function __construct()
    {
        parent::__construct();
    }
    public function create( $account_id, $name ) {
        $create_query = "
        INSERT INTO User
        (account_id,name,updated,created)
        VALUES
        (?,?,?,?)
        ";
        $statement = $this -> connection -> prepare( $create_query);
        $timestamp = date('Y-m-d H:i:s', time() );
        $statement -> bind_param("isss", $account_id, $name, $timestamp, $timestamp );
        try {
            if( $statement -> execute() ) {
                // success
            }
            else {
                // errors
                throw new Exception( $this -> connection -> connect_errno ) ;
            }
        } 
        catch( Exception $exception) {
            // handle the exception
            echo $exception -> getMessage();
        }
    }
    public function checkIfExists ($username) {
        $check_query = "
        SELECT COUNT(name) as total FROM `User` WHERE name=?
        ";
        $statement = $this -> connection -> prepare($check_query);
        $statement -> bind_param('s',$username);
        $statement -> execute();
        $result = $statement -> get_result();
        $count = $result -> fetch_assoc();
        if( $count['total'] > 0 ) {
            // the user already exists
            return false;
        }
        else {
            // no username of the same value in database
            return true;
        }
    }

}
?>