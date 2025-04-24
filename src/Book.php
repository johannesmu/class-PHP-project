<?php

namespace Johannes\Classproject;

use \Exception;
use Johannes\Classproject\Database;

class Book extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $get_query = "
            SELECT 
            Book.id AS id,
            Book.title AS title,
            Book.tagline AS tagline,
            Book.year AS year,
            Book.image AS image,
            CONCAT( Author.author_first, ' ', Author.author_last) AS author
            FROM 
            `Book` 
            INNER JOIN Book_Author ON Book_Author.book_id = Book.id
            INNER JOIN Author ON Book_Author.author_id = Author.author_id
            WHERE Book.visible=1
            GROUP BY Book.id
        ";
        $statement = $this -> connection -> prepare( $get_query );
        $statement -> execute();
        // get the results
        $books = array();
        $result = $statement -> get_result();
        // loop through the result to add to array
        while( $row = $result -> fetch_assoc() ) {
            array_push( $books, $row );
        }
        // return the array of items
        return $books;
    }

    public function getDetail( $id ) {
        $detail_query = "
            SELECT 
            Book.id AS id,
            Book.title AS title,
            Book.tagline AS tagline,
            Book.year AS year,
            Book.image AS image,
            Book.isbn10,
            Book.isbn13,
            Book.pages,
            Book.summary,
            Book.tags,
            CONCAT( Author.author_first, ' ', Author.author_last) AS author
            FROM 
            `Book` 
            INNER JOIN Book_Author ON Book_Author.book_id = Book.id
            INNER JOIN Author ON Book_Author.author_id = Author.author_id
            WHERE Book.visible=1 AND Book.id = ?
            GROUP BY Book.id 
        ";
        $statement = $this -> connection -> prepare( $detail_query );
        $statement -> bind_param("i", $id );
        $statement -> execute();
        $book_detail = array();
        $result = $statement -> get_result();
        $book_detail = $result -> fetch_assoc();
        return $book_detail;
    }
    public function search( $keyword ) {
        $search_query="
        SELECT id, title, image, year  FROM `Book` WHERE title LIKE ?
        ";
        $keyword = "%" . $keyword . "%";
        $statement = $this -> connection -> prepare($search_query);
        $statement -> bind_param("s", $keyword );
        $statement -> execute();
        $result = $statement -> get_result();
        $search_results = array();
        while( $row = $result -> fetch_assoc() ) {
            array_push( $search_results, $row );
        }
        return $search_results;
    }
}
