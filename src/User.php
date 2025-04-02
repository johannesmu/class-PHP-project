<?php

namespace Johannes\Classproject;

use Johannes\Classproject\Account;

class User extends Account
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get($account_id)
    {
        $get_query = "
            SELECT
                id,
                account_id,
                name,
                image,
                about,
                city,
                country,
                created,
                updated,
                active
                FROM User
                WHERE account_id = ?
        ";
        $statement = $this -> connection -> prepare( $get_query );
    }
}
