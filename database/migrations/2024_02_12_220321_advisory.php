<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advisory', function (Blueprint $table) {
            $table->id();
            $table->string('tittle')->nullable();
            $table->string('description')->nullable();
            $table->date('date');
            $table->time('time');
            $table->foreignId('teachers_id');
            $table->foreign('teachers_id')->references('id')->on('teachers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisory');
    }
};
