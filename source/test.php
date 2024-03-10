<?php
require '../connection/connection.php';

if (isset($_POST['item_array'])) {
    $item_array = json_decode($_POST['item_array'], true);

    foreach ($item_array as $item) {
        $item_id = $item['item_id'];
        $item_quantity = $item['item_quantity'];
        $item_price = $item['item_price'];

        $insert_to_orderdetails = "INSERT INTO order_details (item_id, item_quantity, item_price) VALUES ('$item_id', '$item_quantity', '$item_price')";
        $result = mysqli_query($conn, $insert_to_orderdetails);
    }
} else {
    echo "No 'item_array' received.";
}
?>
