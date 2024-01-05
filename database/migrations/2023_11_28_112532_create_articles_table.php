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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("article")->unique();
            $table->string("designation");
            $table->string("category");
            $table->string("marque");
            $table->string("saveur");
            $table->string("unite")->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger("atelier_id")->nullable();
            $table->foreign("atelier_id")->references("id")->on("ateliers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};