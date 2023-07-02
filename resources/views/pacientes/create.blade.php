@extends('layouts.estilo_sem_topo')

@section('title', 'Cadastro de Paciente')

@section('conteudo')
        
    <div class="container">
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card col-10">
                    <h5 class="card-header text-center"> Cadastrar pacientes </h5>
                    
                    <form action="{{ route('paciente.store') }}" method="POST">
                        @csrf
                        <div class="card-body justify-content-center">
                            
                            <div class="mb-3 col-10">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome do paciente" maxlength="100" value="{{ old('nome') }}" >
                                <p style="color: red;">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</p>
                            </div>
                        
                            <div class="mb-3 col-5">
                                <label for="nascimento" class="form-label">Data de nascimento</label>
                                <input type="date" class="form-control" id="nascimento" name="nascimento" value="{{ old('nascimento') }}" >
                                <p style="color: red;"> {{ $errors->has('nascimento') ? $errors->first('nascimento')  : '' }} </p>
                            </div>
                        
                            <div class="mb-3 col-5">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" aria-label="select_exp" name="sexo" id="sexo" >
                                    <option value="inativo">Escolha o sexo</option>
                                    
                                    <option value="ativo1" {{ old('sexo') == 'ativo1' ? 'selected' : '' }}>Masculino</option>
                                    <option value="ativo2" {{ old('sexo') == 'ativo2' ? 'selected' : '' }}>Feminino</option>
                                    <option value="ativo3" {{ old('sexo') == 'ativo3' ? 'selected' : '' }}>Outros</option>
                                </select>
                                <p style="color: red;"> {{ $errors->has('sexo') ? $errors->first('sexo') : '' }} </p>
                            </div>

                            <div class="mb-3 col-5">
                                <label for="contato" class="form-label">Contato</label>
                                <input type="tel" class="form-control" id="contato" name="contato" inputmode="numeric" placeholder="(xx) xxxxx-xxxx" maxlength="11" value="{{ old('contato') }}" >
                                <p style="color: red"> {{ $errors->has('contato') ? $errors->first('contato') : '' }} </p>
                            </div> 

                            <div class="mb-3 col-5">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" inputmode="numeric" maxlength="11" value="{{ old('cpf') }}" >
                                <p style="color: red;"> {{ $errors->has('cpf') ? $errors->first('cpf') : ''  }}   </p>
                                  
                            </div> 

                            <div class="mb-3 col-10">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Insira o endereço" maxlength="150" value="{{ old('endereco') }}" >
                                <p style="color: red;" > {{ $errors->has('endereco') ? $errors->first('endereco') : '' }} </p>
                            </div>
                            {{-- ESTA DIV SERVE PARA POSICIONARMOS OS BOTÕES A DIREITA DO CARD. --}}
                            <div class="d-flex justify-content-between">
                                
                                {{-- BOTÃO PARA VOLTAR --}}
                                <a href="{{ url()->previous() }}" class="btn btn-primary "> Voltar </a>                            
                                {{-- BOTÃO DE CADASTRO --}}
                                <button type="submit" name="cadastro_consulta" class="btn btn-secondary ml-auto"> Salvar e agendar consulta </button>          
                                <button type="submit" class="btn btn-primary ml-auto"> Salvar </button>
                                

                            </div>
                        </div>

                    </form>
                        
                </div>


            </div>

        </div>
    </div>


@endsection