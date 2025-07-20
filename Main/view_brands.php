<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Brands</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        table { border-collapse: collapse; width: 80%; margin: auto; background: white; box-shadow: 0 0 10px #ccc; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007bff; color: white; }
        h2 { text-align: center; }
    </style>
</head>
<body>
<h2>Brand List</h2>
<table>
    <tr><th>Brand ID</th><th>Brand Name</th></tr>
    <?php
    $result = $conn->query("SELECT * FROM brands");
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['bid']}</td><td>{$row['bname']}</td></tr>";
    }
    ?>
</table>
</body>
</html>
