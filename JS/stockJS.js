$(document).ready(function(){
    $('#example').DataTable();
    item_array = [];
    $('.btn_buy').on('click',function(){
        var card = $(this).closest('.card-body');
        let txt_id = card.find('.item_id').val();
        let txt_quantity = card.find('.item_quantity').val();
        let item_name = card.find('.item_name').text();
        let item_price = card.find('.item_price').text();

        var items = {
            'item_id': txt_id,
            'item_quantity':txt_quantity,
            'item_name':item_name,
            'item_price':item_price
        };
        item_array.push(items);
        $('#display_item').empty();
        for(let i=0;i<item_array.length;i++){
            var itemList = '<div class="itemList"></div>';
            itemList += '<span class="item_name">' +item_array[i].item_name+'</span>';
            itemList += '<span class="item_name">' +item_array[i].item_price+'</span>';
            itemList += '<span class="item_name">' +item_array[i].item_quantity+'</span>';
            $('#display_item').append(itemList);
        }
    });
});