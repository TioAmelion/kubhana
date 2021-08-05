<!DOCTYPE html>
<html>
<head>
	@include('admin.includes.head')
</head>
<body oncontextmenu="return false;" style="background: #000">
	<div class="wrapper">
		@include('admin.includes.navbarSite')
		
		@yield('conteudo')

		@auth
		{{-- MODAL DA INSTITUIÇÃO --}}
		<div class="post-popup post-popupi job_post">
			<div class="post-project">
				<h3>Publicar</h3>
				<div class="post-project-fields">
					<form method="POST" id="form-publicacao" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-lg-12">
								<input type="text" class="text-ligth" id="titulo" name="titulo" placeholder="Título">
								<span id="tituloError" style="color: red"></span>
							</div>
							<div class="col-lg-12">
								<div class="inp-field inst">
									<select class="text-ligth" id="categoria_id" name="categoria_id">
										<option selected disabled>Selecione uma Necessidade</option>
										@foreach($cat as $c)
										<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
										@endforeach
									</select>
									<span id="classificacaoError" style="color: red"></span>
								</div>
							</div>
							<div class="col-lg-12">
								<textarea class="text-dark" name="descricao" id="descricao" placeholder="Descrição"></textarea>
								<span id="descricaoError" style="color: red"></span>
							</div>
							<div class="col-lg-12">
								<input type="file" id="image" name="image" value="" placeholder="" onchange="previewFile()">
								<img id="previewImg" src="/examples/images/transparent.png" style="height: 100px; weight:100px" alt="">
							</div>
							<br>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" id="publicar" type="submit" value="post">Publicar</button></li>
								</ul>
							</div>
						</div>
					</form>
				</div>

				<!--post-project-fields end-->
				
				<a href="#" title="Fechar"><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		{{-- MODAL PARA DOAR --}}
		<div class="post-popup pst-pj">
			<div class="post-project">
				<h3>Ajude com a sua doação - <span style="font-weight: bold" id="nome"></span></h3>
				<div class="post-project-fields">
                    <form method="POST" id="form-doacao" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-lg-12 estado_pergunta">
								<br>
								<span id="estadoProduto" class="estado_p text-muted" id="estadoProduto">Em que estado se encontra o produto?</span> <br>
								<input class="text-muted" type="radio" name="estado" id="muito_bom_estado" value="Muito bom estado">
								<span id="estadoProduto" class="text-muted" for="muito_bom_estado">Muito bom estado</span><img src="assets/images/star.svg" height="18px">

								<input class="text-muted" id="estadoProduto" type="radio" name="estado" id="boa_condicao" value="Boa condição">
								<span id="estadoProduto" class="text-muted" for="boa_condicao">Boa condição</span><img src="assets/images/star4.svg" height="18px">

								<input class="text-muted" type="radio" name="estado" id="condicao_intermediaria" value="Condição intermediária">
								<span id="estadoProduto" class="text-muted" for="condicao_intermediaria">Condição intermediária</span><img src="assets/images/star2.svg" height="18px">

								<input class="text-muted" type="radio" name="estado" id="condição_ruim" value="Condição ruim">
								<span id="estadoProduto" class="text-muted" for="condição_ruim">Condição ruim</span><img src="assets/images/star3.svg" height="18px">
							</div>
							<div class="col-lg-6">
								<br>
								<input type="number" id="quantidade" name="quantidade" placeholder="Quantidade do produto">
								<input type="hidden" id="instId" name="instId" value="">
							</div>
							<div class="col-lg-12">
								<textarea id="descricaoDoar" name="descricaoDoar" placeholder="O que pretende doar" cols="3" rows="3"></textarea>
							</div>
							<div class="col-lg-12">
								<br>
								<ul>
									<li><button class="active" id="doar" type="submit">Doar</button></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="#" title="Fechar"><i class="la la-times-circle-o"></i></a>
			</div>
		</div>

		{{-- MODAL DO DOADOR --}}
		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Doe um item para ajudar as pessoas</h3>
				<div class="post-project-fields">
					<form method="POST" enctype="multipart/form-data" id="form-doador">
						@csrf
						<div class="row">
							<div class="col-lg-12">
								<input type="text" class="text-ligth" id="titulo_doacao" name="titulo_doacao" placeholder="Título do item que pretende doar">
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select class="text-ligth" id="categoria_id_doador" name="categoria_id_doador">
										<option selected disabled>Selecione uma Necessidades</option>
										@foreach($cat as $c)
											<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row">
								<div id="data_validar">
								</div>
								<div class="col-lg-6">
									<br>
									<input type="number" id="quantidade_doacao" name="quantidade_doacao" placeholder="Quantidade do item" min="0">
								</div>
							</div>
							<div class="col-lg-12 estado_pergunta">
								<br>
								<span class="estado_p text-muted">Em que estado se encontra o item?</span> <br>
								<input class="text-muted" type="radio" name="classificacao" id="muito_bom_estado" value="Muito bom estado">
								<span class="text-muted" for="muito_bom_estado">Muito bom estado</span><img src="assets/images/star.svg" height="18px">

								<input class="text-muted" type="radio" name="classificacao" id="boa_condicao" value="Boa condição">
								<span class="text-muted" for="boa_condicao">Boa condição</span><img src="assets/images/star4.svg" height="18px">

								<input class="text-muted" type="radio" name="classificacao" id="condicao_intermediaria" value="Condição intermediária">
								<span class="text-muted" for="condicao_intermediaria">Condição intermediária</span><img src="assets/images/star2.svg" height="18px">

								<input class="text-muted" type="radio" name="classificacao" id="condicao_ruim" value="Condição ruim">
								<span class="text-muted" for="condicao_ruim">Condição ruim</span><img src="assets/images/star3.svg" height="18px">

								<span id="estado_erro" style="color: red"></span>
							</div>
							<div class="col-lg-12 estado_local">
								<br> <br>
								<span class="estado_l text-muted">Local de doação</span>
								<img src="assets/images/placeholder.svg">
								<input type="text" id="local_doacao" name="local_doacao" placeholder="Ex: Provincia: Luanda - kilamba kiaxi, bairro palanca, rua f1, casa nº 23">
								<span id="local_doacaoError" style="color: red"></span>
							</div>
							<div class="col-lg-12">
								<textarea class="text-dark" name="descricao_doacao" id="descricao_doacao" placeholder="Descreve detalhadamente o item que quer doar"></textarea>
								<span id="descricao_doacaoError" style="color: red"></span>
							</div>
							<div class="col-lg-12">
								<input type="file" id="imagem" name="imagem" value="" placeholder="selecione a imagem do item">
							</div>
							<br>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" id="doar_people" type="submit" value="post">Doar</button></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
				<!--post-project-fields end-->
				<a href="#" title="Fechar"><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div>
        @endauth
	<!--theme-layout end-->
	{{-- @include('admin.includes.script') --}}
	<script>
		$(function () {
			$('.alimentos').css('background-image', 'url(assets/images/vegetable.svg)');
			$('.alimentos').css('visibility', 'visible');
			$('#previewImg').hide();
		});
	</script>

	<!-- Inicio Scrim Ajax para Publicar doação da Instituição -->

	<script>
		//Funcao para previsualizar imagem
		function previewFile(){

			var file = $('input[type=file]').get(0).files[0];
			if (file) {
				var reader = new FileReader(); 
				reader.onload = function(){
					$("#previewImg").attr("src", reader.result);
				}
				$('#previewImg').show();
				reader.readAsDataURL(file);				
			}
		}

		$('#form-publicacao').on('submit', function(element){
			element.preventDefault();
			
			$.ajax({
				url: "/publicar",
				type: "POST",
				data: new FormData(this),
				contentType: false,
           		processData: false,
				dataType: "json",
				success: function(response) {

					console.log('Dar res: ', response);

					if(response.mensagem){
					    toastr.success(response.mensagem, 'Publicar!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
					        timeOut: 2000, onHidden: function () {
					            window.location.reload();
					        } 
						});
					}else { 
					
						//var erro1 = $.inArray(response, ['O campo titulo é obrigatório.']);	
						//var erro1 = response.indexOf('O campo titulo é obrigatório.');
						var erro1 = jQuery.inArray("O campo titulo é obrigatório.", response.erro);
						var erro2 = jQuery.inArray("O campo categoria id é obrigatório.", response.erro);
						var erro3 = jQuery.inArray("O campo descricao é obrigatório.", response.erro);

						if (erro1 > -1 )
							$('#titulo').addClass('border border-danger');

						if (erro2 > -1 )
						$('#categoria_id').addClass('border border-danger');	

						if (erro3 > -1 )
							$('#descricao').addClass('border border-danger');		

					    toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
					}
				}
			});
			document.getElementById("form-publicacao").reset();
		});

		//------------------------------------------------------

	//** Script para Remover a class Danger dos input da modal Instituição **//

		$('#titulo').keyup(function(){
			$( "#titulo" ).removeClass( "border border-danger" );

        });

		$(function() {
			$('#categoria_id').click(function(event) {
				$( "#categoria_id" ).removeClass( "border border-danger" );
			});
    	});

		$('#descricao').keyup(function(){
			$( "#descricao" ).removeClass( "border border-danger" );

	//** ------------------------------------------------------------------ **//

        });

	</script>

	<!-- Fim do Scrim Ajax para Publicar doação da Instituição -->

	<!-- Inicio do Scrim Ajax para Publicar doação do User -->
	<script>
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
					
					console.log('Dar res: ', response);
					
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

	//** Script para Remover a class Danger dos input da modal Instituição **//

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

	</script>

	<!-- Fim do Scrim Ajax para Publicar doação do User -->

	<script>
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
		})
	</script>

	<!-- Script para adicionar a data das categorias especificas  -->
	<script>

		$(document).ready(function(){
			$('#categoria_ida').change(function(e){
				var key  = $(this).val();
				var html = '';

				if (key >= 1 && key <3 || key == 4){
					//alert('chamar data');
					$('#data_validar').empty();		
					html += '<div class="col-lg-12" id="conteudo">';
					html += '<span class="data text-muted">Data de Validade</span>';
					html += '<br>';
					html += '<input type="date" id="data_expiracao" name="data_expiracao">';
					html += '</div>';
					$('#data_validar').append(html);

				}else{
					$('#conteudo').remove();		
					
				}
				//alert(id_categoria);
			});
		});

	</script>
	
	<script>
		$(document).ready(function () {
			fetch_data();
			
			function fetch_data(query = '') {
				$.ajax({
					url: '{{ route('autocomplete') }}',
					type: "GET",
					data: {query: query},
					dataType: "json",
					success: function (response) {
						console.log("QUERY", response);
						$('#result-search').empty();
						$('#result-search').prepend(response);
					}
				});
			}

			$(document).on('keyup', '#search-g', function () {
				var query = $(this).val();
				console.log(query);
				fetch_data(query);
			});	
		});
	</script>

	<!-- SCRIPT PARA VOTAR NA PUBLICACAO -->
	<script>
		$('.gostar').on('click', function(element) {
			let id = element.currentTarget.getAttribute('publicacao-id');
			let classificacao = 0;
			votarPublicacao(id, classificacao);
		});

		$('.urgente').on('click', function(element) {
			let id = element.currentTarget.getAttribute('publicacao-id');
			let classificacao = 1;
			votarPublicacao(id, classificacao);
		});

		$('.maisUrgente').on('click', function(element) {
			let id = element.currentTarget.getAttribute('publicacao-id');
			let classificacao = 2;
			votarPublicacao(id, classificacao);
		})

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

					console.log('Dar res: ', response);

					if(response.mensagem && response.dados){
					    toastr.success(response.mensagem, 'Votação!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
					        timeOut: 5000, onHidden: function () {
					            window.location.reload();
					        }  
						});
					}else {
					    toastr.error(response.mensagem, 'Erro ao votar!', { "timeOut": 5000 });
					}
				}
			});
		}
	</script>
</body>
<script>
	'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'}),_trfd.push({'ap':'cpsh'},{'server':'a2plcpnl0235'}) 
</script>
<script src='assets/img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js'></script>
</html>