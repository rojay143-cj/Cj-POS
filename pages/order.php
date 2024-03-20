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
                            <img src="<?php echo $rowItem['image']; ?>" alt="Hammer" class="img-thumbnail h-50">
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
    </div>
        <!-- Modal Item Order -->
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
                    <div class="text-center error"></div>
                    <div class="col-sm-12 mt-3">
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
                            <input type="text" id="tend_amount" class="form-control">
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
                            <input type="hidden" class="total_amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                    <button type="button" class="btn btn-primary" id="orderSummary">Confirm Order</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Summary Order -->
        <div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center error"></div>
                        <div class="col-sm-12 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Customer name</span>
                                </div>
                                <input type="text" id="summary_name" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cash amount</span>
                                </div>
                                <input type="text" id="summary_cash" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Phone / Mobile</span>
                                </div>
                                <input type="text" id="summary_mob" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Payment Type</span>
                                </div>
                                <select class="form-control" id="summary_pay">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Price</th>
                                    <th>Item Quantity</th>
                                    <th>Item Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="order_summary">
                                
                            </tbody>
                    </table>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-group m-auto">
                            <span class="form-control">Total: Php <span id="summary_total_amount"></span></span>
                            <input type="hidden" class="summary_total_amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-back" data-bs-dismiss="modal">Back</button>
                        <button type="button" class="btn btn-primary" id="btn_order_item">Buy Item</button>
                    </div>
                </div>
            </div>
        </div>
    <script>
        $('#orderSummary').on('click',function(){
            $('#summaryModal').modal('show');
            $('#exampleModal').modal('hide');
            let cusName = $('#cusName').val();
            let tend_amount = $('#tend_amount').val();
            let cusMob = $('#cusMob').val();
            let payType = $('#payType').val();
            let total = $('.total_amount').val();

            $('#summary_name').val(cusName);
            $('#summary_cash').val(tend_amount);
            $('#summary_mob').val(cusMob);
            $('#summary_pay').val(payType);
            $('.summary_total_amount').val(total);
            $('#summary_total_amount').html(total);

            let orders = $('#order_record').html();
            $('#order_summary').html(orders);
            $('.btn-back').on('click',function(){
                $('#exampleModal').modal('show');
                $('#summaryModal').modal('hide');
            });
        });
    </script>
</body>
</html>