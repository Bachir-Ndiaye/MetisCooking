<?php

namespace App\Model;

class SignupManager extends AbstractManager
{

    public const TABLE = 'users';

    public function insert($firstname, $lastname, $email, $password): string
    {
        $query = 'INSERT INTO users (firstname, lastname, email, password)
                    VALUES (:firstname, :lastname, :email, :password);';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':password', $password, \PDO::PARAM_STR);

        $statement->execute();

        return $this->pdo->lastInsertId();
    }
}
