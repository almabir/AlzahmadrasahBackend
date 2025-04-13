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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_type');
            $table->string('name');
            $table->string('fathers_name')->nullable();
            $table->boolean('probashi')->default(false);
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('reference')->nullable();
            $table->text('address');
            $table->string('donation_payment_method');
            $table->string('transaction_id')->nullable(); // For website payments
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
