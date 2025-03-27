<?php
namespace Johannes\Classproject;
use Dotenv\Dotenv;
use \Exception;
use Johannes\Classproject\SessionManager;

class App {
    protected $config;
    public $site_name;
    
    public function __construct()
    {
        // class constructor
        $this -> loadConfig();
        SessionManager::init();
    }

    private function loadConfig()
    {
        try {
            // cwd = current working directory
            $app_dir = getcwd();
            $dotenv = Dotenv::createImmutable($app_dir);
            $dotenv->load();
            $this -> site_name = $_ENV['SITENAME'];
            date_default_timezone_set( $_ENV['TIMEZONE'] );
        }
        catch ( Exception $exception) {
            $msg = $exception -> getMessage();
            exit($msg);
        }
    }
}
?>