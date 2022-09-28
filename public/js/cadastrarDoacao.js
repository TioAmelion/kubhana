//Inicio do Script Ajax para Publicar doação do User para a instituição
$(function() {

    $.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
		},
	});
    
    /*  quando clica no icone para fazer a doação */
	$(".criar-nova-publicacao-doar").click(function (e) {
		$("#btn-salvar-doar").val("criar-publicacao");
		$("#btn-salvar-doar").html("Publicar");
		$("#publicacao_id_doar").val("");
        $('#instituicao_id').val(e.currentTarget.getAttribute('id'));
        $('#publicacao_doacao_id').val(e.currentTarget.getAttribute('publicacaoDoacaoId'));
		$("#publicacaoDoarForm").trigger("reset");
		$("#publicacaoCrudModalll").html("Ajude com a sua doação - " + e.currentTarget.getAttribute('nomeInst'));
		$("#ajax-publicacao-doar-modal").modal("show");
		$("#modal-preview-doar").attr("src", "https://via.placeholder.com/150");
	});

    $('#publicacaoDoarForm').on('submit', function(element){
        element.preventDefault();
         
        $.ajax({
            url: "/doacao", 
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {

                if(response.status == 200 && response.data) {

                    $("#publicacaoDoarForm").trigger("reset");
                	$("#btn-salvar-doar").html("Publicado");

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
                    validaForm(response);
                }
            }
        });
    });

    //quando clica em doações no feed de noticias na publicacao
    $(".modal-listar-doadores").click(function (e) {

        publicacao_id = e.currentTarget.getAttribute('publicacaoDocId');
                
        $.get("doacoes/" + publicacao_id, (res)=> {
            console.log(res.data);

            $('#add-rem-doacao > #dados-tabela-doacao').remove();
            
            res.data.forEach(element => {
                $('#add-rem-doacao').append(
                '<tbody id="dados-tabela-doacao"><tr>'+
                    '<th scope="row">1</th>'+
                    '<td>'+element.name+'</td>'+
                    '<td>'+element.email+'</td>'+
                    '<td>'+element.telefone+'</td>'+
                    '<td><button class="btn btn-danger">Entrar em contacto</button></td>'
                +'</tr></tbody>'
                );
            });
        });

		$("#ajax-mostrar-doacoes").modal("show");
	});

    $('.post-doacoes-receber').hide(); 

    $('.btn-doacoes-receber').click(function (e) {
        e.preventDefault();
        $('.post-filtros').hide();
        $('.search-box-div').hide();
        $('.post-doacoes-receber').show();
    });

    $('.btn-filtros').click(function (e) {
        e.preventDefault();
        $('.post-doacoes-receber').hide(); 
        $('.post-filtros').show(); 
        $('.search-box-div').show(); 
    });

    //confirmar Doaoção
    $('.btn-confirmar').click(function (e) { 
        e.preventDefault();

        doacao_id = e.currentTarget.getAttribute('doacao');
        
        $.ajax({
            url: "confirmar-doacao/" + doacao_id, 
            type: "GET",
            dataType: "json",
            success: function(response) {
                console.log("DOACAO ID", response);
                if(response.status == 200 && response.data) {

                    $("#publicacaoDoarForm").trigger("reset");
                	$("#btn-salvar-doar").html("Publicado");

					toastr.success('', response.mensagem, { 
						showMethod: "slideDown", 
						hideMethod: "slideUp", 
						timeOut: 2000, onHidden: function () {
							window.location.reload();
						} 
					});

                } else if (response.erro) {
                    toastr.error('', 'Ocorreu um erro', { timeOut: 5000 });
                } 
            }
        });
        
    });

    $('.ver-doacao').click(function (e) { 
        e.preventDefault();
        ver_doacao = e.currentTarget.getAttribute('ver-doacao');
        
        $.get("doacao/" + ver_doacao, (res)=> {
            if (res.data) {
                $('#verEstadoProduto').html(res.data.estado.split('_')[0] + " " + res.data.estado.split('_')[1]);
                $('#verQtdDoacao').html(res.data.quantidade);
                $('#verDescricao').html(res.data.descricao);
                $('#ver-imagem').attr('src', "images/"+res.data.imagem);
                $('#ajax-ver-doacao-modal').modal('show');
            } else {
                
            }
        });
    });
});

//validar formulario
function validaForm(response) {
    console.log('form: ', response, jQuery.inArray("O campo quantidade é obrigatório.", response.erroValidacao));
    var quantidade = jQuery.inArray("O campo quantidade é obrigatório.", response.erroValidacao);
    var descricao = jQuery.inArray("O campo descricao doar é obrigatório.", response.erroValidacao);
    var estado = jQuery.inArray("O campo estado é obrigatório.", response.erroValidacao);
    
    if (quantidade > -1 ) {
        console.log('erro')
        $('#quantidade').addClass('border border-danger');
        $('#quantidadeErro').html("Campo quantidade a doar é obrigatório");
    }

    if(descricao > -1) {
        $('#descricaoDoar').addClass('border border-danger');
        $('#descricaoDoarErro').html("Campo descrição obrigatório");
    }

    if(estado > -1) {
        $('#estadoProduto').addClass('border border-danger');
        $('#estadoProdutoErro').html("Selecione o estado em que o produto se encontra");
    }

    $('#quantidade').keyup(function(){
        $("#quantidade").removeClass( "border border-danger");
        $('#quantidadeErro').html("");
    });

    $('#descricaoDoar').keyup(function(){
        $("#descricaoDoar").removeClass("border border-danger");
        $('#descricaoDoarErro').html("");
    });

    $('#estadoProduto').keyup(function(){
        $("#estadoProduto").removeClass("border border-danger");
        $('#estadoProdutoErro').html("");
    });
}

//Funcao para previsualizar imagem
function readURLLL(input, id) {
    id = id || "#modal-preview-doar";

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $("#modal-preview-doar").removeClass("hidden");
        $("#start").hide();
    }
}