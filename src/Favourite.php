<?php
namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;

class Favourite extends Database{
    public function __construct()
    {
        parent::__construct();
    }

    public function create( $account_id, $book_id ) {
        $create_query = "
        INSERT INTO Favourite
        ( account_id, book_id, active )
        VALUES
        ( ?, ?, 1 )
        ";
        $statement = $this -> connection -> prepare( $create_query );
        $statement -> bind_param("ii", $account_id, $book_id );
        try {
            if( !$statement -> execute()) {
                throw new Exception("data insert error");
            }
            else {
                return true;
            }
        } catch( Exception $e) {
            return false;
        }
       
    }
    // check if book is in user's favourite
    public function get( $account_id ) {
        $get_query = "
        SELECT
        id,
        book_id
        FROM 
        Favourite
        WHERE active = 1
        AND account_id = ?
        ";
        $statement = $this -> connection -> prepare( $get_query );
        $statement -> bind_param("i", $account_id );
        $statement -> execute();
        $result = $statement -> get_result();
        $favourites = array();
        while( $row = $result -> fetch_assoc() ) {
            array_push( $favourites, $row );
        }
        return $favourites;
    }
}
?>