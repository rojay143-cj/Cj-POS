<?php 
    $getSup= "SELECT * FROM supplier";
    $getSup = mysqli_query($conn, $getSup);
    while($rowSup = $getSup -> fetch_assoc()){
        $supData[] = $rowSup;
    }
?>