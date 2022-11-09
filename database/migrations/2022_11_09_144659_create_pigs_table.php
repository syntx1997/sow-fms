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
        Schema::create('pigs', function (Blueprint $table) {
            $table->id();
            $table->string('pig_no');
            $table->string('breed');
            $table->date('date_born');
            $table->string('origin');
            $table->string('dam');
            $table->date('date_procured');
            $table->string('sire');
            $table->string('type');
            $table->string('photo')->default('no-img.png')->nullable();
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
        Schema::dropIfExists('pigs');
    }
};
