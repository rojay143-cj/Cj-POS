<?php 
    require '../connection/connection.php';
    echo '<script src="../api/datatables.js"></script>
    <script src="../JS/MasterJS.js"></script>
    <link rel="stylesheet" href="../api/datatables.css">
    <script src="../api/bootstrap.js"></script>
    <link rel="stylesheet" href="../api/bootstrap.css">
    <link rel="stylesheet" href="../CSS/style.css">
    ';
?>



<?php 
    /*  CODE FOR ITEM */
    $dataItem = [];
    $getItem = "SELECT * FROM item JOIN supplier ON item.supplier_id = supplier.supplier_id";
    $getItem = mysqli_query($conn, $getItem);
    while($rowItem = $getItem -> fetch_assoc()){
        $dataItem[] = $rowItem;
    }

    if(isset($_POST['add_item'])){
        $txtItemname = $_POST['txtItemname'];
        $txtItemprice = $_POST['txtItemprice'];
        $txtItemquantity = $_POST['txtItemquantity'];
        $reorder = 15;
        $supCat = $_POST['supCat'];
        $barcode = rand(1,999999999);
        $txtItemdes = $_POST['txtItemdes'];

        if(empty($txtItemname && $txtItemprice && $txtItemquantity && $supCat && $barcode)){
            echo "
                <script>
                    $(document).ready(function(){
                        alert('Failed To Add The Item (Fill-up the form)!');
                    })
                </script>
            ";
        }else{
            $sqlinsertItem = "INSERT INTO item (item_name, unit_price, quantity, reorder_point, barcode, description, supplier_id) 
            VALUES ('$txtItemname','$txtItemprice','$txtItemquantity', '$reorder','$barcode', '$txtItemdes','$supCat')";
            $sqlinsertItem = mysqli_query($conn, $sqlinsertItem);

            echo "
                <script>
                    $(document).ready(function(){
                        alert('Item added successfully');
                        window.location.href = 'item.php';
                    })
                </script>
            ";
        }
    }
?>

<?php
/* CODE FOR SUPPLIER */
    $supData = [];
    $getSup= "SELECT * FROM supplier";
    $getSup = mysqli_query($conn, $getSup);
    while($rowSup = $getSup -> fetch_assoc()){
        $supData[] = $rowSup;
    }

    if(isset($_POST['reg_sup'])){
        $txtSupname = $_POST['txtSupname'];
        $txtSupconname = $_POST['txtSupcontactname'];
        $txtSupemail = $_POST['txtSupemail'];
        $txtSupphone = $_POST['txtSupphone'];
        $txtAddress = $_POST['txtSupaddress'];
        if(!empty($txtSupname) && !empty($txtSupconname) && !empty($txtSupemail) && !empty($txtSupphone) && !empty($txtAddress)){
            $sqlInsertSup = "INSERT INTO supplier (supplier_name, contact_name, contact_email, contact_phone, address) 
            VALUES ('$txtSupname','$txtSupconname','$txtSupemail','$txtSupphone','$txtAddress')";
            $sqlInsertSup = mysqli_query($conn, $sqlInsertSup);
            echo "
                <script>
                    $(document).ready(function(){
                        alert('Successfully Registered');
                        window.location.href='supplier.php';
                    })
                </script>
            ";
        }else{
            echo "
            <script>
                $(document).ready(function(){
                    alert('Supplier Registration Unsuccesfull (Fill-up the form)');
                })
            </script>
        ";
        }
    }
?>
<?php
/* CODE FOR Add to Cart & Placing Orders */
if (isset($_POST['item_array'])) {
    $item_array = json_decode($_POST['item_array'], true);

    foreach ($item_array as $item) {
        $customer_name = $item['customer_name'];
        $customer_mobile = $item['customer_mobile'];
        $pay_type = $item['pay_type'];
        $tend_amount = $item['tend_amount'];
        $total_amount = $item['total_amount'];

        $stmt_order = mysqli_prepare($conn, "INSERT INTO orders (customer_name, customer_phone, payment_type, amount_tendered, total_amount) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt_order, "sssss", $customer_name, $customer_mobile, $pay_type, $tend_amount, $total_amount);
        mysqli_stmt_execute($stmt_order);
    }
}
?>

<?php
/* CODE FOR Add to Cart & Placing Orders */
if (isset($_POST['item_array'])) {
    $item_array = json_decode($_POST['item_array'], true);

    foreach ($item_array as $item) {
        $item_id = $item['item_id'];
        $item_quantity = $item['item_quantity'];
        $item_price = $item['item_price'];
        $subtotal = $item_quantity * $item_price;

        $sqlget_orderID = "SELECT * FROM orders";
        $result_orderID = mysqli_query($conn, $sqlget_orderID);
        while($rowOrders = $result_orderID -> fetch_array()){
            $currentId = $rowOrders['order_id'];
        }

        $stmt_orderDetails = mysqli_prepare($conn, "INSERT INTO order_details (item_id, item_quantity, item_price, item_subtotal, order_id) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt_orderDetails, "ssssi", $item_id, $item_quantity, $item_price, $subtotal, $currentId);
        mysqli_stmt_execute($stmt_orderDetails);
    }
}
?>

