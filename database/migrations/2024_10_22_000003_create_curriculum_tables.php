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
        // Create curriculums table
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Create curriculum_subjects table
        Schema::create('curriculum_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained('curriculums')->onDelete('cascade');
            $table->string('subject_name');
            $table->json('grade_levels'); // Array of grades this subject applies to
            $table->timestamps();
        });

        // Add curriculum_id to Subject table
        Schema::table('Subject', function (Blueprint $table) {
            $table->foreignId('curriculum_id')->nullable()->after('class')->constrained('curriculums')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Subject', function (Blueprint $table) {
            $table->dropForeign(['curriculum_id']);
            $table->dropColumn('curriculum_id');
        });
        
        Schema::dropIfExists('curriculum_subjects');
        Schema::dropIfExists('curriculums');
    }
};




