<?php

class User {
    private $conn;

    // Constructor to establish a database connection
    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to get user details by ID
    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE userId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Destructor to close the database connection
    public function __destruct() {
        $this->conn->close();
    }
}

?>
