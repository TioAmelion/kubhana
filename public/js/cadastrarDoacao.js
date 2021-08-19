//Inicio do Script Ajax para Publicar doação do User para a instituição

$(function() {

    $('#form-doacao').on('submit', function(element){
        element.preventDefault();
         
        $.ajax({
            url: "/doacao", 
            type: "POST",
            data: new FormData(this),
            contentType: false,
               processData: false,
            dataType: "json",
            success: function(response) {

                console.log('Dar res: ', response);

                if(response.mensagem && response.dados){
                    toastr.success(response.mensagem, 'Doação!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
                        timeOut: 5000, onHidden: function () {
                            window.location.reload();
                        }  
                    });

                }else if(response.erro) {

                    var erro1 = jQuery.inArray("O campo quantidade é obrigatório.", response.erro);
                    var erro2 = jQuery.inArray("O campo descricao doar é obrigatório.", response.erro);
                    var erro3 = jQuery.inArray("O campo estado é obrigatório.", response.erro);
                    
                    if (erro1 > -1 )
                        $('#quantidade').addClass('border border-danger');

                    if(erro2 > -1)
                        $('#descricaoDoar').addClass('border border-danger');
                    
                    if(erro3 > -1)
                        $('#estadoProduto').addClass('border border-danger');

                    toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
                }

                //Script para Remover a class Danger dos input da modal Doação

                $('#quantidade').keyup(function(){
                    console.log("QTD", $('#quantidade').val());
                    $( "#quantidade" ).removeClass( "border border-danger" );
                });

                $('#descricaoDoar').keyup(function(){
                    $( "#descricaoDoar" ).removeClass( "border border-danger" );
                });

                $('#estadoProduto').keyup(function(){
                    $( "#estadoProduto" ).removeClass( "border border-danger" );
                });
            }
        });
    });
    
    //PEGAR O ID DA INSTITUIÇÃO
    $('.com').on('click', function(element){
        $('#instId').val(element.currentTarget.getAttribute('id'));
        $('#nome').text(element.currentTarget.getAttribute('nomeInst'));
    });
});