//Inicio do Script Ajax para Publicar doação do User
$(function () {

	// $.ajaxSetup({
	// 	headers: {
	// 		"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
	// 	},
	// });
	
	var publicacao_id_eliminar;
	
	/*  quando clica no botão Publique uma Necessidade */
	$("#criar-nova-publicacao-doador").click(function () {
		$("#btn-salvar-d").val("criar-publicacao");
		$("#btn-salvar-d").html("Publicar");
		$("#publicacao_id_doador").val("");
		$("#publicacaoDoadorForm").trigger("reset");
		$("#publicacaoCrudModall").html("Adicionar Nova Publicação");
		$("#ajax-publicacao-doador-modal").modal("show");
		$("#modal-preview-doador").attr("src", "https://via.placeholder.com/150");
	});

	/*  quando clica no botão Editar */
    $(".editar-publicacao-doador").click(function () {
        var publicacao_id = $(this).data("id");
        $.get("publicarUser/" + publicacao_id + "/edit", function (data) {
            $("#publicacaoCrudModall").html("Editar Publicação");
            $("#btn-salvarr").val("editar-publicacao");
            $("#ajax-publicacao-doador-modal").modal("show");
            $("#publicacao_id_doador").val(data.id);

            $("#titulo_doacao").val(data.titulo);
            $("#categoria_id_doador").val(data.categoria_id);
            $("#descricao_doacao").val(data.texto);
			$("input:radio[value="+data.estado_item+"][name='classificacao']").prop('checked',true);
            $("#quantidade_doacao").val(data.quantidade_item);
            $("#local_doacao").val(data.localizacao);

            $("#modal-preview-doador").attr("alt", "No image available");
            if (data.imagem) {
                $("#modal-preview-doador").attr("src", "images/" + data.imagem);
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
            url: "publicarUser/" + publicacao_id_eliminar,
            success: function (data) {
				return
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

	$('#publicacaoDoadorForm').on('submit', function(element){
		element.preventDefault();

		$.ajax({
			url: "/publicarUser",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			processData: false,
			dataType: "json",
			success: (response) => {
				
				console.log('publicar doacao usuario: ', response);
				
				if(response.status == 200 && response.data) {

					$("#publicacaoDoadorForm").trigger("reset");
                	$("#btn-salvar-d").html("Publicado");

					toastr.success(response.mensagem, 'Publicar!', { 
						showMethod: "slideDown", 
						hideMethod: "slideUp", 
						timeOut: 2000, onHidden: function () {
							window.location.reload();
						} 
					});

				} else if (response.erro) {
                    toastr.error(response.mensagem, { timeOut: 5000 });
				} else {
                    validarForm(response);
                }
			}
		});

	});

    removerClass();
});

//Funcao para previsualizar imagem
function readURLL(input, id) {
    id = id || "#modal-preview-doador";

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $("#modal-preview-doador").removeClass("hidden");
        $("#start").hide();
    }
}

function validarForm(response) {
    var erro4 = jQuery.inArray("O campo titulo doacao é obrigatório.", response.erroValidacao);
	var erro5 = jQuery.inArray("O campo categoria id é obrigatório.", response.erroValidacao);
	var erro6 = jQuery.inArray("O campo local doacao é obrigatório.", response.erroValidacao);
	var erro7 = jQuery.inArray("O campo descricao é obrigatório.", response.erroValidacao);
	var erro8 = jQuery.inArray("O campo quantidade doacao é obrigatório", response.erroValidacao);

	if (erro4 > -1 )
		$('#titulo_doacao').addClass('border border-danger');

	if (erro5 > -1 )
	$('#categoria_id_doador').addClass('border border-danger');	

	if (erro6 > -1 )
		$('#local_doacao').addClass('border border-danger');	

	if (erro7 > -1 )
		$('#descricao_doacao').addClass('border border-danger');

	if (erro8 > -1 )
		$('#quantidade_doacao').addClass('border border-danger');	

}

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

