$(function () {
    $("#formulario").submit(function (e) {
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
                    return;
                }

                if (response.redirect) {
                    window.location.href = response.redirect.url;
                }
            }
        });
    });
});
