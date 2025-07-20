<?php include 'db_connect.php'; ?>
<h2>Add Customer to Cart</h2>
<form method="post">
    ID: <input type="number" name="cust_id"><br>
    Name: <input type="text" name="name"><br>
    Mobile No: <input type="text" name="mobno"><br>
    <input type="submit" name="submit" value="Add Customer">
</form>

<?php
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO customer_cart VALUES ({$_POST['cust_id']}, '{$_POST['name']}', '{$_POST['mobno']}')";
    echo $conn->query($sql) ? "Customer added!" : "Error: " . $conn->error;
}
?>
