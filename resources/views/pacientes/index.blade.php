@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- MOSTRAR NOME DE USUÁRIO --}}
                    <span class="fw-bold"> Usuário: </span> <a class="text-decoration-none">   {{ Auth::user()->name }}   </a>
                    
                    <a href="{{ route('logout') }}" style="text-decoration: none; color: red; float: right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > SAIR </a>
                    {{-- FORMULÁRIO PARA FAZER LOGOUT --}}
                    <form id="logout-form" method="post" action="{{ route('logout') }}" >
                        @csrf
                    </form>
                    <h4 class="text-center fw-bold"> PACIENTES CADASTRADOS: {{ $contagem }} </h4>
                    
                    {{-- FORM DE PESQUISA --}}
                    <form action="{{ route('paciente.index') }}" method="GET">
                        <div class="row">
                            <div class="form-group mb-2">
                                <label for="pesquisa"> Pesquisar: </label>
                                                                                    
                                <input type="text" id="pesquisa" name="pesquisa"  placeholder="Digite" maxlength="50">
                            </div>
                            <div class="col">
                                <button class="btn btn-primary btn-sm" type="submit">Ok</button>
                                <a href="{{ route('paciente.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                            </div>
                        </div>
                    </form>
                    
                    

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
                            <th scope="col">Nome</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Endereço</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($pacientes as $p)
                                <tr>
                                    <th scope="row">{{ $p->id }}</th>
                                    <td>{{ $p->nome }}</td>                               
                                    <td>{{ $p->contato }}</td>
                                    <td>{{ date('d/m/Y', strtotime($p->nascimento))}}</td>
                                    <td>{{ $p->sexo}}</td>
                                    <td>{{ $p->cpf}}</td>
                                    <td>{{ $p->endereco}}</td>
                                    <td> <a href="{{ route('consulta.create', ['paciente' => $p->id]) }}" class="btn btn-secondary btn-sm" > Agendar Consulta </a> </td>
                                    <td> <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $p->id }}" onclick="document.getElementById('removeForm')" > Excluir </a></td>

                                    <td> <a href="{{ route('paciente.edit', $p->id) }}" class="btn btn-primary btn-sm" > Editar </a> </td>


                                </tr>
                                
                            @endforeach    
                                    
                        </tbody>
                                                
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Remover registro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                Tem certeza que deseja remover o registro de ID: <span id="productId"></span>  e todas as suas consultas?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                {{-- FORM DE REMOÇÃO --}}
                                <form id="removeForm" action="{{ route('paciente.destroy', '') }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        {{-- SCRIPT PARA CAPTURARMOS O ID QUE APRESENTAREMOS NO MODAL --}}
                        <script>
                            var myModal = document.getElementById('exampleModal');
                            myModal.addEventListener('show.bs.modal', function (event) {
                            var button = event.relatedTarget;
                            var productId = button.getAttribute('data-id');
                            var modalProductId = myModal.querySelector('#productId');
                            var removeForm = myModal.querySelector('#removeForm');
                        
                            modalProductId.textContent = productId;
                            removeForm.action = "{{ route('paciente.destroy', '') }}" + "/" + productId;
                            });
                        </script>
                          
                    </table>
                        
                        


                </div>
            </div>
        </div>
    </div>
</div>

@endsection