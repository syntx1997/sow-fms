<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_d31_d70', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pig_id');
            $table->string('day');
            $table->time('time');
            $table->string('feed_amount');
            $table->string('feed_type');
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
        Schema::dropIfExists('bg_d31_d70');
    }
};
