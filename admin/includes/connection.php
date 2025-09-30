<?php

class Database
{
    public static $connection;

    public static function setUpConnection()
    {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("sona.lk", "sonalk_anc_db", "@Ancsuperadmin", "sonalk_anc", "3306");
            // Enable error reporting
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            // Check connection
            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }

    public static function iud($q, $params = [])
    {
        try {
            Database::setUpConnection();
            $stmt = Database::$connection->prepare($q);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . Database::$connection->error);
            }

            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            // Handle error (you might want to log this instead of outputting)
            die("Database error: " . $e->getMessage());
        }
    }

    public static function search($q, $params = [])
    {
        try {
            Database::setUpConnection();
            $stmt = Database::$connection->prepare($q);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . Database::$connection->error);
            }

            if (!empty($params)) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            die("Database error: " . $e->getMessage());
        }
    }
}
class FileHandler
{
    public static function deleteFile($filePath)
    {
        if (!empty($filePath)) {
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($filePath, '/');
            if (file_exists($fullPath)) {
                try {
                    unlink($fullPath);
                    return true;
                } catch (Exception $e) {
                    error_log("File deletion failed: " . $e->getMessage());
                    return false;
                }
            }
        }
        return false;
    }
}
