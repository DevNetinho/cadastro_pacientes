@extends('layouts.estilo_sem_topo')

@section('title', 'Agendar consulta')

@section('conteudo')
        
    <div class="container">
        
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card col-10">
                    <h4 class="card-header text-center"> Agendar Consulta </h4>
                    
                    <div class="card-body">
                        <div class="card-title"> <h5>Dados do paciente </h5></div>

                        <div class="card-text mb-5">        
                            <p><strong>Nome:</strong> {{ $paciente->nome }}</p>
                            <p><strong>Contato:</strong> {{ $paciente->contato ?? 'Não especificado' }}</p>
                            {{-- CÁLCULO PARA APRESENTAR A IDADE DO PACIENTE PARA O USUÁRIO --}}
                            <p><strong>Data de nascimento:</strong> {{ date('d/m/Y', strtotime($paciente->nascimento)) }} - {{ intval(date('Y')) - intval($paciente->nascimento) }} anos </p>
                            <p><strong>Sexo:</strong> {{ $paciente->sexo }}</p>
                            <p><strong>CPF:</strong> {{ $paciente->cpf }}</p>
                            <p><strong>Endereco:</strong> {{ $paciente->endereco }}</p>                         
                            
                        </div>
            
                        
                        <form action="{{ route('consulta.store') }}" method="POST">
                            @csrf
                            {{-- INCLUINDO O ID DO PACIENTE PARA A REQUEST --}}
                            <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

                            <div class="row mb-4">
                                <div class="col-md-5">
                                    <label for="data_consulta">Data da consulta:</label> <br>
                                    <input type="date" id="data_consulta" name="data_consulta" class="form-control">
                                    <p style="color: red"> {{ $errors->has('data_consulta') ? $errors->first('data_consulta') : '' }} </p>
                                </div>

                                <div class="col-md-7">
                                    <label for="tipo_consulta">Área médica: </label>
                                    <input type="text" id="tipo_consulta" name="tipo_consulta" class="form-control" placeholder="Digite a área médica ex: Ortopedista..." maxlength="50" value="{{ old('tipo_consulta') }}" >
                                    <p style="color: red"> {{ $errors->has('tipo_consulta') ? $errors->first('tipo_consulta') : '' }} </p>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <label for="horario_consulta">Horário da consulta:</label>
                                    <input type="time" id="horario_consulta" name="horario_consulta" class="form-control" value="{{ old('horario_consulta') }}">
                                    <p style="color: red"> {{ $errors->has('horario_consulta') ? $errors->first('horario_consulta') : '' }} </p>
                                </div>
                                <div class="col-md-8">
                                    <label for="medico">Médico:</label>
                                    <input type="text" id="medico" name="medico" class="form-control" placeholder="Digite o nome do médico..." value="{{ old('medico') }}" maxlength="100" >
                                    <p style="color: red"> {{ $errors->has('medico') ? $errors->first('medico') : ''  }} </p>

                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                               
                                <a href="{{ route('paciente.index') }}" class="btn btn-secondary"> Voltar </a>
                                <button type="submit" class="btn btn-primary "> Agendar </button>
                            </div>
                        </form>

                        


                        
                    </div>                    
                </div>
                
                

            </div>

        </div>

        <style>
            .custom_margin {
                margin-bottom: 250px; /* MARGIN CUSTOMIZADA PARA DAR MAIS ESPAÇO PARA APRESENTAÇÃO DA TABLE */
            }
        </style>
        <div class="row justify-content-center mt-4 custom_margin">
            <div class="col-md-10">
                <div class="card col-10">
                    <div class="card-header text-center">Histórico de consultas</div>

                    {{-- PRIMEIRO É VERIFICADO SE HÁ CONSULTAS AGENDADAS POR ESSE PACIENTE --}}
                    @if($contagem > 0)
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Data da consulta</th>
                                        <th scope="col">Horário</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Médico</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                        @foreach ($consultas_paciente as $consulta)  
                                            <tr>
                                                <th scope="row">{{ $consulta->id }}</th>
                                                <td style="color: #006400">{{ date( 'd/m/Y', strtotime( $consulta->data_consulta)) }}</td>
                                                <td>{{ $consulta->horario_consulta }}</td>
                                                <td>{{ $consulta->tipo_consulta }}</td>
                                                <td>{{ $consulta->medico }}</td>
                                                <td> <a href="{{ route('consulta.exportar', ['id' => $consulta->id]) }}" class="btn btn-primary btn-sm"> Gerar PDF </a> </td>
                                                
                                                <form action="{{ route('consulta.destroy', $consulta->id )}}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <td> <button type="submit" class="btn btn-danger btn-sm"> Excluir </button> </td>
                                                </form>
                                            </tr>
                                        @endforeach                                    
                                    @else
                                        <p class="fw-bold text-center mt-2">Não há consultas agendadas no momento.</p>
                                    
                                </tbody>
                            </table>
                        </div>
                    @endif
                    

                </div>
            </div>
        </div>

    </div>


@endsection