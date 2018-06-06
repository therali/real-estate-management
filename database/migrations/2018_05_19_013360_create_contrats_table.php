<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer( 'code' );
            $table->date('date_in');
            $table->date('date_out')->nullable();
            $table->integer('depot_gar')->nullable();;
            $table->date('date_pay')->nullable();;
            $table->tinyInteger('mode_pay')->nullable();;
            $table->integer('loyer_nu');
            $table->tinyInteger('periodicite');
            $table->string('etat');
            $table->longText('note')->nullable();

            $table->unsignedInteger('locataire_id')->index();
            $table->foreign('locataire_id')->references('id')->on('locataires');

            $table->unsignedInteger('local_id')->index();
            $table->foreign('local_id')->references('id')->on('locals');

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
        Schema::dropIfExists('contrats');
    }
}
