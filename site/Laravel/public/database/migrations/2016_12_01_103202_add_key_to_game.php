<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyToGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {

            $table->foreign('Spieler_1')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('Spieler_2')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('gamescore')
                ->references('id')->on('gamescore')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            Schema::drop('games');
        });
    }
}
