<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #000;
        }
        table {
            margin: auto;
            width: 60%;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px #ccc;
            background-color: white;
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 16px;
        }
        td {
            padding: 10px;
            text-align: center;
            font-size: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>

<h2>Category List</h2>

<table>
    <tr>
        <th>Category ID</th>
        <th>Category Name</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM categories");
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['cid'] . "</td>";
        echo "<td>" . $row['category_name'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
