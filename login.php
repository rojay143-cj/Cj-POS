<?php 
    require 'connection/connection.php';
    require 'source/source.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="api/datatables.js"></script>
    <link rel="stylesheet" href="api/datatables.css">
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
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #39A7FF;
            box-shadow: 5px 5px #E0F4FF;
        }.addItem{
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }.footer .foot-wrapper{
            box-shadow: 1px 1px 1px 1px #E0F4FF;
            border: #39A7FF 1px solid;
            padding: 15px;
            width: 90%;
            margin: 0 auto;
        }.addItem input{
            display: block;
            width: 300px;
            font-size: 1.5rem;
            margin: 0 auto;
            text-align: center;
            margin-top: 15px;
        }.addItem button{
            font-size: 1.5rem;
            display: block;
            width: 300px;
            margin: 0 auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="stock-container">
        <div class="side-nav">
            <h1 style="text-align:center;background-color: #39A7FF;color: #FFEED9;margin: 10px;padding: 20px 0">STOCKMASTER</h1>
            <div class="wrapper">
                <div><a href="">ITEM</a></div>
                <div><a href="">SUPPLIER</a></div>
                <div><a href="">SALES</a></div>
                <div><a href="">SETTINGS</a></div>
            </div>
        </div>
        <div class="main">
            <h2 style="text-align: center;">Available items</h2>
            <table id="example" class="display" style="width:100%;text-align:center">
                <thead>
                    <tr>
                        <th>item ID</th>
                        <th>item name</th>
                        <th>quantity</th>
                        <th>unit price</th>
                        <th>barcode</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($itemData as $rowItem){
                    ?>
                    <tr>
                        <td><?php echo $rowItem['item_id'] ?></td>
                        <td><?php echo $rowItem['name'] ?></td>
                        <td><?php echo $rowItem['quantity'] ?></td>
                        <td><?php echo $rowItem['unit_price'] ?></td>
                        <td><?php echo $rowItem['barcode'] ?></td>
                        <td><button style="padding: 10px;cursor:pointer; width: 100px">Edit</button></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div>
                <h2 style="text-align: center;margin-top:15px;">Add New Item</h2>
                <form action="" method="POST" class="addItem">
                    <input type="text" placeholder="Item Name">
                    <input type="text" placeholder="Quantity">
                    <input type="text" placeholder="Item Price">
                    <input type="text" placeholder="Barcode">
                    <div><button>Generate Barcode</button>
                    <button>Add Item</button></div>
                </form>
            </div>
        </div>
        <div class="footer">footer</div>

    <script>
       $('#example').DataTable();
    </script>
</body>
</html>