$(function () {
    utilities.ajax_load("close");

    $("body").on("click", "[data-action]", function (e) {
        e.preventDefault();

        utilities.ajax_load("open");

        var data = $(this).data();

        $.get(data.action, data, function (callback) {
            document.getElementById("cart").textContent = callback.cart;
            utilities.ajax_load('close');
        }, "json").fail(function () {
            utilities.ajax_load('close');
            alert("Erro ao processar a requisição !");
        })
    })
});