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
														<a class="post-jb active" href="#" title="">
															<img src="assets/images/tap.svg" height="18px"> Doe um item
														</a>
													</li>
												@else
													<li><a class="post-jbd active" href="#" title=""><img src="assets/images/tap.svg" height="18px"> Publique uma Necessidade</a></li>
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
													<img src="assets/images/resources/us-pic.png" alt="">
													<div class="usy-name">
														<h3>{{$dados->name}}</h3>
														<span><img src="assets/images/clock.png" alt="">3 min ago</span>
													</div>
												</div>
												<div class="ed-opts">
													@if (Auth::check())
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Editar</a></li>
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
												<p>{{$dados->texto}}</p>
												@if($dados->image) <img class="img-publicacao" src="images/{{$dados->image}}" style="object-fit: fill;height: 400px;width: 400px;" alt=""> @endif
											</div>
											<div class="job-status-bar">
												@if (Auth::check())
													<ul class="like-com">
														<li class="reaction-container">
															<a href="#"><i class="la la-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</a>
															<span>25</span>
															<div class="reaction-box">
																<div class="reaction-icon">
																	<label>gostar</label>
																	<img class="teste" id="gostar" name="gostar" src="assets/images/reactions_love.png" alt="">
																</div>
																<div class="reaction-icon">
																	<label>urgente</label>
																	<img class="" id="urgente" name="urgente" src="assets/images/reactions_wow.png" alt="">
																</div>
																<div class="reaction-icon">
																	<label>mais urgente</label>
																	<img class="" id="mais urgente" name="mais urgente" src="assets/images/reactions_sad.png" alt="">
																</div>
															</div>
														</li>
														<li><a href="#" title="" id="{{$dados->usuario_id}}" nomeInst= "{{$dados->name}}" class="com post_project"><img src="assets/images/heart.svg" height="18px"></a></li>
														<li> </li>
													</ul>
												@else
												<ul class="like-com">
													<li class="reaction-container">
														<a href="{{route('login')}}"><i class="la la-heart"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</a>
														<span>25</span>
													</li>
													<li><a href="{{route('login')}}" title="" class="comm post_projectt" style="position: relative; top: -5px;"><img src="assets/images/heart.svg" height="18px"></a></li>
													<li> </li>
												</ul>
												@endif
												<a><i class="la la-eye"></i>Visualizou 50</a>
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
</main>
@endsection