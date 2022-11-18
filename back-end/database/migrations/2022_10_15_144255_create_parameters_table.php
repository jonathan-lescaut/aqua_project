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
        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('c°', 4, 2);
            $table->decimal('ph', 4, 2);
            $table->decimal('kh', 4, 2);
            $table->decimal('gh', 4, 2);
            $table->decimal('no2', 4, 2);
            $table->decimal('no3', 4, 2);
            $table->timestamps();
            $table->foreign('id')
            ->references('id')
            ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
};
