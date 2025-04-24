<?php 
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Book;

// create app from App class
$app = new App();

// get items from database
$search_result = array();
$book = new Book();
if( !$_GET["keyword"] ) {
    header("location: /");
}
else {
    $search_result = $book -> search($_GET["keyword"]);
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






// create data variables
$page_title = "$username's Favourite Books";

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'search.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'loggedin' => $isauthenticated,
    'username' => $username,
    'email' => $email,
    'id' => $id,
    'results' => $search_result
] );
?>