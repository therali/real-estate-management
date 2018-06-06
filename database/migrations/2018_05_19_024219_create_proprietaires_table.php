<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProprietairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prenom');
            $table->string('nom');
            $table->string('tel1');
            $table->string('tel2')->nullable();
            $table->string('email')->nullable();
            $table->string('cp')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('proprietaires');
    }
}
