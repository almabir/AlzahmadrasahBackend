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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // Links to students table
            $table->string('fee_type'); // Example: Admission Fee, Monthly Fee, Exam Fee, Library Fee, etc.
            $table->decimal('amount', 10, 2); // Fee amount
            $table->enum('payment_status', ['pending', 'paid'])->default('pending'); // Payment status
            $table->date('due_date')->nullable(); // Due date for payment
            $table->date('payment_date')->nullable(); // Actual payment date (if paid)
            $table->string('payment_method')->nullable(); // Example: Cash, Visa, Bank Transfer, Mobile Banking
            $table->string('transaction_id')->nullable(); // For online payments
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
