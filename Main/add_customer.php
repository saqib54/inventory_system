<?php
require 'db_connect.php';

// Initialize variables
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $cust_id = filter_input(INPUT_POST, 'cust_id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $mobno = filter_input(INPUT_POST, 'mobno', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$cust_id || !$name || !$mobno) {
        $errors[] = "All fields are required.";
    } else {
        // Prepare SQL query
        $sql = "INSERT INTO customer_cart (cust_id, name, mobno) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iss", $cust_id, $name, $mobno);
            if ($stmt->execute()) {
                $success = "Customer added successfully!";
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
    <title>Add Customer - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error { color: red; }
        .success { color: green; }
        .form-box { max-width: 500px; margin: 2rem auto; padding: 1.5rem; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="form-box bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Add Customer</h2>
        
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
                <label class="block text-sm font-medium">Customer ID:</label>
                <input type="number" name="cust_id" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Name:</label>
                <input type="text" name="name" required class="w-full px-2 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Mobile No:</label>
                <input type="text" name="mobno" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Add Customer</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>