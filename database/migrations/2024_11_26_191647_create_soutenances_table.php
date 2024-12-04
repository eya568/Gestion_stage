<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoutenancesTable extends Migration
{
    public function up()
    {
        Schema::create('soutenances', function (Blueprint $table) {
            $table->id();
            $table->string('etudiant');
            $table->string('jury1');
            $table->string('jury2');
            $table->string('encadrant')->nullable();
            $table->string('societe')->nullable();
            $table->string('type')->nullable(); // Move 'type' to the desired position
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('classe', 100)->nullable();
            $table->string('salle')->nullable();
            $table->time('heure')->nullable();
            $table->date('date_soutenance')->nullable();
            $table->timestamps();
        });
    }
}
