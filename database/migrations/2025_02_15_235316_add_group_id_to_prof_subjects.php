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
        Schema::table('prof_subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('prof_subjects', 'group_id')) {
                $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prof_subjects', function (Blueprint $table) {
            if (Schema::hasColumn('prof_subjects', 'group_id')) {
                $table->dropForeign(['group_id']);
                $table->dropColumn('group_id');
            }
        });
    }
};
