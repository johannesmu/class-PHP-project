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
$page_title = "Login to your account";
$login_errors = [];

// checking for form submission via POST
if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    // store email from form in a variable
    $email = $_POST['email'];
    // store password from form in a variable
    $password = $_POST['password'];
   
    $account = new Account();
    // call the create method in account
    $login = $account -> login($email,$password);
    if( $login['success'] == true ) {
        // account has been created set the session variable
        $_SESSION['email'] = $login['data']['email'];
        $_SESSION['username'] = $login['data']['username'];
        $_SESSION['id'] = $login['data']['id'];
        //print_r($login);
        header("location: / ");
    }
    else {
        // there are errors
        $login_errors = implode( "," , $account -> response['errors']);
    }
}

// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'login.twig' );
// render the ouput
echo $template -> render( [ 
    'title' => $page_title, 
    'website_name' => $site_name,
    'errors' => $login_errors 
] );
?>