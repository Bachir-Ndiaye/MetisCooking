<?php

namespace App\Model;

class NewsletterManager extends AbstractManager
{
    public const TABLE = 'newsletters';

    /**
     * Insert new item in database
     * @param array $users
     * @return int
     */
    public function insert(array $users): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`) VALUES (:email)");
        $statement->bindValue('email', $users['email'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
