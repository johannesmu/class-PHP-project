<?php
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Account;

// create app from App class
$app = new App();
$site_name = $app -> site_name;

//handle form submission for signup
if( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'signup') {
    $email = $_POST['email'];
    $password = $_POST['password'];
   // create user account
   $account = new Account();
}
// create data variables
$page_title = "Sign Up Page";
$greeting = "Welcome to my website";
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