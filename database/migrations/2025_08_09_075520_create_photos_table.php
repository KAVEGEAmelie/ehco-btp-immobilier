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
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bien_immobilier_id')->constrained()->onDelete('cascade');
        $table->string('chemin'); // Renommé de chemin_image à chemin
        $table->string('alt_text')->nullable();
        $table->integer('ordre')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
