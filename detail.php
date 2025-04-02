<?php
require_once 'vendor/autoload.php';
// classes used in this page
use Johannes\Classproject\App;
use Johannes\Classproject\Book;
// create app from App class
$app = new App();
$book = new Book();
// book detail
$detail = array();
if( $_GET['id'] ) {
    $detail = $book -> getDetail( $_GET['id'] );
}

$site_name = $app -> site_name;
// checking if user is logged in
$isauthenticated = false;
$email = null;
if( isset( $_SESSION['email'] ) ) {
    $isauthenticated = true;
    $email = $_SESSION['email'];
}
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
    'email' => $email
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
