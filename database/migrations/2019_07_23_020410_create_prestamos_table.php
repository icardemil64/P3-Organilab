<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_alumno');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('id_encargado_salida');
            $table->string('id_encargado_recibo');
            $table->integer('id_laboratorio');
            $table->integer('id_recurso')->nullable();
            $table->timestamp('fecha_entrega')->nullable();
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
        Schema::dropIfExists('prestamos');
    }
}
