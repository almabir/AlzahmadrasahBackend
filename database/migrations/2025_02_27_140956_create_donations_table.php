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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_area_id')->constrained('donationareas'); // Foreign key to donation_areas table
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->string('donor_mobile')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('address')->nullable();
            $table->string('payment_gateway');
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
