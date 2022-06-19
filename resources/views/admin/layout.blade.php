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

		<!-- MODAL DA INSTITUIÇÃO-->
		<div class="modal fade" id="ajax-publicacao-modal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="publicacaoCrudModal"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" id="publicacaoForm" name="publicacaoForm" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="publicacao_id" id="publicacao_id">
							<div class="form-group">
								<input type="text" class="form-control text-ligth" id="titulo" name="titulo" placeholder="Título">
								<span id="tituloError" style="color: red"></span>
							</div>
							<div class="form-group">
								<select class="form-control" id="categoria_id" name="categoria_id">
									<option selected disabled>Selecione uma Necessidade</option>
									@foreach($categorias as $c)
										<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
									@endforeach
								</select>
								<span id="classificacaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<textarea class="form-control text-dark" name="descricao" id="descricao" placeholder="Descrição"></textarea>
								<span id="descricaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<input id="image" type="file" name="image" accept="image/*" onchange="readURL(this);">
								<input type="hidden" name="hidden_image" id="hidden_image">
							</div>
							<div class="form-group" style="margin-bottom: 8rem;">
								<img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" width="100" height="100">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary" id="btn-salvar" value="criar">Publicar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		{{-- MODAL DOADOR --}}
		<div class="modal fade" id="ajax-publicacao-doador-modal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="publicacaoCrudModall"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" id="publicacaoDoadorForm" name="publicacaoDoadorForm" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="publicacao_id_doador" id="publicacao_id_doador">
							<div class="form-group">
								<input type="text" class="form-control" id="titulo_doacao" name="titulo_doacao" placeholder="Título do item que pretende doar">
							</div>
							<div class="form-group">
								<select class="form-control" id="categoria_id_doador" name="categoria_id_doador">
									<option selected disabled>Selecione uma Necessidades</option>
									@foreach($categorias as $c)
										<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<input class="form-control" type="number" id="quantidade_doacao" name="quantidade_doacao" placeholder="Quantidade do item" min="0">
							</div>
							<div class="form-group estado_pergunta">
								<br>
								<span class="estado_p text-muted">Em que estado se encontra o item?</span> <br>
								<input class="form-control" type="radio" name="classificacao" id="muito_bom_estado" value="Muito_bom_estado">
								<span class="text-muted" for="muito_bom_estado">Muito bom estado</span><img src="assets/images/star.svg" height="18px">

								<input class="form-control" type="radio" name="classificacao" id="boa_condicao" value="Boa_condição">
								<span class="text-muted" for="boa_condicao">Boa condição</span><img src="assets/images/star4.svg" height="18px">

								<input class="form-control" type="radio" name="classificacao" id="condicao_intermediaria" value="Condição_intermediária">
								<span class="text-muted" for="condicao_intermediaria">Condição intermediária</span><img src="assets/images/star2.svg" height="18px">

								<input class="form-control" type="radio" name="classificacao" id="condicao_ruim" value="Condição_ruim">
								<span class="text-muted" for="condicao_ruim">Condição ruim</span><img src="assets/images/star3.svg" height="18px">

								<span id="estado_erro" style="color: red"></span>
							</div>
							<div class="form-group estado_local">
								<br> <br>
								<span class="estado_l text-muted">Local de doação</span>
								<img src="assets/images/placeholder.svg">
								<input class="form-control" type="text" id="local_doacao" name="local_doacao" placeholder="Ex: Provincia: Luanda - kilamba kiaxi, bairro palanca, rua f1, casa nº 23">
								<span id="local_doacaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<textarea class="form-control text-dark" name="descricao_doacao" id="descricao_doacao" placeholder="Descreve detalhadamente o item que quer doar"></textarea>
								<span id="descricao_doacaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<input id="image" type="file" name="image" accept="image/*" onchange="readURLL(this);">
								<input type="hidden" name="hidden_image" id="hidden_image">
							</div>
							<div class="form-group" style="margin-bottom: 8rem;">
								<img id="modal-preview-doador" src="https://via.placeholder.com/150" alt="Preview" width="100" height="100">
							</div>
							{{-- </div> --}}
							{{-- <input type="hidden" name="publicacao_id_doador" id="publicacao_id_doador">
							<div class="form-group">
								<input type="text" class="form-control" id="titulo_doacao" name="titulo_doacao" placeholder="Título do item que pretende doar">
							</div>
							<div class="form-group estado_pergunta">
								<br>
								<span id="estadoProduto" class="estado_p text-muted" id="estadoProduto">Em que estado se encontra o produto?</span> <br>
								<input class="form-control" type="radio" name="estado" id="muito_bom_estado" value="Muito bom estado">
								<span id="estadoProduto" class="text-muted" for="muito_bom_estado">Muito bom estado</span><img src="assets/images/star.svg" height="18px">

								<input class="form-control" id="estadoProduto" type="radio" name="estado" id="boa_condicao" value="Boa condição">
								<span id="estadoProduto" class="text-muted" for="boa_condicao">Boa condição</span><img src="assets/images/star4.svg" height="18px">

								<input class="form-control" type="radio" name="estado" id="condicao_intermediaria" value="Condição intermediária">
								<span id="estadoProduto" class="text-muted" for="condicao_intermediaria">Condição intermediária</span><img src="assets/images/star2.svg" height="18px">

								<input class="form-control" type="radio" name="estado" id="condição_ruim" value="Condição ruim">
								<span id="estadoProduto" class="text-muted" for="condição_ruim">Condição ruim</span><img src="assets/images/star3.svg" height="18px">
							</div>
							<div class="form-group">
								<br>
								<input class="form-control" type="number" id="quantidade" name="quantidade" placeholder="Quantidade do produto">
								<input type="hidden" id="instId" name="instId" value="">
							</div>
							<div class="form-group">
								<textarea class="form-control" id="descricaoDoar" name="descricaoDoar" placeholder="O que pretende doar" cols="3" rows="3"></textarea>
							</div>
							<div class="form-group">
								<input id="image" type="file" name="image" accept="image/*" onchange="readURLL(this);">
								<input type="hidden" name="hidden_image" id="hidden_image">
							</div>
							<div class="form-group" style="margin-bottom: 8rem;">
								<img id="modal-preview-doador" src="https://via.placeholder.com/150" alt="Preview" width="100" height="100">
							</div> --}}
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary" id="btn-salvar-d" value="criar-doacao">Publicar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal eliminar -->
		<div class="modal fade" id="ajax-eliminar-modal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="container d-flex pl-0"><img src="https://imgur.com/Kh1gwTq.png">
							<h5 class="modal-title ml-2" id="exampleModalLabel">Delete the link?</h5>
						</div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
					</div>
					<div class="modal-body">
						<p class="text-muted">Se você excluir, a publicação desaparecerá para sempre. Tem certeza de que deseja continuar?</p>
					</div>
					<div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button> <button type="button" class="btn btn-danger eliminar">Eliminar</button> </div>
				</div>
			</div>
		</div>

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

		{{-- MODAL DO DOADOR
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
										@foreach($categorias as $c)
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
		</div> --}}
        @endauth
	@include('admin.includes.script')
	<script>
		$(function() {
			$('#search').hide();
			
			$(".reaction-container").hover(function() {
				_this = $(this);
				_this.find(".reaction-box .reaction-icon").each( function(index, element) {
					setTimeout(function() {
						$(element).addClass("show");
					}, index * 100);
				});
			}, function() {
				$(".reaction-icon").removeClass("show")
			});
		})
	</script>
</body>	
<script>
	'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'}),_trfd.push({'ap':'cpsh'},{'server':'a2plcpnl0235'}) 
</script>
<script src='assets/img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js'></script>
</html>