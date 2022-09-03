@extends('admin.layout_mensagens')

@section('conteudo')
    <section class="messages-page">
        <div class="container">
            <div class="messages-sec">
                <div class="row" style="display: flex; justify-content: center">
                    <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
                        <div class="main-conversation-box">
                            <div class="message-bar-head">
                                <div class="usr-msg-details">
                                    <div class="usr-ms-img">
                                        <img src="images/resources/m-img1.png" alt="">
                                    </div>
                                    <div class="usr-mg-info">
                                        <h3>{{$nome}}</h3>
                                        <p>Mensagens</p>
                                    </div><!--usr-mg-info end-->
                                </div>
                                <a href="#" title=""><i class="fa fa-ellipsis-v"></i></a>
                            </div><!--message-bar-head end-->
                            <div class="messages-line" style="position: inherit; overflow: auto;">
                                <div class="main-message-box">
                                    <div class="messg-usr-img">
                                        <img src="images/resources/m-img1.png" alt="">
                                    </div><!--messg-usr-img end-->
                                    <div class="message-dt">
                                        <div class="message-inner-dt img-bx">
                                            <img src="images/resources/mt-img1.png" alt="">
                                            <img src="images/resources/mt-img2.png" alt="">
                                            <img src="images/resources/mt-img3.png" alt="">
                                        </div><!--message-inner-dt end-->
                                        <span>Sat, Aug 23, 1:08 PM</span>
                                    </div><!--message-dt end-->
                                </div><!--main-message-box end-->
                                @foreach($mensagens as $mensagem)
                                    @if (Auth::check() && $mensagem->origem == Auth::user()->id)
                                        <div class="main-message-box ta-right">
                                            <div class="message-dt">
                                                <div class="message-inner-dt">
                                                    <p>{{$mensagem->texto}}</p>
                                                </div><!--message-inner-dt end-->
                                                <span>{{$mensagem->created_at}}</span>
                                            </div><!--message-dt end-->
                                            <div class="messg-usr-img">
                                                <img src="images/resources/m-img2.png" alt="">
                                            </div><!--messg-usr-img end-->
                                        </div><!--main-message-box end-->
                                    @else
                                        <div class="main-message-box st3">
                                            <div class="message-dt st3">
                                                <div class="message-inner-dt">
                                                    <p>{{$mensagem->texto}}<img src="images/smley.png" alt=""></p>
                                                </div><!--message-inner-dt end-->
                                                <span>{{$mensagem->created_at}}</span>
                                            </div><!--message-dt end-->
                                            <div class="messg-usr-img">
                                                <img src="images/resources/m-img1.png" alt="">
                                            </div><!--messg-usr-img end-->
                                        </div><!--main-message-box end-->
                                    @endif
                                @endforeach
                            </div><!--messages-line end-->
                            <div class="message-send-area">
                                <form method="POST" id="mensagemForm" name="mensagemForm" enctype="multipart/form-data">
                                    <div class="mf-field">
                                        <span id="testeId"></span>
    									<input type="hidden" id="mensagem_destino" name="mensagem_destino">
                                        <input type="text" id="mensagem_texto" name="mensagem_texto" placeholder="Digite a mensagem aqui">
                                        <button type="submit" id="btn-salvar-mensagem">Enviar</button>
                                        <br>
    									<span id="validar_mensagem" style="color: red"></span>
                                    </div>
                                    <ul>
                                        <li><a href="#" title=""><i class="fa fa-smile-o"></i></a></li>
                                        <li><a href="#" title=""><i class="fa fa-camera"></i></a></li>
                                        <li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
                                    </ul>
                                </form>
                            </div><!--message-send-area end-->
                        </div><!--main-conversation-box end-->
                    </div>
                </div>
            </div><!--messages-sec end-->
        </div>
    </section>
@endsection
