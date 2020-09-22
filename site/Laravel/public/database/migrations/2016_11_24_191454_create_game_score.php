<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamescore', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Siege_Spieler_1')->nullable();
            $table->integer('Unentschieden')->nullable();
            $table->integer('Siege_Spieler_2')->nullable();
            $table->integer('Gesamte_Spiele')->nullable();
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
        Schema::dropIfExists('gamescore');
    }
}
