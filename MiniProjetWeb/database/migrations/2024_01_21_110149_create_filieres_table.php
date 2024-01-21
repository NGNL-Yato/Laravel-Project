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
        Schema::create('filieres', function (Blueprint $table) {
            $table->id();
            $table->string('nom_filiere');
            $table->string('abreviation_nomfiliere');
            $table->foreignId('id_departement')->constrained('departements');
            $table->foreignId('id_formation')->constrained('formations');
            $table->foreignId('id_prof')->constrained('professeurs');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filieres');
    }
};
