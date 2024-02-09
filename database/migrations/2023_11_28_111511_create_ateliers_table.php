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
        Schema::create('ateliers', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string("libelle");
            $table->string("usine");
            $table->integer("cadenceLigne");
            $table->integer("cadenceJournaliere");
            $table->integer("nbre_quart_default");
            $table->integer("nbre_ligne");
            $table->integer("nbre_heure");
            $table->decimal("TRGObjectif");
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ateliers');
    }
};
