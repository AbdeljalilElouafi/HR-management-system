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
        Schema::create('career_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); // Employee ID
            $table->string('type'); // Type of change (e.g., promotion, role change, department transfer)
            $table->string('title')->nullable(); // New title or role
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null'); // New department
            $table->decimal('salary', 10, 2)->nullable(); // New salary (if applicable)
            $table->date('change_date'); // Date of the change
            $table->text('description')->nullable(); // Additional details
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_changes');
    }
};
