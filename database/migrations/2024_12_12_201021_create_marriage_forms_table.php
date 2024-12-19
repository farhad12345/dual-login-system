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
        Schema::create('marriage_forms', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('fathers_name');
            $table->string('grandfathers_name');
            $table->string('thing');
            $table->string('village');
            $table->date('event_date');
            $table->date('today_date');
            $table->string('city_of_occassion');
            $table->string('hall');
            $table->string('her_address');
            $table->string('brides_fathers_name');
            $table->string('her_village');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marriage_forms');
    }
};
