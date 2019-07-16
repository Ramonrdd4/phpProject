<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('estado_cita');
            $table->unsignedInteger('id_paciente');
            $table->unsignedInteger('id_Horario');
            $table->timestamps();

            $table->foreign('id_Horario')->references('id')->on('horarios');
            $table->foreign('id_paciente')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
}
