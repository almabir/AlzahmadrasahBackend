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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('probashi', ['yes', 'no']);
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('nid_number')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('occupation')->nullable();
            $table->string('volunteer_for')->nullable();
            $table->string('special_skill')->nullable();
            $table->string('permanent_district')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('present_district')->nullable();
            $table->text('present_address')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
