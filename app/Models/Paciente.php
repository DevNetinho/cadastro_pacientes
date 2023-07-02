<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'contato', 'nascimento', 'sexo', 'cpf', 'endereco'];

    public function consultas() {
        return $this->hasMany('App\Models\Consulta'); //TEM MUITOS

    }


}
