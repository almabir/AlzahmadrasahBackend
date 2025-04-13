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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Page Title
            $table->string('slug')->unique();  // URL slug
            $table->text('content')->nullable();  // Page Content (can be JSON for flexibility)
            $table->string('meta_title')->nullable();  // SEO Title
            $table->string('meta_description')->nullable();  // SEO Description
            $table->string('meta_keywords')->nullable();  // SEO Keywords
            $table->boolean('status')->default(1);  // 1 = Active, 0 = Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
