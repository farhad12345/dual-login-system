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
        Schema::create('wahaj_watan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->string('record_number');
            $table->string('license_number');
            $table->string('origin_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('service');
            $table->string('site_link');
            $table->string('property_type');
            $table->decimal('area', 10, 2); // For area dimensions
            $table->decimal('height', 10, 2);
            $table->decimal('width', 10, 2);
            $table->integer('number_of_floors');
            $table->string('state');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('street');
            $table->string('document')->nullable(); // For file uploads
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wahaj_watan_details');
    }
};
