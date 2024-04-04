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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('rol')->nullable();
            $table->string('avatar')->nullable();
            $table->string('image_cover')->nullable();
            $table->string('name')->nullable();
            $table->string('paternal_surname',)->nullable();
            $table->string('maternal_surname',)->nullable();
            $table->date('date_birthday');
            $table->string('phone_number',)->nullable();
            $table->string('sex',)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('token', 255)->nullable();
            $table->string('refresh_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
