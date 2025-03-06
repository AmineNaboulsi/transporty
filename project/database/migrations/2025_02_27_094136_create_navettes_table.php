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
        Schema::create('navettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("campany_id")->constrained('campanys')->onDelete('cascade');;
            $table->string('nom');
            $table->float('price');
            $table->date('date_navette');
            $table->string('description');
            $table->string('type_vehicule');
            $table->integer('places_disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navettes');
    }
};
