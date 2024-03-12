$(document).ready(function(){
    ////////////////////////////////////////////////////////////////////////////////////////////////////
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////
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
            '<span>Total: ₱' + total_amount + '</span>'
        );
    }
    $('#btn_modal').on('click', function(){
        modaltable();
        $('#exampleModal').modal('show');
    });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $('#btn_order_item').on('click', function(){
        let cusName = $('#cusName');
        let tend_amount = $('#tend_amount');
        let cusMob = $('#cusMob');
        let payType = $('#payType :selected');
        
        if((cusName.val() != null && cusName.val() != '' ) && (tend_amount.val() != null && tend_amount.val() != '')){
            $.ajax({
                type: 'POST',
                url: '../source/code.php',
                data: {item_array:JSON.stringify(item_array)},
                success: function(){
                    alert('Item placed successfully');
                },
                error:function(){
                    alert('Error!');
                }
            });
        }else{
            alert('Please Enter fill-up the form!');
        }
    });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
});