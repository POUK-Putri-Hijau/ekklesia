<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->mediumIncrements('id')->primary();
            $table->string('name', 70);
            $table->date('birth_date');
            $table->string('address', 256);
            $table->mediumInteger('family_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('family_id')
                ->references('id')
                ->on('families')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
