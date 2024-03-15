<?php 
    require '../source/code.php';
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
            <h2 style="text-align: center;">List of Item</h2>
            <table id="example" class="display" style="max-width:100%;text-align:center">
                <thead>
                    <tr>
                        <th width="100">item id</th>
                        <th>item name</th>
                        <th>unit price</th>
                        <th>quantity</th>
                        <th>barcode</th>
                        <th>supplier</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($dataItem as $rowItem){
                    ?>
                    <tr>
                        <td><img src="<?php echo $rowItem['image'] ?>" class="img-thumbnail" style="width: 50px; height: 45px">#<?php echo $rowItem['item_id'] ?></td>
                        <td><?php echo $rowItem['item_name'] ?></td>
                        <td><?php echo $rowItem['unit_price'] ?></td>
                        <td><?php echo $rowItem['quantity'] ?></td>
                        <td><?php echo $rowItem['barcode'] ?></td>
                        <td><?php echo $rowItem['supplier_name'] ?></td>
                        <td><button style="padding: 10px;cursor:pointer; width: 100px">Edit</button></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="addItem">
                <form action="" method="POST">
                <h2>Add New Item</h2>
                    <input type="text" name="txtItemname" placeholder="Item name">
                    <input type="text" name="txtItemprice" placeholder="Unit Price">
                    <input type="text" name="txtItemquantity" placeholder="Quantity">
                    <select name="supCat" id="supCat">
                        <option value="">Select Supplier</option>
                        <?php 
                            foreach($supData as $rowSup){
                        ?>
                        <option value="<?php echo $rowSup['supplier_id'] ?>"><?php echo $rowSup['supplier_name'] ?></option>
                        <?php } ?>
                    </select>
                    <textarea name="txtItemdes" placeholder="Add Item Description(Optional)" style="width: 290px;height: 100px"></textarea>
                    <div class="div_register_sup"><button name="add_item" id="add_item">Register Supplier</button></div>
                </form>
            </div>
        </div>
        <div class="footer">footer</div>
    </div>

    <script>
       $('#example').DataTable();
    </script>
</body>
</html>