<?php 
    require '../source/source.php';
?>
<?php 
    if(!isset($_SESSION['cart_item'])){
        $_SESSION['cart_item'] = array();
    }
    if(isset($_POST['get_item_id'])){
        $id = $_POST['get_item_id'];
        echo $id;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster</title>
    <style>
        .selection{
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 10px;
            justify-content: center;
            align-items: center;
        }
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
            <div class="container">
                <div class="row">
                    <div class="selection col-lg-8 p-2 flex-wrap">
                        <?php foreach($dataItem as $rowItem){ ?>
                        <div class="card-body card col-sm-12 w-100 h-100">
                            <img src="../assets/image/hammer.webp" alt="Hammer" class="img-thumbnail">
                            <h5 class="card-title item_name"><?php echo $rowItem['item_name']; ?></h5>
                            <span class="card-text item_price"><?php echo $rowItem['unit_price']; ?></span>
                            <div class="form-group">
                                <input type="number" min="1" value="1" placeholder="quantity" class="form-control item_quantity">
                                <input type="hidden" class="item_id" value="<?php echo $rowItem['item_id']; ?>">
                                <button class="btn-primary btn-block mt-2 w-100 btn_buy">Buy</button>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="confirmation col-lg-4 p-2">
                        <div class="card-body">
                            <div class="card text-center">
                                <h4 class="card-title">Order Details</h4>
                                <div class="card">
                                    <div>
                                        <span id="display_item"></span>
                                    </div>
                                </div>
                                <div class="card">
                                    <button id="btn_order_item">Buy Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">footer</div>
    </div>
    <script>
        $(document).ready(function(){
            item_array = [];
            $('.btn_buy').on('click',function(){
                var card = $(this).closest('.card-body');
                let item_name = card.find('.item_name').text();
                let item_price = card.find('.item_price').text();
                let item_quantity = parseInt(card.find('.item_quantity').val());
                let item_id = card.find('.item_id').val();
                
                var existingItem = item_array.find(item => item.item_id === item_id);
                if(existingItem){
                    existingItem.item_quantity += item_quantity;
                }else{
                    item_list = {
                    'item_name':item_name,
                    'item_price':item_price,
                    'item_quantity':item_quantity,
                    'item_id':item_id
                };
                    item_array.push(item_list);
                };
                displayItem();
            });
            function displayItem(){
                $('#display_item').empty();
                for(var i = 0;i < item_array.length;i++){
                    var items = '<div class="order_items"></div>';
                    items += '<span class="item_name">' +item_array[i].item_name + ': </span>';
                    items += '<span class="item_price">₱' +item_array[i].item_price + ' </span>';
                    items += '<span class="item_quantity">' +item_array[i].item_quantity + 'qty</span>';
                    $('#display_item').append(items);
                }
            }
            $('#btn_order_item').on('click', function(){
                
            });
        });
    </script>
    <table>
        <thead>
            <tr>
                <th>Item name</th>
                <th>Item price</th>
                <th>Item quanitty</th>
            </tr>
        </thead>
        <tbody id="get_selected_items">
            <tr>
                
            </tr>
        </tbody>
    </table>
</body>
</html>
