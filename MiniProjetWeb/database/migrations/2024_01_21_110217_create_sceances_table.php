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
            $table->foreignId('id_class')->constrained('classes');
            $table->foreignId('id_module')->constrained('modules');
            $table->string('mois');
            $table->integer('semaine');
            $table->foreignId('id_horaire')->constrained('horaires');
            $table->foreignId('id_jour')->constrained('jours');
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
