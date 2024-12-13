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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('genere_id')->default(1); // Afegim el camp genere_id
            $table->string('image_path');
            $table->string('description')->nullable();
            $table->timestamps();
            //relacions
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('genere_id')->references('id')->on('generes')->onDelete('cascade'); // Afegim la relació amb la taula generes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['genere_id']); // Eliminem la relació amb la taula generes
        });
        Schema::dropIfExists('images');
    }
};