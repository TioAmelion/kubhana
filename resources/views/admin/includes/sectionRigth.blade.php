<div class="col-lg-3 pd-right-none no-pd">
<div class="right-sidebar">

<div class="widget widget-jobs">
	<div class="sd-title">
		<h3>Centros Sem Ajudas</h3>
		<i class="la la-ellipsis-v"></i>
	</div>
	<div class="jobs-list">
		<div class="job-info">
			@foreach ($instSemAjudas as $ajuda)
				<div class="job-details">
				<h3>{{$ajuda->nome_instituicao}}</h3>
				<p>Doe alguma coisa para ajudar essa instituição</p>
			</div>
			<div class="hr-rate">
				<!-- <span>250 gostos</span> -->
			</div>
			@endforeach
		</div><!--job-info end-->
	</div><!--jobs-list end-->
</div><!--widget-jobs end-->
<div class="widget suggestions full-width">
	<div class="sd-title">
		<h3>Pessoas em Estado Crítico</h3>
		<i class="la la-ellipsis-v"></i>
	</div><!--sd-title end-->
	<div class="suggestions-list">
		@foreach ($estadoPessoa as $item)
			<div class="suggestion-usd">
					<img src="images/resources/s1.png" alt="">
					<div class="sgt-text">
						<h4>{{$item->titulo}}</h4>
						<span>{{$item->texto}}</span>
					</div>
			</div>
			<div class="view-more">
				<a href="#" title="">Ver mais</a>
			</div>
		@endforeach
	</div><!--suggestions-list end-->
</div>
</div><!--right-sidebar end-->
</div>