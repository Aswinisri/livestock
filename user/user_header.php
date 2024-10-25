<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html"); // Redirect to login if not logged in
    exit();
}

// Get the user's name from the session, or set a default value if not set
$user_name = isset($_SESSION['name']) ? $_SESSION['name'] : 'User'; // Default to 'User' if name is not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS file here -->
    <style>
        /* Styling for the header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            color: white;
        }
        
        h1 {
            font-size: 24px;
            margin: 0; /* Remove margin for a cleaner look */
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        <nav>
            <a href="home.php">Dashboard</a>
            <a href="view_products.php">View Products</a>
            <a href="order_history.php">Order History</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
</body>
</html>
