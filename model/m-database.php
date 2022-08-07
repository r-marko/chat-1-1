<?php
namespace Database;
 
class DatabaseCreate {
    const DB_HOST = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DB_NAME = "alt_e";

    public function __construct(){
        $connection = new \PDO("mysql:host=" . $this::DB_HOST, $this::USERNAME, $this::PASSWORD);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql_querry = "CREATE DATABASE IF NOT EXISTS " . $this::DB_NAME . ";";
        $connection->exec($sql_querry);
    }
}

class TableCreate{

    public function __construct($tableName){
        $pdo = new DatabaseCreate();
        $dsn = "mysql:host=" . $pdo::DB_HOST . ";dbname=" . $pdo::DB_NAME;
        $connection = new \PDO($dsn, $pdo::USERNAME, $pdo::PASSWORD);
        $querry_table_create = "CREATE TABLE IF NOT EXISTS " . $tableName . " (
            id INT(30) PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(40) UNIQUE NOT NULL,
            password VARCHAR(225) NOT NULL,
            status BOOLEAN NOT NULL
        );";
        $connection->query($querry_table_create);
    }

    public function createTableChatCouples($tableName){
        $pdo = new DatabaseCreate();
        $dsn = "mysql:host=" . $pdo::DB_HOST . ";dbname=" . $pdo::DB_NAME;
        $connection = new \PDO($dsn, $pdo::USERNAME, $pdo::PASSWORD);
        $querry_table_create = "CREATE TABLE IF NOT EXISTS " . $tableName . " (
            id INT(30) PRIMARY KEY AUTO_INCREMENT,
            chat_sender_id INT(30) NOT NULL,
            chat_receiver_id INT(30) NOT NULL
        );";
        $connection->query($querry_table_create);
    }

    public function createTableMessages($tableName){
        $pdo = new DatabaseCreate();
        $dsn = "mysql:host=" . $pdo::DB_HOST . ";dbname=" . $pdo::DB_NAME;
        $connection = new \PDO($dsn, $pdo::USERNAME, $pdo::PASSWORD);
        $querry_table_create = "CREATE TABLE IF NOT EXISTS " . $tableName . " (
            id INT(30) PRIMARY KEY AUTO_INCREMENT,
            receiver_id INT(30) NOT NULL,
            sender_id INT(30) NOT NULL,
            message VARCHAR(255) NOT NULL,
            message_date DATETIME NOT NULL
        );";
        $connection->query($querry_table_create);
    }
}

class DatabaseConnection {
    public static function connect(){
        $pdo = new DatabaseCreate();
        $dsn = "mysql:host=" . $pdo::DB_HOST . ";dbname=" . $pdo::DB_NAME;
        $connection = new \PDO($dsn, $pdo::USERNAME, $pdo::PASSWORD);
        return $connection;
    }
}

class TableInsert{
    public static function insertRegisterForm($username, $password, $status){
        $pdo = DatabaseConnection::connect();
        $sql = "INSERT INTO users(username, password, status) VALUES (?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password, $status]);
    }

    public static function insertMessagesTable($receiver_id, $sender_id, $message, $message_date){
        $pdo = DatabaseConnection::connect();
        $sql = "INSERT INTO messages(receiver_id, sender_id, message, message_date) VALUES (?, ?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$receiver_id, $sender_id, $message, $message_date]);
    }
}

class TableGetContent{
    public static function getAllFromUserTable(){
        $pdo = DatabaseConnection::connect();
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM users;";
        $rows = $pdo->query($sql)->fetchAll();
        return $rows;       
    }
    
    public static function getAllFromTableMessages(){
        $pdo = DatabaseConnection::connect();
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM messages;";
        $stmt = $pdo->query($sql);
        $status = $stmt->execute();
        if($status){
            $rows = $stmt->fetchAll();
            return $rows;
        }
        return null;
    
    }

    public static function fetchOneFromTable($tableName, $condition, $val){
        $pdo = DatabaseConnection::connect();
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM :tableName WHERE :condition LIKE :val;";
        $stmt = $pdo->prepare($sql);
        $status = $stmt->execute();
        if($status){
            $rows = $stmt->fetchAll();
            return $rows;
        } else {
            return null;
        }
    }

    public static function fetchUsernameColumn(){
        $pdo = DatabaseConnection::connect();
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $sql = "SELECT username FROM users";
        $stmt = $pdo->query($sql);
        $status = $stmt->execute();
        if($status){
            $rows = $stmt->fetchAll();
            return $rows;
        } else {
            return null;
        }
    }

    public static function fetchUernameAndPasswordColumns(){
        $pdo = DatabaseConnection::connect();
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $sql = "SELECT username, password FROM users";
        $stmt = $pdo->query($sql);
        $status = $stmt->execute();
        if($status){
            $rows = $stmt->fetchAll();
            return $rows;
        } else {
            return null;
        }
    }
}

class TableUpdate{

    public static function updateStatus($status, $username){
        $pdo = DatabaseConnection::connect();
        $sql = "UPDATE users SET status=:status WHERE username=:username";
        $stmt = $pdo->prepare($sql);
        $stmt = $stmt->execute([":status" => $status, ":username" => $username]);
        return $stmt;
    }
}
?>