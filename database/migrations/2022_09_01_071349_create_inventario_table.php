<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();


            $table->string('concepto');
            $table->integer('id_almacen');
            $table->string('tipo_operacion');
            $table->integer('id_producto');
            $table->decimal('stock_unidades',20,2);
            $table->decimal('stock_master',20,2);
            $table->date('fecha_prevista');
            $table->time('hora');
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
        Schema::dropIfExists('inventario');
    }
}
