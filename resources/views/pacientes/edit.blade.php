@extends('layouts.estilo_sem_topo')

@section('title', 'Edição de Paciente')

@section('conteudo')
        
    <div class="container">
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card col-10">
                    <h5 class="card-header text-center"> Editar registro de paciente </h5>
                    
                    <form action="{{ route('paciente.update', $paciente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body justify-content-center">
                            
                            <div class="mb-3 col-10">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome do paciente" maxlength="100" value="{{ $paciente->nome ?? old('nome')}}" >
                                <p style="color: red;">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</p>
                            </div>
                        
                            <div class="mb-3 col-5">
                                <label for="nascimento" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" id="nascimento" name="nascimento" value="{{ $paciente->nascimento ?? old('nascimento') }}" >
                                <p style="color: red;"> {{ $errors->has('nascimento') ? $errors->first('nascimento')  : '' }} </p>
                            </div>
                        
                            <div class="mb-3 col-5">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" aria-label="select_exp" name="sexo" id="sexo" >
                                    <option value="inativo">Escolha o sexo</option>
                                    
                                    <option value="ativo1" {{ $paciente->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="ativo2" {{ $paciente->sexo  == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                    <option value="ativo3" {{ $paciente->sexo == 'Outros' ? 'selected' : '' }}>Outros</option>
                                </select>
                                <p style="color: red;"> {{ $errors->has('sexo') ? $errors->first('sexo') : '' }} </p>
                            </div>

                            <div class="mb-3 col-5">
                                <label for="contato" class="form-label">Contato</label>
                                <input type="tel" class="form-control" id="contato" name="contato" inputmode="numeric" placeholder="(xx) xxxxx-xxxx" maxlength="11" value="{{ $paciente->contato ?? old('contato') }}" >
                                <p style="color: red"> {{ $errors->has('contato') ? $errors->first('contato') : '' }} </p>
                            </div> 

                            <div class="mb-3 col-5">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" inputmode="numeric" maxlength="11" value="{{ $paciente->cpf ?? old('cpf') }}" >
                                <p style="color: red;"> {{ $errors->has('cpf') ? $errors->first('cpf') : ''  }}   </p>
                                  
                            </div> 

                            <div class="mb-3 col-10">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Insira o endereço" maxlength="150" value="{{ $paciente->endereco ?? old('endereco') }}" >
                                <p style="color: red;" > {{ $errors->has('endereco') ? $errors->first('endereco') : '' }} </p>
                            </div>
                            {{-- ESTA DIV SERVE PARA POSICIONARMOS OS BOTÕES A DIREITA DO CARD. --}}
                            <div class="d-flex justify-content-between">
                                
                                {{-- BOTÃO PARA VOLTAR --}}
                                <a href="{{ url()->previous() }}" class="btn btn-primary "> Voltar </a>                           
                                {{-- BOTÃO DE CADASTRO --}}
                                <button type="submit" class="btn btn-primary ml-auto"> Salvar </button>                 
                            </div>
                        </div>

                    </form>
                        
                </div>


            </div>

        </div>
    </div>


@endsection