<?php
class Database {
    // Define your database credentials
    private static $host = 'localhost';  // Replace with your database host
    private static $dbname = 'search_db'; // Replace with your database name
    private static $username = 'root';    // Replace with your database username
    private static $password = 'root';        // Replace with your database password
    private static $conn = null;

    // Method to connect to the database
    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }

    // Method to disconnect (optional)
    public static function disconnect() {
        self::$conn = null;
    }
}
?>