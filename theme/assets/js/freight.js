let freight =
$(function () {
    var pgt = function (url, callback) {
        var func = document.getElementsByName('')
    };

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
                ajax_load("open");
            },
            success: function (response) {
                ajax_load("close");

                troca_endereco(response);
                payment.updatePrices(response);
            }
        }).fail(function () {
            ajax_load("close");
        });
    });

    function troca_endereco(data) {
        $("#street").val(data.freight.street);
        $("#number").val(data.freight.number);
        document.getElementById("number").readOnly = false;
        $("#district").val(data.freight.district);
        $("#city").val(data.freight.city);
        $("#state").val(data.freight.state);
        $("#zip_code").val(data.freight.zip_code);
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
