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
       Schema::table('navettes', function (Blueprint $table) {
          $table->foreignId('city_start')->constrained('citys')->onDelete('cascade');;
          $table->foreignId('city_arrive')->constrained('citys')->onDelete('cascade');;
          $table->time('time_start');
          $table->time('time_end');
       });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
       Schema::table('navettes', function (Blueprint $table) {
          $table->dropForeign('navettes_city_start_foreign');
          $table->dropForeign('navettes_city_arrive_foreign');
          $table->dropColumn(['city_start', 'city_arrive', 'time_start', 'time_end']);
       });
    }
};
