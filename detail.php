<?php
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Book;
use Johannes\Classproject\Review;

// create app from App class
$app = new App();
$book = new Book();
// book detail
$detail = array();
$book_id = null;
if( $_GET['id'] ) {
    $book_id = $_GET['id'];
    $detail = $book -> getDetail( $book_id );
}


$site_name = $app -> site_name;
// checking if user is logged in
$isauthenticated = false;
$username = '';
$email = '';
$id = '';
if( isset( $_SESSION['email'] ) ) {
    $isauthenticated = true;
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
}
// handle review submission via a POST request
$review = new Review();
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $review_title = $_POST['review-title'];
    $review_text = $_POST['review-text'];
    $review_rating = $_POST['rating'];
    // create the review
    $review_create = $review -> create($review_title, $review_text, $review_rating, $id,$book_id);
}

// get reviews for the book 
$reviews = $review -> getBookReviews($book_id);
$has_reviewed =  $review -> hasUserReviewed($username,$reviews);

// create data variables
$page_title = "Detail for " . $detail['title'];
// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'detail.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'detail' => $detail,
    'loggedin' => $isauthenticated,
    'username' => $username,
    'email' => $email,
    'id' => $id,
    'book_id' => $book_id,
    'reviews' => $reviews,
    'reviewed' => $has_reviewed
] );


// if ($_SERVER["REQUEST_METHOD"] = "GET" && isset( $_GET["id"] )) {
//     echo "detail for ";
//     echo $_GET["id"];
// }
// else {
//     // redirect to home page
//     // header("location: index.php");
//     // tell the user the item doesn't exist
//     echo "the item requested doesn't exist";
// }
?>
