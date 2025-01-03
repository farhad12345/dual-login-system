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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('service_required');
            $table->date('start_date');
            $table->date('completion_date')->nullable();
            $table->enum('status', ['started', 'in_progress', 'completed']);
            $table->string('document');
            $table->string(column: 'city');
            $table->string('commertial_register');
            $table->string('person_name');
            $table->string('person_contact');
            $table->string('service_type');
            $table->string(column: 'days');
            $table->string(column: 'email');
            $table->string(column: 'ministry');
            $table->string('business_type');
            $table->string('type');
            $table->string('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
