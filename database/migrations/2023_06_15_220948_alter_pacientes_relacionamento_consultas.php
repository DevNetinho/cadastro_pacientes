<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPacientesRelacionamentoConsultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->unsignedBigInteger('paciente_id')->after('id')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropForeign('consultas_paciente_id_foreign'); //REMOVE A FOREIGN KEY
            $table->dropColumn('paciente_id'); //REMOVE A COLUNA CRIADA ACIMA.
        }); 
    }
}
