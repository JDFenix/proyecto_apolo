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
        Schema::create('user_advisories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id');
            $table->foreignId('advisory_id');
            
            $table->foreign('students_id')->references('id')->on('students');
            $table->foreign('advisory_id')->references('id')->on('advisory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_advisories');
    }
};
