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
        Schema::create('sub_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade'); // Foreign key to pages
            $table->string('title'); // SubPage Title
            $table->text('description')->nullable(); // SubPage Description
            $table->string('thumbnail')->nullable(); // Thumbnail Image URL
            $table->string('slug')->unique(); // URL slug for subpage
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_pages');
    }
};
