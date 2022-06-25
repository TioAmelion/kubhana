@extends('admin.layout')

@section('conteudo')
	<main>
		<div class="main-section">
			<div class="container">
				<div class="main-section-data">
					<div class="row">
						@include('admin.includes.sectionLeft')
						<div class="col-lg-6 col-md-6 no-pd">
							<div class="main-ws-sec">
								@auth
									<div class="post-topbar">
										<div class="user-picy">
											<img src="assets/images/resources/user-pic.png" alt="">
										</div>
										<div class="post-st">
											<ul>									
												@if($idPessoas != null)
													<li>
														<a class="post-jbb active" href="javascript:void(0)" title="" id="criar-nova-publicacao-doador">
															Doe um item
														</a>
													</li>
												@else
													<li><a class="post-jbb active" href="javascript:void(0)" id="criar-nova-publicacao">Publique uma Necessidade</a></li>
												@endif
											</ul>
										</div><!--post-st end-->
							
									</div><!--post-topbar end-->
								@endauth
								<div class="posts-section">
									@foreach($pub as $dados)
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<div class="img-avatar" style="float: left">
														{!! Avatar::create($dados->name)->setFontSize(15)->setDimension(40, 40)->setBackground('#000')->setForeground('#fff')->toSvg(); !!}
														{{-- {!! $dados->imagem ? 'assets/images/resources/us-pic.png' : Avatar::create($dados->name)->setFontSize(15)->setDimension(40, 40)->setBackground('#000')->setForeground('#fff')->toSvg(); !!} --}}
													</div>
													{{-- <img src="assets/images/resources/us-pic.png" alt=""> --}}
													<div class="usy-name" data-id="{{$dados->user_id}}" style="cursor: pointer">
														<h3>{{$dados->name}}</h3>
														<span><img src="assets/images/clock.png" alt="">{{$dados->data}}</span>
													</div>
												</div>
												<div class="ed-opts">
													@if (Auth::check())
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															@if($dados->user_id == Auth::user()->id)
																<li><a href="javascript:void(0)" data-id="{{$dados->id}}" class="{{$idPessoas != null ? 'editar-publicacao-doador' : 'editar-publicacao'}}">Editar</a></li>
																<li><a href="javascript:void(0)" data-id="{{$dados->id}}" class="{{$idPessoas != null ? 'eliminar-publicacao-doador' : 'eliminar-publicacao'}}">Eliminar</a></li>
															@endif
															<li><a href="javascript:void(0)" data-id="{{$dados->id}}" class="denunciar-publicacao">Denunciar</a></li>
														</ul>
													@endif
												</div>
											</div> 
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="images/icon8.png" alt=""><span>{{--$dados->classificacao--}}</span></li>
												</ul>
												<ul class="bk-links">
												</ul>
											</div>
											<div class="job_descp">
												<h3>{{$dados->titulo}}</h3>
												<p><img src="assets/images/placeholder.svg" style="width: 18px;">{{$dados->localizacao}}</p>
												<p>{{$dados->texto}}</p>
												@if($dados->imagem) <img class="img-publicacao" src="images/{{$dados->imagem}}" style="object-fit: fill;height: 400px;width: 500px;" alt=""> @endif
											</div>
											<div class="job-status-bar">
												@if (Auth::check())
													<ul class="like-com">
														<li class="reaction-container">

														{{-- Select para verificar se o usuario logado votou na publicação --}}
														@php
															$verificar = App\Models\Classificacao_publicacao::where('publicacao_id', '=', $dados->id)->where('user_id', '=' ,Auth::user()->id)->get();	
														@endphp
														{{-- fim --}}

														@if ($verificar->count() < 1)

															<a href="#"><i class="la la-heart"> votar</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</a>
															<span>{{$dados->votos ? $dados->votos : ''}}</span>
														
															@else

														<a href="#"><i class="la la-heart" style="color: red"> {{ $dados->votos > 1 ? 'você e outras pessoas votaram' : 'você votou' }} </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</a>
														<span>{{$dados->votos ? $dados->votos : ''}}</span>
														
														@endif
															
															<div class="reaction-box">
																<div class="reaction-icon">
																	<label>urgente</label>
																	<img class="urgente" id="urgente" name="urgente" publicacao-id="{{$dados->id}}" src="assets/images/reactions_wow.png" alt="">
																</div>
																<div class="reaction-icon">
																	<label>mais urgente</label>
																	<img class="maisUrgente" id="mais urgente" name="mais urgente" publicacao-id="{{$dados->id}}" src="assets/images/reactions_sad.png" alt="">
																</div>
															</div>
														</li>
														<li>
															<a href="#" title="" id="{{$dados->user_id}}" nomeInst= "{{$dados->name}}" class="com post_project"><img src="assets/images/heart.svg" height="18px"></a>
														</li>
														<li> </li>
													</ul>
												@else
												<ul class="like-com">
													<li class="reaction-container">
														<a href="{{route('login')}}"><i class="la la-heart"> Votar</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</a>
														<span>{{$dados->votos ? $dados->votos : 0}}</span>
													</li>
													<li><a href="{{route('login')}}" title="" class="comm post_projectt" style="position: relative; top: -5px;"><img src="assets/images/heart.svg" height="18px"></a></li>
													<li> </li>
												</ul>
												@endif
												<a><i class="la la-eye"></i>Ajudas</a>
											</div>
										</div><!--post-bar end-->
									@endforeach

									<div class="top-profiles">
										<div class="pf-hd" style="background-color: white">
											<h3>Instituições Precisando de Ajuda</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="profiles-slider">
											@foreach ($instituicao as $item)
												<div class="user-profy">
													<img src="images/resources/user1.png" alt="">
													<h3>{{$item->nome_instituicao}}</h3>
													<span>Lar de Idosos</span>
													<ul>
														<li><a href="#" title="" class="followw">Doar</a></li>
													</ul>
													<a href="#" title="">Ver mais</a>
												</div><!--user-profy end-->
											@endforeach
										</div><!--profiles-slider end-->
									</div><!--top-profiles end-->
									<div class="posty">
									</div><!--posty end-->
									<div class="process-comm">
										<div class="spinner">
											<div class="bounce1"></div>
											<div class="bounce2"></div>
											<div class="bounce3"></div>
										</div>
									</div><!--process-comm end-->
								</div><!--posts-section end-->
							</div><!--main-ws-sec end-->
						</div>
						@include('admin.includes.sectionRigth')
					</div>
				</div><!-- main-section-data end-->
			</div>
		</div>		
	</main>

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
								<input type="text" class="form-control" id="titulo_doacao" name="titulo_doacao" placeholder="Título do produto que pretende doar">
								<span id="titulo_doacaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<select class="form-control" id="categoria" name="categoria">
									<option selected disabled>Selecione uma Categoria</option>
									@foreach($categorias as $c)
										<option class="alimentos" value="{{$c->id}}">{{$c->nome_categoria}}</option>
									@endforeach
								</select>
								<span id="categoria_id_doadorError" style="color: red"></span>
							</div>
							<div class="form-group">
								<input class="form-control" type="number" id="quantidade_doacao" name="quantidade_doacao" placeholder="Quantidade do produto que pretende doar" min="1" autocomplete="off">
								<span id="quantidade_doacaoError" style="color: red"></span>
							</div>
							<div class="form-group estado_pergunta">
								<br>
								<span class="estado_p text-muted">Em que estado se encontra o produto?</span> <br>
								<br>
								<input class="form-control" type="radio" name="estado_produto" id="muito_bom_estado" value="Muito_bom_estado">
								<span class="text-muted" for="muito_bom_estado">Muito bom estado</span><img src="assets/images/star.svg" height="18px">

								<input class="form-control" type="radio" name="estado_produto" id="boa_condicao" value="Boa_condição">
								<span class="text-muted" for="boa_condicao">Boa condição</span><img src="assets/images/star4.svg" height="18px">

								<input class="form-control" type="radio" name="estado_produto" id="condicao_intermediaria" value="Condição_intermediária">
								<span class="text-muted" for="condicao_intermediaria">Condição intermediária</span><img src="assets/images/star2.svg" height="18px">

								<input class="form-control" type="radio" name="estado_produto" id="condicao_ruim" value="Condição_ruim">
								<span class="text-muted" for="condicao_ruim">Condição ruim</span><img src="assets/images/star3.svg" height="18px">
								<br>
								<span id="estado_erro" style="color: red; position: relative; left:3px;; top:2px"></span>
							</div>
							<div class="form-group estado_local">
								<br> <br>
								<span class="estado_l text-muted">Local de doação</span>
								<img src="assets/images/placeholder.svg">
								<input class="form-control" type="text" id="local_doacao" name="local_doacao" placeholder="Ex: Provincia: Luanda - kilamba kiaxi, bairro palanca, rua f1, casa nº 23">
								<span id="local_doacaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<textarea class="form-control text-dark" name="descricao_doacao" id="descricao_doacao" placeholder="Descreve detalhada do produto que quer doar"></textarea>
								<span id="descricao_doacaoError" style="color: red"></span>
							</div>
							<div class="form-group">
								<input id="image" type="file" name="image" accept="image/*" onchange="readURLL(this);">
								<input type="hidden" name="hidden_image" id="hidden_image">
							</div>
							<div class="form-group" style="margin-bottom: 8rem;">
								<img id="modal-preview-doador" src="https://via.placeholder.com/150" alt="Preview" width="100" height="100">
							</div>
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

		<!-- Modal eliminar doador -->
		<div class="modal fade" id="ajax-eliminar-modall" aria-hidden="true">
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
					<div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button> <button type="button" class="btn btn-danger eliminar-doador">Eliminar</button> </div>
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
	@endauth
@endsection