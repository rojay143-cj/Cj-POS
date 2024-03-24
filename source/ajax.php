<?php
require '../connection/connection.php';
    $today = date("Y-m-d");
    $startDate = date("Y-m-d", strtotime("monday this week", strtotime($today)));
    $endDate = date("Y-m-d", strtotime("sunday this week", strtotime($today)));
    $sqlgetSales = "SELECT DAYNAME(orders.created_at) AS day_name, SUM(order_details.item_quantity) AS total_sales 
                    FROM order_details 
                    JOIN orders ON order_details.order_id = orders.order_id
                    WHERE orders.created_at >= '$startDate' AND orders.created_at < '$endDate'
                    GROUP BY DAYNAME(orders.created_at)
                    ORDER BY FIELD(DAYNAME(orders.created_at), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
    $result = mysqli_query($conn, $sqlgetSales);

    $salesData = array();
    $xValues = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

    while($row = mysqli_fetch_assoc($result)){
        $salesData[$row['day_name']] = $row['total_sales'];
    }

    $yValues = array();
    foreach($xValues as $day){
        if(isset($salesData[$day])){
            $yValues[] = $salesData[$day];
        } else {
            $yValues[] = 0;
        }
    }
    $data = [
        'xValues' => $xValues,
        'yValues' => $yValues
    ];
    echo json_encode($data);
?>