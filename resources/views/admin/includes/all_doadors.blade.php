@extends('admin.layout_instituicao')

@section('conteudo')
    <section class="companies-info">
        <div class="container">
            <div class="company-title">
                <h3>Todos Doadores</h3>
            </div>
            <!--company-title end-->
            <div class="companies-list">
                <div class="row">
                    @foreach ($dates as $date)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="user-data full-width">
                                <div class="user-profile">
                                    <div class="username-dt">
                                        <div class="usr-pic">
                                            <img src="assets/images/resources/user-pic-1.png" alt="">
                                        </div>
                                    </div>
                                    <!--username-dt end-->
                                    <div class="user-specs">
                                        {{-- <h3>{{ $date->pessoa->user->name }}</h3>
                                    <span>+244 {{ $date->pessoa->telefone }}</span> --}}
                                        <h3>{{ $date->name }}</h3>
                                        <span>+244 {{ $date->telefone }}</span><br><br>
                                        <span>{{ $date->nome_provincia }} - {{ $date->nome_municipio }}</span>
                                    </div>
                                </div>
                                <!--user-profile end-->
                                <ul class="user-fw-status">
                                    <li>
                                        <h4>Ajudas</h4>
                                        <span>0</span>
                                    </li>
                                    <li>
                                        <h4>Doações</h4>
                                        <span>0</span>
                                    </li>
                                    <li>
                                        <a href="#" title="">Ver Perfil</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--companies-list end-->
            <div class="process-comm">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
            <!--process-comm end-->
        </div>
    </section>
    <!--companies-info end-->
@endsection
