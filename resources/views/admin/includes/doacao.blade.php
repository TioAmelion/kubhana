@extends('admin.layout')

@section('conteudo')
    <div class="search-sec">
        <div class="container">
            <div class="search-box">
                <form>
                    <input type="text" name="search" placeholder="pesquisar doações">
                    <button type="submit">Pesquisar</button>
                </form>
            </div><!--search-box end-->
        </div>
    </div><!--search-sec end-->
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="filter-secs">
                                <div class="filter-heading">
                                    <h3>Filtrar</h3>
                                    <a href="#" title="">Limpar filtros</a>
                                </div><!--filter-heading end-->
                                <div class="paddy">
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Pesquisar</h3>
                                            <a href="#" title="">Limpar</a>
                                        </div>
                                        <form>
                                            <input type="text" name="search-skills" placeholder="Pesquisar">
                                        </form>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Encontrar</h3>
                                            <a href="#" title="">Limpar</a>
                                        </div>
                                        <ul class="avail-checks">
                                            <li>
                                                <input type="radio" name="cc" id="c1">
                                                <label for="c1">
                                                    <span></span>
                                                </label>
                                                <small>Doações</small>
                                            </li>
                                            <li>
                                                <input type="radio" name="cc" id="c2">
                                                <label for="c2">
                                                    <span></span>
                                                </label>
                                                <small>Doadores</small>
                                            </li>
                                            <li>
                                                <input type="radio" name="cc" id="c3">
                                                <label for="c3">
                                                    <span></span>
                                                </label>
                                                <small>Instituições</small>
                                            </li>
                                            <li>
                                                <input type="radio" name="cc" id="c3">
                                                <label for="c3">
                                                    <span></span>
                                                </label>
                                                <small>Pessoas Necessitadas</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Províncias</h3>
                                            <a href="#" title="">Limpar</a>
                                        </div>
                                        <form class="job-tp">
                                            <select>
                                                <option>Selecione a província</option>
                                                <option>Cabinda</option>
                                                <option>Huíla</option>
                                                <option>Kwanza Norte</option>
                                            </select>
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </form>
                                    </div>
                                </div>
                            </div><!--filter-secs end-->
                        </div>
                        <div class="col-lg-6">
                            <div class="main-ws-sec">
                                <div class="posts-section">
                                    @foreach($doacoes as $dados)
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
													<li><a href="#" class="chat-sms"><i class="la la-envelope"></i></a></li>
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
														@endif
													</div>
												</div>

                                                @if($dados->user_id != Auth::user()->id)
                                                    <div class="ajudar-feed" style="">
                                                        <img class="gostar" src="assets/images//ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                        <a href="#" id="solicitar-doacao" publicacaoId="{{$dados->user_id}}" nomeInst= "{{$dados->name}}" style="font-weight: 600; font-size: 18px; color:#000"> Solicitar Doação</a>
                                                    </div>
                                                @else
                                                    <div class="ajudar-feed" style="">
                                                        <img class="gostar" src="assets/images//ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                        <a href="#" publicacaoId="{{$dados->user_id}}" nomeInst= "{{$dados->name}}" style="font-weight: 600; font-size: 18px; color:#000"> Solicitar Doação</a>
                                                    </div>
                                                @endif

                                                <div class="ajudar-feed" style="">
                                                    <img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/doadores.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                    <a href="#" class="criar-nova-publicacao-doar" style="font-weight: 600; font-size: 18px; color:#000"> Solicitações {{$dados->solicitacoes}} </a>
                                                </div>

												
											</div>
										</div><!--post-bar end-->
									@endforeach
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
                        <div class="col-lg-3">
                            <div class="right-sidebar">
                                <div class="widget widget-jobs">
                                    <div class="sd-title">
                                        <h3>Pessoas que mais doam</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="jobs-list">
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Aurea Cardoso</h3>
                                                <p style="text-align: center; color:red">Ver Perfil</p>
                                            </div>
                                        </div><!--job-info end-->
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Elisabeth Adão</h3>
                                                <p style="text-align: center; color:red">Ver Perfil</p>
                                            </div>
                                        </div><!--job-info end-->
                                    </div><!--jobs-list end-->
                                </div><!--widget-jobs end-->
                            </div><!--right-sidebar end-->
                        </div>
                    </div>
                </div><!-- main-section-data end-->
            </div> 
        </div>
    </main>
@endsection
