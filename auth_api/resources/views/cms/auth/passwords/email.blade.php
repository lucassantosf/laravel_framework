@extends('layouts.cms_login')

@section('content')
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 class="text-center m-0">
                        <a href="{{route('login')}}" class="logo logo-admin"><img src="{{asset('assets/cms/images/logo.png')}}" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 mb-3 text-center">Esqueci minha senha</h4>
                        <div class="alert alert-info" role="alert">
                            Enviaremos as instruções para resetar a senha!
                        </div>

                        <form class="form-horizontal m-t-30" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Resetar senha</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
@endsection
