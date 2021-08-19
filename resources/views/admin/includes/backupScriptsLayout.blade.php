<script>
    $(function () {

        $.ajax({
            url: "/classificacao",
            type: "GET",
            dataType: "json",
            success: function(response) {

                var erro4 = jQuery.inArray({{Auth::user()->id}}, response);
                console.log('classificacao: ', response, erro4);

                // response.dados.forEach(element => {
                    // if (erro4 == -1) {
                    // 	console.log('classificacao id: ',  element.user_id,  {{Auth::user()->id}});

                    // 	$('#verificar').text('votou')
                    // } else {
                    // 	$('#verificar').text('votar')
                    // }
                // });
                
            }
        });			
    });
</script>
<script>
    $(function () {
        $('.alimentos').css('background-image', 'url(assets/images/vegetable.svg)');
        $('.alimentos').css('visibility', 'visible');
        $('#previewImg').hide();
    });
</script>

<!-- Inicio Scrim Ajax para Publicar doação da Instituição -->
<script>
    //Funcao para previsualizar imagem
    function previewFile(){

        var file = $('input[type=file]').get(0).files[0];
        if (file) {
            var reader = new FileReader(); 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
            $('#previewImg').show();
            reader.readAsDataURL(file);				
        }
    }

    $('#form-publicacao').on('submit', function(element){
        element.preventDefault();
        
        $.ajax({
            url: "/publicar",
            type: "POST",
            data: new FormData(this),
            contentType: false,
               processData: false,
            dataType: "json",
            success: function(response) {

                console.log('Dar res: ', response);

                if(response.mensagem){
                    toastr.success(response.mensagem, 'Publicar!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
                        timeOut: 2000, onHidden: function () {
                            window.location.reload();
                        } 
                    });
                }else { 

                    var erro1 = jQuery.inArray("O campo titulo é obrigatório.", response.erro);
                    var erro2 = jQuery.inArray("O campo categoria id é obrigatório.", response.erro);
                    var erro3 = jQuery.inArray("O campo descricao é obrigatório.", response.erro);

                    if (erro1 > -1 )
                        $('#titulo').addClass('border border-danger');

                    if (erro2 > -1 )
                    $('#categoria_id').addClass('border border-danger');	

                    if (erro3 > -1 )
                        $('#descricao').addClass('border border-danger');		

                    toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
                }
            }
        });
        document.getElementById("form-publicacao").reset();
    });

    //------------------------------------------------------

//** Script para Remover a class Danger dos input da modal Instituição **//
    $('#titulo').keyup(function(){
        $( "#titulo" ).removeClass( "border border-danger" );

    });

    $(function() {
        $('#categoria_id').click(function(event) {
            $( "#categoria_id" ).removeClass( "border border-danger" );
        });
    });

    $('#descricao').keyup(function(){
        $( "#descricao" ).removeClass( "border border-danger" );
    });
</script>
<!-- Fim do Scrim Ajax para Publicar doação da Instituição -->

<!-- Inicio do Scrim Ajax para Publicar doação do User -->
<script>
    $('#form-doador').on('submit', function(element){
        element.preventDefault();

        $.ajax({
            url: "/publicarUser",
            type: "POST",
            data: new FormData(this),
            contentType: false,
               processData: false,
            dataType: "json",
            success: function(response) {
                
                console.log('Dar res: ', response);
                
                // if(response.mensagem){
                // 	toastr.success(response.mensagem, 'Publicar!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
                // 		timeOut: 2000, onHidden: function () {
                // 			window.location.reload();
                // 		} 
                // 	});

                // 	Limpar dos dados do form
                // 	document.getElementById("form-doador").reset();

                // }else if(response.erro){
                
                // 	var erro4 = jQuery.inArray("O campo titulo doacao é obrigatório.", response.erro);
                // 	var erro5 = jQuery.inArray("O campo categoria id é obrigatório.", response.erro);
                // 	var erro6 = jQuery.inArray("O campo local doacao é obrigatório.", response.erro);
                // 	var erro7 = jQuery.inArray("O campo descricao é obrigatório.", response.erro);
                // 	var erro8 = jQuery.inArray("O campo quantidade doacao é obrigatório", response.erro);

                // 	if (erro4 > -1 )
                // 		$('#titulo_doacao').addClass('border border-danger');

                // 	if (erro5 > -1 )
                // 	$('#categoria_id_doador').addClass('border border-danger');	

                // 	if (erro6 > -1 )
                // 		$('#local_doacao').addClass('border border-danger');	

                // 	if (erro7 > -1 )
                // 		$('#descricao_doacao').addClass('border border-danger');

                // 	if (erro8 > -1 )
                // 		$('#quantidade_doacao').addClass('border border-danger');	

                // 	toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });

                // } else if(response.mensagem && response.erro) {
                // 	toastr.error(response.erro, 'Erro ao publicar!', { "timeOut": 5000 });
                // }
            }
        });

    });

//** Script para Remover a class Danger dos input da modal Instituição **//
    $('#titulo_doacao').keyup(function(){
        $( "#titulo_doacao" ).removeClass( "border border-danger" );

    });

    $(function() {
        $('#categoria_ida').click(function(event) {
            $( "#categoria_ida" ).removeClass( "border border-danger" );
        });
    });
        
    $('#local_doacao').keyup(function(){
        $( "#local_doacao" ).removeClass( "border border-danger" );

    });

    $('#descricao_doacao').keyup(function(){
        $( "#descricao_doacao" ).removeClass( "border border-danger" );
    });
</script>
<!-- Fim do Scrim Ajax para Publicar doação do User -->

<script>
    $('#form-doacao').on('submit', function(element){
        element.preventDefault();
         
        $.ajax({
            url: "/doacao", 
            type: "POST",
            data: new FormData(this),
            contentType: false,
               processData: false,
            dataType: "json",
            success: function(response) {

                console.log('Dar res: ', response);

                if(response.mensagem && response.dados){
                    toastr.success(response.mensagem, 'Doação!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
                        timeOut: 5000, onHidden: function () {
                            window.location.reload();
                        }  
                    });

                }else if(response.erro) {

                    var erro1 = jQuery.inArray("O campo quantidade é obrigatório.", response.erro);
                    var erro2 = jQuery.inArray("O campo descricao doar é obrigatório.", response.erro);
                    var erro3 = jQuery.inArray("O campo estado é obrigatório.", response.erro);
                    
                    if (erro1 > -1 )
                        $('#quantidade').addClass('border border-danger');

                    if(erro2 > -1)
                        $('#descricaoDoar').addClass('border border-danger');
                    
                    if(erro3 > -1)
                        $('#estadoProduto').addClass('border border-danger');

                    toastr.error('Por favor corriga os erros do Formulario', 'Erro ao publicar!', { "timeOut": 5000 });
                }

                //Script para Remover a class Danger dos input da modal Doação

                $('#quantidade').keyup(function(){
                    console.log("QTD", $('#quantidade').val());
                    $( "#quantidade" ).removeClass( "border border-danger" );
                });

                $('#descricaoDoar').keyup(function(){
                    $( "#descricaoDoar" ).removeClass( "border border-danger" );
                });

                $('#estadoProduto').keyup(function(){
                    $( "#estadoProduto" ).removeClass( "border border-danger" );
                });
            }
        });
    });
    
    //PEGAR O ID DA INSTITUIÇÃO
    $('.com').on('click', function(element){
        $('#instId').val(element.currentTarget.getAttribute('id'));
        $('#nome').text(element.currentTarget.getAttribute('nomeInst'));
    })
</script>

<!-- Script para adicionar a data das categorias especificas  -->
<script>
    $(document).ready(function(){
        $('#categoria_ida').change(function(e){
            var key  = $(this).val();
            var html = '';

            if (key >= 1 && key <3 || key == 4){
                //alert('chamar data');
                $('#data_validar').empty();		
                html += '<div class="col-lg-12" id="conteudo">';
                html += '<span class="data text-muted">Data de Validade</span>';
                html += '<br>';
                html += '<input type="date" id="data_expiracao" name="data_expiracao">';
                html += '</div>';
                $('#data_validar').append(html);

            }else{
                $('#conteudo').remove();		
                
            }
            //alert(id_categoria);
        });
    });

</script>

<script>
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
</script>

<!-- SCRIPT PARA VOTAR NA PUBLICACAO -->
<script>

    $('.urgente').on('click', function(element) {
        let id = element.currentTarget.getAttribute('publicacao-id');
        let classificacao = 1;
        votarPublicacao(id, classificacao);
    });

    $('.maisUrgente').on('click', function(element) {
        let id = element.currentTarget.getAttribute('publicacao-id');
        let classificacao = 2;
        votarPublicacao(id, classificacao);
    });

    function votarPublicacao(idPublicacao, classificacao) {

        let _token =   $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            url: "/votar", 
            type: "POST",
            data: {
                publicacao_id: idPublicacao,
                classificacao: classificacao,
                _token: _token
            },
            dataType: "json",
            success: function(response) {

                console.log('Dar res: ', response);

                if(response.mensagem && response.dados){
                    toastr.success(response.mensagem, 'Votação!', { "showMethod": "slideDown", "hideMethod": "slideUp", 
                        timeOut: 5000, onHidden: function () {
                            window.location.reload();
                        }  
                    });
                }else {
                    toastr.error(response.mensagem, 'Erro ao votar!', { "timeOut": 5000 });
                }
            }
        });
    }
</script>