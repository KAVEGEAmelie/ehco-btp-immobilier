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
    Schema::create('bien_immobiliers', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->longText('description');
        $table->integer('surface');
        $table->decimal('prix', 10, 2);
        $table->string('ville');
        $table->string('adresse');
        $table->integer('nombre_pieces');
        $table->integer('nombre_chambres');
        $table->integer('nombre_sdb');
        $table->boolean('disponible')->default(true);
        $table->enum('statut', ['disponible', 'vendu', 'loue', 'reserve'])->default('disponible');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_immobiliers');
    }
};
