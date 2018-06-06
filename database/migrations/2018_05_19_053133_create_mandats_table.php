<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandats', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dd');
            $table->date('df')->nullable();
            $table->integer('loyer_nu');
            $table->integer('periodicite');
            $table->tinyInteger('etat');
            $table->tinyInteger('charge_ded')->nullable();
            $table->longText('note')->nullable();

            $table->unsignedInteger('local_id')->index();
            $table->foreign('local_id')->references('id')->on('locals');

            $table->unsignedInteger('proprietaire_id')->index();
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires');

            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('mandats');
    }
}
