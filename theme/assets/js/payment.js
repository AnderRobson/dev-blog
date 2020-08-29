let payment =
$(function () {
    $("#payment").submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let action = form.attr("action");
        let data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (response) {
                ajax_load("close");
            }
        }).fail(function () {
            ajax_load("close");
        });
    });

    function updatePrices(data) {
        //Valor do frete
        $("#freight_value_cart").val(data.freight.value);
        $("#freight_value").val(data.freight.value);

        //Valor total do pedido
        $("#total_amount").val(data.cart.total_amount);

        //Sub-total total do pedido
        $("#subtotal").val(data.cart.subtotal);

    }
    function ajax_load(action) {
        var load_div = $(".ajax_load");
        if (action === "open") {
            load_div.fadeIn().css("display", "flex");
        } else {
            load_div.fadeOut();
        }
    }

    function generateMessage(data) {
        return '<div class="alert alert-' + data.type + ' alert-dismissible fade show" role="alert">' +
            data.message +
            '</div>';
    }
});
