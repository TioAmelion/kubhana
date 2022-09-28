@extends('admin.layout')

@section('conteudo')
    <main>
        <div class="main-section">
            <div class="container">
                <div style="text-align: center">
                    <h1 style="font-size: 1.6rem; font-weight: 500;">Doações a Receber</h1>
                </div>
                <br> <br>
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
