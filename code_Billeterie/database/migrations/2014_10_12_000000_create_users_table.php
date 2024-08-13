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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('datenaiss')->nullable();
          //  entreprise,adresse,ville
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('entreprise')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('indicatiftel')->nullable();
            $table->string('telephone');
            $table->string('sexe')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
