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
        // Drop the imagesa table if it exists
        Schema::dropIfExists('imagesa');
        Schema::dropIfExists('images');

        // Create the generes table
        Schema::create('generes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the generes table
        Schema::dropIfExists('generes');
    }
};