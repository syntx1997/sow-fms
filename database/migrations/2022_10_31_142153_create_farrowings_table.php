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
        Schema::create('farrowings', function (Blueprint $table) {
            $table->id();
            $table->string('litter_no');
            $table->date('actual_date');
            $table->string('status');
            $table->integer('weight');
            $table->string('foster');
            $table->string('sow');
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
        Schema::dropIfExists('farrowings');
    }
};
