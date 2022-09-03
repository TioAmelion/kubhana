//Inicio Scrim Ajax para Publicar doação da Instituição

$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    /*  quando clica no botão Publique uma Necessidade */
    $(".solicitar-doacao").click(function (e) {
        $("#btn-salvar-solicitacao").val("enviar-solicitacao");
        $('#publicacao_solicitar_id').val(e.currentTarget.getAttribute('publicacaoId'));
        $('#publicacao_user_id').val(e.currentTarget.getAttribute('user-id'));

		$("#texto_solicitacao_padrao").val("O(a) senhor(a) " + e.currentTarget.getAttribute('nomeDoador') + " Solicito encarecidamente da sua doação.");
		$("#nomeProprietario").html("Senhor(a) " + e.currentTarget.getAttribute('nomeDoador') + " Solicita encarecidamente da sua doação.");
        $("#solicitacaoForm").trigger("reset");
        $("#ajax-solicitacao-modal").modal("show");
    });
    
    $(".modal-listar-solicitantes").click(function (e) {
        publicacao_id = e.currentTarget.getAttribute('publicacao-id');
        
        $("#ajax-mostrar-solicitacoes").modal("show");
        
        $.get("solicitantes/" + publicacao_id, (res)=> {
            console.log(res.data);

            $('#add-rem > #dados-tabela').remove();
            
            if (res.data.length) 
            {
                res.data.forEach(element => {
                    $('#add-rem').append(
                    '<tbody id="dados-tabela"><tr>'+
                        '<th scope="row">1</th>'+
                        '<td>'+element.name+'</td>'+
                        '<td>'+element.telefone+'</td>'+
                        '<td>'+element.texto+'</td>'+
                        '<td><button class="btn btn-primary">Entrar em contacto</button></td>'
                    +'</tr></tbody>'
                    );
                });

            } else {
                // $('#add-rem').append('<div>Sem nenhum registro.</div>');
            }
        })
    });

    $("#solicitacaoForm").on("submit", function (element) {
        element.preventDefault();

        $.ajax({
            url: "/solicitar",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: "json",
            success: (response) => {
                
                if (response.status == 200 && response.data) {
                    $("#solicitacaoForm").trigger("reset");
                    $("#btn-salvar-solicitacao").html("Solicitado...");

                    toastr.success(response.mensagem, "Solicitar!", {
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

    /*  quando clica no botão Editar */
    // $(".editar-publicacao").click(function () {
    //     var publicacao_id = $(this).data("id");
    //     $.get("publicar/" + publicacao_id + "/edit", function (data) {
    //         $("#publicacaoCrudModal").html("Editar Publicação");
    //         $("#btn-salvar").val("editar-publicacao");
    //         $("#ajax-publicacao-modal").modal("show");
    //         $("#publicacao_id").val(data.id);
    //         $("#titulo").val(data.titulo);
    //         $("#categoria_id").val(data.categoria_id);
    //         $("#descricao").val(data.texto);

    //         $("#modal-preview").attr("alt", "No image available");
    //         if (data.imagem) {
    //             $("#modal-preview").attr("src", "images/" + data.imagem);
    //             $("#hidden_image").attr("src", "images/" + data.imagem);
    //         }
    //     });
    // });

    // quando clica no botão eliminar
    // $(".eliminar-publicacao").click(function () {
    //     $('#ajax-eliminar-modal').modal("show");
    //     publicacao_id_eliminar = $(this).data("id");
    // });

    // $('.eliminar').click(function() {
    //     $.ajax({
    //         type: "DELETE",
    //         url: "publicar/" + publicacao_id_eliminar,
    //         success: function (data) {
    //             toastr.success("Publicação Eliminada", "", {
    //                 showMethod: "slideDown",
    //                 hideMethod: "slideUp",
    //                 timeOut: 1000,
    //                 onHidden: function () {
    //                     window.location.reload();
    //                 },
    //             });
    //         },
    //         error: function (data) {
    //             toastr.error("Ocorreu um erro ao Eliminar Publicação, contacte o Administrador", "", {
    //                 timeOut: 5000,
    //             });
    //         },
    //     });
    // });

    removerClass();
});

function validarForm(response) {
    // var erro1 = jQuery.inArray( "O campo titulo é obrigatório.", response.erroValidacao);

    // if (erro1 > -1) {
    //     $("#titulo").addClass("border border-danger");
    //     $("#tituloError").html("O campo titulo é obrigatório.");
    // }
}

// Script para Remover a class Danger dos input da modal Instituição
function removerClass() {
    // $("#titulo").keyup(function () {
    //     $("#titulo").removeClass("border border-danger");
    //     $("#tituloError").html("");
    // });
}
