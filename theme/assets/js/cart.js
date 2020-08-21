$(function () {
    function load(action) {
        var load_div = $(".ajax_load");
        if (action === "open") {
            load_div.fadeIn().css("display", "flex");
        } else {
            load_div.fadeOut();
        }
    }

    load("close");

    $("body").on("click", "[data-action]", function (e) {
        e.preventDefault();

        load("open");

        var data = $(this).data();

        $.get(data.action, data, function (callback) {
            console.log(callback);
            document.getElementById("cart").textContent = callback.cart;
            load('close');
        }, "json").fail(function () {
            load('close');
            alert("Erro ao processar a requisição !");
        })
    })
});