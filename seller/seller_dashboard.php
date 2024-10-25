<?php
// Start session and include the seller header
include('seller_header.php');

// Get the seller's name from the session
$seller_name = $_SESSION['seller_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file -->
    <style>
        /* Basic styling for the dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .card a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- <header>
        <h1>Welcome, <?php echo htmlspecialchars($seller_name); ?>!</h1>
        <nav>
            <a href="add_product.php">Add Product</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header> -->

    <main>
        <h2>Seller Dashboard</h2>
        <div class="dashboard-container">
            <!-- Manage Products Card -->
            <div class="card">
                <h2>Manage Products</h2>
                <p>View and edit your existing products.</p>
                <a href="manage_products.php">Go to Manage Products</a>
            </div>

            <!-- Add Dairy Product Card -->
            <div class="card">
                <h2>Add Dairy Product</h2>
                <p>Add new dairy products to your inventory.</p>
                <a href="add_dairy_product.php">Go to Add Dairy Product</a>
            </div>

            <!-- Add Cattle Product Card -->
            <div class="card">
                <h2>Add Cattle Product</h2>
                <p>Add new cattle listings to your inventory.</p>
                <a href="add_cattle_product.php">Go to Add Cattle Product</a>
            </div>

            <!-- Sales Overview Card (Example) -->
            <div class="card">
                <h2>View Sales</h2>
                <p>Check your sales performance and analytics.</p>
                <a href="sales_overview.php">Go to Sales Overview</a>
            </div>
        </div>
    </main>

</body>
</html>
