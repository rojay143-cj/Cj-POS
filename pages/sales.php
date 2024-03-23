<?php 
    require '../source/code.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster</title>
    <style>
        
    </style>
</head>
<body>
    <div class="stock-container">
        <div class="side-nav">
            <h1 style="text-align:center;background-color: #39A7FF;color: #FFEED9;margin: 10px;padding: 20px 0">STOCKMASTER</h1>
            <div class="wrapper">
                <div><a href="index.php">HOME</a></div>
                <div><a href="orders.php">ORDERS</a></div>
                <div><a href="item.php">ITEM</a></div>
                <div><a href="supplier.php">SUPPLIER</a></div>
                <div><a href="sales.php">SALES</a></div>
            </div>
        </div>
        <div class="main">
            <h2 style="text-align: center;">Sales Report</h2>
        </div>
        <div class="footer">footer</div>

    <script>
       $('#example').DataTable();
    </script>
</body>
</html>