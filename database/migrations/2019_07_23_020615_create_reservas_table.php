<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('run');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('id_encargado_salida');
            $table->string('id_encargado_recibo')->nullable();
            $table->integer('id_laboratorio');
            $table->integer('id_recurso')->nullable();
            $table->dateTime('dia_entrega');
            $table->integer('id_bloque_horario');
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
        Schema::dropIfExists('reservas');
    }
}
