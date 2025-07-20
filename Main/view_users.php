<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        h2 { text-align: center; }
        table {
            margin: auto; width: 70%;
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

<h2>User List</h2>

<table>
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Password</th>
        <th>User Type</th>
        <th>Last Login</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM inv_user");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['user_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['password']}</td>
            <td>{$row['user_type']}</td>
            <td>{$row['last_login']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
