<?php
require 'database/Database.php';
require 'database/QueryBuilder.php';

class DB{
    public static function __callStatic($name, $arguments)
    {
        $qb = new QueryBuilder(Database::getInstance());
        return call_user_func_array([$qb, $name], $arguments);
    }
}
