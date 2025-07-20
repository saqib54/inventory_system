<?php
require 'db_connect.php';

// Initialize variables
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $pid = filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT);
    $cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT);
    $bid = filter_input(INPUT_POST, 'bid', FILTER_VALIDATE_INT);
    $sid = filter_input(INPUT_POST, 'sid', FILTER_VALIDATE_INT) ?: null;
    $pname = filter_input(INPUT_POST, 'pname', FILTER_SANITIZE_STRING);
    $p_stock = filter_input(INPUT_POST, 'p_stock', FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate required fields
    if (!$pid || !$cid || !$bid || !$pname || !$p_stock || !$price) {
        $errors[] = "All required fields must be filled with valid data.";
    } else {
        // Prepare SQL query
        $sql = "INSERT INTO product (pid, cid, bid, sid, pname, p_stock, price, added_date) VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE())";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iiisssd", $pid, $cid, $bid, $sid, $pname, $p_stock, $price);
            if ($stmt->execute()) {
                $success = "Product added successfully!";
            } else {
                $errors[] = "Database error: " . $conn->error;
            }
            $stmt->close();
        } else {
            $errors[] = "Failed to prepare the SQL statement.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error { color: red; }
        .success { color: green; }
        .form-box { max-width: 500px; margin: 2rem auto; padding: 1.5rem; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="form-box bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Add Product</h2>
        
        <?php if ($success): ?>
            <p class="success text-center"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <?php if ($errors): ?>
            <ul class="error mb-4">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post" class="space-y-4">
            <div>
                <label class="block text-sm font-medium">Product ID:</label>
                <input type="number" name="pid" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Category ID:</label>
                <input type="number" name="cid" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Brand ID:</label>
                <input type="number" name="bid" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Store ID (Optional):</label>
                <input type="number" name="sid" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Product Name:</label>
                <input type="text" name="pname" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Stock:</label>
                <input type="number" name="p_stock" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Price:</label>
                <input type="text" name="price" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Add Product</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>