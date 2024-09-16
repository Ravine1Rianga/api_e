<?php
// Include the User class
require_once 'user.php';

// Create a new User object (update with your database credentials)
$user = new User('localhost', 'root', 'password', 'ics_e');

// Fetch the user details (for example, we are fetching the user with ID 1)
$userId = 1; // This could be dynamic, such as from a GET parameter.
$userDetails = $user->getUserById($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .user-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        .user-details h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-details p {
            font-size: 16px;
            margin: 10px 0;
        }
        .user-details span {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="user-details">
    <h2>User Information</h2>
    
    <?php if ($userDetails): ?>
        <p><span>Full Name:</span> <?= htmlspecialchars($userDetails['fullname']); ?></p>
        <p><span>Email:</span> <?= htmlspecialchars($userDetails['email']); ?></p>
        <p><span>Username:</span> <?= htmlspecialchars($userDetails['username']); ?></p>
        <p><span>Gender ID:</span> <?= htmlspecialchars($userDetails['genderId']); ?></p>
        <p><span>Role ID:</span> <?= htmlspecialchars($userDetails['roleId']); ?></p>
        <p><span>Account Created:</span> <?= htmlspecialchars($userDetails['created']); ?></p>
        <p><span>Last Updated:</span> <?= htmlspecialchars($userDetails['updated']); ?></p>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>

</body>
</html>
