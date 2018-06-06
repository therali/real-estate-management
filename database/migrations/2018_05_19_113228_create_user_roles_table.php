<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger( 'user_id' )->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->unsignedInteger( 'menu_id' )->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');;
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
        Schema::dropIfExists('user_roles');
    }
}
