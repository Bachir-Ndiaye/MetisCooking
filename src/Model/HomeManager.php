<?php

namespace App\Model;

class HomeManager extends AbstractManager
{
    public const TABLE = 'newsletters';

    /**
     * Insert new item in database
     * @param string $newsletter
     * @return int
     */
    public function insert(string $newsletter): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`) VALUES (:email)");
        $statement->bindValue('email', $newsletter, \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
