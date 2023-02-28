<?php

namespace app\core\db;
use app\core\Application;
use app\core\Model;

/**
 * Summary of DbModel
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attributes) {
            $statement->bindValue(":$attributes", $this->{$attributes});         
        }

        $statement->execute();
        return true;
    }

    /**
     * Summary of findOne
     * @param mixed $where [email => example@xample.com, firstname => example]
     * @return void
     * @author Michal Orlowski
     */
    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);


    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}