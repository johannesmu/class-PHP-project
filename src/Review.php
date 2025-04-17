<?php
namespace Johannes\Classproject;

use Johannes\Classproject\Database;

class Review extends Database {
    public function __construct()
    {
        parent::__construct();
    }
    public function create( $title, $text, $rating, $account_id, $book_id ) {
        $create_query = "
        INSERT INTO Review
        ( title, text, rating, account_id, book_id, updated, created, active )
        VALUES
        ( ?,?,?,?,?,?,?,1)";
        $statement = $this -> connection -> prepare($create_query);
        $timestamp = date("Y-m-d H:i:s", time() );
        $statement -> bind_param("ssiiiss",
                            $title, 
                            $text, 
                            $rating,
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
    public function getBookReviews( $book_id ) {
        $get_query = "
        SELECT
        Review.id as id,
        title,
        text,
        rating,
        book_id,
        Review.created as created,
        Review.updated as updated,
        User.name as username
        FROM Review
        INNER JOIN User
        ON Review.account_id = User.account_id
        WHERE book_id=? 
        AND active=1
        ";
        $statement = $this -> connection -> prepare($get_query);
        $statement -> bind_param("i", $book_id );
        $statement -> execute();
        $result = $statement -> get_result();
        $reviews = array();
        while ( $row = $result -> fetch_assoc() ) {
            array_push($reviews,$row);
        }
        return $reviews;
    }
    public function hasUserReviewed($username,$reviews) {
        foreach( $reviews as $review ) {
            if( $review['username'] == $username ) {
                return true;
            }
        }
        return false;
    }
}
?>