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
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('origin')->nullable();
            $table->string('service_required')->nullable();
            $table->date('start_date')->nullable();
            $table->enum('status', ['started', 'in_progress', 'completed'])->nullable();
            $table->string('property_type')->nullable();
            $table->string(column: 'area')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('no_of_floors')->nullable();
            $table->string('state')->nullable();
            $table->string(column: 'city')->nullable();
            $table->string(column: 'neighborhood')->nullable();
            $table->string(column: 'street')->nullable();
            $table->string('business_type')->nullable();
            $table->string('type')->nullable();
            $table->string('reason')->nullable();
            $table->string('country')->nullable();
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
