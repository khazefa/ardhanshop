$(document).ready(function(){
    // ------------------------------------------------------- //
    // Ajax Actions
    // ------------------------------------------------------ //
    get_cart_total();
//    get_cart_items();
    load_courier();
    calculate_shipping();
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

function load_courier() {
    $('#fcity_checkout').change(function () {
        var fcity = $(this).val();
//        alert("hello "+fcity);

        $.ajax({
            url:"cart_item.php?act=load-courier&fcity="+fcity,
            type:"GET",
            dataType:"json",
            success:function(response, data)
            {
                var $courier = $('#fcourier_checkout');
                if(fcity == 0){
                    $courier.empty();
                    $courier.append('<option value=0>--</option>');
                }else{
                    $courier.empty();
                    for (var i = 0; i < response.length; i++) {
                        $courier.append('<option value=' + response[i].shipp_id + '>' + response[i].shipp_courier + '</option>');
                    }
                }

                //manually trigger a change event for the courier so that the change handler will get triggered
                $courier.change();
            },
            cache: false,
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log('ERRORS: ' + textStatus + ' - ' + errorThrown );
            }
        });
    });
}

function calculate_shipping() {
    $('#fcourier_checkout').change(function () {
        var fcourier = $(this).val();
        var fsubtotal = $("#fsubtotal_checkout").val();
        var fweight = $("#fweight_checkout").val();

        $.ajax({
            url:"cart_item.php?act=shipping-total&fcourier="+fcourier+"&fsubtotal="+fsubtotal+"&fweight="+fweight,
            type:"GET",
            dataType:"json",
            success:function(response, data)
            {
                $('#fshipping_cost').val(response.shipp_cost);
                $('#forders_total').val(response.orders_total);
                $('#fshipping_cost_html').html(response.shipp_cost_rp);
                $('#forders_total_html').html(response.orders_total_rp);
            },
            cache: false,
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log('ERRORS: ' + textStatus + ' - ' + errorThrown );
            }
        });
    });
}