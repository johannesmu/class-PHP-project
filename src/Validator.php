<?php
namespace Johannes\Classproject;
class Validator {
    public static function validateEmail( $email ) {
        if( filter_var( $email, FILTER_VALIDATE_EMAIL) ) {
            return true;
        }
        else {
            return false;
        }
    }
    public static function validatePassword( $password ) {
        if( strlen($password) >= 8 ) {
            return true;
        }
        else {
            return false;
        }
    }
    public static function validateUsername( $username ) {
        // check the length of username
        if( strlen($username) >= 32 ) {
            return false;
        }
        // check if username is not alphanumeric
        else if( ctype_alnum($username) == false ) {
            return false;
        }
        else {
            return true;
        }
    }
}
?>