<?php 
    require '../source/code.php';
?>

<?php
    /* Orders.php Region */
    if(!isset($orderData)){
        $orderData =[];
    }
    $sqlgetOrder = "SELECT *, orders.created_at,order_details.item_quantity
    FROM item
    JOIN order_details ON item.item_id = order_details.item_id
    JOIN orders ON order_details.order_id = orders.order_id GROUP BY orders.order_id";
    $orderResult = mysqli_query($conn, $sqlgetOrder);
        while($rowOrder = $orderResult -> fetch_assoc()){
            $orderData[] = $rowOrder;
            $_SESSION['discount'] = $rowOrder['discount'];
            $_SESSION['vat'] = $rowOrder['vat'];
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
            </div>
        </div>
        <div class="main">
            <div class="card-body mt-5">
            <h1 class="text-center">★Transactions</h1>
            <table class="table table-striped table-borderless mt-5">
                <thead>
                    <tr>
                        <th><h5 class="text-secondary">ORDER NUMBER</th>
                        <th><h5 class="text-secondary">CUSTOMER NAME</th>
                        <th><h5 class="text-secondary">PAYMENT TYPE</th>
                        <th><h5 class="text-secondary">ORDERED ON</th>
                        <th><h5 class="text-secondary">ORDER STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $orderData = array_reverse($orderData); foreach ($orderData as $rowOrder) { ?>
                        <tr style="font-size: 16px; font-family:verdana;" class="border rounded trans" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $rowOrder['order_id']; ?>" data-order-id="<?php echo $rowOrder['order_id']; ?>">
                            <td class="text-primary"><?php echo $rowOrder['order_id']; ?></td>
                            <td><?php echo $rowOrder['customer_name']; ?></td>
                            <td><?php echo $rowOrder['payment_type']; ?></td>
                            <td><?php echo $rowOrder['created_at']; ?></td>
                            <td><form action="orders.php?orderId=<?php echo $rowOrder['order_id']; ?>" method="post">
                                    <select name="status" class="p-1" onchange="this.form.submit()">
                                        <option value=""><?php echo $rowOrder['order_stat']; ?></option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </form>
                                <?php
                                    if(isset($_POST['status'])){
                                        $orderId = $_GET['orderId'];
                                        $status = $_POST['status'];
                                        $sqlStatus = "UPDATE orders SET order_stat = '$status' WHERE order_id = '$orderId'";
                                        $sqlStatus = mysqli_query($conn, $sqlStatus);
                                        echo'
                                            <script>
                                                window.location.href="orders.php";
                                            </script>
                                        ';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="collapse border" id="collapse_<?php echo $rowOrder['order_id']; ?>">
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <?php
                                        $orderId = $rowOrder['order_id'];
                                            $sqlreadAll = "SELECT *, orders.created_at, order_details.item_quantity
                                                FROM item
                                                JOIN order_details ON item.item_id = order_details.item_id
                                                JOIN orders ON order_details.order_id = orders.order_id
                                                WHERE order_details.order_id = '$orderId'";
                                            $sqlreadAll = mysqli_query($conn, $sqlreadAll);
                                            while ($rowread = $sqlreadAll->fetch_assoc()) {
                                                //$readalldata[] = $rowread;
                                                ?>
                                                <div class="card shadow m-2" style="width: 16rem;">
                                                    <img src="<?php echo $rowread['image']; ?>" class="img-thumbnail rounded object-fit-cover" style="height: 100px;width: 100px">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-start"><?php echo $rowread['item_name']; ?></h5>
                                                        <div class="d-inline">
                                                        <ul class="list-group list-group-horizontal">
                                                            <li class="list-group-item w-100"><?php echo $rowread['item_quantity']; ?><span style="font-size: 10px">QTY</span></li>
                                                            <li class="list-group-item text-end text-primary text-nowrap">Php <span><?php echo $rowread['item_subtotal']; ?>.00</span></li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php $readalldata[] = $rowread;} ?>
                                    </div>
                                    <?php foreach($readalldata as $rowread) {} ?>
                                    <div class="d-inline">
                                        <h2 class="mx-2">Total amount</h2>
                                        <ul class="list-group list-group-horizontal mx-2">
                                            <li class="list-group-item text-primary text-nowrap w-100 mb-3"><h5>Php <?php echo $rowread['total_amount']; ?>.00</h5></li>
                                            <li class="list-group-item text-start text-wrap mb-3 w-75"><div><?php echo $rowread['notes']; ?></div></li>
                                            <li class="list-group-item text-end text-nowrap text-white mb-3">
                                                <form action="receipt.php" method="post" target="_blank">
                                                    <button type="submit" class="btn btn-info text-white">View receipt</button>
                                                    <?php 
                                                        $_SESSION['orderID'] = $rowOrder['order_id'];
                                                    ?>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="footer">footer</div>
    </div>

    <script>
       $('#example').DataTable();

    </script>
</body>
</html>