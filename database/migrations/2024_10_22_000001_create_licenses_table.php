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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_key')->unique();
            $table->enum('type', ['monthly', 'yearly', '2year', 'lifetime'])->default('yearly');
            $table->date('issued_date');
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['active', 'expired', 'suspended'])->default('active');
            $table->string('school_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};




