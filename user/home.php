<?php
// Include the database connection
include('../db_connection.php');
include('user_header.php');

// Query to fetch all categories from the database
$sql = "SELECT id, name, image, product_type FROM categories ORDER BY product_type";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Home Page</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <style>
        /* Basic styles for the category card layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .card h2 {
            font-size: 1.5em;
            color: #333;
            margin: 10px 0;
        }

        .card a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .card a:hover {
            background-color: #0056b3;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .product-type-title {
            width: 100%;
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; color: #333;">Our Categories</h1>
    <div class="container">

        <?php
        // Initialize variables to track current product type
        $current_type = '';
        
        // Check if any categories are returned from the database
        if ($result->num_rows > 0) {
            // Loop through each category and display it in a card
            while ($row = $result->fetch_assoc()) {
                // Check if we need to display the product type title
                if ($current_type !== $row['product_type']) {
                    $current_type = $row['product_type'];
                    echo '<h2 class="product-type-title">' . htmlspecialchars($current_type) . ' Products</h2>'; // Display product type title
                }

                echo '<div class="card">';
                echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="">'; // Adjust image path as necessary
                echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
                echo '<a href="product_details.php?category_id=' . urlencode($row['id']) . '">View Products</a>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align: center;'>No categories available at the moment.</p>";
        }

        $conn->close(); // Close database connection
        ?>

    </div>
</body>
</html>
