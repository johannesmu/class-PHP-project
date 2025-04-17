<?php 
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Book;
use Johannes\Classproject\Favourite;

// create app from App class
$app = new App();

// get items from database
$book = new Book();
$items = $book -> get();

$site_name = $app -> site_name;
// create data variables
$page_title = "$site_name Book Club";
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
// handle favourites submission
if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    $account_id = $_POST['account_id'];
    $book_id = $_POST['book_id'];
    $fav = new Favourite();
    $create_fav = $fav -> create($account_id, $book_id);
}

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'page.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'items' => $items,
    'loggedin' => $isauthenticated,
    'username' => $username,
    'email' => $email,
    'id' => $id
] );
?>