<?php 
    require '../source/code.php';
?>
<?php 
    $orderId = $_SESSION['orderID'];
    //unset($_SESSION['orderID']);
    $sqlreceipt = "SELECT *, orders.created_at,order_details.item_quantity
    FROM item
    JOIN order_details ON item.item_id = order_details.item_id
    JOIN orders ON order_details.order_id = orders.order_id WHERE orders.order_id = '$orderId'";
    $sqlreceipt = mysqli_query($conn, $sqlreceipt);
    while($receiptrow = $sqlreceipt ->fetch_assoc()){
        $receiptData[] = $receiptrow;
    }
?>
<?php
    foreach($receiptData as $receiptrow){
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciept</title>
    <style>
        .details{
            list-style: none;
            font-size: 0.7rem;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="text-center mb-5 lh-1 border w-50 m-auto mt-5">
                
                <h1 style="font-size: 1rem">The Summerhouse Cafe</h1>
                <div class="text-center wrapper">
                    <p style="font-size: 0.8rem;">2F Gloriana Bella Building South Poblacion, Valencia, Negros Oriental<br>Phone: +63 929 099 5773<br>+63 905 288 0939</p>
                </div>
                <div class="card">
                    <p>Item Name: <span id="itemName"></span></p>
                </div>
            </div>
        </div>
    </div>
    <?php foreach($dataItem as $item) { ?>
    <script>
        var data = <?php echo json_encode($item); ?>;
        console.log(data.item_name);
        $('#itemName').append('<li class="d-inline">' + data.item_name + '</li>');
    </script>
    <?php }?>
</body>
</html>