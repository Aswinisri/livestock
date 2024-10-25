<?php
include('../db_connection.php');
include('seller_header.php');

// Check if the seller is logged in
if (!isset($_SESSION['seller_id'])) {
    echo "Error: You must be logged in as a seller to add a product.";
    exit;
}

// Fetch categories for Cattle
$sql = "SELECT * FROM categories WHERE product_type = 'Cattle'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Cattle Product</title>
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
        <h2>Add Cattle Product</h2>
        <form action="add_cattle_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_type" value="Cattle">
            <input type="hidden" name="seller_id" value="<?php echo $_SESSION['seller_id']; ?>"> <!-- Hidden field for seller ID -->
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" required>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['name']; ?>">
                            <?php echo $row['name']; ?>
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
                <label for="doctor_report">Doctor's Report (PDF):</label>
                <input type="file" name="doctor_report" id="doctor_report" accept=".pdf" required>
            </div>
            <div class="form-group">
                <label for="product_image">Upload Image:</label>
                <input type="file" name="product_image" id="product_image" accept="image/*" required>
            </div>
            <input type="submit" value="Add Cattle Product">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
