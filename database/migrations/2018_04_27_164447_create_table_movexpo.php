<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMovexpo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mov_expo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folexpo'); 
            $table->datetime('fechahora');
            $table->time('hora');
            $table->date('ftc');
            $table->string('cnombre'); 
            $table->string('capellidop');
            $table->string('capellidom'); 
            $table->string('clada'); 
            $table->string('ctelefono'); 
            $table->string('cext'); 
            $table->string('ctipotel'); 
            $table->string('cmail'); 
            $table->string('cid_destin'); 
            $table->string('destino'); 
            $table->integer('nid_depto');
            $table->integer('nid_area');
            $table->date('fsalida');
            $table->integer('numpax');
            $table->text('observa');
            $table->float('totpaquete');
            $table->string('moneda'); 
            $table->float('impteapag');
            $table->string('monedap'); 
            $table->string('letras');  
            $table->float('tc');
            $table->string('cid_emplea'); 
            $table->string('ciniciales'); 
            $table->string('nvendedor'); 
            $table->string('mailejec'); 
            $table->string('status'); 
            $table->string('motivocanc');  
            $table->string('quiencancela'); 
            $table->string('cid_cotiza'); 
            $table->string('cid_expedi'); 
            $table->string('baja');
            $table->date('tproceso');
            $table->date('fecha');
            $table->string('aplic');
            $table->integer('archivo');
            $table->string('lamm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mov_expo');
    }
}
