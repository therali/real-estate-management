// $(document).ready(function () {
//     $('*[data-confirm]').on('click', function (e) {
//         var conf = confirm($(this).data('confirm'));
//
//         if (!conf) e.preventDefault();
//     });
//     $('body').on('hidden.bs.modal', '.modal', function () {
//         $(this).removeData('bs.modal');
//     });
//
//     $('form').submit(function () {
//         var btn = $(this).find('input[type=submit],button[type=submit]');
//         btn.attr('disabled', true);
//         btn.html("<i class='fa fa-cog fa-spin'></i> Procesando...");
//     });
// });

function checkDelete(element, token) {
    if (confirm('Are you sure you want to delete this?')) {
        $.ajax({
            type: "post",
            url: element,
            data: {_method: 'delete', _token: token},
            dataType: "json",
            success: function (result) {
                if (result.redirect) {
                    window.location.href = result.redirect;
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrown);
            }
        });
    }
}

function checkData(element, token) {
    $.ajax({
        type: "post",
        url: element,
        data: {_method: 'get', _token: token},
        dataType: "json",
        success: function (result) {
            if (result.redirect) {
                window.location.href = result.redirect;
            }
        }
    });
}

