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
        Schema::create('mawayeed_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('invitation_name')->nullable();
            $table->string('occasion')->nullable();
            $table->string('day')->nullable();
            $table->date('date')->nullable();
            $table->enum('status', ['started', 'in_progress', 'completed'])->nullable();
            $table->string('time')->nullable();
            $table->string(column: 'city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mawayeed_details');
    }
};
