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
                utilities.ajax_load("open");
            },
            success: function (response) {
                utilities.ajax_load("close");
                if (response.message) {
                    var view = utilities.generateMessage(response.message);
                    $(".form_ajax").html(view);
                    $(".form_ajax").show();
                }

                if (response.redirect) {
                    window.location.href = response.redirect.url;
                }
            }
        }).fail(function () {
            utilities.ajax_load("close");
            alert("Erro ao processar a requisição !");
        });
    });
});

let payment = {
    updatePrices: function (data) {
        //Valor do frete
        $("#freight_value_cart").val(data.freight.value);
        $("#freight_value").val(data.freight.value);

        //Valor total do pedido
        $("#total_amount").val(data.cart.total_amount);

        //Sub-total total do pedido
        $("#subtotal").val(data.cart.subtotal);

    }
};