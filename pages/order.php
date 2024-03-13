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
                                    <button type="button" class="btn btn-primary" id="btn_modal">
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
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
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
                        <tbody id="order_record">
                            
                        </tbody>
                    </table>
                    <div class="col-sm-12 mt-5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Customer name</span>
                            </div>
                            <input type="text" name="cusName" id="cusName" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cash amount</span>
                            </div>
                            <input type="text" name="tend_amount" id="tend_amount" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone / Mobile</span>
                            </div>
                            <input type="text" name="cusMob" id="cusMob" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Payment Type</span>
                            </div>
                            <select class="form-control" name="payType" id="payType">
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="GCash">GCash</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-3 mt-3">
                        <div class="form-group m-auto">
                            <span class="form-control">Total: Php <span id="total_amount"></span></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_order_item">Buy Item</button>
                    <button class="try">try</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var item_array = [];
            $('#btn_order_item').on('click',function(){
                    let cusName = $('#cusName').val();
                    let tend_amount = $('#tend_amount').val();
                    let cusMob = $('#cusMob').val();
                    let payType = $('#payType :selected').val();
                    let totalAmount = $('#total_amount').text()
                    item_list = {
                        'customer_name': cusName,
                        'tend_amount': tend_amount,
                        'total_amount':totalAmount,
                        'customer_mobile': cusMob,
                        'pay_type': payType
                    };
                    item_array.push(item_list);
                    if(($('#cusName').val() != null && $('#cusName').val() != '' ) && ($('#tend_amount').val() != null && $('#tend_amount').val() != '')){
                        $.ajax({
                            type: 'POST',
                            url: '../source/code.php',
                            data:{item_array:JSON.stringify(item_array)},
                            success: function(){
                                item_array = [];
                                alert("Order placed");
                            },
                            error: function(){
                                alert('Failed to Send data!');
                            }
                        });
                    }else{
                        alert('Please Enter fill-up the form!');
                    }
            });
            $('.btn_buy').on('click',function(){
                $('#display_item').empty();
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
                    'item_id':item_id,
                };
                    item_array.push(item_list);
                };
                for(var i = 0;i < item_array.length;i++){
                    var items = '<div class="order_items"></div>';
                    items += '<div class="card-body"><span class=""col-sm-12">' +item_array[i].item_name + ': </span>';
                    items += '<span id="item_price">₱' +item_array[i].item_price + ' </span>';
                    items += '<span id="item_quantity">' +item_array[i].item_quantity + 'qty</span></div>';
                    $('#display_item').append(items);
                }
            });
            function modaltable() {
                $('#order_record').empty();
                let total_amount = 0;
                for (var i = 0; i < item_array.length; i++) {
                    var row = '<tr>';
                    row += '<td>' + item_array[i].item_name + '</td>';
                    row += '<td>₱' + item_array[i].item_price + '</td>';
                    row += '<td>' + item_array[i].item_quantity + ' qty</td>';
                    var subtotal = item_array[i].item_price * item_array[i].item_quantity;
                    row += '<td>₱' + subtotal + '</td>';
                    row += '</tr>';
                    total_amount += subtotal;
                    $('#order_record').append(row);
                }
                $('#total_amount').html(
                    total_amount
                );
            }
            $('#btn_modal').on('click', function(){
                $('#exampleModal').modal('show');
                modaltable();
            });
        })
    </script>
</body>
</html>