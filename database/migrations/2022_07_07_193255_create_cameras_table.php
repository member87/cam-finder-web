<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
          $table->id();
          $table->string("ip");
          $table->string("port");
          $table->integer("count");
          $table->string("source");
          $table->string("city");
          $table->string("country");
          $table->string("code");
          $table->string("lat");
          $table->string("long");
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
        Schema::dropIfExists('cameras');
    }
};
