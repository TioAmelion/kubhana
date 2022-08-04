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
														<span><img src="assets/images/clock.png" alt=""><?php print_r(explode(" ",$dados->created_at)[0]) ?></span>
													</div>
												</div>
												<div class="ed-opts">
													@if (Auth::check())
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															@if($dados->user_id == Auth::user()->id)
																<li><a href="javascript:void(0)" data-id="{{$dados->id}}" class="{{$idPessoas != null ? 'editar-publicacao-doador' : 'editar-publicacao'}}">Editar</a></li>
																<li><a href="javascript:void(0)" data-id="{{$dados->id}}" class="{{$idPessoas != null ? 'eliminar-publicacao-doador' : 'eliminar-publicacao'}}">Eliminar</a></li>
															@else
																<li><a href="javascript:void(0)" data-id="{{$dados->id}}" class="denunciar-publicacao">Denunciar</a></li>
															@endif
														</ul>
													@endif
												</div>
											</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="assets/images/placeholder.svg" style="width: 16px;"><span style="float: none">{{$dados->localizacao}}</span></li>
												</ul>
												<ul class="bk-links">
													{{-- <li><a href="#" title=""><i class="la la-bookmark"></i></a></li> --}}
													<li><a href="#" title=""><i class="la la-envelope"></i></a></li>
												</ul>
											</div>
											<div class="job_descp">
												<h3>{{$dados->titulo}}</h3>

												@if ($dados->quantidade_item)
													<ul class="job-dt">
														<li><span>Quantidade a Doar: {{$dados->quantidade_item}}</span></li>
													</ul>
												@endif
												
												<p>{{$dados->texto}}</p>
												@if($dados->imagem) <img class="img-publicacao" src="images/{{$dados->imagem}}" style="object-fit: fill;height: 400px;width: 500px;" alt=""> @endif
											</div>
											
											<div class="job-status-bar">
												<div class="reaction-geral">
													<div class="like-com">
														@if (Auth::check())
															<div class="reaction-container">
																{{-- Select para verificar se o usuario logado votou na publicação --}}
																@php
																	$verificar = App\Models\Classificacao_publicacao::where('publicacao_id', '=', $dados->id)->where('user_id', '=' ,Auth::user()->id)->get();	
																@endphp
																{{-- fim --}}

																@if ($verificar->count() < 1)
																	<img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/like.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
																	<a href="#" style="font-weight: 600; font-size: 18px; color:#000"> Gostar</a>
																@else
																	@foreach ($verificar as $item)

																		@if ($item->classificacao == 1)
																			<img class="apoio" id="apoio" name="apoio" publicacao-id="{{$dados->id}}" src="assets/images/apoio.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
																			<a href="#" style="color: #BBA9D1; font-weight: 600; font-size: 18px">&nbsp;&nbsp;Apoio</a>

																		@elseif($item->classificacao == 2)
																			<img class="apoio" id="apoio" name="apoio" publicacao-id="{{$dados->id}}" src="assets/images/gosto.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
																			<a href="#" style="color: #1485BD; font-weight: 600; font-size: 18px">&nbsp;&nbsp;Gosto</a>

																		@else($item->classificacao == 3)
																			<img class="apoio" id="apoio" name="apoio" publicacao-id="{{$dados->id}}" src="assets/images/parabens.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
																			<a href="#" style="color: #6DAE4D; font-weight: 600; font-size: 18px">&nbsp;&nbsp;Parabéns</a>
																		@endif
																	@endforeach
																@endif
																<div class="reaction-box">
																	<div class="reaction-icon">
																		<label>Apoio</label>
																		<img class="apoio" id="apoio" name="apoio" publicacao-id="{{$dados->id}}" src="assets/images/apoio.png" alt="">
																	</div>
																	<div class="reaction-icon">
																		<label>Gostar</label>
																		<img class="gostar" id="gostar" name="gostar" publicacao-id="{{$dados->id}}" src="assets/images/gosto.png" alt="">
																	</div>
																	<div class="reaction-icon">
																		<label>Parabéns</label>
																		<img class="parabens" id="parabens" name="parabens" publicacao-id="{{$dados->id}}" src="assets/images/parabens.png" alt="">
																	</div>
																</div>
															</div>
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
													</div>
												</div>

												@if($dados->tipo_publicacao == "ajuda")

													<div class="ajudar-feed" style="">
														<img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
														<a href="#" class="criar-nova-publicacao-doar" style="font-weight: 600; font-size: 18px; color:#000"> Doar</a>
													</div>
													<div class="ajudar-feed" style="">
														<img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
														<a href="#" class="criar-nova-publicacao-doar" id="{{$dados->user_id}}" nomeInst= "{{$dados->name}}" style="font-weight: 600; font-size: 18px; color:#000"> Doações</a>
													</div>

												@endif

												@if($dados->tipo_publicacao == "doacao")

													<div class="ajudar-feed" style="">
														<img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images//ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
														<a href="#" class="chat-sms" style="font-weight: 600; font-size: 18px; color:#000"> Solicitar Doação</a>
													</div>
													<div class="ajudar-feed" style="">
														<img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/doadores.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
														<a href="#" class="criar-nova-publicacao-doar" style="font-weight: 600; font-size: 18px; color:#000"> Solicitações</a>
													</div>

												@endif
												
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

	<div class="chatbox-list">
		<div class="chatbox">
			<div class="chat-mg">
				<a href="#" title=""><img src="assets/images/resources/usr-img1.png" alt=""></a>
				<span>2</span>
			</div>
			<div class="conversation-box">
				<div class="con-title mg-3">
					<div class="chat-user-info">
						<img src="images/resources/us-img1.png" alt="">
						<h3>John Doe <span class="status-info"></span></h3>
					</div>
					<div class="st-icons">
						<a href="#" title=""><i class="la la-cog"></i></a>
						<a href="#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
						<a href="#" title="" class="close-chat"><i class="la la-close"></i></a>
					</div>
				</div>
				<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
					<div class="chat-msg">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
						<span>Sat, Aug 23, 1:10 PM</span>
					</div>
					<div class="date-nd">
						<span>Sunday, August 24</span>
					</div>
					<div class="chat-msg st2">
						<p>Cras ultricies ligula.</p>
						<span>5 minutes ago</span>
					</div>
					<div class="chat-msg">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
						<span>Sat, Aug 23, 1:10 PM</span>
					</div>
				</div><!--chat-list end-->
				<div class="typing-msg">
					<form>
						<textarea placeholder="Type a message here"></textarea>
						<button type="submit"><i class="fa fa-send"></i></button>
					</form>
					<ul class="ft-options">
						<li><a href="#" title=""><i class="la la-smile-o"></i></a></li>
						<li><a href="#" title=""><i class="la la-camera"></i></a></li>
						<li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
					</ul>
				</div><!--typing-msg end-->
			</div>
		</div>
	</div>

	@auth
		<!-- MODAL MENSAGEM-->
		<div class="modal fade" id="ajax-mensagem-modal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="publicacaoCrudModal">Nome da pessoa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
							<div class="chat-msg">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
								<span>Sat, Aug 23, 1:10 PM</span>
							</div>
							<div class="date-nd">
								<span>Sunday, August 24</span>
							</div>
							<div class="chat-msg st2">
								<p>Cras ultricies ligula.</p>
								<span>5 minutes ago</span>
							</div>
							<div class="chat-msg">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
								<span>Sat, Aug 23, 1:10 PM</span>
							</div>
						</div><!--chat-list end-->
						<div class="typing-msg">
							<form>
								<textarea placeholder="Type a message here"></textarea>
								<button type="submit"><i class="fa fa-send"></i></button>
							</form>
							<ul class="ft-options">
								<li><a href="#" title=""><i class="la la-smile-o"></i></a></li>
								<li><a href="#" title=""><i class="la la-camera"></i></a></li>
								<li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

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
								<input class="form-control" type="text" id="quantidade_doacao" name="quantidade_doacao" placeholder="Quantidade do produto que pretende doar" min="1" autocomplete="off">
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
								<select class="form-control" id="estado_doacao" name="estado_doacao">
									<option selected disabled>Estado da Doação</option>
									<option class="alimentos" value="disponivel">Disponível</option>
									<option class="alimentos" value="indisponivel">Indisponível</option>
								</select>
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

		{{-- MODAL PARA DOAR --}}
		<div class="modal fade" id="ajax-publicacao-doar-modal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="publicacaoCrudModalll"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" id="publicacaoDoarForm" name="publicacaoDoarForm" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="publicacao_id_doar" id="publicacao_id_doar">
							<input type="hidden" id="instituicao_id" name="instituicao_id" value="">
							<div class="form-group estado_pergunta">
								<span id="estadoProduto" class="estado_p text-muted" id="estadoProduto">Em que estado se encontra o produto?</span> <br>
								<br>
								<input class="form-control" type="radio" name="estado" id="muito_bom_estado" value="Muito_bom_estado">
								<span id="estadoProduto" class="text-muted" for="muito_bom_estado">Muito bom estado</span><img src="assets/images/star.svg" height="18px">

								<input class="form-control" id="estadoProduto" type="radio" name="estado" id="boa_condicao" value="Boa_condição">
								<span id="estadoProduto" class="text-muted" for="boa_condicao">Boa condição</span><img src="assets/images/star4.svg" height="18px">

								<input class="form-control" type="radio" name="estado" id="condicao_intermediaria" value="Condição_intermediária">
								<span id="estadoProduto" class="text-muted" for="condicao_intermediaria">Condição intermediária</span><img src="assets/images/star2.svg" height="18px">

								<input class="form-control" type="radio" name="estado" id="condição_ruim" value="Condição_ruim">
								<span id="estadoProduto" class="text-muted" for="condição_ruim">Condição ruim</span><img src="assets/images/star3.svg" height="18px">
								<br>
								<span id="estadoProdutoErro" style="color: red; position: relative; left:3px;; top:2px"></span>
							</div>
							<div class="form-group">
								<br>
								<input class="form-control" type="number" id="quantidade" name="quantidade" placeholder="Quantidade do produto">
								<span id="quantidadeErro" style="color: red"></span>
							</div>
							<div class="form-group">
								<textarea class="form-control" id="descricaoDoar" name="descricaoDoar" placeholder="O que pretende doar" cols="3" rows="3"></textarea>
								<span id="descricaoDoarErro" style="color: red"></span>
							</div>
							<div class="form-group">
								<input id="image" type="file" name="image" accept="image/*" onchange="readURLLL(this);">
								<input type="hidden" name="hidden_image" id="hidden_image">
							</div>
							<div class="form-group" style="margin-bottom: 8rem;">
								<img id="modal-preview-doar" src="https://via.placeholder.com/150" alt="Preview" width="100" height="100">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary" id="btn-salvar-doar" value="criar-doacao">Doar</button>
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
		
	@endauth
@endsection