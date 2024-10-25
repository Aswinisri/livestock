<?php
include('../db_connection.php');
include('seller_header.php');


// Fetch the seller ID from the session
// if (!isset($_SESSION['seller_id'])) {
//     echo "<script>alert('Error: You must be logged in as a seller to add a product.');</script>";
//     exit;
// }

$seller_id = $_SESSION['seller_id'];

// Fetch seller details from the sellers table
$seller_sql = "SELECT * FROM sellers WHERE seller_id = ?";
$stmt = $conn->prepare($seller_sql);
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$seller_result = $stmt->get_result();
$seller = $seller_result->fetch_assoc();

// Fetch categories for Dairy Products
$sql = "SELECT * FROM categories WHERE product_type = 'Dairy Product'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dairy Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 15px 0 5px;
        }
        input[type="text"], input[type="number"], input[type="submit"], select, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add Dairy Product</h2>
        
        <!-- Display Seller Information -->
        <!-- <div>
            <p><strong>Logged in as:</strong> <?php echo htmlspecialchars($seller['name']); ?></p>
            <p><strong>Seller ID:</strong> <?php echo htmlspecialchars($seller['seller_id']); ?></p>
        </div> -->
        
        <form action="add_dairy_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_type" value="Dairy Product">
            <input type="hidden" name="seller_id" value="<?php echo htmlspecialchars($seller_id); ?>"> <!-- Hidden field for seller_id -->
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" required>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['name']); ?>">
                            <?php echo htmlspecialchars($row['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" required>
            </div>
            <div class="form-group">
                <label for="product_image">Upload Image:</label>
                <input type="file" name="product_image" id="product_image" accept="image/*" required>
            </div>
            <input type="submit" value="Add Dairy Product">
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
