<?php
namespace Johannes\Classproject;
use Dotenv\Dotenv;
use \Exception;

class App {
    protected $config;
    public $site_name;
    
    public function __construct()
    {
        // class constructor
        $this -> loadConfig();
    }

    private function loadConfig()
    {
        try {
            // cwd = current working directory
            $app_dir = getcwd();
            $dotenv = Dotenv::createImmutable($app_dir);
            $dotenv->load();
            $this -> site_name = $_ENV['SITENAME'];
            $this -> setTimeZone();
        }
        catch ( Exception $exception) {
            $msg = $exception -> getMessage();
            exit($msg);
        }
    }
    private function setTimeZone() {
        try{
            if(! date_default_timezone_set( $_ENV['TIMEZONE'] ) ) {
                throw new Exception("Timezone data is not valid");
            }
        }
        catch( Exception $exception ) {
            $msg = $exception -> getMessage();
            exit($msg);
        }    
    }
}
?>