<?php 
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Account;
use Johannes\Classproject\SessionManager;

// create app from App class
$app = new App();
$site_name = $app -> site_name;
// inititialise session
SessionManager::init();
// create data variables
$page_title = "Signup for an account";
$signup_errors = [];

// checking for form submission via POST
if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    // store email from form in a variable
    $email = $_POST['email'];
    // store password from form in a variable
    $password = $_POST['password'];
    // store username from form in a variable
    $username = $_POST['username'];
    // create an instance of account class
    $account = new Account();
    // call the create method in account
    $account_create = $account -> create($email,$password,$username);
    if( $account_create['success'] == true ) {
        // account has been created set the session variable
        $_SESSION['email'] = $email;
        header("location: / ");
    }
    else {
        // there are errors
        print_r($account_create);
       // $signup_errors = implode( "," , $account_create['errors']);
    }
}

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'signup.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'errors' => $signup_errors 
] );
?>