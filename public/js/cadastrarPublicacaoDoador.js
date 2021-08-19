//Inicio do Script Ajax para Publicar doação do User
$(function () {

		$('#form-doador').on('submit', function(element){
			element.preventDefault();

			$.ajax({
				url: "/publicarUser",
				type: "POST",
				data: new FormData(this),
				contentType: false,
           		processData: false,
				dataType: "json",
				success: function(response) {
					
					console.log('publicar doacao usuario: ', response);
					
					// if(response.mensagem){
					// 	toastr.success(response.mensagem, 'Publicar!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
					// 		timeOut: 2000, onHidden: function () {
					// 			window.location.reload();
					// 		} 
					// 	});

					// 	Limpar dos dados do form
					// 	document.getElementById("form-doador").reset();

					// }else if(response.erro){
					
					// 	var erro4 = jQuery.inArray("O campo titulo doacao é obrigatório.", response.erro);
					// 	var erro5 = jQuery.inArray("O campo categoria id é obrigatório.", response.erro);
					// 	var erro6 = jQuery.inArray("O campo local doacao é obrigatório.", response.erro);
					// 	var erro7 = jQuery.inArray("O campo descricao é obrigatório.", response.erro);
					// 	var erro8 = jQuery.inArray("O campo quantidade doacao é obrigatório", response.erro);

					// 	if (erro4 > -1 )
					// 		$('#titulo_doacao').addClass('border border-danger');

					// 	if (erro5 > -1 )
					// 	$('#categoria_id_doador').addClass('border border-danger');	

					// 	if (erro6 > -1 )
					// 		$('#local_doacao').addClass('border border-danger');	

					// 	if (erro7 > -1 )
					// 		$('#descricao_doacao').addClass('border border-danger');

					// 	if (erro8 > -1 )
					// 		$('#quantidade_doacao').addClass('border border-danger');	

					// 	toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });

					// } else if(response.mensagem && response.erro) {
					// 	toastr.error(response.erro, 'Erro ao publicar!', { "timeOut": 5000 });
					// }
				}
			});

		});

    removerClass();
});
//Fim

// Script para Remover a class Danger dos input da modal Instituição 
function removerClass() {

    $('#titulo_doacao').keyup(function(){
        $( "#titulo_doacao" ).removeClass( "border border-danger" );

    });

    $(function() {
        $('#categoria_ida').click(function(event) {
            $( "#categoria_ida" ).removeClass( "border border-danger" );
        });
    });
        
    $('#local_doacao').keyup(function(){
        $( "#local_doacao" ).removeClass( "border border-danger" );

    });

    $('#descricao_doacao').keyup(function(){
        $( "#descricao_doacao" ).removeClass( "border border-danger" );
    });
}
//FIM

