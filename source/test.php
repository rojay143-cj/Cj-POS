<?php
require '../connection/connection.php';

if (isset($_POST['item_array'])) {
    $item_array = json_decode($_POST['item_array'], true);
    foreach ($item_array as $items) {
        $item_id = mysqli_real_escape_string($conn, $items['item_id']);
        $item_price = mysqli_real_escape_string($conn, $items['item_price']);
        $item_quantity = mysqli_real_escape_string($conn, $items['item_quantity']);

        $sqlinsertItem = "INSERT INTO order_details (item_id, item_quantity, item_price) 
                          VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sqlinsertItem);

        if ($stmt === false) {
            die("Error preparing statement: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "sss", $item_id, $item_quantity, $item_price);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            echo "Error inserting item: " . mysqli_error($conn);
        } else {
            echo "Item placed successfully!";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "No 'item_array' received.";
}
?>
