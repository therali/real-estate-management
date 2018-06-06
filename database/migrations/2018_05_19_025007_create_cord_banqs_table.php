<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCordBanqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cord_banqs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('format');
            $table->string('titulaire');
            $table->integer('num_compte')->nullable();
            $table->string('name_banq')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic_swift')->nullable();

            $table->unsignedInteger('proprietaire_id')->index();
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires');

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
        Schema::dropIfExists('cord_banqs');
    }
}
