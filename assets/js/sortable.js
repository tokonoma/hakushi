$(function() {
    //jquery UI drag and drop sort function
    $('#item-list').sortable({
        handle: '.move-btn',
        update: function(event, ui){
            var posCounter = 1;
            $(".reorder-badge").show();
            $('.panel').each(function(i) {
               var itemUID = $(this).data('uid');
               var itemPOS = posCounter;
               updateOrder(itemUID, itemPOS)
               posCounter++;
            });
            $(".reorder-badge").fadeOut("fast");
        }
    });
})