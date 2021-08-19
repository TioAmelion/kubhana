//Inicio Scrim Ajax para Publicar doação da Instituição
$(function () {

    previewFile();

    $("#form-publicacao").on("submit", function (element) {
        element.preventDefault();

        $.ajax({
            url: "/publicar",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                console.log("publicar instituicao: ", response);

                if (response.mensagem) {
                    toastr.success(response.mensagem, "Publicar!", {
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        timeOut: 2000,
                        onHidden: function () {
                            window.location.reload();
                        },
                    });

                } else {

                    var erro1 = jQuery.inArray(
                        "O campo titulo é obrigatório.",
                        response.erro
                    );

                    var erro2 = jQuery.inArray(
                        "O campo categoria id é obrigatório.",
                        response.erro
                    );
                    var erro3 = jQuery.inArray(
                        "O campo descricao é obrigatório.",
                        response.erro
                    );

                    if (erro1 > -1)
                        $("#titulo").addClass("border border-danger");

                    if (erro2 > -1)
                        $("#categoria_id").addClass("border border-danger");

                    if (erro3 > -1)
                        $("#descricao").addClass("border border-danger");

                    toastr.error(
                        "Por favor corriga os erros do Formulario",
                        "Erro ao publicar!",
                        { timeOut: 5000 }
                    );
                }
            },
        });
        document.getElementById("form-publicacao").reset();
    });

    removerClass();
});
//Fim do Scrim Ajax para Publicar doação da Instituição

//Funcao para previsualizar imagem
function previewFile() {

    var file = $("input[type=file]").get(0).files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function () {
            $("#previewImg").attr("src", reader.result);
        };

        $("#previewImg").show();
        reader.readAsDataURL(file);
    }
}
//FIM

// Script para Remover a class Danger dos input da modal Instituição 
function removerClass() {

    $("#titulo").keyup(function () {
        $("#titulo").removeClass("border border-danger");
    });
    
    $(function () {
        $("#categoria_id").click(function (event) {
            $("#categoria_id").removeClass("border border-danger");
        });
    });
    
    $("#descricao").keyup(function () {
        $("#descricao").removeClass("border border-danger");
    });
}
//FIM

