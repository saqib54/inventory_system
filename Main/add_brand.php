<?php
require 'db_connect.php';

// Initialize variables
$errors = [];
$success = '';

// Debug: Check if db_connect.php is included correctly
if (!isset($conn) || $conn->connect_error) {
    $errors[] = "Database connection failed: " . ($conn ? $conn->connect_error : "Connection not established");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $bid = filter_input(INPUT_POST, 'bid', FILTER_VALIDATE_INT);
    $bname = filter_input(INPUT_POST, 'bname', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$bid || !$bname) {
        $errors[] = "Brand ID and Name are required.";
    } else {
        // Prepare SQL query
        $sql = "INSERT INTO brands (bid, bname) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("is", $bid, $bname);
            if ($stmt->execute()) {
                $success = "Brand added successfully!";
            } else {
                $errors[] = "Database error: " . $conn->error;
            }
            $stmt->close();
        } else {
            $errors[] = "Failed to prepare the SQL statement: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Brand - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error { color: red; }
        .success { color: green; }
        .form-box { max-width: 500px; margin: 2rem auto; padding: 1.5rem; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="form-box bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Add Brand</h2>
        
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
                <label class="block text-sm font-medium">Brand ID:</label>
                <input type="number" name="bid" required class="w-full px-3 py-2 border rounded-md" min="1">
            </div>
            <div>
                <label class="block text-sm font-medium">Brand Name:</label>
                <input type="text" name="bname" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Add Brand</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>