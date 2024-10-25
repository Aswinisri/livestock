<?php
include('../db_connection.php');
include('seller_header.php');

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fetch seller ID from the session
$seller_id = $_SESSION['seller_id'];

// Fetch products for the logged-in seller
$sql = "SELECT * FROM products WHERE seller_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <style>
        .manage-products-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            background-color: #28a745;
            border-radius: 5px;
            margin-right: 5px;
        }

        .actions a.delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="manage-products-container">
        <h1>Manage Your Products</h1>
        
        <!-- Display the products in a table -->
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Doctor Report</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are products to display
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($product['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['product_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['product_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['price']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['stock']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['doctor_report']) . "</td>";
                        
                        // Display the image
                        if ($product['product_image']) {
                            echo "<td><img src='" . htmlspecialchars($product['product_image']) . "' alt='Product Image' width='50'></td>";
                        } else {
                            echo "<td>No Image</td>";
                        }
                        
                        // Actions for Edit/Delete
                        echo "<td class='actions'>";
                        echo "<a href='edit_product.php?id=" . $product['id'] . "'>Edit</a>";
                        echo "<a href='delete_product.php?id=" . $product['id'] . "' class='delete' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>";
                        echo "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No products found. Add some products.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
