<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Consulta; //USAREMOS O MODEL CONSULTA PARA RECUPERAR OS REGISTROS PARA REMOÇÃO DO PACIENTE
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    public function __construct() { //ADICIONAR O MIDDLEWARE AUTH EM NOSSA ROTA
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        if (isset($request->pesquisa) && $request->pesquisa != '' ) {
            $contagem = Paciente::count(); //CONTAGEM DE REGISTROS
            
            $pesquisa = $request->pesquisa . '%'; //VALOR DIGITADO NO INPUT

            $pacientes = Paciente::where(function ($query) use ($pesquisa) { //QUERY SQL PARA PESQUISA DE ACORDO COM O QUE FOI DIGITADO
                $query->where('nome', 'LIKE', $pesquisa)
                    ->orWhere('sexo', 'LIKE', $pesquisa)
                    ->orWhere('nascimento', 'LIKE', $pesquisa)
                    ->orWhere('cpf', 'LIKE', $pesquisa);
            })->get();        
            
            return view('pacientes.index', ['contagem' => $contagem, 'pacientes' => $pacientes]);
            

        } else {
            $contagem = Paciente::count();
            $pacientes = Paciente::all();
            return view('pacientes.index', ['contagem' => $contagem, 'pacientes' => $pacientes]);
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //ROTA POST PARA REGISTRO
    {
        
        
        //VALIDAÇÃO
        $regras = [
            'nome' => 'required|min:1|max:100',
            'nascimento' => 'required|date',
            'sexo' => 'required|in:ativo1,ativo2,ativo3',
            'contato' => 'required|numeric|min:9',
            'cpf' => 'required|numeric|unique:pacientes|min:11',
            'endereco' => 'required|min:2|max:150'

        ];

        $feedback = [
            'nome.required' => 'O campo nome precisa ser preenchido',
            'nascimento.required' => 'Preencha a data de nascimento',
            'nascimento.date' => 'Formato inválido',
            'sexo.in' => 'Escolha uma opção',
            'contato.required' => 'Insira um contato',
            'contato.numeric' => 'Apenas valores numéricos',
            'contato.min' => 'No mínimo 9 dígitos',
            'cpf.unique' => 'Este CPF já está cadastrado',
            'cpf.required' => 'Insira um CPF',
            'cpf.numeric' => 'Apenas valores numéricos',
            'cpf.min' => 'Insira no mínimo 11 dígitos',
            'endereco.required' => 'Insira um endereço',
            'endereco.min' => 'Insira no mínimo 2 caracteres',
            
        ];
        
        $request->validate($regras, $feedback);
        
        //PEGAREMOS A REQUEST PARA ALTERARMOS OS VALORES RETORNADOS DO SELECT CONFORME O SEXO DO PACIENTE
        $data = $request->all();

        // DEFINIR OS NOMES DO SELECT
        if ($request->sexo == 'ativo1') {
            
            //PEGA O VALOR DE SEXO E IGUALA A Masculino CASO O SELECT RETORNE ativo1
            $data['sexo'] = 'Masculino';
            //SOBREESCREVE O ÍNDICE sexo COM O NOVO VALOR(Masculino)
            $request->replace($data);
                        
        } elseif ($request->sexo == 'ativo2') {
                      
           $data['sexo'] = 'Feminino';           
           $request->replace($data);                      
           
           
        } elseif ($request->sexo == 'ativo3') {
            
            $data['sexo'] = 'Outros';           
            $request->replace($data);             
                       
        }

        //VERIFICAR SE O USUÁRIO QUER AGENDAR UMA CONSULTA LOGO APÓS O CADASTRO DO PACIENTE.
        if ($request->has('cadastro_consulta')) {
            
            Paciente::create($request->all()); //CRIA O CADASTRO
            
            $paciente_id = Paciente::where('cpf', $request->cpf)->select('id')->first(); //RECUPERA O ID DO PACIENTE QUE FOI CADASTRADO PARA POSTERIORMENTE ENVIAR PARA A ROTA consulta.create     
            
            return redirect()->route('consulta.create', ['paciente' => $paciente_id]); //REDIRECIONA PARA O AGENDAMENTO DE CONSULTA
        } else {
            Paciente::create($request->all());
            return redirect()->route('paciente.index');
        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        
        return view('pacientes.edit', ['paciente' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {

        //VALIDAÇÃO
        $regras = [
            'nome' => 'required|min:1|max:100',
            'nascimento' => 'required|date',
            'sexo' => 'required|in:ativo1,ativo2,ativo3',
            'contato' => 'required|numeric|min:9',
            'endereco' => 'required|min:2|max:150'                    

        ];
       

        $feedback = [
            'nome.required' => 'O campo nome precisa ser preenchido',
            'nascimento.required' => 'Preencha a data de nascimento',
            'nascimento.date' => 'Formato inválido',
            'sexo.in' => 'Escolha uma opção',
            'contato.required' => 'Insira um contato',
            'contato.numeric' => 'Apenas valores numéricos',
            'contato.min' => 'No mínimo 9 dígitos',
            'cpf.unique' => 'Este CPF já está cadastrado',
            'cpf.required' => 'Insira um CPF',
            'cpf.numeric' => 'Apenas valores numéricos',
            'cpf.min' => 'Insira no mínimo 11 dígitos',
            'endereco.required' => 'Insira um endereço',
            'endereco.min' => 'Insira no mínimo 2 caracteres',
            
        ];

        $cpf = $request->cpf;
        $id = $paciente->id;
        
        //QUERY PARA VERIFICAR SE JÁ EXISTE UM ID, QUE NÃO SEJA O PRÓPRIO ID DO PACIENTE QUE ESTÁ SENDO ATUALIZADO.
        $resultado = Paciente::where('cpf', $cpf)->where('id', '!=', $id)->get();

        
        //VERIFICA SE RETORNOU ALGUMA LINHA NA QUERY E ATRIBUI A REGRA PARA CADA CASO
        if ($resultado->count() > 0 ) {
            
            $regras['cpf'] = 'required|numeric|unique:pacientes|min:11';
            

        } else {
            $regras['cpf'] = 'required|numeric|min:11';

        }
        
        $request->validate($regras, $feedback);
        
        //PEGAREMOS A REQUEST PARA ALTERARMOS OS VALORES RETORNADOS DO SELECT CONFORME O SEXO DO PACIENTE
        $data = $request->all();

        // DEFINIR OS NOMES DO SELECT
        if ($request->sexo == 'ativo1') {
            
            //PEGA O VALOR DE SEXO E IGUALA A Masculino CASO O SELECT RETORNE ativo1
            $data['sexo'] = 'Masculino';
            //SOBREESCREVE O ÍNDICE sexo COM O NOVO VALOR(Masculino)
            $request->replace($data);
                        
        } elseif ($request->sexo == 'ativo2') {
                      
           $data['sexo'] = 'Feminino';           
           $request->replace($data);                      
           
           
        } elseif ($request->sexo == 'ativo3') {
            
            $data['sexo'] = 'Outros';           
            $request->replace($data);             
                       
        }

        $paciente->update($request->all());

        return redirect()->route('paciente.index');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {

        //PRIMEIRO DEVE-SE EXCLUIR TODAS CONSULTAS DO PACIENTE QUE SERÁ REMOVIDO, PARA ASSIM, REMOVER O PACIENTE COM SUCESSO.
        Consulta::where('paciente_id', $paciente->id)->delete();
        
        //ARRUMAR PROBLEMA DAS CONSTRAINTS, ONDE NÃO CONSEGUIMOS REMOVER UM REGISTRO QUE TENHA CONSULTAS MARCADAS
        $paciente->delete();

        return redirect()->route('paciente.index');
    }
}
