<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('age');
            $table->text('address');
            $table->string('telephone');
            $table->unsignedBigInteger('lc_number')->nullable();
            $table->timestamp('date_of_joined')->nullable();
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'MemberSeeder'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
