<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->after('id_prof'); // Add this line
            $table->foreign('id_user')->references('id')->on('users'); // Add this line
        });
    }
    
    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropForeign(['id_user']); // Add this line
            $table->dropColumn('id_user'); // Add this line
        });
    }
};
