<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW vw_family_total_members AS
            SELECT
                f.id AS family_id,
                f.name AS family_name,
                COUNT(m.id) AS total_members
            FROM
                families f
            LEFT JOIN
                members m ON f.id = m.family_id
            GROUP BY
                f.id, f.name;
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('vw_family_total_members');
    }
};
