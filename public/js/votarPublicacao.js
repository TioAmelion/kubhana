//VOTAR NA PUBLICACAO
$(function () {

    $('.urgente').on('click', function(element) {
        let id = element.currentTarget.getAttribute('publicacao-id');
        let classificacao = 1;
        listar(id, classificacao);
    });

    $('.maisUrgente').on('click', function(element) {
        let id = element.currentTarget.getAttribute('publicacao-id');
        let classificacao = 2;
        listar(id, classificacao);
    });
});
//FIM

//FUNCAO PARA VOTAR NA PUBLICACAO
function votarPublicacao(idPublicacao, classificacao) {

    let _token =   $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        url: "/votar", 
        type: "POST",
        data: {
            publicacao_id: idPublicacao,
            classificacao: classificacao,
            _token: _token
        },
        dataType: "json",
        success: function(response) {

            console.log('votar publicacao: ', response);

            // if(response.mensagem && response.dados){
            //     toastr.success(response.mensagem, 'Votação!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
            //         timeOut: 5000, onHidden: function () {
            //             window.location.reload();
            //         }  
            //     });
            // }else {
            //     toastr.error(response.mensagem, 'Erro ao votar!', { "timeOut": 5000 });
            // }
        }
    });
}
//FIM

//FUNCAO PARA SE O USUARIO LOGADO VOTOU NA PUBLICACAO
function listar(idPublicacao, classificacao) {

    $.ajax({
        url: "/verificarVoto",
        type: "GET",
        data: {
            publicacao_id: idPublicacao
        },
        dataType: "json",
        success: function(response) {

            console.log('listar publicacao: ', response);

            if(response.dados.length === 0){
                votarPublicacao(idPublicacao, classificacao)

            }else {

                response.dados.forEach(res => {
                    editar(res.id, classificacao);
                });
            }
        }
    });
}
//FIM

//FUNCAO PARA EDITAR VOTACAO NA PUBLICACAO
function editar(id, classificacao) {

    let _token =   $('meta[name="csrf-token"]').attr('content')

    $.ajax({
        url: "/update",
        type: "POST",
        data: {
            id: id,
            classificacao: classificacao,
            _token: _token
        },
        dataType: "json",
        success: function(response) {

            console.log('editar publicacao: ', response);
        }
    });
}
//FIM