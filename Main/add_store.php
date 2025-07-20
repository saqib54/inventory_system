<?php
require 'db_connect.php';

// Initialize variables
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $sid = filter_input(INPUT_POST, 'sid', FILTER_VALIDATE_INT);
    $sname = filter_input(INPUT_POST, 'sname', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING) ?: '';
    $mobno = filter_input(INPUT_POST, 'mobno', FILTER_SANITIZE_STRING) ?: '';

    // Validate required fields
    if (!$sid || !$sname) {
        $errors[] = "Store ID and Name are required.";
    } else {
        // Prepare SQL query
        $sql = "INSERT INTO stores (sid, sname, address, mobno) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("isss", $sid, $sname, $address, $mobno);
            if ($stmt->execute()) {
                $success = "Store added successfully!";
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
    <title>Add Store - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error { color: red; }
        .success { color: green; }
        .form-box { max-width: 500px; margin: 2rem auto; padding: 1.5rem; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="form-box bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Add Store</h2>
        
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
                <label class="block text-sm font-medium">Store ID:</label>
                <input type="number" name="sid" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Name:</label>
                <input type="text" name="sname" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Address (Optional):</label>
                <input type="text" name="address" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Mobile (Optional):</label>
                <input type="text" name="mobno" class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Add Store</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>