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
										@foreach($categorias as $c)
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
				<a href="#" title="Fechar"><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Publicar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form-publicacao" enctype="multipart/form-data">
						@csrf
						<div class="col-lg-12 form-group">
							<input type="text" class="form-control text-ligth" id="titulo" name="titulo" placeholder="Título">
							<span id="tituloError" style="color: red"></span>
						</div>
						<div class="col-lg-12 form-group">
							<div class="inp-field inst">
								<select class="form-control" id="categoria_id" name="categoria_id">
									<option selected disabled>Selecione uma Necessidade</option>
									@foreach($categorias as $c)
									<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
									@endforeach
								</select>
								<span id="classificacaoError" style="color: red"></span>
							</div>
						</div>
						<div class="col-lg-12 form-group">
							<textarea class="form-control text-dark" name="descricao" id="descricao" placeholder="Descrição"></textarea>
							<span id="descricaoError" style="color: red"></span>
						</div>
						<div class="col-lg-12 form-group">
							<input class="form-control" type="file" id="image" name="image" value="" placeholder="" onchange="previewFile()">
							<img id="previewImg" src="/examples/images/transparent.png" style="height: 100px; weight:100px" alt="">
						</div>
							<!-- <br>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" id="publicar" type="submit" value="post">Publicar</button></li>
								</ul>
							</div> -->
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary" id="publicar">Salvar</button>
				</div>
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
		</div>
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