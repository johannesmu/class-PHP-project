<?php
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Book;
// create app from App class
$app = new App();
$book = new Book();

$site_name = $app -> site_name;
// create data variables
$page_title = "$site_name Book Club";
$greeting = "Welcome to $site_name";

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'detail.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'greeting' => $greeting,
    'website_name' => $site_name
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
