<?php 
    require '../source/source.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster</title>
    <style>
        
    </style>
</head>
<body>
    <div class="stock-container">
        <div class="side-nav">
            <h1 style="text-align:center;background-color: #39A7FF;color: #FFEED9;margin: 10px;padding: 20px 0">STOCKMASTER</h1>
            <div class="wrapper">
                <div><a href="order.php">ORDER</a></div>
                <div><a href="item.php">ITEM</a></div>
                <div><a href="supplier.php">SUPPLIER</a></div>
            </div>
        </div>
        <div class="main">
            <h2 style="text-align: center;">List of Supplier</h2>
            <table id="example" class="display" style="max-width:100%;text-align:center">
                <thead>
                    <tr>
                        <th>Supplier name</th>
                        <th>Contact name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($supData as $rowSup){
                    ?>
                    <tr>
                        <td><?php echo $rowSup['supplier_name'] ?></td>
                        <td><?php echo $rowSup['contact_name'] ?></td>
                        <td><?php echo $rowSup['contact_email'] ?></td>
                        <td><?php echo $rowSup['contact_phone'] ?></td>
                        <td><?php echo $rowSup['address'] ?></td>
                        <td><button style="padding: 10px;cursor:pointer; width: 100px">Edit</button></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="addItem">
                <form action="" method="POST">
                <h2>Register New Supplier</h2>
                    <input type="text" name="txtSupname" placeholder="Suppier name">
                    <input type="text" name="txtSupcontactname" placeholder="Contact name">
                    <input type="text" name="txtSupemail" placeholder="Email">
                    <input type="text" name="txtSupphone" placeholder="Phone number">
                    <textarea name="txtSupaddress" placeholder="Supplier Address" style="width: 290px;height: 100px"></textarea>
                    <div class="div_register_sup"><button name="reg_sup">Register Supplier</button></div>
                </form>
            </div>
        </div>
        <div class="footer">footer</div>

    <script>
       $('#example').DataTable();
    </script>
</body>
</html>