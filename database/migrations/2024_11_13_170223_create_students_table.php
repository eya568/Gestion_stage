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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('cin');
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('classe_id')->constrained()->onDelete('cascade');  // This creates a foreign key relationship with the classes table
            $table->timestamps();
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }

};