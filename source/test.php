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
<?php
    if(isset($_POST['customer_array'])){
        $customer_array = json_decode($_POST['customer_array'],true);

        foreach($customer_array as $details){
            $customer_name = $details['customer_name'];
            $tend_amount = $details['tend_amount'];
            $customer_mobile = $details['customer_mobile'];
            $pay_type = $details['pay_type'];
        }
        $insert_to_order = "INSERT INTO orders (customer_name, customer_phone, payment_type, amount_tendered) 
        VALUES ('$customer_name', '$customer_mobile', '$pay_type', '$tend_amount')";
        $result_order = mysqli_query($conn, $insert_to_order);
    }
?>