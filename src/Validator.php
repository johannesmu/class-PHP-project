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
}
?>