<?php session_start();
    ?>
<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Admin Dashboard</title>


    
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .w3-sidebar {
            height: 100%;
            width: 70px;
            background-color: #111;
            position: fixed;
            overflow-x: hidden;
            padding-top: 20px;
            transition: width 0.3s;
            z-index: 1;
        }

        .w3-sidebar:hover {
            width: 200px;
        }

        .w3-sidebar a {
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            padding: 30px;
            text-align: center;
        }

        .w3-sidebar a:hover {
            color: #f1f1f1;
        }

        .main--content {
            position: relative;
            background: #fff;
            width: calc(100% - 70px);
            padding: 1rem;
            margin-left: 70px;
            transition: margin-left 0.3s;
            color: #333;
        }

        .w3-sidebar:hover + .main--content {
            margin-left: 200px;
        }

        .header--wrapper img {
            width: 50px;
            height: 50px;
            cursor: pointer;
            border-radius: 50%;
        }

        .header--wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            background: #343a40;
            border-radius: 10px;
            padding: 10px 2rem;
            margin-bottom: 1rem;
            margin-left: 20px;
        }

        .header--title {
            color: #fff;
        }

        .user--info {
            display: flex;
            align-items: center;
            gap: 1;
        }

        .search--box {
            background: #dee2e6;
            border-radius: 15px;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 12px;
        }

        .search--box input {
            background: transparent;
            padding: 10px;
            border: none;
        }

        .search--box i {
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.5s ease-out;
        }

        .search--box i:hover {
            transform: scale(1.2);
        }

        .card-container {
            background: #fff;
            width: calc(100% - 2rem);
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 10px;
            color: #343a40;
            margin-left: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .main--title {
            color: #343a40;
            padding-bottom: 10px;
        }

        .card--wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .data--card {
            flex: 1;
            border-radius: 10px;
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.6s ease-in-out;
        }

        .data--card:hover {
            transform: scale(1.10);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .card--header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .amount {
            display: flex;
            flex-direction: column;
        }

        .title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .amount-value {
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }

        .icon {
            font-size: 3rem;
        }

        .card-detail {
            font-size: 0.8rem;
        }

        .sales {
            background: linear-gradient(to right, #45a049, #8cc84b);
        }

        .online-payment {
            background: linear-gradient(to right, #36b9cc, #66b3a6);
        }

        .expenses {
            background: linear-gradient(to right, #e74c3c, #e66767);
        }

        .new-customers {
            background: linear-gradient(to right, #f39c12, #f5d76e);
        }

        .icon {
            font-size: 3rem;
        }

        .stock-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .stock-table th,
        .stock-table td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
            background-color: #3498db;
            color: #fff;
        }

        .stock-table th {
            position: sticky;
            top: 0;
            z-index: 2;
            background-color: #3498db;
        }

        .stock-table td {
            background-color: #fff;
            color: #343a40;
            transition: background-color 0.3s ease-in-out;
        }

        .stock-table tbody tr:hover td {
            background-color: #f2f2f2;
        }

        .edit-button
         {
                        
            color: #000;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 10px 10px;
            margin-right: 5px;
            transition: transform 0.3s ease-in-out;
            margin-bottom: 10px;
        }

        .delete-button {
            border: none;
            color: #000;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 10px 10px;
            margin-right: 5px;
            transition: transform 0.3s ease-in-out;

            
        }

        .edit-button:hover{
            background-color: #FFED00;
            border: none;
            transform: scale('1.2');
        }
        .delete-button:hover {
            background-color: #FE0000;
            border: none;
            transform: scale('1.1');
        }

        #profileimg{
            margin-left: 6px;
        }
    </style>




</head>

<body>

<div class="w3-sidebar">
    <a href="adminpage.php" class="w3-bar-item w3-button" title="Home"><i class="fa fa-home"></i></a>
    
    <a href="collection.php" class="w3-bar-item w3-button" title="Store"><i class="fas fa-store"></i></a>
   
    <?php

 
    if (isset($_SESSION['user_id'])) {
        echo '<a class="nav-link" title="Add Item" href="add_item.php"><i class="fas fa-plus"></i></a>';
    }

    if (isset($_SESSION['user_id'])) {
        echo '<a class="nav-link" title="Log out" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>';
    }
    ?>

</div>


<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <span>Primary</span>
            <h2>dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                <i class="fa-solid fa-search"></i>
                <input id="myInput" type="text" placeholder="Search">
            </div>
           
        </div>
    </div>

    <div class="card-container">
        <h2 class="main--title">Today's data</h2>
        <div class="card--wrapper">
            <div class="data--card sales">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Sales</span><span class="amount-value">$40 000.00</span>
                    </div> <i class="fas-dollar-sign icon"></i>
                    <span class="card-detail">Last 24 hours</span>
                </div>
            </div>
            <div class="data--card online-payment">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Online Payment</span><span class="amount-value">$2900.00</span>
                    </div> <i class="fas-dollar-sign icon"></i>
                    <span class="card-detail">Last 24 hours</span>
                </div>
            </div>
            <div class="data--card expenses">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Expenses</span><span class="amount-value">$5000.00</span>
                    </div> <i class="fas-dollar-sign icon"></i>
                    <span class="card-detail">Last 24 hours</span>
                </div>
            </div>
            <div class="data--card new-customers">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">New Customers</span><span class="amount-value">90</span>
                    </div> <i class="fas-dollar-sign icon"></i>
                    <span class="card-detail">Last 24 hours</span>
                </div>
            </div>
        </div> <hr> 


        <div class="stock-table-container">
            <h2 class="main--title">Update Stocks</h2>
            <div class="table-responsive">
                <table class="stock-table table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Material</th>
                        <th>Product Information</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody id="myItemtable">
            <?php


$mysqli = connectDatabase();

$selectQuery = "SELECT * FROM posts ORDER BY item_id DESC"; 
$result = $mysqli->query($selectQuery);
?>


<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['item_name'] . "</td>";
        echo "<td>$" . $row['price'] . "</td>";
        echo "<td>" . $row['material'] . "</td>";
        echo "<td>" . (isset($row['product_information']) ? htmlspecialchars($row['product_information']) : "") . "</td>";
        echo "<td>";
        echo "<button class='edit-button' onclick='editItem(" . $row['item_id'] . ")'>Edit</button>";     
        echo "<button class='delete-button' onclick='confirmDelete(" . $row['item_id'] . ")'>Remove</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No items found</td></tr>";
}

$mysqli->close();
?>

<script>
    function confirmDelete(itemId) {
        var confirmDelete = confirm("Are you sure you want to delete this item?");
        if (confirmDelete) {
            
            window.location.href = "delete_item.php?id=" + itemId;
        }
    }

    function editItem(itemId) {
        
        window.location.href = "edit_item.php?id=" + itemId;
    }
</script>

<script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myItemtable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            });
    </script>
</body>

