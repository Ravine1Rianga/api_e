<?php
require_once 'includes/dbConnection.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new dbconnection('MySQLi', 'localhost', '', 'root', '', 'ics_e');
    }

    public function getGenders() {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare("SELECT genderId, gender FROM gender");
        $stmt->execute();
        $result = $stmt->get_result(); // Get the result set
        $genders = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        return $genders;
    }

    public function getRoles() {
        $conn = $this->db->getConnection();

        $stmt = $conn->prepare("SELECT roleId, role FROM roles");
        $stmt->execute();
        $result = $stmt->get_result(); // Get the result set
        $roles = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
        return $roles;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $genderId = $_POST['genderId'];
    $roleId = $_POST['roleId'];

    // Validate inputs 
    if (!empty($fullname) && !empty($email) && !empty($username) && !empty($password) && !empty($genderId) && !empty($roleId)) {
        
        // Initialize the database connection
        $db = new dbconnection('MySQLi', 'localhost', '', 'root', '', 'ics_e');
        $conn = $db->getConnection();

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password, genderId, roleId) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error)); // Debugging 
        }

        // Bind the parameters
        $stmt->bind_param('ssssii', $fullname, $email, $username, $password, $genderId, $roleId);

        // Execute the statement
        if ($stmt->execute()) {
            // Success message, user added
            echo "Sign-up successful!";
        } else {
            // Display any error
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill out all fields.";
    }
} else {
    echo "Invalid request method.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up Form</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

    <form class="signup-form" action="signup_process.php" method="POST">
        <h2>Sign Up</h2>
<div class="mb-3">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required maxlength="50" placeholder="Enter full name">
</div>
<div class="mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required maxlength="50" placeholder="Enter email">
        </div>
        <div class="mb-3"> 
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required maxlength="50" placeholder="Enter username">
        </div>
        <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required maxlength="60" placeholder="Enter password">
        </div>
        <div class="mb-3">
        <label for="genderId">Gender</label>
        <select id="genderId" name="genderId" required>
            <option value="0">Select Gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="3">Other</option>
        </select>
        </div>
        <div class="mb-3">
        <label for="roleId">Role</label>
        <select id="roleId" name="roleId" required>
            <option value="1">Teacher</option>
            <option value="2">Admin</option>
            <option value="3">Student</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary"> Sign Up</button>
    </form>

</body>
</html>
