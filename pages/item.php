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
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .side-nav{ grid-area: side-nav;}
        .main{ grid-area: main;}
        .footer{ grid-area: footer;}
        .stock-container{
            display: grid;
            grid-template-areas: 
            '. . . . . . . . .'
            'side-nav main main main main main main main main'
            'footer footer footer footer footer footer footer footer footer';
        }
        .side-nav{
            height: 100vh;
            width: auto;
            background-color: #87C4FF;
        }.wrapper a{
            display: block;
            padding: 10px;
            background-color: #E0F4FF;
            color: #39A7FF;
            margin: 10px;
            text-align: center;
            text-decoration: none;
            font-weight: lighter;
        }.wrapper a:hover{
            background-color: #FFEED9;
            box-shadow: 1px 1px 1px 1px #E0F4FF;
        }#example_wrapper{
            background-color: #E0F4FF;
            width: 90%;
            max-width: 100%;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #39A7FF;
            /*box-shadow: 5px 5px #E0F4FF;*/
        }.addItem{
            width: 90%;
            height: auto;
            margin: 0 auto;
            padding: 15px 0;
            font-size: 1.1em;
        }.addItem form{
            border: #87C4FF 1px solid;
            background-color: #E0F4FF;
            width: 312px;
            padding: 10px;
        }.addItem form > input, #supplier{
            display: block;
            margin: 10px 0;
            width: 290px;
            height: 30px;
            text-align: center;
            font-size: 1.1em;
        }.div_register_sup button{
            font-size: 1.1em;
            padding: 10px;
            width: 290px;
        }#supCat{
            width: 290px;
            height: 30px;
            margin-bottom: 10px;
            text-align:center;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <div class="stock-container">
        <div class="side-nav">
            <h1 style="text-align:center;background-color: #39A7FF;color: #FFEED9;margin: 10px;padding: 20px 0">STOCKMASTER</h1>
            <div class="wrapper">
                <div><a href="item.php">ITEM</a></div>
                <div><a href="supplier.php">SUPPLIER</a></div>
            </div>
        </div>
        <div class="main">
            <h2 style="text-align: center;">List of Item</h2>
            <table id="example" class="display" style="max-width:100%;text-align:center">
                <thead>
                    <tr>
                        <th>item id</th>
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
                        <td>#<?php echo $rowItem['item_id'] ?></td>
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
                    <div class="div_register_sup"><button name="add_item">Register Supplier</button></div>
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