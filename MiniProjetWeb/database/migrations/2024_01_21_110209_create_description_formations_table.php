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
        Schema::create('description_formations', function (Blueprint $table) {
            $table->id();
            $table->text('objectif_text');
            $table->text('competence_debouche');
            $table->foreignId('id_filiere')->constrained('filieres');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_formations');
    }
};
