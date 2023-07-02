<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 150);
            $table->date('nascimento');
            $table->string('sexo', 15);
            $table->string('cpf', 12)->unique();
            $table->string('endereco', 300);     

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropUnique('pacientes_cpf_unique');
        });
        Schema::dropIfExists('pacientes');
    }
}
