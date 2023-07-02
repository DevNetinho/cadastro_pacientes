<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        .titulo {
            border:1px;
            text-align: center;
            width: 100%;
            font-weight: bold;
            margin-bottom: 25px;
        }

        p {
            margin-top: 10px;
            font-size: 25px;
        }

    </style>
</head>
<body>
    
    <h1 class="titulo" >Dados da consulta </h1>
    <p><strong>Nome do paciente: </strong> {{$paciente->nome}} </p>
    <p><strong>Data da consulta: </strong> {{ date('d/m/Y', strtotime($dados->data_consulta)) }} </p>
    <p><strong>Horário: </strong> {{ $dados->horario_consulta }} </p>
    <p><strong>Área médica: </strong> {{ $dados->tipo_consulta }} </p>
    <p><strong>Médico: </strong> {{ $dados->medico }} </p>


</body>
</html>