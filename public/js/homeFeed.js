$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".chat-sms").on("click", function(e){

        destinatario = e.currentTarget.getAttribute('mensagem-id');

        nomeDestinatario = e.currentTarget.getAttribute('destinatario');

        document.cookie = "conversa-id=" +destinatario;
        document.cookie = "nome=" +nomeDestinatario;
        window.location.href = "http://127.0.0.1:8000/mensagens";
        
        // $("#ajax-mensagem-modal").modal('show');
        // $.get("mensagens/" + destinatario, (res)=> {
        //     console.log(res);

        //     $('.mensagens > .listar-mensagens').remove();
            
        //     res.data.forEach(element => {
        //         if (element.origem == 5) {
        //             $('.mensagens').append(
        //                 '<div class="listar-mensagens">'+
        //                     '<div class="origem">'+
        //                         '<p>'+element.texto+'</p>'+
        //                     '</div>'+
        //                 '</div>'
        //             );
        //         } else if(element.destino == destinatario) {
        //             $('.mensagens').append(
        //                 '<div class="listar-mensagens">'+
        //                     '<div class="origem">'+
        //                         '<p>'+element.texto+'</p>'+
        //                     '</div>'+
        //                 '</div>'
        //             );
        //         }
        //     });
        // })
    });

    $('#mensagem_texto').keyup(function(e){
        $('#btn-salvar-mensagem').removeAttr('disabled')
        $('#validar_mensagem').html('')
    }); 

    $("#mensagemForm").on("submit", function (element) {
        element.preventDefault();

        if($('#mensagem_texto').val().length == 0){
            $('#btn-salvar-mensagem').attr('disabled', true)
            $('#validar_mensagem').html('Campo obrigatório.')

        } else {           

            $.ajax({
                url: "/enviar-mensagem",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "json",
                success: (response) => {
                    console.log("emviar mensagem: ", response);

                    if (response.status == 200 && response.data) {
                        $("#mensagemForm").trigger("reset");
                        $("#btn-salvar-mensagem").html("Enviando...");

                        toastr.success(" ", response.mensagem, {
                            showMethod: "slideDown",
                            hideMethod: "slideUp",
                            timeOut: 1000,
                            onHidden: function () {
                                window.location.reload();
                            },
                        });
                    } else if (response.erro) {
                        toastr.error(response.mensagem, { timeOut: 5000 });
                    }
                },
            });
        }
    });

    //Notificações
    $(".not-box-open").on("click", function(){
        listarNotificacoes();
        $(".notification-box").toggleClass("active");
    });

    setInterval(function(){
        listarNotificacoes();
    }, 5000);

    function listarNotificacoes()
    {
        $.get("/notificacoes", (res)=> {
            console.log(res);

            var html = "";

            if (res.qtdNotificacao > 0) {
                $('.qtdNotificacao').html(res.qtdNotificacao);
            } else {
                $('.qtdNotificacao').html("");
            } 

            $('.add-not > .rem-not').remove();
            $('.add-not > .all-not').remove();
            
            if(res.data.length > 0)
            {
                res.data.forEach(item => {
                    html +=    '<div class="rem-not"><div class="notfication-details">'+
                        ' <div class="noty-user-img">'+
                            '<img src="assets/images/resources/ny-img1.png" alt="">'+
                        ' </div>'+
                            '<div class="notification-info">'+
                            ' <h3><a href="#" title="">'+ item.name +'</a> '+ item.texto +'</h3>'+
                            '</div>'+
                        '</div>'+
                        '</div>'
                });

                html += '<div class="all-not"><div class="view-all-nots">'+
                        '<a href="#" title="">Ver todas as notificações</a>'+
                    '</div></div>'
                    
                $('.add-not').append(html)
                
            } else {
                $('.add-not').append('<div class="rem-not"><div class="notfication-details"><h3 style="color: #000000; font-size: 16px; font-weight: 600;">Sem notificações pra ler</h3></div></div>')
            }
        })
    }
});