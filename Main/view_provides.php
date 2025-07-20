<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Provides List</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        h2 { text-align: center; }
        table {
            margin: auto; width: 60%;
            border-collapse: collapse;
            box-shadow: 0 0 10px #ccc;
            background-color: white;
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
            text-align: center;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>

<h2>Provides List</h2>

<table>
    <tr>
        <th>Brand ID</th>
        <th>Store ID</th>
        <th>Discount</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM provides");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['bid']}</td>
            <td>{$row['sid']}</td>
            <td>{$row['discount']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
