$(function () {
    $("#form").submit(function (e) {
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

                address.addEditAddress();
                freight.exchangeAddress(response);
                payment.updatePrices(response)
            }
        }).fail(function () {
            utilities.ajax_load("close");
            alert("Erro ao processar a requisição !");
        });
    });
});

let freight = {
    exchangeAddress: function (data) {
        $("#street").val(data.freight.street);
        $("#number").val(data.freight.number);
        $("#district").val(data.freight.district);
        $("#city").val(data.freight.city);
        $("#state").val($('option:contains(' + data.freight.state + ')').val());
        $("#zip_code").val(data.freight.zip_code);
    }
};
