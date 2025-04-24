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
        Favourite.id AS id,
        book_id,
        Book.title AS title,
        Book.image AS image
        FROM 
        Favourite
        INNER JOIN Book
        ON book_id = Book.id
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
    // method to delete favourite
    public function delete( $fav_id ) {
        $delete_query = "
        DELETE FROM `Favourite` WHERE id = ?
        ";
        $statement = $this -> connection -> prepare( $delete_query );
        $statement -> bind_param("i", $fav_id );
        if( $statement -> execute() ) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>