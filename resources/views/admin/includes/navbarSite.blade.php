<header>
	<div class="container">
		<div class="header-data">
			<div class="logo">
				<a href="#" title=""><img src="assets/images/logo.png" alt=""></a>
			</div><!--logo end-->
			<div class="search-bar">
				<form>
					<input type="text" name="search-g" id="search-g" placeholder="pesquisar...">
					<button type="submit"><i class="la la-search"></i></button>
				</form>
				<div id="result-search"></div>				
			</div><!--search-bar end-->
			<nav>
				<ul>
					<li>
						<a href="#" title="">
							<span><img src="assets/images/icon1.png" alt=""></span>
							Home
						</a>
					</li>
					<li>
						<a href="/instituicoes" title="">
							<span><img src="assets/images/icon2.png" alt=""></span>
							Instituições
						</a>
						<ul>
							<li><a href="#" title="">Lares</a></li>
							<li><a href="assets/company-profile.html" title="">Centros</a></li>
						</ul> 
					</li>
							<li>
								<a href="/" title="">
									<span><img src="assets/images/icon4.png" alt=""></span>
									Doações
								</a>
							</li>
								<ul>
									<li><a href="#" title="">Lares</a></li>
									<li><a href="assets/images/company-profile.html" title="">Centros</a></li>
								</ul> 
							</li>
							<li>
								<a href="#" title="">
									<span><img src="assets/images/icon3.png" alt=""></span>
									Doadores
								</a>
							</li>
							<li>
								<a href="#" title="" class="not-box-open">
									<span><img src="assets/images/icon7.png" alt=""></span>
									Notificações
								</a>
								<div class="notification-box">
									<div class="nt-title">
										<h4>Definções</h4>
										<a href="#" title="">Limpar tudo</a>
									</div>
									<div class="nott-list">
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="images/resources/ny-img1.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="view-all-nots">
						  					<a href="#" title="">View All Notification</a>
						  				</div>
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li>
							@auth
								<li>
								</li>
							@else
								<li>
									<a href="{{ route('login') }}" title="">
										<span><img src="assets/images/icon4.png" alt=""></span>
										Login
									</a>
								</li>
							@endauth
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn">
						<a href="#" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
				</ul>
			</nav><!--nav end-->
			@auth
				<div class="user-account">
				<div class="user-info" style="width: 260px">
					<img src="assets/images/resources/user.png" alt="">
					<a href="#" class="dropdown-toggle" title="">{{ Auth::user()->name}}</a>
					{{-- <i class="la la-sort-down"></i> --}}
				</div>
				<div class="user-account-settingss">
					<ul class="us-links">
						<li><a href="/perfil" title="">Perfil</a></li>
						<li><a href="#" title="">Privacidade</a></li>
						<li><a href="#" title="">Termos & Condições</a></li>
					</ul>
                <!-- Authentication -->
				<h3 class="tc"><a href="/logout" title="">Sair</a></h3>
				</div><!--user-account-settingss end-->
			</div>
			@endauth
		</div><!--header-data end-->
	</div>
	{{-- @include('admin.includes.script') --}}
	{{-- <script>
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
	</script> --}}
</header>