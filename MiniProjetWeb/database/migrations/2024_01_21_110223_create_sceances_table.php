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
        Schema::create('sceances', function (Blueprint $table) {
            $table->id();
            $table->string('etat_sceance');
            $table->string('type_sceance');
            $table->integer('horaire');
            $table->integer('jour');
            $table->integer('semaine');
            $table->integer('mois');
            $table->integer('annee');
            $table->foreignId('id_class')->nullable()->constrained('classes');
            $table->foreignId('id_cours')->nullable()->constrained('cours');
            $table->foreignId('id_salle')->constrained('salles');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sceances');
    }
};
