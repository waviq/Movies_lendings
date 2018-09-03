<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LendingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('movie_id')->nullable();
            $table->unsignedInteger('member_id')->nullable();
            $table->timestamp('lending_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->unsignedBigInteger('lateness_charge')->nullable();
            $table->timestamps();
        });

        Schema::table('lending', function (Blueprint $table) {
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lending', function (Blueprint $table) {
            $table->dropForeign('lending_movie_id_foreign');
            $table->dropForeign('lending_member_id_foreign');
        });
        Schema::dropIfExists('lending');
    }
}
