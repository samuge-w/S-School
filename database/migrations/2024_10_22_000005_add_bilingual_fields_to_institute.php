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
        Schema::table('institute', function (Blueprint $table) {
            $table->text('vision_en')->nullable()->after('address');
            $table->text('vision_pt')->nullable()->after('vision_en');
            $table->text('mission_en')->nullable()->after('vision_pt');
            $table->text('mission_pt')->nullable()->after('mission_en');
            $table->string('motto_en')->nullable()->after('mission_pt');
            $table->string('motto_pt')->nullable()->after('motto_en');
            $table->string('alternate_name_en')->nullable()->after('name');
            $table->string('alternate_name_pt')->nullable()->after('alternate_name_en');
            $table->string('nuit')->nullable()->after('motto_pt');
            $table->string('facebook')->nullable()->after('nuit');
            $table->string('logo')->default('beira-unida-logo.png')->after('facebook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institute', function (Blueprint $table) {
            $table->dropColumn([
                'vision_en', 'vision_pt', 'mission_en', 'mission_pt',
                'motto_en', 'motto_pt', 'alternate_name_en', 'alternate_name_pt',
                'nuit', 'facebook', 'logo'
            ]);
        });
    }
};




