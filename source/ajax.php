<?php
require '../connection/connection.php';

$dataItem = [];
$getItem = "SELECT * FROM item JOIN supplier ON item.supplier_id = supplier.supplier_id";
$getItem = mysqli_query($conn, $getItem);
while($rowItem = $getItem -> fetch_assoc()){
    $dataItem[] = $rowItem;
}
echo json_encode($dataItem);
mysqli_close($conn);
?>