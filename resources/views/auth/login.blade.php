@extends('layouts.app') 

@section('content')
<div class="container">
    {{-- CARD AJUSTADO PARA O CENTRO DA TELA, COM A class ABAIXO --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Faça o login para acessar o sistema</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ADICIONAMOS ESSE STYLE PARA CENTRALIZAR NOSSO CARD NA TELA --}}
                        <style>
                            .card {
                                margin-top: 20%;
                            }    
                        </style>        

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">                                
                                
                                {{-- LINK REGISTRAR USUÁRIO --}}
                                <a class="custom-link" href="{{ route('register') }}">Registrar usuário</a>  

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                  
                                    <label class="form-check-label" for="remember">
                                        Lembrar
                                    </label>                                    
                                </div>
                                      
                            </div>                     
                                                            
                        </div>

                        {{-- MARGEM CUSTOMIZADA PARA POSICIONAR O Registrar --}}
                        <style>
                            .custom-link {
                                margin-right: 10px;
                                float: right;
                            }
                        </style>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Acessar
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Esqueceu sua senha?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
