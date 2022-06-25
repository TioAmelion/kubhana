//Inicio Scrim Ajax para Publicar doação da Instituição

$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var publicacao_id_eliminar; 

    /*  quando clica no botão Publique uma Necessidade */
    $("#criar-nova-publicacao").click(function () {
        $("#btn-salvar").val("criar-publicacao");
        $("#btn-salvar").html("Publicar");
        $("#publicacao_id").val("");
        $("#publicacaoForm").trigger("reset");
        $("#publicacaoCrudModal").html("Adicionar Nova Publicação");
        $("#ajax-publicacao-modal").modal("show");
        $("#modal-preview").attr("src", "https://via.placeholder.com/150");
    });

    /*  quando clica no botão Editar */
    $(".editar-publicacao").click(function () {
        var publicacao_id = $(this).data("id");
        $.get("publicar/" + publicacao_id + "/edit", function (data) {
            $("#publicacaoCrudModal").html("Editar Publicação");
            $("#btn-salvar").val("editar-publicacao");
            $("#ajax-publicacao-modal").modal("show");
            $("#publicacao_id").val(data.id);
            $("#titulo").val(data.titulo);
            $("#categoria_id").val(data.categoria_id);
            $("#descricao").val(data.texto);

            $("#modal-preview").attr("alt", "No image available");
            if (data.imagem) {
                $("#modal-preview").attr("src", "images/" + data.imagem);
                $("#hidden_image").attr("src", "images/" + data.imagem);
            }
        });
    });

    // quando clica no botão eliminar
    $(".eliminar-publicacao").click(function () {
        $('#ajax-eliminar-modal').modal("show");
        publicacao_id_eliminar = $(this).data("id");
    });

    $('.eliminar').click(function() {
        $.ajax({
            type: "DELETE",
            url: "publicar/" + publicacao_id_eliminar,
            success: function (data) {
                toastr.success("Publicação Eliminada", "", {
                    showMethod: "slideDown",
                    hideMethod: "slideUp",
                    timeOut: 1000,
                    onHidden: function () {
                        window.location.reload();
                    },
                });
            },
            error: function (data) {
                toastr.error("Ocorreu um erro ao Eliminar Publicação, contacte o Administrador", "", {
                    timeOut: 5000,
                });
            },
        });
    });

    $("#publicacaoForm").on("submit", function (element) {
        element.preventDefault();

        $("#btn-salvar").val();

        $.ajax({
            url: "/publicar",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: "json",
            success: (response) => {
                console.log("publicar instituicao: ", response);

                if (response.status == 200 && response.data) {
                    $("#publicacaoForm").trigger("reset");
                    $("#btn-salvar").html("Publicado");

                    toastr.success(response.mensagem, "Publicar!", {
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        timeOut: 2000,
                        onHidden: function () {
                            window.location.reload();
                        },
                    });
                } else if (response.erro) {
                    toastr.error(response.mensagem, { timeOut: 5000 });
                } else {
                    
                    validarForm(response);
                }
            },
        });
    });

    removerClass();
});

//Funcao para previsualizar imagem
function readURL(input, id) {
    id = id || "#modal-preview";

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $("#modal-preview").removeClass("hidden");
        $("#start").hide();
    }
}

function validarForm(response) {
    var erro1 = jQuery.inArray( "O campo titulo é obrigatório.", response.erroValidacao);

    var erro11 = jQuery.inArray("O campo titulo não pode conter mais de 120 caracteres.", response.erroValidacao);

    var erro2 = jQuery.inArray( "O campo necessidade é obrigatório.", response.erroValidacao);

    var erro3 = jQuery.inArray("O campo descricao é obrigatório.",response.erroValidacao);

    if (erro1 > -1) {
        $("#titulo").addClass("border border-danger");
        $("#tituloError").html("O campo titulo é obrigatório.");
    }

    if (erro11 > -1) {
        $("#tituloError").html("O campo titulo não pode conter mais de 120 caracteres.");
    }

    if (erro2 > -1) {
        $("#categoria_id").addClass("border border-danger");
        $("#classificacaoError").html("O campo necessidade é obrigatório." );
    }

    if (erro3 > -1) {
        $("#descricao").addClass("border border-danger");
        $("#descricaoError").html("O campo descricao é obrigatório.");
    }
}

// Script para Remover a class Danger dos input da modal Instituição
function removerClass() {
    $("#titulo").keyup(function () {
        $("#titulo").removeClass("border border-danger");
        $("#tituloError").html("");
    });

    $(function () {
        $("#categoria_id").click(function (event) {
            $("#categoria_id").removeClass("border border-danger");
            $("#classificacaoError").html("");
        });
    });

    $("#descricao").keyup(function () {
        $("#descricao").removeClass("border border-danger");
        $("#descricaoError").html("");
    });
}
