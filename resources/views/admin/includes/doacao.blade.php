@extends('admin.layout')

@section('conteudo')
    <div class="search-sec">
        <div class="container">
            <div class="search-box change-section" style="margin-bottom: 10px">

                @if (Auth::check() && Auth::user()->tipo_perfil == "instituicao")

                    <a href="" class="btn btn-danger btn-filtros">Doações</a>
                    <a href="" class="btn btn-primary btn-doacoes-receber">Doações a Receber</a>

                @else

                <a href="" class="btn btn-danger btn-filtros">Filtros</a>
                <a href="" class="btn btn-primary btn-solicitacoes">Solicitações</a>

                @endif

            </div>
            <div class="search-box search-box-div">
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
                    <div class="row post-filtros">
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
                                                    @if(Auth::check() && $dados->user_id != Auth::user()->id)
                                                        {{--<li><a href="{{ url('mensagens/'.$dados->user_id) }}" class=""><i class="la la-envelope"></i></a></li>--}}
                                                        <li><a href="#" class="chat-sms" destinatario="{{$dados->name}}" mensagem-id="{{$dados->user_id}}"><i class="la la-envelope"></i></a></li> 
                                                    @endif
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

                                            @if (Auth::check())
                                                <div class="job-status-bar">
                                                    <div class="reaction-geral">
                                                        <div class="like-com">
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
                                                        </div>
                                                    </div>
                                                    @if($dados->tipo_publicacao == "ajuda")

                                                        @if(Auth::user()->tipo_perfil == "doador")

                                                            <div class="ajudar-feed" style="">
                                                                <img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                                <a href="#" class="criar-nova-publicacao-doar" id="{{$dados->user_id}}" publicacaoDoacaoId="{{$dados->id}}" nomeInst= "{{$dados->name}}" style="font-weight: 600; font-size: 18px; color:#000"> Doar</a>
                                                            </div>

                                                        @else

                                                            <div class="ajudar-feed" style="">
                                                                <img class="gostar" publicacao-id="{{$dados->id}}" src="assets/images/ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                                <span style="font-weight: 600; font-size: 18px; color:#848282"> Doar</span>
                                                            </div>

                                                        @endif

                                                        <div class="ajudar-feed" style="">
                                                            <img class="gostar" src="assets/images/ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                            <a href="#" class="modal-listar-doadores" publicacaoDocId="{{$dados->id}}" style="font-weight: 600; font-size: 18px; color:#000"> Doações {{$dados->doacoes}}</a>
                                                        </div>

                                                    @endif

                                                    @if($dados->tipo_publicacao == "doacao")

                                                        @if(Auth::user()->tipo_perfil == "instituicao")

                                                            <div class="ajudar-feed" style="">
                                                                <img class="gostar" src="assets/images//ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                                <a href="#" class="solicitar-doacao" user-id="{{$dados->user_id}}" publicacaoId="{{$dados->id}}" nomeDoador= "{{$dados->name}}" style="font-weight: 600; font-size: 18px; color:#000"> Solicitar Doação</a>
                                                            </div>

                                                        @else

                                                            <div class="ajudar-feed" style="">
                                                                <img class="gostar" src="assets/images//ajudar-logo.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                                <span style="font-weight: 600; font-size: 18px; color:#848282"> Solicitar Doação</span>
                                                            </div>
                                                            
                                                        @endif

                                                        <div class="ajudar-feed" style="">
                                                            <img class="gostar" src="assets/images/doadores.png" alt="" style="width: 20px; float: none; position: relative; top:3px">
                                                            <a href="#" class="modal-listar-solicitantes" publicacao-id="{{$dados->id}}" style="font-weight: 600; font-size: 18px; color:#000"> Solicitações {{$dados->solicitacoes}} </a>
                                                        </div>

                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="process-comm">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    <div class="row post-doacoes-receber">
                        <div class="posts-section">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Imagem Produto</th>
                                        <th scope="col">Doador</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Quantidade a Doar</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Descricao</th>
                                        <th scope="col">Acções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todasDoacoes as $doacoes)
                                        <tr>
                                            <td>
                                                @if($doacoes->imagem) <img class="img-publicacao" src="{{asset('images/'.$doacoes->imagem)}}" style="object-fit: fill;height: 100px;width: 100px;" alt=""> @endif
                                            </td>
                                            <td> {{ $doacoes->nome_pessoa }} </td>
                                            <td> {{ $doacoes->telefone }} </td>
                                            <td> {{ $doacoes->quantidade }} </td>
                                            <td> <?php print_r(explode("_",$doacoes->estado)[0]) ?> <?php print_r(explode("_",$doacoes->estado)[1]) ?> </td>
                                            <td> {{ $doacoes->descricao }} </td>
                                            @if ($doacoes->confirmado == "nao")
                                                <td>
                                                    <button class="btn btn-primary btn-confirmar" doacao="{{ $doacoes->publicacao_id }}">Confirmar Doação</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button disabled class="btn btn-warning" doacao="{{ $doacoes->publicacao_id }}">Doação Confirmada</button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- main-section-data end-->
            </div> 
        </div>
    </main>

	<!-- MODAL SOLICITAR DOAÇÃO-->
    <div class="modal fade" id="ajax-solicitacao-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicitar Doação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="solicitacaoForm" name="solicitacaoForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="publicacao_solicitar_id" id="publicacao_solicitar_id">
                        <input type="hidden" name="publicacao_user_id" id="publicacao_user_id">
                        <input type="hidden" name="texto_solicitacao_padrao" id="texto_solicitacao_padrao">
                        <div class="form-group">
                            <h2 for="exampleFormControlInput1">Enviaremos este texto padrão.</h2>
                            <br> <br>
                            <span id="nomeProprietario" style="color: red"></span> 
                            <br> <br>
                            <h2>Caso desejar alterar o texto, por favor preencha o campo.</h2>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="texto_solicitacao" id="texto_solicitacao" placeholder="Digite o texto aqui" autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" id="btn-salvar-solicitacao" value="criar">Enviar Solicitação</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection
