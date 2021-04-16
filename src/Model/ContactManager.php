<?php

namespace App\Model;

class ContactManager extends AbstractManager
{

    public const TABLE = 'users';

    public function insert($firstname, $lastname, $email, $comment): string
    {
        $query = 'INSERT INTO users (firstname, lastname, email)
                    VALUES (:firstname, :lastname, :email);';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);

        $statement->execute();
        $userId = $this->pdo->lastInsertId();

        $queryComment = 'INSERT INTO comments (comment, user_id)
                        VALUES (:comment, :user_id);';
         $statement = $this->pdo->prepare($queryComment);
         $statement->bindValue(':comment', $comment, \PDO::PARAM_STR);
         $statement->bindValue(':user_id', $userId, \PDO::PARAM_INT);

         $statement->execute();

        return $this->pdo->lastInsertId();
    }
}
