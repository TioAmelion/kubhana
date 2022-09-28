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
						<div class="img-avatar" style="float: left">
							{!! Avatar::create($doacao->name)->setFontSize(15)->setDimension(40, 40)->setBackground('#000')->setForeground('#fff')->toSvg(); !!}
							{{-- {!! $dados->imagem ? 'assets/images/resources/us-pic.png' : Avatar::create($dados->name)->setFontSize(15)->setDimension(40, 40)->setBackground('#000')->setForeground('#fff')->toSvg(); !!} --}}
						</div>
						{{-- <img src="assets/images/resources/s1.png" alt=""> --}}
						<div class="sgt-text">
							<h4>{{$doacao->name}}</h4>
							<span>{{$doacao->descricao}}</span>
						</div>
					</div>
					<div class="view-more">
						<a href="#" class="ver-doacao" ver-doacao="{{ $doacao->id }}">Ver mais</a>
					</div>
				@endforeach
			</div><!--suggestions-list end-->
		</div><!--suggestions end-->
	</div><!--main-left-sidebar end-->
</div>