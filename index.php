<?php 
require_once 'vendor/autoload.php';
// testing phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// create data variables
$page_title = "Class Project Home Page";
$greeting = "Welcome to my website";
// Loading the twig template
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment( $loader );
$template = $twig -> load( 'page.twig' );
// render the ouput
echo $template -> render( [ 'title' => $page_title, 'greeting' => $greeting ] );
?>