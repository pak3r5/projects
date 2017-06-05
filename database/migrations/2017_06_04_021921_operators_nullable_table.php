<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperatorsNullableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $platform = DB::getDoctrineConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('operators', function (Blueprint $table) {
            $table->string('street',64)->nullable()->change();
            $table->string('colony',64)->nullable()->change();
            $table->string('city',64)->nullable()->change();
            $table->string('state',64)->nullable()->change();
            $table->string('country',32)->nullable()->change();
            $table->string('cp',5)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
