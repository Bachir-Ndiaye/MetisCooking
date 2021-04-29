<?php

namespace App\Model;

class ContactManager extends AbstractManager
{

    public const TABLE = 'contact';

    public function insert($firstname, $lastname, $email, $comment): string
    {
        $query = 'INSERT INTO contact (firstname, lastname, email, comment)
                    VALUES (:firstname, :lastname, :email, :comment);';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->bindValue(':comment', $comment, \PDO::PARAM_STR);



        $statement->execute();


        return $this->pdo->lastInsertId();
    }
}
