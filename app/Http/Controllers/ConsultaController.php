<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;
use PDF;

class ConsultaController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::with(['consultas'])->get(); //LISTAGEM DE TODAS CONSULTAS MARCADAS
        $n = Consulta::count(); //TOTAL DE CONSULTAS MARCADAS
        //dd($consultas);
        return view('home', ['pacientes' => $pacientes, 'n' => $n]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($paciente_id)
    {   
            
        //RECUPERA O REGISTRO DO PACIENTE DE ACORDO COM SEU ID
        $paciente = Paciente::find($paciente_id);        
        //IF PARA TRATAR CASO O ID NÃO EXISTA
        if ($paciente) {            
            //VERIFICA SE HÁ CONSULTAS MARCADAS
            $contagem = Consulta::where('paciente_id', $paciente_id)->count();
                     
            //RECUPERA TODAS CONSULTAS DO PACIENTE ATUAL
            $consultas_paciente = Consulta::where('paciente_id', $paciente_id)->get();            

            return view('consultas.create', ['paciente' => $paciente, 'consultas_paciente' => $consultas_paciente, 'contagem' => $contagem]);
        } else{
            abort(404); //Exibe página de não encontrado
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //VALIDAÇÃO
        $regras = [
            'data_consulta' => 'required|date',
            'tipo_consulta' => 'required|min:3|max:100',
            'horario_consulta' => 'required',
            'medico' => 'required|min:2|max:90'
        ];

        $feedback = [
            'data_consulta.required' => 'Preencha o campo data',
            'data_consulta.date' => 'O campo deve ser preenchido com uma data válida',
            'tipo_consulta.min' => 'Insira no mínimo 3 caracteres',
            'tipo_consulta.max' => 'Máximo de caracteres é 100',
            'tipo_consulta.required' => 'Preencha o campo de Área médica',
            'horario_consulta.required' => 'Preencha o campo de horário',            
            'medico.required' => 'Preencha o campo de médico',
            'medico.min' => 'Insira no mínimo 2 caracteres',
            'medico.max' => 'Máximo de caracteres é 90'            
        ];

        $request->validate($regras, $feedback);
                
        Consulta::create($request->all());

        return redirect()->route('consulta.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consulta::where('id', $id)->delete();

        return redirect()->back(); //redirecionar para a mesma rota
    }

    public function exportar($id) //MÉTODO DE EXPORTAÇÃO DO PDF
    {
        $dados = Consulta::where('id', $id)->first();
        $paciente = Paciente::where('id', $dados->paciente_id)->first();
        
        
        $pdf = Pdf::loadView('consultas.pdf', ['dados' => $dados, 'paciente' => $paciente]);
        return $pdf->download('consulta.pdf');
    

    }

}
