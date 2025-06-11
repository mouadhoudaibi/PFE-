<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->string('bac_file')->nullable()->after('group_id');
            $table->string('releve_file')->nullable()->after('bac_file');
        });
    }

    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
            $table->dropColumn('bac_file');
            $table->dropColumn('releve_file');
        });
    }
};
