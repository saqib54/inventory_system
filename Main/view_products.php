<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        h2 { text-align: center; }
        table {
            margin: auto; width: 90%;
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

<h2>Product List</h2>

<table>
    <tr>
        <th>Product ID</th>
        <th>Category ID</th>
        <th>Brand ID</th>
        <th>Store ID</th>
        <th>Name</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Added Date</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM product");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['pid']}</td>
            <td>{$row['cid']}</td>
            <td>{$row['bid']}</td>
            <td>{$row['sid']}</td>
            <td>{$row['pname']}</td>
            <td>{$row['p_stock']}</td>
            <td>{$row['price']}</td>
            <td>{$row['added_date']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
