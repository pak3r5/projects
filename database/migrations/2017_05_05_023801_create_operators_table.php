<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperatorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('rfc',13);
            $table->string('name',64);
            $table->enum('type',['Cliente','Contratista', 'Financiera', 'Proveedor', 'Socio']);
            $table->string('street',64);
            $table->string('colony',64);
            $table->string('city',64);
            $table->string('state',64);
            $table->string('cp',5);
            $table->string('country',32);
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
        Schema::drop('operators');
    }
}
