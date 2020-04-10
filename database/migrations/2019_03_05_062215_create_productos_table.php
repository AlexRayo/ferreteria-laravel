<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cantidad_inicial');
            $table->bigInteger('cantidad_actual');
            $table->text('descripcion');
            $table->decimal('precio_compra');
            $table->decimal('precio_venta');
            $table->dateTime('fecha_compra');
            $table->text('marca')->nullable();
            $table->text('modelo')->nullable();
            $table->text('notas')->nullable();
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
        Schema::dropIfExists('productos');
    }
}
