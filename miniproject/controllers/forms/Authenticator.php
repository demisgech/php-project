<?php

declare(strict_types=1);

require_once("App/getDBConnection.php");
require_once("Http/Session.php");

class Authenticator
{
    public static function attempt(string $email, string $password): bool
    {
        try {
            $db = getDBConnection();
            $sql = <<<SQL
                        SELECT * FROM users
                        WHERE email = :email;
                     SQL;
            $user = $db->query($sql, [
                "email" => $email
            ])->find();
            if ($user && password_verify($password, $user['password'])) {
                static::login([
                    'email' => $user['email']
                ]);
                return true;
            }
        } catch (RuntimeException  $ex) {
            echo $ex->getMessage();
        }
        return false;
    }

    public static function login(array $user): void
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        // as a good practice try to regenerate the session id

        session_regenerate_id(delete_old_session: true);
    }

    public static function logout(): void
    {
        Session::destroy();
    }

}