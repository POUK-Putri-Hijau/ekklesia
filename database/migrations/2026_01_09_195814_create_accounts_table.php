<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->smallInteger('id', true)->primary();
            $table->string('name', 60);
            $table->string('email')->unique();
            $table->string('password', 128);
            $table->enum('role', ['admin', 'staff'])->default('staff');
            $table->timestamps();

            $table->index(['id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
