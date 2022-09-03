@extends('admin.layout')

@section('conteudo')
    <div class="search-sec">
        <div class="container">
            <div class="search-box change-section" style="margin-bottom: 10px">

                @if (Auth::check() && Auth::user()->tipo_perfil == "instituicao")

                    <a href="" class="btn btn-danger btn-filtros">Filtros</a>
                    <a href="" class="btn btn-primary btn-doacoes-receber">Doações a Receber</a>

                @else

                <a href="" class="btn btn-danger btn-filtros">Filtros</a>
                <a href="" class="btn btn-primary btn-solicitacoes">Solicitações</a>

                @endif

            </div>
            <div class="search-box">
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

                    @if (Auth::user()->tipo_perfil == "instituicao")                    
                        <div class="row row-doacoes">
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
                                    @foreach ($doacoesInst as $doacoes)
                                        <tr>
                                            <td>
                                                @if($doacoes->imagem) <img class="img-publicacao" src="{{asset('images/'.$doacoes->imagem)}}" style="object-fit: fill;height: 100px;width: 100px;" alt=""> @endif
                                            </td>
                                            <td> {{ $doacoes->nome_pessoa }} </td>
                                            <td> {{ $doacoes->telefone }} </td>
                                            <td> {{ $doacoes->quantidade }} </td>
                                            <td> {{ $doacoes->estado }} </td>
                                            <td> {{ $doacoes->id }} </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-confirmar" doacao="{{ $doacoes->id }}">Confirmar</a> &nbsp;
                                                <a href="#" class="btn btn-primary btn-doacoes">Entrar em Contacto</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
