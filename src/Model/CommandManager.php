<?php

namespace App\Model;

class CommandManager extends AbstractManager
{
    public const TABLE = 'commandorder';

    public function insert($amount, $userId, $commandNumber): string
    {
        $query = "INSERT INTO " . self::TABLE . " (amount, created_at, user_id, command_number)
                        VALUES (:amount, NOW(), :userId, :commandNumber);";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':amount', $amount, \PDO::PARAM_INT);
        $statement->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $statement->bindValue(':command_number', $commandNumber, \PDO::PARAM_STR);

        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    public function searchUser()
    {
        $query = 'SELECT * from users JOIN commandorder ON commandorder.user_id=users.id';
        return $this->pdo->query($query)->fetchAll();
    }

    public function searchCommands(int $id)
    {
        $query = 'SELECT * from commandorder JOIN users ON users.id=commandorder.user_id WHERE user_id=' . $id;
        return $this->pdo->query($query)->fetchAll();
    }
}
