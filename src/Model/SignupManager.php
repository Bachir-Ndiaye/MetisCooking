<?php

namespace App\Model;

class SignupManager extends AbstractManager
{

    public const TABLE = 'users';

    public function insert1($firstname, $lastname, $email, $password): string
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

    public function insert($firstname, $lastname, $email, $password): string
    {

        $query = 'SELECT firstname, lastname, email, password FROM users WHERE email= ?';
        $statement = $this->pdo->prepare($query);
        $statement->execute([$email]);
        $result = $statement->rowcount();

        if ($result > 0) {
            return '0';
        }

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
