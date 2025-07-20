<?php
require 'db_connect.php';

// Initialize variables
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$user_id || !$name || !$password || !$user_type) {
        $errors[] = "All fields are required.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query
        $sql = "INSERT INTO inv_user (user_id, name, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $user_id, $name, $hashed_password, $user_type);
            if ($stmt->execute()) {
                $success = "User added successfully!";
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
    <title>Add User - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error { color: red; }
        .success { color: green; }
        .form-box { max-width: 500px; margin: 2rem auto; padding: 1.5rem; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="form-box bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Add User</h2>
        
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
                <label class="block text-sm font-medium">User ID:</label>
                <input type="text" name="user_id" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Name:</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">Password:</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium">User Type:</label>
                <input type="text" name="user_type" required class="w-full px-3 py-2 border rounded-md">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Add User</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>