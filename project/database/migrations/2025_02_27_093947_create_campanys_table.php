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
        Schema::create('campanys', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanys');
    }
};
