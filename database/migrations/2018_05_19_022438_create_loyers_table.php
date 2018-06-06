<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('libelle');
            $table->date('dd');
            $table->date('df');
            $table->integer('montant');
            $table->date('echeance');
            $table->longText('msg_quittance')->nullable();
            $table->longText('note')->nullable();

            $table->unsignedInteger('contrat_id')->index();
            $table->foreign('contrat_id')->references('id')->on('contrats');
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
        Schema::dropIfExists('loyers');
    }
}
