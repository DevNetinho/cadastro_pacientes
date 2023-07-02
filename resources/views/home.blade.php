@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- MOSTRAR NOME DE USUÁRIO --}}
                    Usuário:  <a class="text-decoration-none">   {{ Auth::user()->name }}   </a>
                    
                    <a href="{{ route('logout') }}" style="text-decoration: none; color: red; float: right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > SAIR </a>
                    {{-- FORMULÁRIO PARA FAZER LOGOUT --}}
                    <form id="logout-form" method="post" action="{{ route('logout') }}" >
                        @csrf
                    </form>
                    <h4 class="text-center fw-bold"> CONSULTAS MARCADAS:  {{ $n }} </h4>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Data da Consulta</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Médico</th>
                          </tr>
                        </thead>
                        <tbody> 
                            {{-- PRIMEIRO FIZ UM FOREACH PARA APRESENTAR OS DADOS DE PACIENTES, LOGO APÓS, OBTI OS DADOS DA CONSULTA DO PACIENTE COM OUTRO FOREACH --}}
                            @foreach ($pacientes as $p)
                                @foreach ($p->consultas as $c)

                            <tr>
                                <th scope="row">{{ $c->id }}</th>
                                <td>{{ $p->nome }}</td>                                
                                <td>{{ $p->cpf }}</td>
                                <td style="color: #006400" >{{ date('d/m/Y', strtotime($c->data_consulta)) }}</td>
                                <td>{{ $c->horario_consulta }}</td>
                                <td>{{ $c->tipo_consulta }}</td>
                                <td>{{ $c->medico }}</td>
                            </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
