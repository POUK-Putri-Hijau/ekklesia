<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('accounts')->insert([
            'name' => 'Admin Ekklesia',
            'email' => 'admin@default.email',
            'password' => password_hash('P4$$word.', PASSWORD_ARGON2ID,  [
                'memory_cost' => 65536,
                'time_cost' => 3,
                'threads' => 4,
            ]),
            'role' => 'admin'
        ]);
    }

    public function down(): void
    {
        DB::table('accounts')
            ->where('email', 'admin@default.email')
            ->delete();
    }
};
