<?php 
    require '../source/code.php';
?>
<?php
    //YEARLY
    if(isset($_POST['yearly'])){
        $yearly = $_POST['yearly'];
            $first = new DateTime($yearly.'-01-01');
            $last = new DateTime($yearly.'-12-31');

            $firstyear = $first->format('y-m-d');
            $lastyear = $last->format('y-m-d');
            $sqlReports = "SELECT *,SUM(CASE WHEN payment_type = 'cash' THEN total_amount ELSE 0 END) as cash,
                SUM(CASE WHEN payment_type = 'gcash' THEN total_amount ELSE 0 END) as gcash,
                SUM(CASE WHEN payment_type = 'bank' THEN total_amount ELSE 0 END) as bank,
                SUM(total_amount) as totalsales
                FROM orders WHERE CAST(created_at as DATE) BETWEEN '$firstyear' AND '$lastyear'";
                $sqlReports = mysqli_query($conn, $sqlReports);
                while ($rowReport = $sqlReports -> fetch_array()) {
                $reportData[] = $rowReport;
                }
            $sqltotalOrder = "SELECT item.item_name, sum(item_quantity) as totalorders,count(*) as totalsold FROM item INNER JOIN (SELECT item_id, count(*) as orders 
            FROM order_details GROUP BY item_id ORDER BY orders DESC LIMIT 1) as bestseller ON item.item_id = bestseller.item_id
            JOIN order_details
            JOIN orders ON order_details.order_id = orders.order_id WHERE CAST(created_at as DATE) BETWEEN '$firstyear' AND '$lastyear'";
            $sqltotalOrder = mysqli_query($conn, $sqltotalOrder);
            while($totOrder = $sqltotalOrder -> fetch_array()) {
            $totOrderData[] = $totOrder;
        }
            $sqlmodorder = "SELECT *, orders.order_id, sum(item_quantity) as quantity FROM orders
                    INNER JOIN order_details ON orders.order_id = order_details.order_id WHERE CAST(orders.created_at as DATE) BETWEEN '$firstyear' AND '$lastyear' GROUP BY orders.order_id";
                    $sqlmodorder = mysqli_query($conn, $sqlmodorder);
                    while ($rowmodorder = mysqli_fetch_array($sqlmodorder)){
                        $modData[] = $rowmodorder;
            }
            $sqlbestseller = "SELECT item.item_id, item.item_name, SUM(order_details.item_quantity) AS productsales
                              FROM order_details
                              JOIN orders ON order_details.order_id = orders.order_id
                              JOIN item ON order_details.item_id = item.item_id
                              WHERE DATE(orders.created_at) BETWEEN '$firstyear' AND '$lastyear'
                              GROUP BY item.item_id
                              ORDER BY productsales DESC
                              LIMIT 3";
            
            $result = mysqli_query($conn, $sqlbestseller);
            
            while ($rowbestseller = mysqli_fetch_array($result)) {
                $bestData[] = $rowbestseller;

            }
            if($_SESSION['msgWarning'] == "Please pick a date to view the sales reports"){
                $_SESSION['msgWarning'] = "Sales for the year: ".date('Y', strtotime($lastyear));
            }
    }
?>
<?php
    //Set undefined values in SELECTION DATES
    if(isset($_POST["monthly"]) || isset($_POST["yearly"]) || isset($_POST["subRange"])){
        foreach ($totOrderData as $totOrder) {}
        foreach ($reportData as $rowReport) {}
    }else{
        $reportData = [];
        $totOrderData = [];
        $rowbestseller = [];
        $rowmodorder = [];
        $bestData = [];
        $modData = [];
        $totOrder = [];
        $rowReport = [];
        $rowReport['cash'] =0;
        $rowReport['gcash'] =0;
        $rowReport['bank'] =0;
        $rowReport['totalsales'] =0;
        $totOrder['totalorders']=0;
        $totOrder['totalsold']=0;
        $totOrder['product_name']="";
    }
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
            <div class="container mt-5 reports-container" style="height: 850px">
            <h4 class="mt-3 display-6">★Overview Dashboard</h4>
            <div class="input-group">
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="../images/calendar.jpg" style="width: 30px;height: 30px;margin: 10px;" alt="calendar">SELECT DATE
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
                        <!--<div id="datePicker" class="d-none" name="datePicker"></div>-->
                    </ul>
                </div>
            </div>
            <div class="row mt-2">
                <div class="previous-wrap">
                <div class="text-secondary text-center p-1 mt-2 mb-2">
                    <h5 class="bg-warning text-muted"><?php echo $_SESSION['msgWarning']; ?></h5>
                </div>
                <div class="shadow bg-body rounded prev w-100 text-center">
                    <div class="row">
                        <div class="m-2 p-2 totSales col text-nowrap">
                            <h5 class="display-6">Total sales</h5>
                            <h4 class="text-muted">Php <?php echo number_format($rowReport['totalsales']); ?>.00</h4>
                        </div>
                        <div class="totSales">
                            <a data-bs-toggle="modal" href="#exampleModalToggle"><span class="btn btn-danger">View Report</span></a>
                        </div>
                    </div>
                    <hr>
                    <div class="row col text-center">
                        <h5>Cash sales</h5>
                        <h5 class="text-muted">Php <?php echo number_format($rowReport['cash']); ?>.00</h5>
                    </div>
                    <div class="row col text-center">
                        <h5>Gcash sales</h5>
                        <h5 class="text-muted">Php <?php echo number_format($rowReport['gcash']); ?>.00</h5>
                    </div>
                    <div class="row col text-center">
                        <h5>Online Bank sales</h5>
                        <h5 class="text-muted">Php <?php echo number_format($rowReport['bank']); ?>.00</h5>
                    </div>
                    <hr>
                    <div class="row col text-center">
                        <h5>Total orders</h5>
                        <h5><?php echo $totOrder['totalorders']; ?></h5>
                    </div>
                    <div class="row col text-center">
                        <h5>Total products sold</h5>
                        <h5><?php echo $totOrder['totalsold']; ?></h5>
                    </div>
                    <div class="row col text-center">
                        <h5>Best Seller</h5>
                        <h5>✧<?php echo $totOrder['item_name']; ?></h5>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- MODAL region -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title p-3 text-center w-100" id="exampleModalToggleLabel">★Daily Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reports">
                    <div class="container">
                        <div class="row">
                        <h5 class="bg-warning text-muted text-center"><?php echo $_SESSION['msgWarning']; ?></h5>
                        <div>
                        <table class="shadow p-3 mb-5 bg-body rounded table table-striped table-hover">
                                <thead class="">
                                    <th>| Order ID |</th>
                                    <th>| Quantity |</th>
                                    <th>| Order Total |</th>
                                    <th>| Payment Method |</th>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($modData as $rowmodorder){
                                            
                                    ?>
                                    <tr>
                                        <td>#<?php echo $rowmodorder['order_id']; ?></td>
                                        <td><?php echo $rowmodorder['quantity']; ?></td>
                                        <td>Php <?php echo $rowmodorder['total_amount']; ?></td>
                                        <td><?php echo $rowmodorder['payment_type']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="d-flex text-center shadow p-3 mb-5 bg-body rounded w-100">
                                <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-50">
                                    <h5 class="bg-secondary text-white">Total Orders</h5>
                                    <h5><?php echo $totOrder['totalorders']; ?></h5>
                                </div>
                                <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-50">
                                    <h5 class="bg-secondary text-white">Total Products Sold</h5>
                                    <h5><?php echo $totOrder['totalsold']; ?></h5>
                                </div>
                                <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-50">
                                    <h5 class="bg-secondary text-white">Total Amount</h5>
                                    <h5>Php <?php echo number_format($rowReport['totalsales']); ?>.00</h5>
                                    <h6>Discount: Php <?php echo $_SESSION['discount']; ?>.00</h6>
                                    <h6>VAT: Php <?php echo $_SESSION['vat']; ?>.00</h6>
                                </div>
                            </div>
                        </div>
                            <div class="shadow p-3 bg-body rounded text-center">
                                <div class="text-center ps-5 px-5">
                                    <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-100">
                                        <h5 class="bg-secondary text-white">Total Cash Sales</h5>
                                        <h5>Php <?php echo number_format($rowReport['cash']); ?>.00</h5>
                                    </div>
                                    <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-100">
                                    <h5 class="bg-secondary text-white">Total GCash Sales</h5>
                                        <h5>Php <?php echo number_format($rowReport['gcash']); ?>.00</h5>
                                    </div>
                                    <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-100">
                                        <h5 class="bg-secondary text-white">Total Online Bank Sales</h5>
                                        <h5>Php <?php echo number_format($rowReport['bank']); ?>.00</h5>
                                    </div>
                                    <div class="d-block text-center shadow p-3 mb-5 bg-body rounded w-100">
                                        <h5 class="bg-secondary text-white">Top Best Sellers</h5>
                                        <?php
                                            foreach($bestData as $rowbestseller){
                                        ?>
                                        <ul class="">
                                            <li class="list-group-item">✧<?php echo $rowbestseller['item_name'] ?></li>
                                        </ul>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button aria-label="Print" id="btn-print" class="btn btn-info p-2 text-white">Print Reports</button>
                    <button data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary p-2 text-white">Close</button>
                </div>
                </div>
            </div>
        </div>
        </div>
        <div class="footer">footer</div>
    <script>
        
    </script>
</body>
</html>