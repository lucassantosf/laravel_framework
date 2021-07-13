@extends('layouts.cms_login')

@section('content')
    <!-- Begin page -->
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">
                @if (session('reset'))
                    <div class="col-md-12"><div class="alert-success alert">{{ session('reset') }}</div></div>
                @endif

                <h3 class="text-center m-0">
                    <a href="{{route('login')}}" class="logo logo-admin"><img src="{{asset('assets/cms/images/logo.png')}}" alt="logo"></a>
                </h3>

                <div class="p-3">
                    <h4 class="text-muted font-18 m-b-5 text-center">Painel de conteúdo</h4>
                    <p class="text-muted text-center">Faça o login para continuar.</p>

                    <!-- Verifica e mostra mensagem de sucesso -->
                    @include('cms.includes.alert_messages')

                    <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Usuário</label>
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}"  autofocus autocomplete="off"/>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="userpassword">Senha</label>
                             <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  />

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Entrar</button>
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20 text-right">
                                <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Esqueceu a senha?</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection