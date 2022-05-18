$(function () {
    $('.usy-name').on('click', function(element) {
        window.location.href = '/perfil';
        const id = element.currentTarget.getAttribute('data-id')

        $.ajax({
            type: "GET",
            url: "verificarPerfil/"+id,
            dataType: "json",
            success: function (response) {
                console.log("idd", response);
            }
        });
    })
});