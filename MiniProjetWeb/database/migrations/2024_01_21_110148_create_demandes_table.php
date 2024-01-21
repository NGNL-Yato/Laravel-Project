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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('type_demande');
            $table->foreignId('id_user')->constrained('users');
            $table->string('etat_demande');
            $table->unsignedBigInteger('id_prof'); // Ensure the data type matches the primary key in 'professeurs'
            $table->foreign('id_prof')->references('id')->on('professeurs'); // Reference the 'id' column in 'professeurs'
            $table->timestamps();
        });
        
          
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
