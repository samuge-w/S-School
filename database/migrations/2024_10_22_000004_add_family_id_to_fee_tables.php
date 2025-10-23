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
        // Add family_id to fee collection table
        if (Schema::hasTable('feeCollection')) {
            Schema::table('feeCollection', function (Blueprint $table) {
                $table->string('family_id')->nullable()->after('regiNo');
            });
        }

        // Add family_id to fee due table
        if (Schema::hasTable('feeDue')) {
            Schema::table('feeDue', function (Blueprint $table) {
                $table->string('family_id')->nullable()->after('regiNo');
            });
        }

        // Add family_id to family_vouchar table
        if (Schema::hasTable('family_vouchar')) {
            Schema::table('family_vouchar', function (Blueprint $table) {
                if (!Schema::hasColumn('family_vouchar', 'family_id')) {
                    $table->string('family_id')->nullable()->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('feeCollection')) {
            Schema::table('feeCollection', function (Blueprint $table) {
                $table->dropColumn('family_id');
            });
        }

        if (Schema::hasTable('feeDue')) {
            Schema::table('feeDue', function (Blueprint $table) {
                $table->dropColumn('family_id');
            });
        }
    }
};




