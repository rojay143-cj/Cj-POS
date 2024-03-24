<?php 
    require '../source/code.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
            <div class="canvas-wrapper">
                <canvas id="sales-chart" class="m-auto" style="max-width:1024px;"></canvas>
                <div class="dropdown text-center">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="../assets/image/calendar.jpg" style="width: 30px;height: 30px;margin: 10px;" alt="calendar">SELECT DATE
                    </button>
                    <ul class="dropdown-menu">
                        <form action="" method="post">
                            <span class="input-group-text">Monthly:<input type="month" class="p-2" onchange="this.form.submit()" name="monthly"></span>
                        </form>
                        <form action="" method="post">
                            <span class="input-group-text">
                                    Yearly: 
                                    <select onchange="this.form.submit()" name="yearly" id="yearly" class="w-100 h-25 text-center p-2 ms-3">
                                    <option value="">Select a year</option>
                                    <?php 
                                        for($i = -3; $i <= 37;$i++){
                                            $year = date("Y", strtotime("last day of +$i year"));
                                        
                                    ?>
                                    <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                    <?php } ?>
                                </select>
                            </span>
                        </form>
                        <div class="text-center mt-2">
                            <form action="" method="post" class="text-center">
                            <span class="">Custom</span>
                            <br>
                            <input type="text" class="text-center" placeholder="Start Date" id="startDate" name="startDate">
                            <input class="mt-2 text-center" type="text" placeholder="End Date" id="endDate" name="endDate">
                            <br>
                            <button class="mt-2 mb-2 range" type="submit" name="subRange">Submit</button>
                            </form>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer">footer</div>
    <script>
        
    </script>
</body>
</html>