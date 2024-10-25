<?php
// Start the session
session_start();

// Check if the seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: ../login.html"); // Redirect to login if not logged in
    exit();
}

// Get the seller's name from the session
$seller_name = $_SESSION['seller_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
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
        <h1>Welcome, <?php echo htmlspecialchars($seller_name); ?>!</h1>
        <nav>
            <a href="seller_dashboard.php">Dashboard</a>
            <a href="add_dairy_product.php">Add Dairy Product</a>
            <a href="add_cattle_product.php">Add Cattle</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
</body>
</html>
