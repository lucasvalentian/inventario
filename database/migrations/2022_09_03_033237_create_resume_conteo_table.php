<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeConteoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_conteo', function (Blueprint $table) {
            $table->id();
            $table->integer('id_alamcen');
            $table->integer('conteo');
            $table->integer('id_producto');
            $table->integer('total_unidades');
            $table->string('condicion');
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
        Schema::dropIfExists('resume_conteo');
    }
}
