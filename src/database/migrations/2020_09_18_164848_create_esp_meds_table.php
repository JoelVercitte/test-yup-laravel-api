<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspMedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esp_meds', function (Blueprint $table) {
            $table->id('id_esp_med');
            $table->unsignedBigInteger('id_medico');
            $table->unsignedBigInteger('id_especialidade');
            $table->foreign('id_medico')->references('id_medico')->on('medicos');
            $table->foreign('id_especialidade')->references('id_especialidade')->on('especialidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('esp_meds');
    }
}
