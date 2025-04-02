<?php
namespace Johannes\Classproject;
class Validator {
    public static array $errors = []; 
    public static function validateEmail( $email ) {
        
        $legal_email_characters = "abcdefghijklmnopqrstuvwxyz1234567890@.+-_";
        // count characters in the email address
        $length = strlen( $email );
        // reject email if it is longer than 256 characters
        if( $length > 256 ) {
            self::$errors['length'] = "email is longer than permissible standard";
            return false;
        }
        // remove spaces from the email and convert to lower case
        $lc_email = strtolower( trim($email) );
        // convert email characters into an array
        $email_chars = str_split($lc_email);

        // check if all characters are legal
        foreach( $email_chars as $char ) {
            if( str_contains($legal_email_characters, $char ) == false ) {
                // email contains a character that is not in the legal string
                self::$errors['character'] = "email contains an illegal charactter \'$char\' ";
            }
        }

        // check if email starts with a number
        if( is_numeric( $email_chars[0] ) ) {
            self::$errors['numeric'] = "email cannot start with a number";
        }

        // check for position of '@' and last '.'
        $at_symbol_pos = strpos($lc_email, '@');
        $lastdot_pos = strrpos($lc_email, '.' );
        if( $at_symbol_pos > $lastdot_pos ) {
            self::$errors['format'] = "email format is not valid";
        }
        if( count( self::$errors ) > 0 ) {
            return false;
        }
        else {
            return true;
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