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
        Schema::create('production_jours', function (Blueprint $table) {
            $table->id();
            $table->decimal("qtyProd");
            $table->integer("nbreQuarts");
            $table->decimal("TRGjour")->nullable();
            $table->string("usine")->nullable();
            $table->string("observation")->nullable();
            $table->date("dateProd")->nullable();
            $table->string("unite")->nullable();
            $table->unsignedBigInteger("atelier_id")->nullable();
            $table->foreign("atelier_id")->references("id")->on("ateliers")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_jours');
    }
};
