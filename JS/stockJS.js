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