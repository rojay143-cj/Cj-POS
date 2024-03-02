<?php 
    $getItem = "SELECT * FROM item";
    $getItem = mysqli_query($conn, $getItem);
    while($rowItem = $getItem -> fetch_assoc()){
        $itemData[] = $rowItem;
    }
?>