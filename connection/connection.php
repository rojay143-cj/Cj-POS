<?php
    $dbName = "stockmaster";
    $server = "localhost";
    $username = "root";
    $password = "";
    $conn = "";
    try {
        $conn = mysqli_connect($server,$username,$password,$dbName);
        if(!$conn){
            echo "UNABLE TO CONNECT TO YOUR DATABASE!";
        }

    } catch (mysqli_sql_exception $e) {
        echo "ERROR: " . $e->getMessage();
    }
?>