<?php

require_once('db.php');

class CreateTable
{
    /**
     * Database connection
     *
     * @var object $conn 
     */
    protected $conn;

    /**
     * constructor to initialize database connection
     */
    public function __construct()
    {
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    /**
     * Create user table
     * 
     * @return void
     */
    public function createUserTable()
    {

        $sql = "CREATE TABLE users (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NOT NULL,
            img VARCHAR(255) DEFAULT NULL,
            address TEXT NOT NULL,
            created_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if (!$this->conn->query($sql) === TRUE) {
            die('User Table Create failed. Error: ' . $this->conn->error);
        }
    }

    /**
     * Check if user table exists
     * 
     * @return void
     */
    public function checkAndCreateTable()
    {
        $check = "SHOW TABLES LIKE 'users'";
        $result = $this->conn->query($check);

        if ($result->num_rows == 0) {
            $this->createUserTable();
        }
    }
}

?>