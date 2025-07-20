<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
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

<h2>Customer List</h2>

<table>
    <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Mobile No</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM customer_cart");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['cust_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['mobno']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
