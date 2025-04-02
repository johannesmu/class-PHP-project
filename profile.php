<?php
require_once 'vendor/autoload.php';

// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Book;
// create app from App class
$app = new App();

$site_name = $app -> site_name;
// checking if user is logged in
$isauthenticated = false;
$email = null;

if( isset( $_SESSION['email'] ) ) {
    $isauthenticated = true;
    $email = $_SESSION['email'];
}
// create data variables
$page_title = "Profile for . $email";
// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'profile.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'loggedin' => $isauthenticated,
    'email' => $email
] );
?>