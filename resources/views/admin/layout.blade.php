<!DOCTYPE html>
<html>
<head>
	@include('admin.includes.head')
</head>
<body oncontextmenu="return false;">
	{{-- style="background: #000" --}}
	<div class="wrapper">
		@include('admin.includes.navbarSite')
		@yield('conteudo')
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