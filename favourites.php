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


// initialise favourites
$fav = new Favourite();
$fav_items = $fav -> get( $id );

if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $fav_id = $_POST['fav_id'];
    $fav -> delete( $fav_id );
}

// create data variables
$page_title = "$username's Favourite Books";

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'favourites.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'loggedin' => $isauthenticated,
    'username' => $username,
    'email' => $email,
    'id' => $id,
    'favourites' => $fav_items
] );
?>