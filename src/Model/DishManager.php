<?php

namespace App\Model;

class DishManager extends AbstractManager
{
    public const TABLE = 'menus';

    /**
     * Get entrees in dishes table.
     */
    public function selectDish(string $dishType, string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT menus.name AS menu,
                         dishes.name AS dish,
                         cookers.name AS cooker, 
                         dishes.image_link AS link 
                         FROM menus JOIN dishes 
                         ON menus.' . $dishType . '=dishes.id JOIN cookers ON menus.cooker_id=cookers.id';

        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectOneMenu(string $menuName)
    {
       // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE name=:name;");
        $statement->bindValue('name', $menuName, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectOneDish(int $dishId)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM dishes WHERE id=:id");
        $statement->bindValue('id', $dishId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
