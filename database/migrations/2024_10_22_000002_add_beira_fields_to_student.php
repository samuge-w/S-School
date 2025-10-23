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
        $needsFamilyId = !Schema::hasColumn('Student', 'family_id');
        $needsGuardianName = !Schema::hasColumn('Student', 'guardian_name');
        $needsGuardianContact = !Schema::hasColumn('Student', 'guardian_contact');
        $needsChurchCommunity = !Schema::hasColumn('Student', 'church_community');

        if ($needsFamilyId || $needsGuardianName || $needsGuardianContact || $needsChurchCommunity) {
            Schema::table('Student', function (Blueprint $table) use ($needsFamilyId, $needsGuardianName, $needsGuardianContact, $needsChurchCommunity) {
                if ($needsFamilyId) {
                    $table->string('family_id')->nullable()->after('regiNo');
                }
                if ($needsGuardianName) {
                    $table->string('guardian_name')->nullable()->after('parmanentAddress');
                }
                if ($needsGuardianContact) {
                    $table->string('guardian_contact')->nullable()->after('guardian_name');
                }
                if ($needsChurchCommunity) {
                    $table->string('church_community')->nullable()->after('guardian_contact');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Student', function (Blueprint $table) {
            if (Schema::hasColumn('Student', 'family_id')) {
                $table->dropColumn('family_id');
            }
            if (Schema::hasColumn('Student', 'guardian_name')) {
                $table->dropColumn('guardian_name');
            }
            if (Schema::hasColumn('Student', 'guardian_contact')) {
                $table->dropColumn('guardian_contact');
            }
            if (Schema::hasColumn('Student', 'church_community')) {
                $table->dropColumn('church_community');
            }
        });
    }
};

