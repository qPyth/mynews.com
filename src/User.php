<?php

declare(strict_types=1);

namespace NewsSite;

use Exception;

class User
{
    public function __construct(private Database $database)
    {
    }


    public function registration(array $userRegistrationData): bool|string
    {
        try {
            $stmt = $this->database->getConnection()->prepare('INSERT INTO users(username, password, email, name, lastname) VALUES (:username, :password, :email, :name, :lastname)');
            $result = $stmt->execute($userRegistrationData);
            if(!$result) {
                throw new Exception('Регистрация не удалась, попробуйте позже');
            }
            return true;
        } catch(Exception $exception) {
            return $exception->getMessage();
        }
    }
}