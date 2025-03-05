<?php 
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;

// create app from App class
$app = new App();
$site_name = $app -> site_name;
// create data variables
$page_title = "Signup for an account";

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'signup.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name 
] );
?>