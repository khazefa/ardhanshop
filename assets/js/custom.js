$(document).ready(function(){
    // ------------------------------------------------------- //
    // Ajax Actions
    // ------------------------------------------------------ //
    get_cart_total();
//    get_cart_items();
});

function get_cart_total() {
    $.ajax({
        url:"cart_item.php?act=cart-total",
        type:"GET",
        dataType:"json",
        success:function(response)
        {
            if(response.cart_total > 0){
                $('#cart_total').html(response.cart_total);
            }else{
                $('#cart_total').html('0');
            }
        },
        cache: false,
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('ERRORS: ' + textStatus + ' - ' + errorThrown );
        }
    });
}

function get_cart_items() {
    $.ajax({
        url:"cart_item.php?act=cart-items",
        type:"GET",
        dataType:"json",
        success:function(response)
        {
            var i, html;
            var $ul = $('#cart_items');
            html  = '';
            if(response.length > 0){
                $ul.empty();
                for (var i = 0; i < response.length; i++) {
                    html += '<li class="dropdown-item"><span class="nav-link"><span class="pull-left"><small><b>' 
                            + response[i]
                            + '</b></small></span><span class="pull-right"><button class="btn btn-sm btn-danger">x</button></span>'
                            + '</span></li>';
                }
                html += '<br>';
                html += '<li class="dropdown-item"><div class="dropdown-divider"></div></li><li class="dropdown-item"><a href="#" class="nav-link text-center">View Cart</a></li>';
            }
            $("#cart_items").html(html);
//            $('#cart_items').html(response.cart_total);
        },
        cache: false,
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('ERRORS: ' + textStatus + ' - ' + errorThrown );
        }
    });
}