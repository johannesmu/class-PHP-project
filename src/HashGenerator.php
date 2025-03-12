<?php
namespace Johannes\Classproject;
class HashGenerator {
    public static function ResetHash() {
        $str = time() . random_int( 0, 5000 );
        return hash( 'sha256', $str );
    }
    public static function PasswordHash($password) {
        return password_hash( $password, PASSWORD_DEFAULT );
    }
}
?>