<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 50)->unique();
            $table->integer('Spieler_1')->unsigned();
            $table->string('Choice_Spieler_1', 50)->nullable();
            $table->integer('Spieler_2')->unsigned()->nullable();
            $table->string('Choice_Spieler_2', 50)->nullable();
            $table->integer('gamescore')->unsigned()->nullable();
            $table->string('Winner', 50)->nullable();
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
        Schema::drop('games');
    }
}
