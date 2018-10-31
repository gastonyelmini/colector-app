<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDnisTable extends Migration
{
    public function up()
    {
        Schema::create('dnis', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('dni');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dnis');
    }
}
