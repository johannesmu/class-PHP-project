<?php
namespace Johannes\Classproject;

use \Exception;

class SessionManager {
    public static function init() {
        if( session_status() == PHP_SESSION_NONE ) {
            try {
                if( !session_start() ) {
                    throw new Exception("Session cannot be started");
                }
            }
            catch( Exception $exception ) {
                exit( $exception -> getMessage() );
            }
        }
    }
    public static function kill() {
        session_destroy();
    }
}
?>