<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'locals', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'libelle' );
            $table->string( 'adress' );
            $table->tinyInteger( 'meuble' )->default( 0 );
            $table->longText( 'note' )->nullable();
            $table->float( 'surface' )->nullable();
            $table->integer( 'nbpiece' )->nullable();

            $table->unsignedInteger( 'category_id' )->index()->nullable();
            $table->foreign( 'category_id' )->references( 'id' )->on( 'categories' );

            $table->unsignedInteger( 'user_id' )->index()->nullable();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'locals' );
    }
}
