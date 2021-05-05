<?php

namespace App\Model;

class CommandManager extends AbstractManager
{
    public const TABLE = 'commandorder';

    public function insert($amount, $userId): string
    {
        $query = "INSERT INTO " . self::TABLE . " (amount, created_at, user_id)
                        VALUES (:amount, NOW(), :userId);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':amount', $amount, \PDO::PARAM_INT);
        $statement->bindValue(':userId', $userId, \PDO::PARAM_INT);
        //$statement->bindValue(':dishId', $dishId, \PDO::PARAM_INT);

        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    public function searchUser()
    {
        $query = 'SELECT * from users JOIN commandorder ON commandorder.user_id=users.id';
        return $this->pdo->query($query)->fetchAll();
    }

    public function searchCommands()
    {
        $query = 'SELECT * from commandorder JOIN users ON commandorder.user_id=users.id';
        return $this->pdo->query($query)->fetchAll();
    }
}
