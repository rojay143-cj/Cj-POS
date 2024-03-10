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
                            <input type="hidden" class="item_price" value="<?php echo $rowItem['unit_price']; ?>">
                            <span class="card-text">₱<?php echo $rowItem['unit_price']; ?></span>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Proceed
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">footer</div>
        <!-- Modal Item Order-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Item Quantity</th>
                                <th>Item Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var item_array = [];
            $('.btn_buy').on('click',function(){
                var card = $(this).closest('.card-body');
                let item_name = card.find('.item_name').text();
                let item_price = parseInt(card.find('.item_price').val());
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
                    items += '<div class="card-body"><span class=""col-sm-12">' +item_array[i].item_name + ': </span>';
                    items += '<span id="item_price">₱' +item_array[i].item_price + ' </span>';
                    items += '<span id="item_quantity">' +item_array[i].item_quantity + 'qty</span></div>';
                    $('#display_item').append(items);
                }
            }
            $('#btn_order_item').on('click', function(){
                $.ajax({
                    type: 'POST',
                    url: '../source/source.php',
                    data: {item_array:JSON.stringify(item_array)},
                    success: function(){
                        alert('Item placed successfully');
                    },
                    error:function(){
                        alert('Error!');
                    }
                });
            });
        });
    </script>
</body>
</html>