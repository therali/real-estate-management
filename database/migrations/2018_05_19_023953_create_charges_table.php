<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libelle');
            $table->integer( 'montant' );
            $table->date( 'date_acq' );
            $table->tinyInteger( 'mode_pay' );
            $table->tinyInteger( 'result_comptable' );
            $table->longText( 'note' )->nullable();

            $table->unsignedInteger('type_charge_id')->index();
            $table->foreign('type_charge_id')->references('id')->on('type_charges');

            $table->unsignedInteger('local_id')->index();
            $table->foreign('local_id')->references('id')->on('locals');

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
        Schema::dropIfExists('charges');
    }
}
