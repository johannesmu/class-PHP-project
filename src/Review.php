<?php
namespace Johannes\Classproject;

use Johannes\Classproject\Database;

class Review extends Database {
    public function __construct()
    {
        parent::__construct();
    }
    public function create( $title, $text, $account_id, $book_id ) {
        $create_query = "
        INSERT INTO Review
        ( title, text, account_id, book_id, updated, created, active )
        VALUES
        ( ?,?,?,?,?,?,1)";
        $statement = $this -> connection -> prepare($create_query);
        $timestamp = date("Y-m-d H:i:s", time() );
        $statement -> bind_param("ssiiss",
                            $title, 
                            $text, 
                            $account_id, 
                            $book_id,
                            $timestamp,
                            $timestamp
                        );
        if( $statement -> execute() ) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>