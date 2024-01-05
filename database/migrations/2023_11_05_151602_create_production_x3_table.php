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
        Schema::create('production_x3', function (Blueprint $table) {
            $table->id();
            $table->string('numSuivi');
            $table->string('article');
            $table->decimal('qty')->nallable();
            $table->string('unite');
            $table->string('usine')->nullable();
            $table->date('DateProd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_x3');
    }
};
