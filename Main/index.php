<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            background: #343a40;
            color: white;
            padding: 20px 0;
            margin: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 30px;
        }
        .card {
            background: white;
            width: 250px;
            margin: 15px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card a {
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-top: 10px;
            background: #007bff;
            color: white;
            border-radius: 5px;
        }
        .card a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h1>Inventory Management Dashboard</h1>

<div class="container">
    <div class="card">
        <h3>Brands</h3>
        <a href="add_brand.php">➕ Add Brand</a>
        <a href="view_brands.php">📋 View Brands</a>
    </div>
    <div class="card">
        <h3>Categories</h3>
        <a href="add_category.php">➕ Add Category</a>
        <a href="view_categories.php">📋 View Categories</a>
    </div>
    <div class="card">
        <h3>Users</h3>
        <a href="add_user.php">➕ Add User</a>
        <a href="view_users.php">📋 View Users</a>
    </div>
    <div class="card">
        <h3>Stores</h3>
        <a href="add_store.php">➕ Add Store</a>
        <a href="view_stores.php">📋 View Stores</a>
    </div>
    <div class="card">
        <h3>Products</h3>
        <a href="add_product.php">➕ Add Product</a>
        <a href="view_products.php">📋 View Products</a>
    </div>
    <div class="card">
        <h3>Customers</h3>
        <a href="add_customer.php">➕ Add Customer</a>
        <a href="view_customers.php">📋 View Customers</a>
    </div>
    <div class="card">
        <h3>Provides (Discounts)</h3>
        <a href="add_provides.php">➕ Add Provide Entry</a>
        <a href="view_provides.php">📋 View Provides</a>
    </div>
</div>

</body>
</html>
