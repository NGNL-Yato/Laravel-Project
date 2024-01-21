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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('visibilite_annonce');
            $table->string('cible_annonce');
            $table->string('type_annonce');
            $table->string('titre_annonce');
            $table->dateTime('date_creation');
            $table->dateTime('date_modification')->nullable();
            $table->text('contenu_annonce');
            $table->foreignId('id_class')->constrained('classes')->nullable();
            $table->foreignId('id_user')->constrained('users');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
