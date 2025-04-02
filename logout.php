<?php
require_once 'vendor/autoload.php';

use Johannes\Classproject\App;
use Johannes\Classproject\SessionManager;

$app = new App();

SessionManager::kill();

header("location: /");
?>