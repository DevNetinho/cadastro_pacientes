<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = ['paciente_id', 'data_consulta', 'tipo_consulta', 'horario_consulta' ,'medico'];

    public function paciente() {
        return belongsTo('App\Models\Paciente'); //PERTENCE A...
    }
}
