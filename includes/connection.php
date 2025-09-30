<?php

class Database
{

    public static $connection;

    public static function setUpConnection()
    {
        if (!isset(Database::$connection)) {
            // Database::$connection = new mysqli("sona.lk", "sonalk_anc_db", "@Ancsuperadmin", "sonalk_anc", "3306");
            Database::$connection = new mysqli("localhost", "root", "Modayakek@1234", "sonalk_anc", "3306");
        }
    }

    public static function iud($q)
    {
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    // public static function search($q){
    //     Database::setUpConnection();
    //     $resultset = Database::$connection->query($q);
    //     return $resultset;
    // }

    public static function search($q, $params = [])
    {
        Database::setUpConnection();
        $stmt = Database::$connection->prepare($q);
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }
}
