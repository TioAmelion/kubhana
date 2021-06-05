<!DOCTYPE html>
<html>
<head>
	@include('admin.includes.head')
</head>
<body oncontextmenu="return false;">
	<div class="wrapper">
		@include('admin.includes.navbarSite')
		
		@yield('conteudo')

		@auth
		{{-- MODAL DA INSTITUIÇÃO --}}
		<div class="post-popup post-popupi job_post">
			<div class="post-project">
				<h3>Publicar</h3>
				<div class="post-project-fields">
					<form id="form-publicacao">

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
								<!-- <input type="file" id="imagem" name="imagem" value="" placeholder=""> -->
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
                    <form id="form-doacao">
						<div class="row">
							<div class="col-lg-12">
								<input type="text" id="textoDoacao" name="textoDoacao" placeholder="O que pretende doar">
								<span id="textoDoacaoError" style="color: red"></span>
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select name="categoria">
										<option>Categorias</option>
										<option value="urgencia">Produtos Alimenticios</option>
										<option value="nao_urgencia">Roupas</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<br>
								<input type="number" id="quantidade" name="quantidade" placeholder="Quantidade do item">
								<input type="hidden" id="instId" name="instId" value="">
								<span id="qtdDoacaoError" style="color: red"></span>
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
					<form id="form-doador">

						<div class="row">
							<div class="col-lg-12">
								<input type="text" class="text-ligth" id="titulo_doacao" name="titulo_doacao" placeholder="Título do item que pretende doar">
								<span id="titulo_doacao_erro" style="color: red"></span>
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select class="text-ligth" id="categoria_ida" name="categoria_ida">
										<option selected disabled>Selecione uma Necessidades</option>
										@foreach($cat as $c)
											<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
										@endforeach
									</select>
									<span id="categoria_doacao_erro" style="color: red"></span>
								</div>
							</div>
							<div class="row">
								<div id="data_validar">

								</div>
								<div class="col-lg-6">
									<br>
									<input type="number" id="quantidade_doacao" name="quantidade_doacao" placeholder="Quantidade do item" min="0">
									<span id="quantidade_doacao_erro" style="color: red"></span>
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
		});
	</script>

	<!-- Inicio Scrim Ajax para Publicar doação da Instituição -->

	<script>
		$('#publicar').on('click', function(element){
			element.preventDefault();

			let titulo =  $('#titulo').val()
			let categoria_id =  $('#categoria_id').val()
			let descricao =  $('#descricao').val()
				// let imagem =  $('#imagem').val()
			let _token =   $('meta[name="csrf-token"]').attr('content')
				
			console.log(titulo, categoria_id, descricao, _token);

			$.ajax({
				url: "/publicar",
				type: "POST",
				data: {
					titulo: titulo,
					categoria_id: categoria_id,
					descricao: descricao,
					_token: _token
				},
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
						//$.inArray(response.erro, ["O campo titulo é obrigatório."]);
						switch (response.erro[0]) {
							case "O campo titulo é obrigatório.":
								$('#titulo').addClass("border border-danger");
								break;

							case "O campo categoria id é obrigatório.":
								$('#categoria_id').addClass("border border-danger");
								break;
						
							case "O campo descricao é obrigatório.":
								$('#descricao').addClass("border border-danger");
								break;

							default:
								break;
						}
					    toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
					}
				}
			});
			document.getElementById("form-publicacao").reset();
		});
	</script>

	<!-- Fim do Scrim Ajax para Publicar doação da Instituição -->

	<!-- Inicio do Scrim Ajax para Publicar doação do User -->
	<script>
		$('#doar_people').on('click', function(element){
			element.preventDefault();

			let titulo =  $('#titulo_doacao').val()
			let categoria_id =  $('#categoria_ida').val()
			let data_expiracao =  $('#data_expiracao').val()
			let quantidade_doacao =  $('#quantidade_doacao').val()
			let muito_bom_estado =  $('#muito_bom_estado').val()
			let boa_condicao =  $('#boa_condicao').val()
			let condicao_intermediaria =  $('#condicao_intermediaria').val()
			let condicao_ruim =  $('#condicao_ruim').val()
			let local_doacao =  $('#local_doacao').val()
			let descricao =  $('#descricao_doacao').val()
			let imagem =  $('#imagem').val()
			let estado_item = null

		
			if (document.getElementById("muito_bom_estado").checked) {
				estado_item = muito_bom_estado;				
			} else if (document.getElementById("boa_condicao").checked) {
				estado_item = boa_condicao;		
			} else if (document.getElementById("condicao_intermediaria").checked) {
				estado_item = condicao_intermediaria;	
			} else if (document.getElementById("condicao_ruim").checked) {
			  	estado_item = condicao_ruim;	
			}

			//let descricao =  $('#descricao_doacao').val()
				// let imagem =  $('#imagem').val()
			let _token =   $('meta[name="csrf-token"]').attr('content')
				
			console.log(titulo, categoria_id, descricao,data_expiracao,quantidade_doacao,estado_item,local_doacao, _token);

			$.ajax({
				url: "/publicarUser",
				type: "POST",
				data: {
					titulo: titulo,
					categoria_id: categoria_id,
					descricao: descricao,
					data_expiracao: data_expiracao,
					quantidade_doacao: quantidade_doacao, 
					estado_item: estado_item, 
					local_doacao: local_doacao, 					
					_token: _token
				},
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
						$('#titulo_doacao_erro').text(response.erro[0]);
						$('#categoria_doacao_erro').text(response.erro[1]);
						$('#local_doacaoError').text(response.erro[2]);
						$('#descricao_doacaoError').text(response.erro[3]);

						toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
					}
				}
			});
			//Limpar dos dados do form
			document.getElementById("form-doador").reset();
form-doacao
		});
	</script>

	<!-- Fim do Scrim Ajax para Publicar doação do User -->

	<script>
		$('#doar').on('click', function(element){

			element.preventDefault();

			let textoDoacao =  $('#textoDoacao').val();
			let quantidade =  $('#quantidade').val();
			let instId =  $('#instId').val();
			let _token =   $('meta[name="csrf-token"]').attr('content');
				
			console.log(textoDoacao, instId, quantidade, _token);

			$.ajax({
				url: "/doacao", 
				type: "POST",
				data: {
					textoDoacao: textoDoacao,
					quantidade: quantidade,
					instId: instId,
					_token: _token
				},
				dataType: "json",
				success: function(response) {

					console.log('Dar res: ', response);

					if(response.mensagem && response.dados){
					    toastr.success(response.mensagem, 'Doação!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
					        timeOut: 5000, onHidden: function () {
					            window.location.reload();
					        }  
						});

					}else {   
						$('#textoDoacaoError').text(response.erro[0]);
						$('#qtdDoacaoError').text(response.erro[1]);

					    toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
					}
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
	<!-- ******************************************************** -->
	
</body>
<script>
	'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'}),_trfd.push({'ap':'cpsh'},{'server':'a2plcpnl0235'}) 
</script>
<script src='assets/img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js'></script>

</html>