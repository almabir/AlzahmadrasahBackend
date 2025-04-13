<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary(); // Unique key for the settings
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable(); // Path to the logo image
            $table->string('feature_image_1')->nullable(); // Path to feature image 1
            $table->string('feature_image_2')->nullable(); // Path to feature image 2
            $table->string('feature_image_3')->nullable(); // Path to feature image 3
            $table->timestamps();
        });

        // Insert a default record
        DB::table('settings')->insert([
            'key' => 'settings',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
}