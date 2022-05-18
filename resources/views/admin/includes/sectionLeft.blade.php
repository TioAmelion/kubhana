<div class="col-lg-3 col-md-4 pd-left-none no-pd">
	<div class="main-left-sidebar no-margin">
		<div class="suggestions full-width">
			<div class="sd-title">
				<h3>Doações da Semana</h3>
				<i class="la la-ellipsis-v"></i>
			</div><!--sd-title end-->
			<div class="suggestions-list">
				@foreach ($doacoes as $doacao)
					<div class="suggestion-usd">
					<img src="assets/images/resources/s1.png" alt="">
					<div class="sgt-text">
						<h4>Centro Infantil</h4>
						<span>{{$doacao->descricao}}</span>
					</div>
				</div>
				<div class="view-more">
					<a href="#" title="">Ver mais</a>
				</div>
				@endforeach
			</div><!--suggestions-list end-->
		</div><!--suggestions end-->
	</div><!--main-left-sidebar end-->
</div>