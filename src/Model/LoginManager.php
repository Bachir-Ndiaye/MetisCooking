<?php

namespace App\Model;

class LoginManager extends AbstractManager
{

    public const TABLE = 'users';

    public function insert($email, $password): string
    {
        $query = 'INSERT INTO users (email, password)
                    VALUES (:email, :password);';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':password', $password, \PDO::PARAM_STR);

        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    public function verifLog($email, $password)
    {
        $statement = $this->pdo->prepare('SELECT email, password FROM users WHERE email=:email AND password=:password');
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':password', $password, \PDO::PARAM_STR);
        $statement->execute();

        $verif = $statement->fetch();

        if ($verif === false) {
            return -1;
        } else {
            return $verif;
        }
    }
}
